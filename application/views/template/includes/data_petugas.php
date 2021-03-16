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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Simpanpetugas" method="POST">
            Nama Petugas <input type="text" name="nama_petugas" value="<?php echo set_value('nama_petugas') ?>" class="form-control">
            <font color="red"><?php echo form_error('nama_petugas') ?></font>
            Username <input type="text" name="username" value="<?php echo set_value('username') ?>" class="form-control">
            <font color="red"><?php echo form_error('username') ?></font>
            Passowrd <input type="password" name="pasword" value="<?php echo set_value('pasword') ?>" class="form-control">
            <font color="red"><?php echo form_error('pasword') ?></font>
            Konfirmasi Password <input type="password" name="paswordconf" value="<?php echo set_value('paswordconf') ?>" class="form-control">
            <font color="red"><?php echo form_error('paswordconf') ?></font>
            Level
            <select name="level" id="" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
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
                        ID Petugas
                    </td>
                    <td>
                        Nama Petugas
                    </td>
                    <td>
                        Username
                    </td>
                    <td>
                        Level
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <?php 
                foreach ($data_petugas as $tampilkan) {
                    echo "<tr>";
                        echo "<td>$tampilkan->id_petugas</td>";
                        echo "<td>$tampilkan->nama_petugas</td>";
                        echo "<td>$tampilkan->username</td>";
                        echo "<td>$tampilkan->level</td>";
                        echo"<td><a href='Editpetugas/$tampilkan->id_petugas'><button class='btn btn-primary btn-xs'>Edit</button></a> <button class='btn btn-danger btn-xs' onClick='hapus($tampilkan->id_petugas)'>Hapus</button></td>";
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
            url:"<?php echo base_url('index.php/Admin/Get_petugas_by_id') ?>/"+id,
            type:"GET",
            dataType:"JSON",
            success :function(data){
                $('[name="id_petugas"]').val(data.id_petugas);
                $('#form-modal').modal('show');
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert('Gagal Ambil Ajax');
            }
        });
    }
</script>
<!-- Modal -->
<div class="modal fade" id="form-modal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pesan Hapus data Petugas</h4>
        </div>
        <div class="modal-body">
                <form action="<?php echo base_url() ?>index.php/Admin/Hapuspetugas" id="form_hapus" method="POST">
                    <input type="hidden" name="id_petugas" value="">
                    <p>
                        Apakah anda yakin akan menghapus data tersebut.?!
                    </p>
                
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">YA</button>
                </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>