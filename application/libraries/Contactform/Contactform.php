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
		
		if(!$CI->db->table_exists('contactform_forms'))
		{
			// Basis contactformulier inputs
			$CI->load->dbforge();
			$CI->dbforge->add_field($this->_contactform_forms());
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('contactform_forms');
			
			$fields["name"]          = "Basic";
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
		$fields = $CI->db->where("form_id",$form_id)->get("contactform_fields");

		if($fields->num_rows == 0)
		{
			$form = "<p>The form <b>".$this->form."</b> contains no fields...</p>";
		}
		else
		{
		
			$form = "";
			
			if(@$_GET["s"]==1) $form.= "<p class='success'>Your message has been send!</p>";

			// Contactform inladen
			$form.= $this->full_tag_open;
			$form.= "<form action='".$this->action."' method='".$this->method."' title='".$this->form."'>\n";
			
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
						)
						
				);
			
			return $fields;

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
		    "fields" => array(
		    			"type" => "text"
		    		)
		    );
		
		return $fields;
	}
	
	public function basicTemplate()
	{
	
	}
		
	function _submitForm( $data )
	{
		$CI =& get_instance();
		$this->specific_form = $CI->db->where("id",$data["form_id"])->get("contactform_forms")->result();
		
		// Email verzenden naar de admin van website
		$this->_emailForm($data);
		
		// Bericht opslaan in de database?
		if($this->specific_form[0]->save_submit == 1):
			$this->_saveForm($data);
		endif;
		
		// Potentiele klanten bijhouden?
		if($this->specific_form[0]->save_contact == 1):
			$fields["name"]    = $data["name"];
			$fields["email"]   = $data["e-mail"];
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
		
		$CI->load->library("email");
		
		$CI->email->to($form[0]->to);
		$CI->email->from($data["e-mail"]);
		$CI->email->message($data["message"]);
		$CI->email->subject($data["subject"]);
		if($CI->email->send()):
			return TRUE;
		else:
			return FALSE;
		endif;
	
	}
	
	function _saveForm($data)
	{
		$data["date"]      = time();
		$fields["form_id"] = $data["form_id"];
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
	
	function all_forms($view = false, $admin = false)
	{

		$CI =& get_instance();
		$CI->load->helper("url");
		$list = $CI->db->order_by("name","ASC")->get("contactform_forms");

		if($view == true):
		
			$overview = "<ul>";
			
			foreach($list->result() as $item):
				
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
	
	function submitted_forms()
	{
		$CI =& get_instance();
		return $CI->db->order_by("id","DESC")->get("contactform_submitted");
	}
	
	function add()
	{
		
		
		
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
		
			$fields = $CI->db->where("contactform_fields.form_id",$value->id)->get("contactform_fields")->result();
			foreach($fields as $in => $field):
				$array["fields"][$in] = $field;
			endforeach;
			
		endforeach;
		
		return $array;
	}

}