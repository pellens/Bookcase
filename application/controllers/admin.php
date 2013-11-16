<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	 
	public function index()
	{
	
		// Navigatie opbouwen
		$nav    = array();
		$tables = $this->db->list_tables();
		foreach ($tables as $table)
		{
			$bom = explode("_",$table);
			switch($bom[0])
			{
				case "core" : array_push($nav,"Page overview","Core settings"); break;
			}
		}
		$data["nav"] = array_unique($nav);

		$this->load->view('backend/index',$data);
	}

	public function library($library,$page,$option=null)
	{
		require_once(APPPATH."/libraries/".ucwords($library)."/config.php");

		$data["nav"] = $nav;
		$this->load->view('backend/index',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */