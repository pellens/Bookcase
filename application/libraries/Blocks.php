<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	CORE
	
	Setting basic configurations for a website or pages
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gertpellens.com>
	@copyright		Gert Pellens		<http://www.gertpellens.com>

**/

class Blocks {


	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		
		$CI->load->database();
		$CI->load->helper("url");
		
		if (!$CI->db->table_exists('blocks'))
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
						),
				"page" => array(
							"type" => "varchar",
							"constraint" => "300"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('blocks',TRUE);
		}
		
		if (!$CI->db->table_exists('blocks_content'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"block_id" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"lang" => array(
							"type" => "varchar",
							"constraint" => "10"
						),
				"content" => array(
							"type" => "text"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('blocks_content',TRUE);
		}

	
	}
	
	public function block($name, $lang="", $general=false)
	{
		
		$CI =& get_instance();
		
		// Geen pagename ingesteld
		if(!$CI->core->page)
		{
			die("<p>Please configurate the <b>Core Library</b> first!</p>");
		}
		else
		{

			$result = $CI->db->where("title",$name)->get("blocks");
			
			// Block bestaat nog niet
			if($result->num_rows == 0):
			
				$fields["title"] = $name;
				
				$fields["page"] = (!$general) ? $CI->core->page : "general";
				$CI->db->insert("blocks",$fields);
				
				$block = $CI->db->where("title",$name)->get("blocks")->result();
				
				unset($fields);
				
				$fields["lang"]     = $CI->core->lang;
				$fields["block_id"] = $block[0]->id;
				$fields["content"]  = "<p>The block <b>".$name."</b> has been succesfully created. You can now edit this text.</p>";
				
				$CI->db->insert("blocks_content",$fields);
				
				unset($block);
			
			endif;
			
			$lang = ($CI->core->lang) ? $CI->core->lang : $lang;
			
			$block = $CI->db->where("blocks.title",$name)
							->from("blocks AS blocks")
							->where("blocks_content.lang",$lang)
							->join("blocks_content AS blocks_content","blocks_content.block_id = blocks.id","left")
							->get()
							->result();
			
			return $block[0]->content;
		
		}
	
		
	}
	
	function all()
	{
		$CI =& get_instance();
		
		return $CI->db->order_by("title","ASC")->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
	}
	
	function blocks_page( $page )
	{
		$CI =& get_instance();
		
		return $CI->db->where("page",$page)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
	}

	function block_edit( $block )
	{
		$CI =& get_instance();
		
		return $CI->db->where("blocks.id",$block)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
	}

}
