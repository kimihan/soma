<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->template->load('app_vendedor/template', 'app_vendedor/index');
	}
}
