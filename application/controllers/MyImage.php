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

	public function show($size="",$id=0)
	{
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $id = explode('.',$id);
		$idImage = explode('img',empty($id[0])?0:$id[0]);
		
        if ($dataCache = $this->cache->get( empty($idImage[1])?0: $idImage[1]))
        {
			$cekImage = base_url().'images'.$dataCache[$idImage[1]][$size];
			header("Content-type: image/jpeg");
			echo file_get_contents("$cekImage");
        }
        else
        {
			$cekImage 	= $this->Mdl_image->getDetail($size,empty($idImage[1])?0: $idImage[1]);

			$dataCache 	= $this->Mdl_image->getThumbImage(empty($idImage[1])?0: $idImage[1]);
			$this->cache->save($dataCache['id'], $dataCache['data'], 300);
			header("Content-type: image/jpeg");
			echo file_get_contents("$cekImage");
        }
    }
}