<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_image');
		$this->load->model('Mdl_sizeImage');
	}

	public function index()
	{
        $data = array(
            'PAGE_TITLE'    => 'List Image',
            'BASE_URL'      => base_url(), //tanpa file
            'SITE_URL'      => site_url(),  //index.php
			'THEMES_PAGE'   => base_url('themes'),
			'REQUEST_AJAX_LIST' => site_url("image/show/getList"),
            'MODE_LAYOUT'   	=> 'hold-transition skin-blue fixed sidebar-mini',                
		);
        
        $data['MENU_TOP']       = $this->parser->parse('layout/menu/menu_top', $data, true);
        $data['HEADER_SECTION'] = $this->parser->parse('layout/header/header_fixed', $data, true);
        $data['HEADER_SECTION'].= $this->parser->parse('layout/menu/sidebar', $data, true);
        
        $data['CONTENT_SECTION'] = $this->parser->parse('layout/header/breadcrumb', $data, true);
        $data['CONTENT_SECTION'].= $this->parser->parse('layout/form/image', $data, true);
		$data['BODY_SECTION']	 = $this->parser->parse('layout/content/body_layout', $data, true);
		
		$data['ADD_PLUGIN_CSS']	 = $this->parser->parse('layout/css/datatable_css', $data, true);
		$data['ADD_PLUGIN_JS']	 = $this->parser->parse('layout/js/datatable_js', $data, true);
        
        $data['FOOTER_SECTION']	 = $this->parser->parse('layout/footer/footer', $data, true);
        
        $this->parser->parse('layout/main_layout', $data);
	}


    public function insert()
    {
        $headers = $this->input->request_headers();
        $post = $this->input->post();
        
        $cekAPIKEY = cekAPIKEY($headers['api_key']);
        $updateBy  = empty($post['update_by'])?0:$post['update_by'];

        if($cekAPIKEY == false)
        {
            echo "api key tidak valid";
        }
        elseif(empty($post['folderImage']))
        {
            echo "folder belum di masukkan";
        }
        elseif(empty($_FILES['image_file']['name']))
        {
            echo "file belum di masukkan";
        }
        elseif(file_exists(APPPATH."/../images/".$post['folderImage']."/".$_FILES['image_file']['name']))
        {
            echo "filename sudah ada";
        }
        else
        {
            $folderImage = $post['folderImage'];
            $path = './images/'.$folderImage.'/';
            @mkdir($path, 0777,TRUE);
            $dt_file = '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
            if(!file_exists($path.'index.html'))
            {
                $fh = fopen($path.'index.html', 'w+');
                fwrite($fh, $dt_file);
            }
            $config['upload_path']          = $path.'ori';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 2000;
            $config['max_height']           = 2000;
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('image_file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);die;
                    $this->load->view('upload_form', $error);
            }
            else
            {
                $size = $this->Mdl_sizeImage->getList();
                $data = array('upload_data' => $this->upload->data());
                
                $inputData = array(
                    'updateBy' => $updateBy,
                    'folder'   => $folderImage,
                );

                $inputData2 = array(
                    'image_thumbnail_size' => "ori",
                    'image_thumbnail_type' => 0,
                    'image_thumbnail_name' => $_FILES['image_file']['name'],
                );
                
                $this->Mdl_image->insertImage($inputData,$inputData2);

                foreach($size as $key => $val):
                    $Newpath = './images/'.$folderImage.'/thumbnail/';
                    @mkdir($Newpath, 0777,TRUE);
                    if(!file_exists($Newpath.'index.html'))
                    {
                        $fh = fopen($Newpath.'index.html', 'w+');
                        fwrite($fh, $dt_file);
                    }

                    $iconfig['image_library']    = 'gd2';
                    $iconfig['source_image']     = $path.$_FILES['image_file']['name'];
                    $iconfig['create_thumb']     = TRUE;
                    $iconfig['maintain_ratio']   = TRUE;
                    $iconfig['width']            = $val->size_thumbnail_width;
                    $iconfig['height']           = $val->size_thumbnail_height;
                    $iconfig['quality']          = "100%";
                    $iconfig['new_image']        = $Newpath.'/'.$_FILES['image_file']['name'];
                    
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($iconfig);
                    $this->image_lib->resize();
                    
                    if()
                    {

                    }
                    else
                    {
                        $inputData2 = array(
                            'image_thumbnail_size' => $val->size_thumbnail_width.'x'.$val->size_thumbnail_height,
                            'image_thumbnail_type' => 0,
                            'image_thumbnail_name' => $_FILES['image_file']['name'],
                        );
                        
                        $this->Mdl_image->insertImageThumb($inputData);
                    }
                endforeach;

                echo "sukses";
            }
        }

    }
}