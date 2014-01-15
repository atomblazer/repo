<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* A collection of functions to be run through command line only.

// omg this is a edit test
*/
class Parser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
        $this->load->library('twitterlib');
	$this->config->load('twitter');
    	$this->load->library('Mongo_db');
    	$this->load->model('Tweet_model', 'tweeter');

    }

    public function stream()
    {
        $this->load->library('ctwitter_stream');

        $consumer_token = $this->config->item('consumer_token');
		$consumer_secret = $this->config->item('consumer_secret');
		$access_token = $this->config->item('access_token');
		$access_secret = $this->config->item('access_secret');

        $stream = new Ctwitter_stream();
		$stream->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		
		$stream->start(array('batman')); //criteria
		
		
    }
	
	public function front_end_stream(){
		
		
	}
	 
	public function stream_with_param(array $criteria=array('batman'), $duration=null, $geo =null, $count = null){
        $this->load->library('ctwitter_stream');

        $consumer_token = $this->config->item('consumer_token');
		$consumer_secret = $this->config->item('consumer_secret');
		$access_token = $this->config->item('access_token');
		$access_secret = $this->config->item('access_secret');

		// do not remove these raw settings til we have a kill switch
		$count = 100;
		$duration = 10;
		
        $stream = new Ctwitter_stream();
		$stream->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		$tweets = $stream->start($criteria, $duration,$geo,$count); //criteria	
		$this->tweeter->batch_insert($tweets);
	}
	
	public function rest_with_param(array $criteria=array('batkid'), $geo = null, $until=null, $count=null){
		$this->load->library('ctwitter_stream');

        $consumer_token = $this->config->item('consumer_token');
		$consumer_secret = $this->config->item('consumer_secret');
		$access_token = $this->config->item('access_token');
		$access_secret = $this->config->item('access_secret');

		$count = 10;
		$rest = new Ctwitter_rest();

		$rest->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		$content = $rest->search_rest($criteria, $until,$geo,$count); //criteria

		if (isset($content->statuses))
			foreach ($content->statuses as $tweet)
				$this->tweeter->insert(array($tweet));
	}
	
	public function rest_test(){
		$this->rest_with_param(array('halloween'), "38.288787,-98.371582,15mi", '2013-10-29', 10);
	
	}
	

    public function search($cachetime=null)
    {
      	$this->twitterlib->search($cachetime);
    }

    public function geo_search($cachetime=null) {
    	$form_data = $this->input->post();
        // $this->twitterlib->terms = explode(',', $form_data['query']);
        // $this->twitterlib->location = $form_data['location'];
        $this->twitterlib->terms = array('nyancat', 'nyan');
        $this->twitterlib->location = "38.288787,-98.371582,15mi"; //Within 15mi of Kansas
        $this->search($cachetime);
    }

    public function test_test_db_search() {
    	$terms = array('epitome', 'knock');
    	$this->test_db_search($terms);
    }

    public function test_db_search($terms) {
		// $select = array("0.text");
		// $where = array("0.user.geo_enabled" => true );
		// $results = $this->tweeter->search($select, $where);
		$coordinates = array();
		$regexString = "/";
		foreach($terms as $term)
		{
			$regexString .= "(".$term.")|";
		}
		
		
		$regexString = substr($regexString, 0, -1);
		$regexString .= "/i";
		echo $regexString;
		$regexObj = new MongoRegex($regexString);
		$results = $this->mongo_db->select(array("location"))->where_ne('location', null)->or_where(array('text'=>$regexObj))->get('tweets');

		foreach($results as $result) {
			 $lat = $result['location']['bounding_box']['coordinates']['0']['0']['1'];
			 $long = $result['location']['bounding_box']['coordinates']['0']['0']['0'];
			 $coordinates[] = array($lat, $long);
		}
		return $coordinates;
	
	}

    public function test() {
        echo 'hello world'; break;
    	ini_set('memory_limit','10024M');
    	$tweeets = $this->mongo_db->get('tweets');
    	echo count($tweeets);
    	echo "<br>";

    	//$this->mongo_db->delete_all('tweets');
    	//echo "<pre>"; print_r($tweeets);

    }

    public function clear()
    {
    	$this->mongo_db->delete_all('tweets');
    }

}
?>
