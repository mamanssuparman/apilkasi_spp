<?php 

function ceklogin()
{
    $ci=& get_instance();
    $session_user=$ci->session->userdata('nama_petugas');
    if (!$session_user) {
        redirect('');
    }
}