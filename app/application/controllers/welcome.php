<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$this->vpage( $this->load->view('template/success',null,true) );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
