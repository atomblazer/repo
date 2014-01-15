<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Codeigniter-Twitter-Search-Library
 *
 * Search for tweets using search/streaming api
 *
 * by Elliott Landsborough - github.com/ElliottLandsborough
 */
class Twitterlib {

	var $terms;
	var $location;

	public function __construct()
	{
		ini_set('precision', 20); 
		$this->CI = & get_instance();
		$this->terms = array('GOOG','#google');//$this->get_terms();
		$this->location = "34.048639,-118.247910,5mi";
		$this->CI->load->library('twitteroauth');
	}

	
	public function get_terms($result=false)
	{
		//mongodb implementation
		return $result;
	}

	
	public function stream()
	{
		$user = $this->CI->config->item('user');
		$pass = $this->CI->config->item('pass');
		// check if user and pass are set
		if( !isset($user) || !isset($pass) || !$user || !$pass )
		{
			echo 'ERROR: Username or password not found.'.PHP_EOL;
		}
		else
		{
			// start an infinite loop for reconnection attempts
			while(1)
			{
				$fp = fsockopen("ssl://stream.twitter.com", 443, $errno, $errstr, 30); // has to be ssl
				if(!$fp)
				{
					echo $errstr.'('.$errno.')'.PHP_EOL;
				}
				else
				{
					// build request
					$trackstring=implode(',',$this->terms);
					$query_data = array('track' => $trackstring,'include_entities' => 'true');
					$request = "GET /1/statuses/filter.json?" . http_build_query($query_data) . " HTTP/1.1\r\n";
					$request .= "Host: stream.twitter.com\r\n";
					$request .= "Authorization: Basic " . base64_encode($user . ':' . $pass) . "\r\n\r\n";
					// write request
					fwrite($fp, $request);
					// set stream to non-blocking - research if this is really needed.
					// stream_set_blocking($fp, 0);
					while(!feof($fp))
					{

						$read   = array($fp);
						$write  = null;
						$except = null;

						// Select, wait up to 10 minutes for a tweet.
						// If no tweet, reconnect by retsarting loop.
						$res = stream_select($read, $write, $except, 600, 0);
						if ( ($res == false) || ($res == 0) )
						{
							break;
						}

						$json = fgets($fp);
						echo $json;
						$data = json_decode($json, true);
						if($data)
						{
							$this->process($data);
						}
					}
					fclose($fp);
					// sleep for ten seconds before reconnecting
					sleep(10);
				}
			}
		}
	}

	
	public function search($cachetime=null)
	{
		$consumer_token = $this->CI->config->item('consumer_token');
		$consumer_secret = $this->CI->config->item('consumer_secret');
		$access_token = $this->CI->config->item('access_token');
		$access_secret = $this->CI->config->item('access_secret');

		$connection = $this->CI->twitteroauth->create($consumer_token, $consumer_secret, $access_token, $access_secret);
		$content = $connection->get('account/verify_credentials');
		if(isset($content->errors))
		{
			foreach ($content->errors as $error)
			{
				echo $error->code.' '.$error->message.PHP_EOL;
			}
			die;
		}
		else
		{
			// if the number of minutes to cache has been set
			if($cachetime != null)
			{
				// load the memcache adapter
				$this->CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
			}
			// if we are not caching or if our cache has run out
			if( $cachetime == null || ! $content = $this->CI->cache->get('twitter-api-search') )
			{
				$query=implode('+OR+',$this->terms);
				$query_data = array('q' => $query, 'geocode' => $this->location, 'result_type' => 'recent', 'include_entities' => 'true','rpp' => 1,'result_type'=>'mixed');
				$url = 'https://api.twitter.com/1.1/search/tweets.json';
				$content=$connection->get($url,$query_data);
				// if we want to cache for an amount of time
				if($cachetime != null)
				{
					// cache the results
					$this->CI->cache->save('twitter-api-search', $content, $cachetime*60);
				}
			}
			// if we have new results
			if(isset($content))
			{
				if(isset($content->errors))
				{
					foreach ($content->errors as $error)
					{
						echo $error->code.' '.$error->message.PHP_EOL;
					}
					die;
				}
				if (isset($content->statuses))
				{
					foreach ($content->statuses as $tweet)
					{
						// process each tweet one at a time
						$this->process($tweet);
						//echo "<pre>"; print_r($tweet);
					}
				}
			}
		}
	}

	/**
	* Process the tweet data and record it in mysql.
	* Input: $data (array - output from api)
	*/
	public function process($data=null)
	{
		// if the tweet has an id, if the tweet does not already exist in db, if there is at least one hashtag
		if( ( ( is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) ) /*&& !$this->exists($data)*/ )
		{
			if($this->save($data))
			{
				echo 'Saved a tweet!'.PHP_EOL;
			}
		}
	}

	/**
	* Find out if the tweet has already been inserted into the db
	* input: $data (array) - array from api - needs to contain $data['id_str']
	* output: true/false
	*/
	/*
	function exists($data=null,$result=false)
	{
		if( ( is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) )
		{
			$this->CI->db->select('tweet_id');
			if(is_array($data))
			{
				$tweet_id=$data['id_str'];
			}
			else
			{
				$tweet_id=$data->id_str;
			}
			$this->CI->db->where('tweet_id',$tweet_id);
			$query=$this->CI->db->get('tweets',1,0);
			if($query->num_rows()>0)
			{
				$result=true;
			}
		}
		return $result;
	}*/

	/**
	* input: $data - array of a tweet returned from the twitter api
	* input: $data['id_str'], $data['user']['id_str'] OR data['id_str'], $data['from_user_id_str']
	* output: true/false
	*/
	function save($data=null,$result=false)
	{
		$this->CI->mongo_db->insert('tweets',(array) $data);
		return true;
		//mongodb implementation to save tweets

		/*
		// if we have a tweet with an ID
		if ( (is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) )
		{
			if( is_array($data) && isset($data['user']['id_str']) )
			{ // if we are dealing with streaming api
				$user_id=$data['user']['id_str'];
				$tweet_id=$data['id_str'];
			}
			else if ( is_array($data) && isset($data['from_user_id_str']) )
			{ // if we are dealing with search api
				$user_id=$data['from_user_id_str'];
				$tweet_id=$data['id_str'];
			}
			else if ( is_object($data) && isset($data->user->id_str) )
			{
				$user_id=$data->user->id_str;
				$tweet_id=$data->id_str;

			}
			// if we have detected a user id in the tweet array
			if( isset($user_id) )
			{
				// set input
				$input=array( 'tweet_id' =>  $tweet_id, 'user_id' => $user_id);
				// save tweet in db
				$result=$this->CI->db->insert('tweets',$input);
			}
		}
		return $result;*/
	}

}

/* End of file twitterlib.php */