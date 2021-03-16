<div class="box">
    <div class="box-header">
        Form Input Data Kelas
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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Updatekelas" method="POST">
            <?php 
                foreach ($cari_data_kelas as $tampilkan) { ?>
                <input type="hidden" name="id_kelas" value="<?php echo $tampilkan->id_kelas ?>">
            Nama Kelas <input type="text" name="nama_kelas" value="<?php echo set_value('nama_kelas') ?><?php echo $tampilkan->nama_kelas ?>" class="form-control">
            <font color="red"><?php echo form_error('nama_kelas') ?></font>
            Kompetensi Keahlian <input type="text" name="kompetensi_keahlian" value="<?php echo set_value('kompetensi_keahlian') ?><?php echo $tampilkan->kompetensi_keahlian ?>" class="form-control">
            <font color="red"><?php echo form_error('kompetensi_keahlian') ?></font>
            <br>
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
    <?php }
    ?>
    </div>
</div>