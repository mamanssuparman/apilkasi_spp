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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Simpankelas" method="POST">
            Nama Kelas <input type="text" name="nama_kelas" value="<?php echo set_value('nama_kelas') ?>" class="form-control">
            <font color="red"><?php echo form_error('nama_kelas') ?></font>
            Kompetensi Keahlian <input type="text" name="kompetensi_keahlian" value="<?php echo set_value('kompetensi_keahlian') ?>" class="form-control">
            <font color="red"><?php echo form_error('kompetensi_keahlian') ?></font>
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
                        ID Kelas
                    </td>
                    <td>
                        Nama Kelas
                    </td>
                    <td>
                        Kompetensi Keahlian
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <?php 

                foreach ($data_kelas as $tampilkan) {
                    echo "<tr>";
                        echo "<td>$tampilkan->id_kelas</td>";
                        echo "<td>$tampilkan->nama_kelas</td>";
                        echo "<td>$tampilkan->kompetensi_keahlian</td>";
                        echo "<td><a href='Editkelas/$tampilkan->id_kelas'><button class='btn btn-primary btn-xs'>Edit</button></a> <button class='btn btn-danger btn-xs' onClick='hapus($tampilkan->id_kelas)'>Hapus</button></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</div>

<!-- JS -->
<script>
    function hapus(id){
        $('#form_hapus')[0].reset();
        $.ajax({
            url :"<?php echo base_url('index.php/Admin/Getidkelas') ?>/"+id,
            type:"GET",
            dataType:"JSON",
            success :function(data){
                $('[name="id_kelas"]').val(data.id_kelas);
                $('#form_modal_hapus').modal('show');
            },
            error : function(jqXHR,textStatus,errorThrown){
                alert('Gagal ambil ajax');
            }
        });
    }
</script>
<!-- Modal -->
<div class="modal fade" id="form_modal_hapus">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal Peringatan</h4>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url() ?>index.php/Admin/Hapuskelas" id="form_hapus" method="POST">
                <input type="hidden" name="id_kelas" value="">
                <p>
                    Apakah anda yakin akan menghapus data tersebut.?
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