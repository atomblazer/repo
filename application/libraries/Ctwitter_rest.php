<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ctwitter_rest
{
	
	private $m_oauth_consumer_key;
    private $m_oauth_consumer_secret;
    private $m_oauth_token;
    private $m_oauth_token_secret;

    private $m_oauth_nonce;
    private $m_oauth_signature;
    private $m_oauth_signature_method = 'HMAC-SHA1';
    private $m_oauth_timestamp;
    private $m_oauth_version = '1.0';
	

    public function __construct()
    {
        //
        // set a time limit to unlimited
        //
        $this->CI = & get_instance();
        set_time_limit(0);
    }
	
	public function login($_consumer_key, $_consumer_secret, $_token, $_token_secret)
    {
        $this->m_oauth_consumer_key     = $_consumer_key;
        $this->m_oauth_consumer_secret  = $_consumer_secret;
        $this->m_oauth_token            = $_token;
        $this->m_oauth_token_secret     = $_token_secret;

        //
        // generate a nonce; we're just using a random md5() hash here.
        //
        $this->m_oauth_nonce = md5(mt_rand());

        return true;
    }
	
	// Criteria Mutator
	public function set_param(array $terms, $geocode=NULL, $until=NULL, $count=NULL){
		$this->terms = $terms;
		$this->tweet_geocode = $geocode;
		$this->tweet_until = $until;
		$this->tweet_count = $count;
	}

	
	//
	//filter tweets by id,text,location
	//
	function filter_tweet($tweet){
		$text = $tweet->text;
		$id = $tweet->id_str;
		$location =$tweet->place;
		$date = $tweet->created_at;		
		$array = array("id"=>$id,"text"=>$text,"date"=>$date,"location"=>$location);
		return $array;		
	}
	
	// search the terms using twitter api
	function search_rest(array $terms, $geocode=NULL, $until=NULL, $count=NULL, $cachetime=null) {
		$tweets =array();
		
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
				$query=implode(' ',$terms);
				$query_data = array('q' => $query, 'geocode' => $geocode, 'count' => $count,'until' => $until, 'include_entities' => 'true','rpp' => 1);
				$url = 'https://api.twitter.com/1.1/search/tweets.json';
				$content=$connection->get($url,$query_data);
				// if we want to cache for an amount of time
				if($cachetime != null)
				{
					// cache the results
					$this->CI->cache->save('twitter-api-search', $content, $cachetime*60);
				}
			}
			
			if (isset($content->statuses)){
					foreach ($content->statuses as $tweet)
					{
						// process each tweet one at a time
						$tweet = $this->filter_tweet($tweet); //filter tweets
						$tweets[] = $tweet;
					}
				}				
			return $tweets;
			
			// if we have new results
			/* Moved to FrontEnd Controller
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
						$tweet = $this->filter_tweet($tweet); //filter tweets
						$this->load_tweet_to_database($tweet);
					}
				}
			} */
		}		
	}	
};