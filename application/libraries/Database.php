<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database {

	var $CI;
	
	public function __construct($params = array())
	{
		
	}
	
	function tables()
	{
		$CI  =& get_instance();
		foreach($CI->db->list_tables() as $table)
		{
			$fields[] = array(
				"title" => $table,
				"num_records" => $this->table_records($table),
				"fields" => $this->table_fields($table)
			);
		} 
		
		return $fields;
	}

	function table_records($table)
	{
		$CI  =& get_instance();
		return $CI->db->count_all_results($table);
	}

	function table_fields($table)
	{
		$CI  =& get_instance();
		$result = $CI->db->list_fields($table);

		$array = array(
			"num_fields" => count($result),
			"fields" => $result
		);

		return $array;
	}

}