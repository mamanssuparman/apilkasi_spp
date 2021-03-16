<?php 

class Modeldata extends CI_Model{
    public function Get_data_kelas()
    {
        return $this->db->get('t_kelas');
    }
    public function simpankelas()
    {
        $isidata=array(
            'nama_kelas'    =>$this->input->post('nama_kelas',TRUE),
            'kompetensi_keahlian'   =>$this->input->post('kompetensi_keahlian',TRUE),
        );
        $this->db->insert('t_kelas',$isidata);
    }
    public function get_kelas_by_id($id)
    {
        $this->db->where('id_kelas',$id);
        return $this->db->get('t_kelas')->row();
    }
    public function hapus_kelas($id)
    {
        $this->db->where('id_kelas',$id);
        return $this->db->delete('t_kelas');
    }
    public function get_data_kelas_update($id_kelas)
    {
        $this->db->where('id_kelas',$id_kelas);
        return $this->db->get('t_kelas');
    }
    public function Update_kelas()
    {
        $id_kelas=$this->input->post('id_kelas',TRUE);
        $isidata=array(
            'nama_kelas'        =>$this->input->post('nama_kelas',TRUE),
            'kompetensi_keahlian'   =>$this->input->post('kompetensi_keahlian',TRUE),
        );
        $this->db->where('id_kelas',$id_kelas);
        $this->db->set($isidata);
        $this->db->update('t_kelas');
    }
    public function get_data_spp()
    {
        return $this->db->get('t_spp');
    }
    public function simpanspp($tahun,$nominal)
    {
        $isidata=array(
            'tahun'     =>$tahun,
            'nominal'   =>$nominal,
        );
        $this->db->insert('t_spp',$isidata);
    }
    public function get_spp_by_id($id)
    {
        $this->db->where('id_spp',$id);
        return $this->db->get('t_spp')->row();
    }
    public function get_id_by_spp_edit($id)
    {
        return $this->db->get_where('t_spp',array('id_spp'=>$id));
    }
    public function Hapusspp()
    {
        $this->db->where('id_spp',$this->input->post('id_spp',TRUE));
        $this->db->delete('t_spp');
    }
    public function Updatespp($isidata,$where)
    {
        $this->db->set($isidata);
        $this->db->where('id_spp',$where);
        $this->db->update('t_spp');
    }
    public function get_petugas()
    {
        return $this->db->get('t_petugas');
    }
    public function Simpanpetugas()
    {
        $passwordhash=password_hash($this->input->post('pasword'),PASSWORD_DEFAULT);
        $isidata=array(
            'nama_petugas'  =>$this->input->post('nama_petugas',TRUE),
            'username'      =>$this->input->post('username',TRUE),
            'pasword'       =>$passwordhash,
            'level'         =>$this->input->post('level',TRUE),
        );
        $this->db->insert('t_petugas',$isidata);
    }
    public function hapuspetugas($id)
    {
        $this->db->where('id_petugas',$id);
        $this->db->delete('t_petugas');
    }
    public function get_petugas_by_id($id)
    {
        $this->db->where('id_petugas',$id);
        return $this->db->get('t_petugas');
    }
    public function update_petugas($isidata,$id)
    {
        $this->db->set($isidata);
        $this->db->where('id_petugas',$id);
        $this->db->update('t_petugas');
    }
    public function get_siswa()
    {
        return $this->db->get('vw_siswa_join_kelas_spp');
    }
    public function simpansiswa()
    {
        $isidata=array(
            'nisn'      =>$this->input->post('nisn',TRUE),
            'nis'       =>$this->input->post('nis',TRUE),
            'nama'      =>$this->input->post('nama',TRUE),
            'id_kelas'  =>$this->input->post('kelas',TRUE),
            'alamat'    =>$this->input->post('alamat',TRUE),
            'no_telepon'=>$this->input->post('no_telepon',TRUE),
            'id_spp'    =>$this->input->post('spp',TRUE),
        );
        $this->db->insert('t_siswa',$isidata);
    }
    public function get_transaksi_pembayaran()
    {
        return $this->db->get('vw_pembayaran');
    }
    public function simpantransaksi()
    {
        $isidata=array(
            'id_petugas'    =>$this->input->post('id_petugas',TRUE),
            'nisn'          =>$this->input->post('nisn',TRUE),
            'tgl_bayar'     =>$this->input->post('tanggal',TRUE),
            'bulan_dibayar' =>$this->input->post('bulan_bayar',TRUE),
            'tahun_dibayar' =>$this->input->post('tahun_bayar',TRUE),
            'id_spp'        =>$this->input->post('id_tahun',TRUE),
            'jumlah_bayar'  =>$this->input->post('jumbar',TRUE),
        );
        $this->db->insert('t_pembayaran',$isidata);
    }
}