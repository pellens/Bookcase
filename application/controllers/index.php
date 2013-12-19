<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	 
	public function index()
	{

		// Core settings
        $config["page"] = "homepage";
        $this->core->initialize($config);

        // Marketplace
        //$this->load->library("Products");
//
        //// User settigns
        //$data["login_form"] = $this->users->login_form(true);
        //if(is_logged_in())
        //{
        //	$data["user"] = logged_info();
        //}
//
        //$this->load->library("locality");
        //
        //// Zoekertjes
        ////$this->load->library"zoekertjes");
        ////$data["aantal_zoekertjes"]	= $this->zoekertjes->aantal);

        $this->load->library("contactform");
        $config["form"]           = "general_contactform";
        $this->contactform->initialize($config);
echo $this->contactform->generate();

		$this->load->view('index');

       

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */