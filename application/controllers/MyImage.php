<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyImage extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_image');
	}

	public function index()
	{
        echo "Not Found";
    }

	public function show($id=0)
	{
		$cekImage = $this->Mdl_image->getDetail($id);
		if(empty($cekImage))
		{
			echo "not found";
		}
		else
		{
			header("Content-type: image/jpeg");
			echo file_get_contents("$cekImage");
		}
    }
}