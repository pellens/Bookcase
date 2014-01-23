<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	CORE
	
	Setting basic configurations for a website or pages
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gerardo.be>
	@copyright		Gert Pellens		<http://www.gerardo.be>

**/

class Users {

	var $name     = "";
	var $username = "";
	var $id       = "";
	var $email    = "";
	var $logged   = false;
	var $role     = "user";

	public function __construct($params = array())
	{

		$CI =& get_instance();
		$CI->load->database();
		
		if (!$CI->db->table_exists('users_roles'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"title" => array(
						"type" => "varchar",
						"constraint" => "300"
					)
			);

			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('users_roles',TRUE);
			
			unset($fields);
		}

		if (!$CI->db->table_exists('users'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"username" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"name" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"first_name" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"email" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"password" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"account_created"  => array(
							"type" => "int"
						),
				"last_login" => array(
							"type" => "int"
						),
				"facebook_id" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"google_id" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"role_id" => array(
							"type" => "int"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('users',TRUE);
			
			unset($fields);
		}

	}

	public function user_info($user_id)
	{
		$CI =& get_instance();
		$result = $CI->db->where("users.id",$user_id)->from("users")->join("users_roles","users_roles.id = users.role_id","left")->get()->result();
		return $result[0];
	}

	public function add_user($fields)
	{
		$CI =& get_instance();

		
	}

	public function login_form($view = true, $redirect = false)
	{

		$CI =& get_instance();

		// Because we are on this page, we need to listen here if the form is submitted
		if($_POST && $CI->input->post("type") == "login")
		{

			$fields["login"] = $CI->input->post("login",true);
			$fields["password"] = md5($CI->input->post("password",true));

			$login = $this->login($fields);

			if($login)
			{
				$_SESSION["user_id"] = $login["user_id"];
				$_SESSION["role"]    = $login["role"];

				$update["last_login"] = time();
				$CI->db->where("id",$login["user_id"])->update("users",$update);
				redirect("admin","refresh");
			}
			else
			{
				redirect(current_url()."?login_error=true");
			}
		}
		else
		{

			if(is_logged_in())
			{
				return false;
			}

			$fields[] = array("name"=>"login", "type"=>"text","label"=>trans("label_username_or_email"));
			$fields[] = array("name"=>"password", "type"=>"password","label"=>trans("label_password"));

			if($view)
			{
				$form = form_open();

				foreach($fields as $f):

					$form .= "<p><label for='".$f["name"]."'>".$f["label"]."</label><input type='".$f["type"]."' name='".$f["name"]."' id='".$f["name"]."'/></p>";

				endforeach;

				$form .= "<p><input type='hidden' value='login' name='type'/></p>";
				$form .= "<p><input type='submit' value='".trans("button_aanmelden")."'/></p>";
				$form .= form_close();

				return $form;
			}

			return $fields;
		}
	}

	public function login($fields = array())
	{
		$CI =& get_instance();

		if(count($fields)>0)
		{

			$number = $CI->db->where("username",$fields["login"])->or_where("email",$fields["login"])->where("password",$fields["password"])->count_all_results("users");

			if($number == 0)
			{
				return false;
			}
			else
			{
				$result = $CI->db->where("username",$fields["login"])->or_where("email",$fields["login"])->where("password",$fields["password"])->get("users")->result();
				$fields["user_id"] 	= $result[0]->id;
				$fields["role"] 	= $result[0]->role_id;
				return $fields;
			}
		}
	}

	public function users_overview($view = false)
	{

		$CI =& get_instance();

		$result = $CI->db->from("users")->join("users_roles","users.role_id = users_roles.id","left")->get()->result();

		if($view)
		{
			$output = "<table class='table table-bordered table-striped'>";
			foreach($result as $user):
				$output .= "<tr>";
				$output .= "<td>".$user->first_name." ".$user->name."</td>";
				$output .= "<td>".$user->email."</td>";
				$output .= "<td>".$user->title."</td>";
				$output .= "<td>".$user->last_login."</td>";
				$output .= "</tr>";
			endforeach;
			$output .= "</table>";

			return $output;
		}

		return $result;

	}

}

?>