<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class frontend_controller extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
		$this->load->library('twitterlib');
		$this->config->load('twitter');
    	$this->CI = & get_instance();
    	$this->load->library('Mongo_db');
    	$this->load->library('Ctwitter_rest');
    	$this->load->library('Ctwitter_stream');
    	$this->load->model('Tweet_model', 'tweeter');
    	$this->load->model('users');
    	$this->load->library('session');

    }

	public function index() {$this->home();}

	public function home(){
		session_start();
		$this->load->helper('html');
		$this->load->helper('utility_helper');
		$this->load->library('javascript');
		$this->load->view('login_view');
		$this->load->helper('file');
	}
	
   public function start_search(){
		session_start();
		
		$searchterms = $this->search_terms_to_array($_POST['searchTerms']);
		$api_type = $_POST['apitype'];
		$stream_value = $_POST['stream_value'];
		$max_tweets =$_POST['max_tweets_stream'];
		$reportType =$_POST['reportType'];
		$search_id = $_POST['search_id'];   // THIS IS THE LINE
		if( $this->is_stream($api_type) ) {
			$this->stream_with_param($searchterms,$stream_value,null,$max_tweets,$search_id, $reportType);
		} else {
			$this->rest_with_param($searchterms);
		}

		// $searchterms = $this->search_terms_to_array('flu fever');
		// $stream_duration = 400000;
		
		// $this->stream_with_param($searchterms, $stream_duration);
		
		
		// $testdata['Terms']=$searchterms;
		// $this->load->view('submitformtest', $testdata);
   }
	
	public function stream_with_param(array $criteria=array('batman'), $duration=null, $geo =null, $count = null, $search_id=null, $reportType=null){
        $this->load->library('ctwitter_stream');

        $consumer_token = $this->config->item('consumer_token');
		$consumer_secret = $this->config->item('consumer_secret');
		$access_token = $this->config->item('access_token');
		$access_secret = $this->config->item('access_secret');

		// do not remove these raw settings til we have a kill switch
		// $count = 1000;
		// $duration = 300;
		
		/*
		$dataSFT['$Terms'] = $criteria;
		
		$stream = new Ctwitter_stream();
		$stream->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		$pid = pcntl_fork();
		if ($pid == -1) {
		     die('ERROR HAS OCCURRED BEEP BOOP');
		} else if ($pid) {
		     $this->load->view('submitformtest',$dataSFT);
		     pcntl_wait($status);
		} else {
			$stream->start($criteria, $duration,$geo,$count); //criteria
			$sent = $stream->get_sentiment_count();
			$pos = $sent['pos'];
			$neg = $sent['neg'];
			$neu = $sent['neu'];
			
			$tweet_count = $pos + $neg + $neu;
			$terms = implode(', ', $criteria);
			
			$data = array('neu' => $neu, 'pos' => $pos, 'neg' => $neg, 'count' => $tweet_count, 'terms' => $terms);
			$this->load->view('piechart_view', $data);
		}
		*/
		
        $stream = new Ctwitter_stream();
		$stream->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		$stream->start($criteria, $duration,$geo,$count,$search_id); //criteria
		$sent = $stream->get_sentiment_count();
		if($this->is_piechart($reportType)){
		$pos = $sent['pos'];
		$neg = $sent['neg'];
		$neu = $sent['neu'];

		$tweet_count = $pos + $neg + $neu;
		$terms = implode(', ', $criteria);
		
		$data = array('neu' => $neu, 'pos' => $pos, 'neg' => $neg, 'count' => $tweet_count, 'terms' => $terms);
		$this->load->view('piechart_view', $data);
		//print_r($stream->get_sentiment_count());
		}
		else{
			$this->load->view('reports_view');
		}
		
	}
	
	public function rest_with_param(array $criteria=array('batman'), $geo = null, $until=null, $count=null){
		$this->load->library('ctwitter_stream');

        $consumer_token = $this->config->item('consumer_token');
		$consumer_secret = $this->config->item('consumer_secret');
		$access_token = $this->config->item('access_token');
		$access_secret = $this->config->item('access_secret');

		//$count = 10;
		$rest = new Ctwitter_rest();
		//$geo="40.6700, 73.9400,1500mi";
		$rest->login($consumer_token, $consumer_secret, $access_token , $access_secret);
		$content = $rest->search_rest($criteria, $until,$geo,$count); //criteria		
		if (isset($content)){
			$this->tweeter->batch_insert($content);			
		}
	}
	

public function goto_usercreation(){
	
	$this->load->view('userCreation_view');

}

public function newuser(){

	$username = $this -> input -> post('name');
	$password = $this -> input -> post('password');
	if ( $this->users->create_user( array( "username" => $username, "password" => $password ) ) == null )
	{
		$data['err'] = '<strong>Either Username already exists or you did not enter a valid email!</strong> Please try again.';
		$this->load->view( 'userCreation_view' , $data );
	}
	else
	{
			$data['username']=$username;
			// $this->load->view('submitform_view',$data);
			$this->load->view('login_welcome_view',$data);

	}
			
}


public function validate_user(){
		
		$username = $this -> input -> post('name');
		$password = $this -> input -> post('password');
		$login_creds = array("username"=>$username,"password"=>$password);
		if($this->users->validate_user($login_creds)) {	//if correct

			$datas['username']=$username;
			$this->session->set_userdata('username',$username);
			$this->load->view('login_welcome_view',$datas);

		}
		else 
		{
			$data['err'] = '<strong>Invalid Username/Password!</strong> Please try again.';
			$this->load->view( 'login_view', $data);
		}
		
}

public function validate_user_mobile() {
	
	$handle = fopen("php://input","r");
	$jsonInput = fgets($handle);
	$creds = json_decode($jsonInput,true);
	$data['json'] = $this->users->validate_user_mobile($creds);
	$this->load->view('mobileresponse',$data);	

}

public function goto_search(){
		$this->load->view('submitform_view');
}

public function logout(){
	$this->session->sess_destroy();
	$this->home();

}

	public function is_stream($apitype) {
		if($apitype == "stream")
			return true;
		return false;
	}
	public function is_piechart($reportType) {
		if($reportType == "pieChart")
			return true;
		return false;
	}

	public function search_terms_to_array($terms) {
    	$array = explode(' ', $terms);
    	return $array;
	}
};
?>