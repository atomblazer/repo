<?php
class Sentiment_controller extends CI_Controller {
	 public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
		$this->config->load('twitter');
		$this->load->library('sentiment');
    	$this->CI = & get_instance();
    	$this->load->library('Mongo_db');
    	$this->load->model('Tweet_model', 'tweeter');
    }

    public function analyze() {
    	$tweets = $this->tweeter->search(array('text'), array("location" => null));
    	$counts = array(
            'neu' => 0,
            'pos' => 0,
            'neg' => 0,
        );

        foreach ($tweets as $tweet) {
            $tweet['sentiment'] = $this->sentiment->categorise($tweet['text']);
            $counts[$tweet['sentiment']]++;
            $this->mongo_db->where(array('_id' => $tweet['_id']))->set(array('sentiment' => $tweet['sentiment']))->update('tweets');
            //$this->results[] = $tweet;
       }
       //print_r($this->results);
       print_r($counts);
    }


}
?>