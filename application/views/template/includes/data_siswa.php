<div class="box">
    <div class="box-header">
        Form Input Data Siswa
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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Simpansiswa" method="POST">
            NISN <input type="text" name="nisn" class="form-control" value="<?php echo set_value('nisn') ?>">
            <font color="red"><?php echo form_error('nisn') ?></font>
            NIS <input type="text" name="nis" class="form-control" value="<?php echo set_value('nis') ?>">
            <font color="red"><?php echo form_error('nis') ?></font>
            Nama <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama') ?>">
            <font color="red"><?php echo form_error('nama') ?></font>
            Kelas
            <select name="kelas" id="" class="form-control">
                <?php 
                    foreach ($data_kelas as $tampilkan_kelas) {
                        echo "<option value='$tampilkan_kelas->id_kelas'>$tampilkan_kelas->nama_kelas</option>";
                    }
                   
                ?>
            </select>
            Alamat <input type="text" name="alamat" class="form-control" value="<?php echo set_value('alamat') ?>">
            <font color="red"><?php echo form_error('alamat') ?></font>
            No Telepon <input type="text" name="no_telepon" class="form-control" value="<?php echo set_value('no_telepon') ?>">
            <font color="red"><?php echo form_error('no_telepon') ?></font>
            TAHUN SPP
            <select name="spp" id="" class="form-control">
                    <?php 
                        foreach ($data_spp as $tampilkan_spp) {
                            echo "<option value='$tampilkan_spp->id_spp'>$tampilkan_spp->tahun</option>";
                        }
                    ?>
            </select>
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
    </div>
</div>
<div class="box">
    <div class="box-header">
        Data Siswa
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover" id="example1">
            <thead>
                <tr>
                    <td>
                        NISN
                    </td>
                    <td>
                        NIS
                    </td>
                    <td>
                        Nama
                    </td>
                    <td>
                        Nama Kelas
                    </td>
                    <td>
                        Alamat
                    </td>
                    <td>
                        No Telepon
                    </td>
                    <td>
                        Tahun SPP
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <?php 

                foreach ($data_siswa as $tampilkan_siswa) {
                    echo "<tr>";
                        echo "<td>$tampilkan_siswa->nisn</td>";
                        echo "<td>$tampilkan_siswa->nis</td>";
                        echo "<td>$tampilkan_siswa->nama</td>";
                        echo "<td>$tampilkan_siswa->nama_kelas</td>";
                        echo "<td>$tampilkan_siswa->alamat</td>";
                        echo "<td>$tampilkan_siswa->no_telepon</td>";
                        echo "<td>$tampilkan_siswa->tahun</td>";
                        echo "<td><button class='btn btn-primary btn-xs'>Edit</button> <button class='btn btn-danger btn-xs' onClick='hapus($tampilkan_siswa->nisn)'>Hapus</button></td>";
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
            url : "<?php echo base_url('index.php/Admin/Getnisnsiswa') ?>/"+id,
            type:"GET",
            dataType:"JSON",
            success : function(data){
                $('[name="nisn_hapus"]').val(data.nisn);
                $('#modal-default').modal('show');
            },
            error : function(jqXHR, textStatus, errorThrown){
                alert('Gagal ambil ajax');
            }

        });
    }
</script>
<!-- Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pesan Peringatan Hapus</h4>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url() ?>index.php/Admin/Hapussiswa" id="form_hapus" method="POST">
        <input type="hidden" name="nisn_hapus" value="" id="">
        Apakah anda yakin akan menghapus data tersebut.?!
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>