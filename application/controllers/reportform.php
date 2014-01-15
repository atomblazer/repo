
<?php
class reportform extends CI_Controller {

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
		$regexObj = new MongoRegex($regexString);
		$results = $this->mongo_db->select(array("location"))->where_ne('location', null)->or_where(array('text'=>$regexObj))->get('tweets');

		foreach($results as $result) {
			 $lat = $result['location']['bounding_box']['coordinates']['0']['0']['1'];
			 $long = $result['location']['bounding_box']['coordinates']['0']['0']['0'];
			 $coordinates[] = array($lat, $long);
		}
		return $coordinates;
	
	}

	function index()
	{	$sentData= $this->test_db_search(array("flu", "fever"));
		$data=array("sentData"=>$sentData);
		$this->load->view('reports_view',$data);
	}
}

?>