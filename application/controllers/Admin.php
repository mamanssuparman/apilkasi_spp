<?php 
class Admin extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model('Modeldata');
    $this->load->library('form_validation');
    ceklogin();
}

    public function Index()
    {
       $this->template->load('halaman_master','template/includes/dashboard');
    }
    public function Kelas()
    {
        $data['data_kelas']         =$this->Modeldata->get_data_kelas()->result();
        $this->template->load('halaman_master','template/includes/data_kelas',$data);
    }
    public function Simpankelas()
    {
        $this->form_validation->set_rules('nama_kelas','nama_kelas','required|is_unique[t_kelas.nama_kelas]',array('required'=>'Nama kelas tidak boleh kosong','is_unique' =>'Nama kelas sudah terdaftar di dalam tabel'));
        $this->form_validation->set_rules('kompetensi_keahlian','kompetensi_keahlian','required',array('required'=>'Kompetensi keahlian tidak boleh kosong'));
        if ($this->form_validation->run()==FALSE) {
            $data['data_kelas']         =$this->Modeldata->get_data_kelas()->result();
            $this->template->load('halaman_master','template/includes/data_kelas',$data);
        }else{
            $this->Modeldata->simpankelas();
            $this->session->set_flashdata('pesan','Data Kelas berhasil di simpan.!');
            redirect('Admin/Kelas');
        }
    }
    public function Getidkelas($id=null)
    {
        $data = $this->Modeldata->get_kelas_by_id($id);
        echo json_encode($data);
    }
    public function Hapuskelas()
    {
        $id=$this->input->post('id_kelas',TRUE);
        $this->db->trans_start();
        $this->Modeldata->hapus_kelas($id);  
        $this->db->trans_complete();
        if ($this->db->trans_status()== FALSE) {
            $this->session->set_flashdata('pesan','Maaf data tidak bisa di hapus, karena masih berhubungan dengan tabel yang lain.!');
            redirect('Admin/Kelas');
        }else{
            $this->session->set_flashdata('pesan','Data kelas berhasil di hapus.!');
            redirect('Admin/Kelas');
        }

        
    }
    public function Editkelas($id_kelas=null)
    {
        $data['cari_data_kelas']         =$this->Modeldata->get_data_kelas_update($id_kelas)->result();
        $this->template->load('halaman_master','template/includes/edit_kelas',$data);
    }
    public function Updatekelas()
    {
        $id_kelas=$this->input->post('id_kelas',TRUE);
        $this->form_validation->set_rules('nama_kelas','nama_kelas','required|is_unique[t_kelas.nama_kelas]',array('required'=>'Nama Kelas tidak boleh kosong.!','is_unique'=>'Nama kelas sudah ada di dalam tabel.!'));
        $this->form_validation->set_rules('kompetensi_keahlian','kompetensi_keahlian','required',array('required'=>'Kompetensi Keahlian tidak boleh kosong.!'));
        if ($this->form_validation->run()==FALSE) {
            $data['cari_data_kelas']         =$this->Modeldata->get_data_kelas_update($id_kelas)->result();
            $this->template->load('halaman_master','template/includes/edit_kelas',$data);
        }else{
            $this->Modeldata->Update_kelas();
            $this->session->set_flashdata('pesan','Data Kelas berhasil di perbaharui');
            redirect('Admin/Kelas');
        }
    }
    public function SPP()
    {
        $data['data_spp']         =$this->Modeldata->get_data_spp()->result();
        $this->template->load('halaman_master','template/includes/data_spp',$data);
    }
    public function Simpanspp()
    {
        $this->form_validation->set_rules('tahun','tahun','required|is_unique[t_spp.tahun]',array('required'=>'Tahun tidak boleh kosong','is_unique' =>'Tahun sudah terdaftar di dalam tabel'));
        $this->form_validation->set_rules('nominal','nominal','required',array('required'=>'Nominal tidak boleh kosong'));
        if ($this->form_validation->run()==FALSE) {
            $data['data_spp']         =$this->Modeldata->get_data_spp()->result();
            $this->template->load('halaman_master','template/includes/data_spp',$data);
        }else{
            $tahun      =$this->input->post('tahun',TRUE);
            $nominal    =$this->input->post('nominal',TRUE);
            $this->Modeldata->simpanspp($tahun,$nominal);
            $this->session->set_flashdata('pesan','Data Kelas berhasil di simpan.!');
            redirect('Admin/SPP');
        }
    }
    public function Getidspp($id=null)
    {
       $data= $this->Modeldata->get_spp_by_id($id);
       echo json_encode($data);
    }
    public function Hapusspp()
    {
       $this->form_validation->set_rules('id_spp','id_spp','required|htmlspecialchars',array('required'=>'Pilih dulu ID SPP dulu yang akan di hapus.'));
       if ($this->form_validation->run()==FALSE) {
        $data['data_spp']         =$this->Modeldata->get_data_spp()->result();
        $this->session->set_flashdata('pesan','Data SPP Gagal di Hapus');
        $this->template->load('halaman_master','template/includes/data_spp',$data);
       }else{
           $this->Modeldata->Hapusspp($this->input->post('id_spp',TRUE));
           $this->session->set_flashdata('pesan','Data SPP Berhasil di hapus');
           redirect('Admin/SPP');
       }
    }
    public function Editspp($id=null)
    {
       $data['data_spp']        =$this->Modeldata->get_id_by_spp_edit($id)->result();
        $this->template->load('halaman_master','template/includes/edit_spp',$data);
    }
    public function Updatespp()
    {
        $id_spp=$this->input->post('id_spp',TRUE);
        $this->form_validation->set_rules('id_spp','id_spp','required',array('required'=>'Tidak ada data SPP yang akan di edit'));
        $this->form_validation->set_rules('tahun','tahun','required',array('required'=>'Tahun tidak boleh kosong'));
        $this->form_validation->set_rules('nominal','nominal','required',array('required'=>'Nominal tidak boleh kosong.'));
        if ($this->form_validation->run()==false) {
            $data['data_spp']        =$this->Modeldata->get_id_by_spp_edit($id_spp)->result();
            $this->template->load('halaman_master','template/includes/edit_spp',$data);
        }else{
            $setisidata=array(
                'tahun'     =>$this->input->post('tahun',TRUE),
                'nominal'   =>$this->input->post('nominal',TRUE),
            );
            $this->Modeldata->Updatespp($setisidata,$id_spp);
            $this->session->set_flashdata('pesan','Data SPP berhasil di perbaharui.!');
            redirect('Admin/SPP');
        }
    }
    public function Petugas()
    {
        $data['data_petugas']       =$this->Modeldata->get_petugas()->result();
        $this->template->load('halaman_master','template/includes/data_petugas',$data);
    }
    public function Simpanpetugas()
    {
        $this->form_validation->set_rules('nama_petugas','nama_petugas','required|htmlspecialchars',array('required'=>'Nama petugas tidak boleh kosong.!'));
        $this->form_validation->set_rules('username','username','required|is_unique[t_petugas.username]',array('required'=>'Username tidak boleh kosong','is_unique'=>'Username sudah terdaftar silahkan Gunakan username yang lain'));
        $this->form_validation->set_rules('pasword','pasword','required|htmlspecialchars',array('required'=>'Password tidak boleh kosong.!'));
        $this->form_validation->set_rules('paswordconf','paswordconf','required|matches[pasword]',array('required'=>'Password Konfirmasi tidak boleh kosong','matches'=>'Passowrd tidak sama, silahkan cek kembali'));
        $this->form_validation->set_rules('level','level','required');
        if ($this->form_validation->run()==FALSE) {
            $data['data_petugas']       =$this->Modeldata->get_petugas()->result();
            $this->template->load('halaman_master','template/includes/data_petugas',$data);
        }else{
            $this->Modeldata->Simpanpetugas();
            $this->session->set_flashdata('pesan','Data Petugas berhasil di Simpan');
            redirect('Admin/Petugas');
        }
    }
    public function Get_petugas_by_id($id)
    {
        $this->db->where('id_petugas',$id);
        $data =$this->db->get('t_petugas')->row();
        echo json_encode($data);
    }
    public function Hapuspetugas()
    {
        $this->form_validation->set_rules('id_petugas','id_petugas','required',array('required'=>'Tidak ada data yang akan di hapus.!'));
        if ($this->form_validation->run()==FALSE) {
            $data['data_petugas']       =$this->Modeldata->get_petugas()->result();
            $this->session->set_flashdata('pesan','Data petugas gagal di hapus.!');
            $this->template->load('halaman_master','template/includes/data_petugas',$data);
        }else{
            $this->Modeldata->hapuspetugas($this->input->post('id_petugas',TRUE));
            $this->session->set_flashdata('pesan','Data petugas berhasil di hapus.!');
            redirect('Admin/Petugas');
        }
    }
    public function Editpetugas($id=null)
    {
        $data['data_petugas']         =$this->Modeldata->get_petugas_by_id($id)->result();
        $this->template->load('halaman_master','template/includes/edit_petugas',$data);
    }
    public function Updatepetugas()
    {
        $id=$this->input->post('id_petugas',TRUE);
        $this->form_validation->set_rules('nama_petugas','nama_petugas','required|htmlspecialchars',array('required'=>'Nama Petugas tidak boleh kosong'));
        // $this->form_validation->set_rules('username','username','htmlspecialchars',array('required'=>'Username tidak boleh kosong.!'));
        $this->form_validation->set_rules('pasword','pasword','required|htmlspecialchars',array('required'=>'Password tidak boleh kosong.!'));
        $this->form_validation->set_rules('paswordconf','paswordconf','required|matches[pasword]',array('required'=>'Password tidak boleh kosong.!','matches'=>'Password tidak sama, mohon cek kembali.!'));
        $this->form_validation->set_rules('level','level','required|htmlspecialchars',array('required'=>'Level tidak boleh kosong.!'));
        if ($this->form_validation->run()==FALSE) {
            $data['data_petugas']         =$this->Modeldata->get_petugas_by_id($id)->result();
            $this->template->load('halaman_master','template/includes/edit_petugas',$data);
        }else{
            $isidata=array(
                'nama_petugas'      =>$this->input->post('nama_petugas',TRUE),
                'pasword'           =>$this->input->post('pasword',TRUE),
                'level'             =>$this->input->post('level',TRUE),
            );
            $id_petugas=$this->input->post('id_petugas',TRUE);
            $this->Modeldata->update_petugas($isidata,$id_petugas);
            $this->session->set_flashdata('pesan','Data petugas berhasil di perbaharui.!!');
            redirect('Admin/Petugas');
        }
    }
    public function Siswa()
    {
        $data['data_siswa']     =$this->Modeldata->get_siswa()->result();
        $data['data_kelas']     =$this->Modeldata->Get_data_kelas()->result();
        $data['data_spp']       =$this->Modeldata->get_data_spp()->result();
        $this->template->load('halaman_master','template/includes/data_siswa',$data);
    }
    public function Simpansiswa()
    {
        $this->form_validation->set_rules('nisn','nisn','required|is_unique[t_siswa.nisn]',array('required'=>'NISN Tidak boleh kosong','is_unique'=>'NISN tersebut Sudah ada di dalam tabel siswa'));
        $this->form_validation->set_rules('nis','nis','required|is_unique[t_siswa.nis]',array('required'=>'NIS Tidak boleh kosong','is_unique'=>'NIS tersebut sudah ada di dalam tabel.'));
        $this->form_validation->set_rules('nama','nama','required',array('required'=>'Nama tidak boleh kosong'));
        $this->form_validation->set_rules('kelas','kelas','required',array('required'=>'Kelas tidak boleh kosong'));
        $this->form_validation->set_rules('alamat','alamat','required',array('required'=>'Alamat tidak boleh kosong'));
        $this->form_validation->set_rules('no_telepon','no_telepon','required',array('required'=>'No Telepon tidak boleh kosong'));
        $this->form_validation->set_rules('spp','spp','required',array('required'=>'SPP tidak boleh kosong'));
        if ($this->form_validation->run()==FALSE) {
            $data['data_siswa']     =$this->Modeldata->get_siswa()->result();
            $data['data_kelas']     =$this->Modeldata->Get_data_kelas()->result();
            $data['data_spp']       =$this->Modeldata->get_data_spp()->result();
            $this->template->load('halaman_master','template/includes/data_siswa',$data);
        }else{
            $this->Modeldata->simpansiswa();
            $this->session->set_flashdata('pesan','Data siswa berhasil di simpan');
            redirect('Admin/Siswa');
        }
    }
   public function Transaksi()
   {
       $data['data_siswa']              =$this->Modeldata->get_siswa()->result();
       $data['data_pembayaran']         =$this->Modeldata->get_transaksi_pembayaran()->result();
       $this->template->load('halaman_master','template/includes/data_pembayaran',$data);
   }
  public function Autocomplete()
  {
      $nisn=$_GET['nisn'];
      $this->db->where('nisn',$nisn);
      $query = $this->db->get('vw_siswa_join_kelas_spp')->result();
      echo json_encode($query);
  }
  public function Simpantransaksi()
  {
      $this->form_validation->set_rules('nisn','nisn','required',array('required'=>'NISN tidak boleh kosong'));
      $this->form_validation->set_rules('tanggal','tanggal','required');
      $this->form_validation->set_rules('jumbar','jumbar','required',array('required'=>'Jumlah bayar tidak boleh Kosong'));
      if ($this->form_validation->run()==TRUE) {
          $this->Modeldata->simpantransaksi();
          $this->session->set_flashdata('pesan','Data transaksi berhasil di simpan.');
          redirect('Admin/Transaksi');
      }else{
            $data['data_siswa']              =$this->Modeldata->get_siswa()->result();
            $data['data_pembayaran']         =$this->Modeldata->get_transaksi_pembayaran()->result();
          $this->template->load('halaman_master','template/includes/data_pembayaran',$data);
      }
  }
}