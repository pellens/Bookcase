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
	
	public function block($name, $general=false)
	{
		
		$CI =& get_instance();
		
		// Geen pagename ingesteld
		if(!$CI->core->page)
		{
			die("<p>Please configurate the <b>Core Library</b> first!</p>");
		}
		else
		{

			$result = $CI->db->where("blocks.title",$name)->from("blocks")->get();

			// Block bestaat nog niet
			// Block algemeen aanmaken
			if($result->num_rows == 0):
			
				// Block toevoegen
				$fields["title"] = $name;
				$fields["page"]  = (!$general) ? $CI->core->page : "general";
				$CI->db->insert("blocks",$fields);
				$id = $CI->db->insert_id();
				unset($fields);

				// Bestaat de content al voor deze lang?
				$content = $CI->db->where("blocks_content.block_id",$id)->where("lang",lang())->from("blocks_content")->get();
				if($content->num_rows == 0):

					$fields["lang"]     = lang();
					$fields["block_id"] = $id;
					$fields["content"]  = "<p>The block <b>".$name."</b> has been succesfully created. You can now edit this text.</p>";
					$this->add_content_block($fields);
					unset($fields);

				endif;
			
			else:

				$result = $result->result();
				$id = $result[0]->id;
				$result = $CI->db->where("blocks_content.block_id",$id)->where("lang",lang())->from("blocks_content")->get();
				// Block bestaat
				// Bestaat ook de content voor deze lang al?
				if($result->num_rows == 0):

					$fields["lang"]     = lang();
					$fields["block_id"] = $id;
					$fields["content"]  = "<p>The block <b>".$name."</b> has been succesfully created. You can now edit this text.</p>";
					$this->add_content_block($fields);
					unset($fields);

				endif;

			endif;

			
			
			$block = $CI->db->where("blocks.title",$name)
							->from("blocks AS blocks")
							->where("blocks_content.lang",lang())
							->join("blocks_content AS blocks_content","blocks_content.block_id = blocks.id","left")
							->get()
							->result();
			
			return $block[0]->content;
		
		}
	
		
	}

	function add_content_block($fields)
	{
		$CI =& get_instance();
		
		$CI->db->insert("blocks_content",$fields);
		$id = $CI->db->insert_id();
		return $id;
	}

	function item($id)
	{
		$CI =& get_instance();
		
		$block = $CI->db->where("blocks.id",$id)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
		return $block;
	}
	
	function blocks_overview($lang = false)
	{
		$lang = (!$lang) ? lang() : $lang;
		$CI =& get_instance();
		
		return $CI->db->order_by("title","ASC")->where("blocks_content.lang",$lang)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
	}
	
	function blocks_page( $page )
	{
		$CI =& get_instance();
		
		return $CI->db->group_by("blocks.id")->where("lang",lang())->where("page",$page)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
	}

	function edit_block( $block )
	{
		$CI =& get_instance();

		if(isset($_POST["id"]))
		{
			
			foreach($_POST as $key => $val):

				$a = 0;
				foreach($val as $i):
					$fields[$a][$key] = $i;
					$a++;
				endforeach;

			endforeach;

			foreach($fields as $item):

				$data["content"] = $item["content"];
				$CI->db->where("id",$item["id"])->update("blocks_content",$data);
				unset($data);

			endforeach;

			return true;
			
		}
		else
		{
			return $CI->db->where("blocks.id",$block)->from("blocks")->join("blocks_content","blocks_content.block_id = blocks.id","left")->get()->result();
		}
	}

}
