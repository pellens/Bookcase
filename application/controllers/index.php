<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	 
	public function index()
	{

		// Core settings
        $config["function"] = __FUNCTION__;
        $config["class"]    = __CLASS__;
        $config["page"]     = "homepage";
        $this->core->initialize($config);

        // Form on this page
        $this->load->library("contactform");
        $config["form"]     = "general_contactform";
        $this->contactform->initialize($config);

        // Products on this page
        $this->load->library("products");
        $data["categories"] = $this->products->categories_overview();

        //echo $this->contactform->generate();

		$this->load->view('index',$data);
	}

    public function about()
    {
        // Core settings
        $config["function"] = __FUNCTION__;
        $config["class"]    = __CLASS__;
        $config["page"]     = "about";
        $config["parent"]   = "homepage";
        $this->core->initialize($config);

        $this->load->view('index');
    }

    public function location()
    {
        // Core settings
        $config["function"] = __FUNCTION__;
        $config["class"]    = __CLASS__;
        $config["page"]     = "location";
        $config["parent"]   = "about";
        $this->core->initialize($config);

        echo crumbs();
    }

    public function location_item($id)
    {
        // Core settings
        $config["function"] = __FUNCTION__;
        $config["class"]    = __CLASS__;
        $config["page"]     = "location_item";
        $config["parent"]   = "location";
        $this->core->initialize($config);

        echo crumbs();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */