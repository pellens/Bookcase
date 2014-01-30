<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactform {

	var $CI;
	var $dev            = 1;
	var $full_tag_open  = "<div>";
	var $full_tag_close = "</div>";
	var $action         = "";
	var $form           = "basic";
	var $method         = "POST";
	var $submit_text    = "Submit form";
	var $subject        = "";
	var $row_open       = "<p>";
	var $row_close      = "</p>";
	
	var $spec_form      = "";
	
	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper("url");
		
		// SQL uitvoeren om de nodige databases aan te maken
		if (!$CI->db->table_exists('contactform_submitted'))
		{	
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_basicForm());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_submitted',TRUE);	
		}

		if(!$CI->db->table_exists('contactform_contacts'))
		{
			// Basis contacten systeem (adresboek)
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_contacts());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_contacts');
		}

		if(!$CI->db->table_exists('contactform_receivers'))
		{
			// Basis contacten systeem (adresboek)
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_receivers());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_receivers');
		}

		if(!$CI->db->table_exists('contactform_messages'))
		{
			// Basis contacten systeem (adresboek)
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_messages());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_messages');
		}
		
		if(!$CI->db->table_exists('contactform_forms'))
		{
			// Basis contactformulier inputs
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_forms());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_forms');
			
			$fields["name"]          = "basic";
			$fields["to"]            = "admin@thiswebsite.com";
			$fields["save_contact"]  = 1;
			$fields["save_submit"]   = 1;
			
			$CI->db->insert("contactform_forms",$fields);
			unset($fields);
		}
		
		if(!$CI->db->table_exists('contactform_fields'))
		{
			// Basis contactformulier inputs
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_fields());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_fields');
			
			$fields[] = array("form_id"=>1, "type"=> "text",     "label" => "Voornaam Naam", "value" => "name");
			$fields[] = array("form_id"=>1, "type"=> "text",     "label" => "E-mailadres",   "value" => "e-mail");
			$fields[] = array("form_id"=>1, "type"=> "text",     "label" => "Telefoon",      "value" => "tel");
			$fields[] = array("form_id"=>1, "type"=> "text",     "label" => "Onderwerp",     "value" => "subject");
			$fields[] = array("form_id"=>1, "type"=> "textarea", "label" => "Bericht",       "value" => "message");
			$fields[] = array("form_id"=>1, "type"=> "text",     "label" => "Website",       "value" => "website");
			
			foreach($fields as $field):
				$CI->db->insert("contactform_fields",$field);
			endforeach;
			
			unset($fields);
		}
		
		// Heeft men een form submitted?
		
		if($_POST && @$_POST["contactform_post"] == 1)
		{
			$this->_submitForm($_POST);
		}
		
		// Parameters voor form meegegeven?
		
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
	
	}
	
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}
	
	public function generate($form = null)
	{
	
		// HIER GAAN WE HET CONTACTFORMULIER OPBOUWEN
		// EN OUTPUTTEN OM WEER TE GEVEN
		
		if( $form != null )
		{
			$this->form = $form;
		}
		
		$CI =& get_instance();
		
		$CI->db->where("contactform_forms.name",$this->form);
		$CI->db->from("contactform_forms");
		//$CI->db->join("contactform_fields","contactform_forms.id = contactform_fields.form_id","left");
		
		$result = $CI->db->get();
		
		// Contactform bestaat nog niet, aanmaken met de meegegeven config
		if($result->num_rows == 0 && $this->dev == 1)
		{
			$fields["name"]         = $this->form;
			$fields["save_submit"]  = 1;
			$fields["save_contact"] = 1;
			
			$CI->db->insert("contactform_forms",$fields);
			$form_id = $CI->db->insert_id();

			$data[] = array(
				"form_id"     => $form_id,
				"value"       => "email",
				"label"       => "E-mail",
				"type"        => "email",
				"placeholder" => "E-mail",
				"required"    => 1,
				"position"    => 1
			);
			$data[] = array(
				"form_id"     => $form_id,
				"value"       => "name",
				"label"       => "Firstname and Name",
				"type"        => "text",
				"placeholder" => "Firstname and Name",
				"required"    => 1,
				"position"    => 0
			);
			$data[] = array(
				"form_id"     => $form_id,
				"value"       => "tel",
				"label"       => "Telephone",
				"type"        => "text",
				"placeholder" => "Telephone",
				"required"    => 1,
				"position"    => 2
			);
			$data[] = array(
				"form_id"     => $form_id,
				"value"       => "website",
				"label"       => "Website",
				"type"        => "text",
				"placeholder" => "Website",
				"required"    => 1,
				"position"    => 3
			);

			foreach($data as $fields):
				$CI->db->insert("contactform_fields",$fields);
				unset($fields);
			endforeach;
		}
		
		// Contactform bestaat nog niet, maar niet aanmaken
		elseif($result->num_rows == 0 && $this->dev == 0)
		{
			die("<p>The form <b>".$this->form."</b> does not exist...</p>");
		}
		
		// Contactform bestaat
		elseif($result->num_rows != 0)
		{
			$form = $result->result();
			$form_id = $form[0]->id;
		}
		
		unset($fields);
		$fields = $CI->db->order_by("position","ASC")->where("form_id",$form_id)->get("contactform_fields");

		if($fields->num_rows == 0)
		{
			$form = "<p>The form <b>".$this->form."</b> contains no fields...</p>";
		}
		else
		{
		
			$form = "";
			
			$message = $CI->db->where("form_id",$form_id)->get("contactform_messages")->result();
			$message = $message[0]->thanks_message;
			if(@$_GET["s"]==1) $form.= "<p class='success'>".$message."</p>";

			// Contactform inladen
			$form.= $this->full_tag_open;
			$form.= "<form action='".$this->action."' method='".$this->method."' title='".$this->form."'>\n";
			
			$form.= "<input type='hidden' value='".$this->subject."' name='subject'/>";

			foreach($fields->result() as $item):
			
			    $form.= $this->row_open;	
			    $form.= "<label for='".$item->value."'>".$item->label."</label>";
			    
			    // Onderwerp van formulier : subject
			    ((isset($this->subject) && $item->value == "subject")) ? $value = $this->subject : $value = "";
			    		
			    switch($item->type):
			    
			    	case "telephone" :
			    		$form.= "<input type='tel' id='".$item->value."' value='".$value."' name='".$item->value."' placeholder='".$item->placeholder."'/>";
			    		break;
			    		
			    	case "text" :
			    		$form.= "<input type='text' id='".$item->value."' value='".$value."' name='".$item->value."' placeholder='".$item->placeholder."'/>";
			    		break;
			    		
			    	case "email" :
			    		$form.= "<input type='email' id='".$item->value."' value='".$value."' name='".$item->value."' placeholder='".$item->placeholder."'/>";
			    		break;
			    		
			    	case "textarea" :
			    		$form.= "<textarea id='".$item->value."' value='".$value."' name='".$item->value."' placeholder='".$item->placeholder."'></textarea>"; 
			    		break;
			    		
			    endswitch;
			    
			    $form.= $this->row_close;
			    
			endforeach;
			
			$form.= "<input type='hidden' value='".$item->form_id."' name='form_id'/>\n"; // Welke form?
			$form.= "<input type='hidden' value='".current_url()."' name='redirect'/>\n"; // Source pagina?
			$form.= "<input type='hidden' value='1' name='contactform_post'/>\n"; // Meegeven dat het de submit van een form is
			$form.= "<p><label>&nbsp;</label><input type='submit' value='".$this->submit_text."'/></p>\n"; // Submit knop
			$form.= "</form>\n";
			$form.= $this->full_tag_close;
		
		}
		
		return $form;
	
	}

	
	function _contactform_fields()
	{
	
		$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"form_id" => array(
							"type" => "INT"
						),
				"type" => array(
							"type" => "varchar",
							"constraint" => "40"
						),
				"label" => array(
							"type" => "varchar",
							"constraint" => "100"
						),
				"options" => array(
							"type" => "text"
						),
				"value" => array(
							"type" => "varchar",
							"constraint" => "100"
						),
				"placeholder" => array(
							"type" => "varchar",
							"constraint" => "100"
						),
				"required" => array(
							"type" => "INT",
							"default" => 0
						),
				"position" => array(
							"type" => "INT",
							"default" => 0
						)
		);
		
		return $fields;
	}

	function _contactform_messages()
	{
	
		$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"reply_message" => array(
							"type" => "text"
						),
				"notification_message" => array(
							"type" => "text"
						),
				"thanks_message" => array(
							"type" => "text"
						),
				"form_id" => array(
							"type" => "INT",
							"default" => 0
						)
		);
		
		return $fields;
	}

	function _contactform_receivers()
	{
		$fields = array(
			"id" => array(
						"type"           => "INT",
						"auto_increment" => TRUE
					),
			"email" => array(
						"type" => "varchar",
						"constraint" => "300"
					)
		);

		return $fields;
	}
	
	function _contactform_contacts()
	{
		$fields = array(
				"id" => array(
							"type"           => "INT",
							"auto_increment" => TRUE
						),
				"name" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"email" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"tel" => array(
							"type" => "varchar",
							"constraint" => "30"
						),
				"website" => array(
							"type" => "varchar",
							"constraint" => "300"
						)
				);
			
			return $fields;

	}
	
	function _contactform_forms()
	{
		$fields = array(
				"id" => array(
							"type"           => "INT",
							"auto_increment" => TRUE
						),
				"name" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"to" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"save_submit" => array(
							"type"           => "INT",
							"default"        => 0
						),
				"save_contact" => array(
							"type"           => "INT",
							"default"        => 0
						),
				"send_mail" => array(
							"type"           => "INT",
							"default"        => 0
						)
						
				);
			
			return $fields;

	}

	function contacts_overview($form = false)
	{

		$CI =& get_instance();

		$result = $CI->db->order_by("name","ASC")->get("contactform_contacts")->result();
		return $result;

	}
	
	function _basicForm()
	{	
		$fields = array(
		    "id" => array(
		    			"type"           => "INT",
		    			"auto_increment" => TRUE
		    		),
		    "form_id" => array(
		    			"type" => "INT"
		    		),
		    "lang" => array(
		    			"type" => "varchar",
		    			"constraint" => "2"
		    		),
		    "subject" => array(
		    		"type" => "varchar",
		    		"constraint" => "300"
		    ),
		    "fields" => array(
		    			"type" => "text"
		    ),

			"read" => array(
				"type" => "INT",
				"default" => "0"
			)
		);
		
		return $fields;
	}
	
	public function basicTemplate()
	{
	
	}

	public function ajax_delete_field($id)
	{
		$CI =& get_instance();

		$form = $CI->db->where("id",$id["id"])->select("form_id")->get("contactform_fields")->result();
		$form = $form[0]->form_id;

		$CI->db->where("id",$id["id"])->delete("contactform_fields");

		return true;
	}

	public function ajax_field_order($fields)
	{
		$CI =& get_instance();

		foreach($fields["field"] as $pos => $id):
			
			$update["position"] = $pos;
			$CI->db->where("id",$id)->update("contactform_fields",$update);
			unset($update);

		endforeach;
	}

	public function ajax_add_receiver( $data )
	{
		$CI =& get_instance();
		$row = json_decode($data["receiver"]);

			$insert["form_id"] = $row->id;
			$insert["email"]   = $row->email;

			$CI->db->insert("contactform_receivers",$insert);
			unset($insert);


		return true;
	}

	public function ajax_delete_receiver( $data )
	{
		$CI =& get_instance();
		$CI->db->where("id",$data["id"])->delete("contactform_receivers");

		return true;
	}

	public function ajax_add_field( $data )
	{
		$CI =& get_instance();

		$array = json_decode($data["field"]);

		foreach($array as $row):

			$fields["form_id"] 		= $row->form_id;
			$fields["type"] 		= $row->inputtype;
			$fields["label"] 		= $row->label;
			$fields["value"] 		= url_title($fields["label"],"-",true);
			$fields["placeholder"] 	= "";
			$fields["required"] 	= $row->required;

			foreach($row->options as $option):
				$options[] = $option; 
			endforeach;

			if(count(@$options) > 0) $fields["options"] = serialize($options);

			$CI->db->insert("contactform_fields",$fields);
			echo $CI->db->insert_id();
			die();

		endforeach;
	}
		
	function _submitForm( $data )
	{
		$CI =& get_instance();
		$this->specific_form = $CI->db->where("id",$data["form_id"])->get("contactform_forms")->result();
		
		$form = $this->specific_form;

		// Email verzenden naar de admin van website
		if($form[0]->send_mail == 1)
		{
			$this->_emailForm($data);
		}
		
		// Bericht opslaan in de database?
		if($this->specific_form[0]->save_submit == 1):
			$this->_saveForm($data);
		endif;
		
		// Potentiele klanten bijhouden?
		if($this->specific_form[0]->save_contact == 1):
			$fields["name"]    = ucwords(strtolower($data["name"]));
			$fields["email"]   = $data["email"];
			$fields["tel"]     = $data["tel"];
			$fields["website"] = $data["website"];
			$this->_saveSubmitters($fields);
		endif;
		
		redirect($data["redirect"]."?s=1","refresh");
	}
	
	function _emailForm( $data )
	{
		$CI =& get_instance();
		$form = $this->specific_form;

		$result = $CI->db->where("form_id",$form[0]->id)->get("contactform_messages")->result();
		$result = $result[0];

		$receivers = $CI->db->where("form_id",$form[0]->id)->get("contactform_receivers")->result();
		$receivers = $receivers[0];

		$CI->load->library("email");

		foreach($receivers as $rec):
			$CI->email->to($form[0]->to);
			$CI->email->from($data["email"]);
			$CI->email->message($result->notification_message);
			$CI->email->subject("New message");
			
			if($CI->email->send()):
				return TRUE;
			else:
				return FALSE;
			endif;
		endforeach;
	
	}
	
	function _saveForm($data)
	{
		$data["date"]      = time();
		$fields["lang"]    = lang();
		$fields["form_id"] = $data["form_id"];
		$fields["subject"] = $data["subject"];
		unset($data["redirect"]);
		unset($data["form_id"]);
		$fields["fields"]  = serialize($data);
		$CI =& get_instance();
		$CI->db->insert("contactform_submitted",$fields);
		
	}
	
	function _saveSubmitters($fields)
	{
		$CI =& get_instance();
		
		$CI->db->where("email",$fields["email"]);
		$CI->db->where("name",$fields["name"]);
		$result = $CI->db->get("contactform_contacts");
		
		if($result->num_rows == 0)
		{
			$CI->db->insert("contactform_contacts",$fields);
		}
	}

	function submitter_submissions($email)
	{
		$CI =& get_instance();
		$result = $CI->db->like("fields",$email)->order_by("id","DESC")->get("contactform_submitted");

		if($result->num_rows > 0)
		{
			return $result->result();
		}
	}

	function submission($id)
	{
		$CI =& get_instance();

		// MARK AS READ
		$fields["read"] = 1;
		$CI->db->where("id",$id)->update("contactform_submitted",$fields);

		$result = $CI->db->where("id",$id)->get("contactform_submitted")->result();
		return $result[0];
	}

	function submitter($contact)
	{
		$CI =& get_instance();

		if(is_numeric($contact)):
			$result = $CI->db->where("id",$contact)->get("contactform_contacts")->result();
		else:
			$result = $CI->db->where("email",$contact)->get("contactform_contacts")->result();
		endif;

		return $result[0];
	}

	function receivers_overview($form_id)
	{
		$CI =& get_instance();
		return $CI->db->where("form_id",$form_id)->get("contactform_receivers")->result();
	}
	
	function all_forms($view = false, $admin = false)
	{

		$CI =& get_instance();
		$CI->load->helper("url");
		$list = $CI->db->order_by("name","ASC")->get("contactform_forms")->result();

		if($view == true):
		
			$overview = "<ul>";
			
			foreach($list as $item):
				
				$overview .= "<li>";
				$overview .= "<div class='name'>".$item->name."</div>";
				
				if($admin)
				{
					$overview .= "<div class='actions'>";
					$overview .= "<ul>";
					$overview .= "<li>".anchor("admin/products/edit/".$item->id,"Edit")."</li>";
					$overview .= "<li>".anchor("admin/products/del/".$item->id,"Delete")."</li>";
					$overview .= "</ul>";
					$overview .= "</div>";
				}
				
				$overview .= "</li>";
				
			endforeach;
			
			$overview .= "</ul>";
			
			return $overview;
			
			
		else:
		
			return $list;
		
		endif;
	}
	
	function delete_form($item)
	{
		$CI =& get_instance();
		$CI->db->where("form_id",$item)->delete("contactform_fields");
		$CI->db->where("id",$item)->delete("contactform_forms");
		return true;
	}

	function submitted_forms()
	{
		$CI =& get_instance();
		return $CI->db->select("name, contactform_forms.id as form_id, contactform_submitted.read, contactform_submitted.subject, contactform_submitted.id, contactform_submitted.fields")->order_by("contactform_submitted.id","DESC")->join("contactform_forms","contactform_forms.id = contactform_submitted.form_id","left")->get("contactform_submitted")->result();
	}

	function submission_stats()
	{
		$CI =& get_instance();
		$array["inbox"]  = $CI->db->count_all_results("contactform_submitted");
		$array["unread"] = $CI->db->where("read","0")->count_all_results("contactform_submitted");;

		return $array;
	}

	function edit_form($array)
	{

		$CI =& get_instance();

		$form_id						= $CI->input->post("form_id",true);
		$fields["form_id"]              = $form_id;
		$fields["reply_message"]        = $CI->input->post("reply_message",true);
		$fields["notification_message"] = $CI->input->post("notification_message",true);
		$fields["thanks_message"] 		= $CI->input->post("thanks_message",true);

		// Update or add email notifications
		if($CI->db->where("form_id",$form_id)->count_all_results("contactform_messages") == 0)
		{
			$CI->db->insert("contactform_messages",$fields);
		}
		else
		{
			$CI->db->where("form_id",$form_id)->update("contactform_messages",$fields);
		}

		unset($fields);

		$fields["save_submit"]	= $CI->input->post("save_submit",true);
		$fields["save_contact"]	= $CI->input->post("save_contact",true);
		$fields["send_mail"]	= $CI->input->post("send_mail",true);

		$CI->db->where("id",$form_id)->update("contactform_forms",$fields);
		unset($fields);

		return true;
	}
	
	function item($id)
	{
		$CI =& get_instance();
		$array = array();

		$result = $CI->db->where("contactform_forms.id",$id)->from("contactform_forms")->get()->result();
		foreach($result as $key => $value):
		
			foreach($value as $nr => $item):
				$array[$nr] = $item;
			endforeach;
		
			$messages = $CI->db->where("contactform_messages.form_id",$value->id)->get("contactform_messages")->result();
			foreach($messages as $mes):
				$array["messages"]["reply_message"] 		= $mes->reply_message;
				$array["messages"]["notification_message"] 	= $mes->notification_message;
				$array["messages"]["thanks_message"] 		= $mes->thanks_message;
			endforeach;

			$fields = $CI->db->where("contactform_fields.form_id",$value->id)->order_by("position","ASC")->get("contactform_fields")->result();
			foreach($fields as $in => $field):
				$array["fields"][$in] = $field;
			endforeach;
			
		endforeach;
		
		return $array;
	}

}