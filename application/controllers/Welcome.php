<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_pasien');
    }

	public function index()
	{
		$this->load->view('pasien/login');
	}

	public function login()
    {  
    	$nim 	= $this->input->post('nim',TRUE);
        $password = $this->input->post('password',TRUE);
        $passwordx= md5($password);
        $validate = $this->m_pasien->validate($nim,$passwordx);
        if($validate->num_rows() > 0){
            $data       = $validate->row_array();
            $nama       = $data['nama'];
            $alamat     = $data['alamat'];
            $nim  	 	= $data['nim_nip'];
            $alergi     = $data['alergi'];
            $tgl_lahir  = $data['tgl_lahir'];
            $sesdata    = array(
                'nama'                  => $nama,
                'alamat'                => $alamat,
                'nim_nip'              	=> $nim,
                'alergi'                => $alergi,
                'tgl_lahir'             => $tgl_lahir,
                'logged_in'             => TRUE
            );
            $this->session->set_userdata($sesdata);
            redirect('Profile');          
            }else{
                echo $this->session->set_flashdata('pesan','Nim dan/atau password salah');
                // kosong
                redirect('Welcome');             
             }
    }

    function logout(){
      $this->session->sess_destroy();
      redirect('Welcome');
    }

	// public function about()
	// {
	// 	$this->load->view('pasien/nav_home');
	// 	$this->load->view('pasien/about');
	// 	$this->load->view('pasien/footer_home');
	// }

	public function konsultasi()
	{
		$this->load->view('pasien/nav_profile');
		$this->load->view('pasien/konsultasi');
		$this->load->view('pasien/footer_profile');
	}

	public function chat()
	{
		$this->load->view('pasien/nav_profile');
		$this->load->view('pasien/chat');
		$this->load->view('pasien/footer_profile');
	}
}
