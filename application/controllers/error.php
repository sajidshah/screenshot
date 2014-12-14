<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{
	public $user=null;	
	function __construct()
	{
		parent::__construct();
		
	}
	function index($year = NULL, $month = NULL)
	{
		$this->load->view('error/error_404');
	}
}

