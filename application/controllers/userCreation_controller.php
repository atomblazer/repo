<?php
class userCreation_controller extends CI_Controller {
	function index()
	{
		$this->load->view('userCreation_view');
	}
	
	public function createUser(){
		$this->load->model('users');
		$username = $this -> input -> post('name');
		$password = $this -> input -> post('password');
		$re_pass = $this -> input -> post('re_pass');
		if ( $re_pass === $password)
		{
			$new_user = array("username"=>$username, "password"=>$password);
			
			if($this->users->create_user($new_user))
			{
				$this->load->view('loginv2');
		
			}

		}

		else
			$this->load->view('new_user_error');
			//front-end need to create this view. or we can pass a variable here
		    //that will populate the orignal create_user view only when error 
			//also you guys need to check in the controller=loginv2 if there is
			//a session with a username variable right?

	}
}