<div class="box">
    <div class="box-header">
        Form Input Data Pembayaran
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
             
        <form action="<?php echo base_url() ?>index.php/Admin/Simpantransaksi" method="POST">
                <input type="hidden" name="id_petugas" value="<?php echo $this->session->userdata('id_petugas') ?>">
           NISN<input list="list_siswa" type="text" name="nisn" id="nisn" class="form-control" onchange="return autofill()">
           Nama<input type="text" name="nama" id="nama" class="form-control" disabled>
           <input type="hidden" name="id_kelas" id="id_kelas">
           Kelas<input type="text" name="kelas" id="kelas" class="form-control" disabled>
           Alamat<input type="text" name="alamat" id="alamat" class="form-control" disabled>
           No telepon<input type="text" name="no_telepon" id="no_telepon" class="form-control" disabled>
           <input type="hidden" name="id_tahun" id="id_tahun">
           Tahun SPP<input type="text" name="tahun_spp" id="tahun_spp" class="form-control" disabled>
           Tanggal Bayar <input type="date" name="tanggal" id="tanggal" class="form-control">
           Bulan Bayar
           <select name="bulan_bayar" id="bulan_bayar" class="form-control">
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
           </select>
           Tahun Bayar
           <select name="tahun_bayar" id="tahun_bayar" class="form-control">
                <?php 
                    for ($i=2021; $i < 2030 ; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
           </select>
           Jumlah Bayar <input type="number" name="jumbar" id="jumbar" class="form-control">
           
            <button type="submit" class="btn btn-primary btn-md pull-right">SIMPAN</button>
        </form>
        <datalist id="list_siswa">
                <?php 
                    foreach ($data_siswa as $tampilkan_siswa) {
                        echo "<option value='$tampilkan_siswa->nisn'>$tampilkan_siswa->nama</option>";
                    }
                ?>
        </datalist>
    </div>
</div>
<div class="box">
    <div class="box-header">
        Data Transaksi Pembayaran
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover" id="example1">
            <thead>
                <tr>
                    <td>
                        ID Pembayaran
                    </td>
                    <td>
                        Nama Petugas
                    </td>
                    <td>
                        NISN
                    </td>
                    <td>
                        Nama Siswa
                    </td>
                    <td>
                        Tanggal Bayar
                    </td>
                    <td>
                        Bulan
                    </td>
                    <td>
                        Tahun SPP
                    </td>
                    <td>
                        Nominal
                    </td>
                    <td>
                        Jumlah Bayar
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
           <?php 
                foreach ($data_pembayaran as $tampilkan_transaksi) {
                    echo "<tr>";
                        echo "<td>$tampilkan_transaksi->id_pembayaran</td>";
                        echo "<td>$tampilkan_transaksi->nama_petugas</td>";
                        echo "<td>$tampilkan_transaksi->nisn</td>";
                        echo "<td>$tampilkan_transaksi->nama</td>";
                        echo "<td>$tampilkan_transaksi->tgl_bayar</td>";
                        echo "<td>$tampilkan_transaksi->bulan_dibayar</td>";
                        echo "<td>$tampilkan_transaksi->tahun_dibayar</td>";
                        echo "<td>$tampilkan_transaksi->nominal</td>";
                        echo "<td>$tampilkan_transaksi->jumlah_bayar</td>";
                        echo "<td><button class='btn btn-primary btn-xs'>Edit</button></td>";
                    echo "</tr>";
                }
           ?>
        </table>
    </div>
</div>
<!-- JS -->

<script>
function autofill(){

    var nisn = document.getElementById('nisn').value;
    $.ajax({
        url: "<?php echo base_url('index.php/Admin/Autocomplete') ?>",
        data:'&nisn='+nisn,
        success : function(data){
            var hasil = JSON.parse(data);
            $.each(hasil, function(key, val){
                document.getElementById('nisn').value=val.nisn;
                document.getElementById('nama').value=val.nama;
                document.getElementById('id_kelas').value=val.id_kelas;
                document.getElementById('kelas').value=val.nama_kelas;
                document.getElementById('alamat').value=val.alamat;
                document.getElementById('no_telepon').value=val.no_telepon;
                document.getElementById('id_tahun').value=val.id_spp;
                document.getElementById('tahun_spp').value=val.tahun;
            });
        }
    });
}
</script>