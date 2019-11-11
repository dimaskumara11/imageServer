<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_image');
	}

	public function index()
	{
        // $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        // if ( ! $foo = $this->cache->get('foo'))
        // {
        //     $foo = array('dimas'=>'kumara1');

        //     // Save into the cache for 5 minutes
        //     $this->cache->save('foo', $foo, 300);
        // }
        // else
        // {
        //     print_r($this->cache->get(27));
        // }
        // die;

        $data = array(
            'PAGE_TITLE'    => 'List Image',
            'BASE_URL'      => base_url(), //tanpa file
            'SITE_URL'      => site_url(),  //index.php
			'THEMES_PAGE'   => base_url('themes'),
			'REQUEST_AJAX_LIST' => site_url("image/show/getList"),
            'MODE_LAYOUT'   	=> 'hold-transition skin-blue fixed sidebar-mini',                
		);
		
		$data['DATA_TABLE'] =  
		'{ "data": "nomor" },
			{ "data": "image_thumb" },
			{ "data": "image_file_title" },
			{ "data": "image_file_all" },
			{ "data": "actions" }';
        
        $data['MENU_TOP']       = $this->parser->parse('layout/menu/menu_top', $data, true);
        $data['HEADER_SECTION'] = $this->parser->parse('layout/header/header_fixed', $data, true);
        $data['HEADER_SECTION'].= $this->parser->parse('layout/menu/sidebar', $data, true);
        
        $data['CONTENT_SECTION'] = $this->parser->parse('layout/header/breadcrumb', $data, true);
        $data['CONTENT_SECTION'].= $this->parser->parse('layout/list/image', $data, true);
		$data['BODY_SECTION']	 = $this->parser->parse('layout/content/body_layout', $data, true);
		
		$data['ADD_PLUGIN_CSS']	 = $this->parser->parse('layout/css/datatable_css', $data, true);
		$data['ADD_PLUGIN_JS']	 = $this->parser->parse('layout/js/datatable_js', $data, true);
        
        $data['FOOTER_SECTION']	 = $this->parser->parse('layout/footer/footer', $data, true);
        
        $this->parser->parse('layout/main_layout', $data);
	}


    public function getList()
    {
        $params = $this->input->post();
        $result = $this->Mdl_image->getList($params);
        
        $data = array(
            'draw'              => $params['draw'],
            'recordsTotal'      => $result['recordsTotal'],
            'recordsFiltered'   => $result['recordsFiltered'],
            'data'              => $result['list']
        );
        echo json_encode($data);
    }
}
