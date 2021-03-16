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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Updatespp" method="POST">
                
                Tahun
             <select name="tahun" id="" class='form-control'>
                <?php 
                    for ($i=2020; $i < 2050 ; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
             </select>
             <?php 
                foreach ($data_spp as $tampilkan) { ?>
                    
                    <input type="hidden" name="id_spp" value="<?php echo $tampilkan->id_spp ?>">
            <font color="red"><?php echo form_error('tahun') ?></font>
            Nominal <input type="number" name="nominal" value="<?php echo $tampilkan->nominal; ?>" class="form-control">
            <font color="red"><?php echo form_error('nominal') ?></font>
            <?php   }
             ?>
            <br>
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
    </div>
</div>