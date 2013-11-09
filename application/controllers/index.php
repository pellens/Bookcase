<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	 public function __construct()
	 {
	 	parent::__construct();
	 }
	 
	public function index()
	{
		$config["page"]  = "homepage";
        $this->core->initialize($config);            			

		$this->load->view('index');
	}
	
	public function portfolio()
	{
		$config["page"]  = "portfolio";
        $this->core->initialize($config);            			

		$this->load->view('index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */