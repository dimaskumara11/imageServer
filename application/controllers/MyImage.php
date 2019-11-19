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
		$this->output
			->set_content_type('application/json')
			->set_header('HTTP/1.0 400 NOT FOUND')
			->set_output(json_encode(array('message' => 'Image Not Found')));
    }

	public function show($size="",$id=0)
	{
        $this->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
        $id = explode('.',$id);
		$idImage = explode('img',empty($id[0])?0:$id[0]);
		
        if ($dataCache = $this->cache->get( empty($idImage[1])?0: $idImage[1]))
        {
			$cekImage = base_url().'images'.$dataCache[$idImage[1]][$size];
			$this->output
					->set_content_type('jpeg') // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
					->set_output(file_get_contents($cekImage));
        }
        else
        {
			$cekImage 	= $this->Mdl_image->getDetail($size,empty($idImage[1])?0: $idImage[1]);

			$dataCache 	= $this->Mdl_image->getThumbImage(empty($idImage[1])?0: $idImage[1]);
			// Save into the cache for 2 weeks
			$this->cache->save($dataCache['id'], $dataCache['data'], 1209600);
			$this->output
					->set_content_type('jpeg') // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
					->set_output(file_get_contents($cekImage));
        }
    }
}