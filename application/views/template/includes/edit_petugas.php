<div class="box">
    <div class="box-header">
        Form Edit Petugas
    </div>
    <div class="box-body">
        <?php 
            if (!empty($this->session->flashdata('pesan'))) { ?>
                <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Pesan </h4>
                    <?php echo $this->session->flashdata('pesan') ?>
              </div>   
           <?php }
        ?>
             
        <form action="<?php echo base_url() ?>index.php/Admin/Updatepetugas" method="POST">
        <?php 
            foreach ($data_petugas as $tampilkan) { ?>
            <input type="hidden" name="id_petugas" value="<?php echo $tampilkan->id_petugas ?>">
            Nama Petugas <input type="text" name="nama_petugas" value="<?php echo $tampilkan->nama_petugas ?>" class="form-control">
            <font color="red"><?php echo form_error('nama_petugas') ?></font>
            Username <input type="text" name="username" value="<?php echo $tampilkan->username ?>" class="form-control" disabled>
            <font color="red"><?php echo form_error('username') ?></font>
            Password Baru <input type="password" name="pasword" class="form-control" value="<?php echo set_value('pasword') ?>">
            <font color="red"><?php echo form_error('pasword') ?></font>
            Konfirmasi Password <input type="password" name="paswordconf" value="<?php echo set_value('paswordconf') ?>" class="form-control">
            <font color="red"><?php echo form_error('paswordconf') ?></font>
            Level
            <select name="level" id="" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
            <br>
            <?php   }
            ?>
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
    </div>
</div>