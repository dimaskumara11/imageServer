<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->output->cache(300);
		// $this->load->driver('cache'); //, array('adapter' => 'redis', 'backup' => 'file'));

		// if ( ! $foo = $this->cache->get('foo'))
		// {
		// 		echo 'Saving to the cache!<br />';
		// 		$foo = 'foobarbaz!';

		// 		// Save into the cache for 5 minutes
		// 		$this->cache->save('foo', $foo, 300);
		// }

		// echo $foo;
		echo "test";	
	}
	
	
	public function refreshweb()
	{
		// Deletes cache for the currently requested URI
		$this->output->delete_cache();

		// Deletes cache for /foo/bar
		$this->output->delete_cache('/foo/bar');
	}
	
	
}
