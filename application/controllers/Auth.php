<?php 

class Auth extends CI_Controller{

    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function Index()
    {
        // Proses pengambilan data login sebagai apa
        $level= $this->input->post('level',TRUE);
        if ($level=='admin' or $level=='petugas') {
            $this->form_validation->set_rules('username','username','required',array('required'=>'Unsername tidak boleh kosong'));
            $this->form_validation->set_rules('pasword', 'pasword', 'required',array('required'=>'Password tidak boleh kosong'));
            if ($this->form_validation->run()==TRUE) {
                $cari=$this->db->get_where('t_petugas',array('username'=>$this->input->post('username',TRUE)));
                if ($cari->result_array()>0) {
                    foreach ($cari->result() as $ketemu) {
                        // verifikasi password hash
                        if (password_verify($this->input->post('pasword',TRUE),$ketemu->pasword)) {
                            $sessiondata=array(
                                'id_petugas'        =>$ketemu->id_petugas,
                                'nama_petugas'      =>$ketemu->nama_petugas,
                                'level'             =>$ketemu->level
                            );
                            $this->session->set_userdata($sessiondata);
                            redirect('Admin');
                        }else{
                            redirect('');
                        }
                    }
                    redirect('');
                }
                redirect('');
            }else{
                $this->load->view('login');
            }
            
        }
        // untuk login siswa
    }
    public function Logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}