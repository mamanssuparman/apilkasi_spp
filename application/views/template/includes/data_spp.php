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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Simpanspp" method="POST">
                Tahun
             <select name="tahun" id="" class='form-control'>
                <?php 
                    for ($i=2020; $i < 2050 ; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
             </select>
            <font color="red"><?php echo form_error('tahun') ?></font>
            Nominal <input type="number" name="nominal" value="<?php echo set_value('nominal') ?>" class="form-control">
            <font color="red"><?php echo form_error('nominal') ?></font>
            <br>
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
    </div>
</div>
<div class="box">
    <div class="box-header">
        Data Kelas
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover" id="example1">
            <thead>
                <tr>
                    <td>
                        ID SPP
                    </td>
                    <td>
                        Tahun
                    </td>
                    <td>
                        Nominal
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <?php 

                foreach ($data_spp as $tampilkan) {
                    echo "<tr>";
                        echo "<td>$tampilkan->id_spp</td>";
                        echo "<td>$tampilkan->tahun</td>";
                        echo "<td>$tampilkan->nominal</td>";
                        echo "<td><a href='Editspp/$tampilkan->id_spp'><button class='btn btn-primary btn-xs'>Edit</button></a> <button class='btn btn-danger btn-xs' onClick='hapus($tampilkan->id_spp)'>Hapus</button></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</div>

<!-- JS -->
<script>
    $('#form_hapus')[0].reset();
    function hapus(id){
        $.ajax({
            url :"<?php echo base_url('index.php/Admin/Getidspp') ?>/"+id,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                $('[name="id_spp"]').val(data.id_spp);
                $('#modal-pesan').modal('show');
            },
            error: function(jqXHR,textStatus,errorThrown){
                alert('Gagal ambil Ajax');
            }
        });
    }

</script>
<!-- Modal -->
<div class="modal fade" id="modal-pesan">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url() ?>index.php/Admin/Hapusspp" id="form_spp" method="POST">
                <input type="hidden" name="id_spp" value="" id="">
                <p>
                    Apakah anda yakin akan menghapus data tersebut.!?
                </p>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>