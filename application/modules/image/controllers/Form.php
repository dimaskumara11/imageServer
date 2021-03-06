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

        $key = empty($headers['api_key'])?"-":$headers['api_key'];
        $cekAPIKEY = cekAPIKEY($key);
        $updateBy  = empty($post['update_by'])?0:$post['update_by'];

        if($cekAPIKEY == false)
        {
            $this->output
                ->set_content_type('application/json')
                ->set_header('HTTP/1.0 401 INVALID')
                ->set_output(json_encode(array('message' => 'api key tidak valid')));
        }
        elseif(empty($post['folderImage']))
        {
            $this->output
                ->set_content_type('application/json')
                ->set_header('HTTP/1.0 402 NOT FOUND')
                ->set_output(json_encode(array('message' => 'folder belum di masukkan')));
        }
        elseif(empty($_FILES['image_file']['name']))
        {
            $this->output
                ->set_content_type('application/json')
                ->set_header('HTTP/1.0 403 NOT FOUND')
                ->set_output(json_encode(array('message' => 'file belum di masukkan')));
        }
        else
        {
            $folderImage = $post['folderImage'];
            $path = './images/'.$folderImage.'/ori';

            @mkdir("./images/$folderImage", 0777, true);
            @mkdir($path, 0777,TRUE);
            $dt_file = '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
            if(!file_exists('./images/'.$folderImage.'/index.html'))
            {
                $fp = fopen('./images/'.$folderImage.'/index.html',"wb");
                fwrite($fp,$dt_file);
                fclose($fp);
            }
            if(!file_exists($path.'/index.html'))
            {
                $fh = fopen($path.'/index.html', 'wb');
                fwrite($fh, $dt_file);
                fclose($fh);
            }
            $config['upload_path']          = $path;
            $config['file_name']            = date('Ymd_s').'_'.$_FILES['image_file']['name'];
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 2000;
            $config['max_height']           = 2000;
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('image_file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    switch($error['error'])
                    {
                        case "<p>The filetype you are attempting to upload is not allowed.</p>":
                            $this->output
                                ->set_content_type('application/json')
                                ->set_header('HTTP/1.0 404 INVALID')
                                ->set_output(json_encode(array('message' => 'tipe file tidak cocok, hanya : jpeg, jpg, png','status' => 0)));
                        break;
                        case "<p>The file you are attempting to upload is larger than the permitted size.</p>":
                            $this->output
                                ->set_content_type('application/json')
                                ->set_header('HTTP/1.0 405 INVALID')
                                ->set_output(json_encode(array('message' => 'ukuran file terlalu besar (kilobytes)', 'status' => 0)));
                        break;
                        case "<p>The image you are attempting to upload doesn't fit into the allowed dimensions.</p>":
                            $this->output
                                ->set_content_type('application/json')
                                ->set_header('HTTP/1.0 406 INVALID')
                                ->set_output(json_encode(array('message' => 'dimensi file terlalu besar', 'status' => 0)));
                        break;
                        default:
                            $this->output
                                ->set_content_type('application/json')
                                ->set_header('HTTP/1.0 410 INVALID')
                                ->set_output(json_encode(array('message' => $error['error'], 'status' => 0)));
                    }
            }
            else
            {
                $size = $this->Mdl_sizeImage->getList();
                $data = array('upload_data' => $this->upload->data());
                
                $inputData = array(
                    'updateBy' => $updateBy,
                    'folder'   => $folderImage,
                    'name'     => $data['upload_data']['file_name'],
                );

                $inputData2 = array(
                    'image_thumbnail_size' => "ori",
                    'image_thumbnail_type' => 1,
                );
                
                $imageFileID = $this->Mdl_image->insertImage($inputData,$inputData2);
                
                $imageSize = array(
                        'ori' => "/$folderImage/ori/".$data['upload_data']['file_name'],
                );

                foreach($size as $key => $val):
                    $Newpath = './images/'.$folderImage.'/'.$val->size_thumbnail_width.'x'.$val->size_thumbnail_height;
                    @mkdir($Newpath, 0777,TRUE);
                    if(!file_exists($Newpath.'/index.html'))
                    {
                        $fh = fopen($Newpath.'/index.html', 'w+');
                        fwrite($fh, $dt_file);
                    }

                    $iconfig['image_library']    = 'gd2';
                    // $iconfig['source_image']     = $path.'/'.$_FILES['image_file']['name'];
                    $iconfig['source_image']     = $data['upload_data']['full_path'];
                    $iconfig['create_thumb']     = TRUE;
                    $iconfig['maintain_ratio']   = TRUE;
                    $iconfig['width']            = $val->size_thumbnail_width;
                    $iconfig['height']           = $val->size_thumbnail_height;
                    $iconfig['quality']          = "100%";
                    $iconfig['new_image']        = $Newpath.'/'.$data['upload_data']['file_name'];
                    
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($iconfig);
                    $this->image_lib->resize();
                    $inputData2 = array(
                        'image_thumbnail_size' => $val->size_thumbnail_width.'x'.$val->size_thumbnail_height,
                        'image_thumbnail_type' => 0,
                    );
                    
                    $this->Mdl_image->insertImageThumb($inputData2,$data['upload_data']['file_name']);

                    $imageSize[$val->size_thumbnail_width.'x'.$val->size_thumbnail_height] =  "/$folderImage/".$val->size_thumbnail_width.'x'.$val->size_thumbnail_height.'/'.$data['upload_data']['file_name'];
                    
                endforeach;
                
                $this->output
                    ->set_content_type('application/json')
                    ->set_header('HTTP/1.0 200 OK')
                    ->set_output(
                        json_encode(
                            array(
                                'message' => 'berhasil terupload',
                                'data'    => array(
                                    'image_file' => 'img'.$imageFileID.'.jpg',
                                'status'  => 1
                                )
                            )
                        )
                    );
            }
        }

    }
}