<?php
class Users extends CI_Model {

	/*
	* Construct the User Model object
	* Include Mongo libarary
	* Change to test Database
	*/
	public function __construct(){
		parent::__construct();
		$this->load->library('Mongo_db');
		$this->mongo_db->switch_db('test');
		$this->load->helpers('email_helper');
		$this->load->helpers('file');
	}


	/*
	 * create_index
	* Input:	$keys = array of fields/keys, $options = array of
	* 			Mongodb Options
	* Post:	Adds indexes to tweets collection based on
	* 			- array of $keys where the KEY is the
	* 			Field and the Value is whether should be 'asc' or 'desc'
	* 			if left empty will default to 'asc'
	* 			- array of options are Mongodb Options for example:
	* 				'unique' => TRUE
	*/
	public function create_index()
	{
		$this->mongo_db->add_index('users',array("id" => "asc" ),array("unique" => TRUE));
			
	}

	/*
	 * create_user
	*
	* Input:	User Object: Usernanme, Password, Email, e
	* Output:	False if failed, nothing if passed;
	*
	* Pre:		Objects ready for addition to Tweets Collection
	* Post:	Obejcts saved in Tweets Collection
	*/

	public function create_user($user)
	{
		
			$secured = $this->users->salt_hash($user['password']);
			$user['password'] = $secured['password'];
			$user['salt'] = $secured['salt'];
			$this->mongo_db->insert('users',$user);
			return true;

	}

	/*
	 * Validate User
	 * 
	 * Input:  username & password
	 * Post: true or false user valid or not
	 */
	
	
	public function validate_user($user)
	{
		if(array_key_exists("username", $user) && array_key_exists("password", $user))
		{
			if (!isset($user["password"]) || !isset($user["username"]))
				return null;
				
			else
				if ($this->users->read_user($user['username'])!=null) 
				{
					if($this->users->validate_pass($user["username"], $user["password"])!=null)
						return true;
					else
						return false;
				}
		}
	}

public function validate_user_mobile($user)
	{
		
		$message="";
		if(array_key_exists("name", $user) && array_key_exists("password", $user))
		{
			if (!isset($user["password"]) || !isset($user["name"]))
			{

				$message = '{"message":"false","text":"Missing Username/Password! Please try again."}';
				return $message;
			}
			else
				if ($this->users->read_user($user['name'])!=null) 
				{
					if($this->users->validate_pass($user ["name"], $user["password"])!=null)
					{

						$message = '{"message":"true"}';
						return $message;
					}						//return json_encode(array("message"=>'true', "name"=>$user["username"]));
					else{
						$message = '{"message":"false","text":"Invalid Username/Password! Please try again."}';
						return $message;
					}
						//return json_encode(array("message"=>'false', "name"=>$user["username"]));
				}
		}
		$message = '{"message":"false","text":"Missing Username/Password! Please try again."}';
		return $message;
	}

	/*
	 * read_users
	*
	* Input:	None
	* Output:	False if Failed or array of all available
	* 			users
	* Pre & Post:No Change
	*/
	
	public function read_user($email)
	{
		$user = $this->mongo_db->get_where('users',array("username"=>$email));
		if (key_exists("0", $user))
		{
			return $user[0];
		}
		else
			return null;
	}
	
	public function read_users()
	{
		return $this->mongo_db->get('users');
	}

	/*
	 * read_user()
	 * 
	 * input: $userid
	 * post:  return a user
	 */


	/*
	 * update_user
	*
	* Input: Requires array, Key(field) => Value(value)
	* Post: Returns TRUE from library Mongo_db.php => update_all()
	*  NEED TO COMPLETE THIS!!!
	*/
	public function update_user($email, $new_data)
	{
		$user = read_user($email);
		if($user != null)
		{
			$this->mongo_db->update('users',$email,$new_data);
			return true;
		}
		else
			return null;
	}
	

	/*
	 * delete_user()
	 * Input: userId
	 * Post: Delete a User from the users Colection
	 */	
	public function delete_user($email)
	{
		$user = read_user($email);
		if($user != null)
		{
			$this->mongo_db->delete($email);
			return true;
		}
		else
			return null;	
	}

	/*
	 * delete_users_collection
	* Post:  Drops tweets table to start fresh
	*/
	public function delete_users_collection()
	{
		$this->mongo_db->drop_collection('users');
	}
	
	/*
	 * salt_sha ()
	 *
	 * Input password
	 * Post: return sum
	 */
	private function salt_hash($pass)
	{
		$salt = "";
		for ($i=0; $i<8; $i+=1) {
			$salt.=chr(rand(32,126));
		}
		$salted = substr($salt, 0, 4).$pass.substr($salt, 4, 8);
		$hashed = $salted;
		$timesRepeated = ord(substr($salted,2,3));
		for ($i=0; $i<$timesRepeated; $i+=1) {
			$hashed = hash('sha256',$hashed);
		}
		return array("password"=>$hashed, "salt"=>$salt);
	}

	/*
	 * new_pass()
	 * post: creates simple new password
	 */
	private function new_pass()
	{
		$newPass = '';
			for($i=0; $i<8; $i+=1)
			{
				$newPass.=chr(rand(32,126));
			}
			return $newPass;
	}
	
	/*
	 * reset_password
	 * 
	 * input: username
	 * output: calls new_pass and sends the value to user
	 * 		   via email.
	 */
	public function reset_password($username)
	{
		if(isset($username))
		{
			$user = $this->users->read_user($username);
			$user_name=array("username"=>$username,"password"=>$this->new_pass());
			$pass_word=array("password"=>$this->new_pass());
			$this->update_user($user_name,$pass_word);
			$message = "TwitterData New Temporary Password: ".$pass_word;
			if (array_key_exists("email", $user))
			{
				if (valid_email($address))
					send_email($user["email"],"TwitterData New Temporary Password",$message);	
			}
		}
		
		
	}
	
	public function validate_pass($email, $pass)
	{
		$user = $this->users->read_user($email);
		if($user != null)
		{
			$salt = $user['salt'];
			$salted = substr($salt, 0, 4).$pass.substr($salt, 4, 8);
			$timesRepeated = ord(substr($salted,2,3));
			for ($i=0; $i<$timesRepeated; $i+=1) {
				$salted = hash('sha256',$salted);
			}
			if($salted==$user['password'])
				return true;
		}
		else
			return null;
	}
	
}