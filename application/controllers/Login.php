<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_login');
	}

	public function index()
	{
		$post = $this->input->post();
		$data = array(
			'PAGE_TITLE'    => 'Login',
			'BASE_URL'      => base_url(), //tanpa file
			'SITE_URL'      => site_url(),  //index.php
			'THEMES_PAGE'   => base_url('themes'),
			'SITELOGIN' 	=> base_url('login/cekLogin'),
			'MODE_LAYOUT'   => 'hold-transition skin-blue fixed sidebar-mini',                
		);

		$data['username'] 		= "";
		$data['password'] 		= "";
		$data['errorusername'] 	= "";
		$data['errorpassword'] 	= "";

		if(isset($post))
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$config = array(
				array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'required',
						'errors' => array(
							'required' => '<i class="text-red">Kamu harus mengisi username</i>',
						),
				),
				array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required',
						'errors' => array(
							'required' => '<i class="text-red">Kamu harus mengisi password</i>',
						),
				),
			);
		
			$this->form_validation->set_rules($config);
	
			if ($this->form_validation->run() == FALSE)
			{
				if(!empty(form_error('username')))
				{
					$data['username'] 		= set_value('username');
					$data['errorusername'] 	= form_error('username');
				}
				
				if(!empty(form_error('password')))
				{
					$data['password'] 		= set_value('password');
					$data['errorpassword'] 	= form_error('password');
				}
			}
			else
			{
				$res = $this->Mdl_login->cekLogin($post);
				if($res == FALSE)
				{
					$data['errorusername'] 	= '<i class="text-red">username dan password tidak cocok</i>';

					$data['username'] 		= set_value('username');
					$data['password'] 		= set_value('password');
				}
				else
				{
					redirect('image/show/');
				}
			}
		}
		$this->parser->parse('layout/form/login', $data);

	}
}
