<!-- title container -->
<div class="block-header">
    <h2>Pengelolaan Karyawan</h2>
</div>
<!-- end title container -->

<?= showFlashMessage(); ?>

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Karyawan
                </h2>
                    <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#addKaryawanModal">
                        <i class="material-icons">add</i>
                        <span>Tambah Karyawan</span>
                    </button>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>ALAMAT</th>
                                <th>UMUR</th>
                                <th>NO HANDPHONE</th>
                                <th>GAJI</th>
                                <th>JABATAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                       <tbody>
                            <?php 
                                if (!empty($listkaryawan)) {
                                    $no = 1;

                                    foreach ($listkaryawan as $karyawan): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $karyawan->nama; ?></td>
                                        <td><?= $karyawan->alamat; ?></td>
                                        <td><?= $karyawan->umur; ?> thn</td>
                                        <td><?= $karyawan->no_handphone; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($karyawan->gaji)),3))); ?></td>
                                        <td><?= $karyawan->jabatan; ?></td>
                                        <td>
                                            <button type="button" id="<?php echo $karyawan->id_karyawan; ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#editModal">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $karyawan->id_karyawan; ?>"  data-toggle="modal" data-target="#deleteModal">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada daftar karyawan.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                        
        </div>
    </div>
</div>


<div class="modal fade" id="addKaryawanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Tambah Karyawan</h4>
            </div>
            <div class="modal-body">
                <form id="vInserPegawai" action="<?= base_url('adminroot/pengelolaan_karyawan/insertKaryawan'); ?>" method="POST">
                    <label>Nama</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NamaKaryawanPost" class="form-control" placeholder="Masukan Nama Karyawan" autofocus required>
                        </div>
                    </div>
                    <label>Alamat</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="AlamatKaryawanPost" class="form-control" placeholder="Masukan Alamat" required>
                        </div>
                    </div>
                    <label>Umur</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="UmurKaryawanPost" class="form-control" placeholder="Masukan Umur" required>
                        </div>
                    </div>
                    <label>No Handphone</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NoHpKaryawanPost" class="form-control" placeholder="Masukan No Handphone" required>
                        </div>
                    </div>
                    <label>Gaji</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="GajiKaryawanPost" name="GajiKaryawanPost" class="form-control uang" placeholder="Masukan Gaji" required>
                        </div>
                    </div>
                    <label>Jabatan</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="JabatanKaryawanPost" class="form-control" placeholder="Masukan Jabatan" required>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Edit Karyawan</h4>
            </div>
            <div class="modal-body">
                <form id="vEditPegawai" action="<?= base_url('adminroot/Pengelolaan_karyawan/saveUpdate'); ?>" method="POST">
                    <!-- <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line"> -->
                            <input type="hidden" id="idKaryawan" name="idKaryawan" class="form-control">
                        <!-- </div>
                    </div> -->
                    
                    <label>Nama</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="namaKaryawan" name="namaKaryawan" class="form-control" placeholder="Masukan Nama Karyawan" required>
                        </div>
                    </div>
                    <label>Alamat</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="alamatKaryawan" name="alamatKaryawan" class="form-control" placeholder="Masukan Alamat" required>
                        </div>
                    </div>
                    <label>Umur</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="umurKaryawan" name="umurKaryawan" class="form-control" placeholder="Masukan Umur" required>
                        </div>
                    </div>
                    <label>No Handphone</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="noHpKaryawan" name="noHpKaryawan" class="form-control" placeholder="Masukan No Handphone" required>
                        </div>
                    </div>
                    <label>Gaji</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="gajiKaryawan" name="gajiKaryawan" class="form-control uang" placeholder="Masukan Gaji"required>
                        </div>
                    </div>
                    <label>Jabatan</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="jabatanKaryawan" name="jabatanKaryawan" class="form-control" placeholder="Masukan Jabatan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Karyawan</h4>
            </div>
            <div class="modal-body">
                <h4 class="h4">Apakah anda yakin akan menghapus <b id="NamaKaryawanDel"></b> sebagai karyawan ? </h4>
            </div>
            <div class="modal-footer">
                <a class="btn bg-red waves-effect hapus">
                    <i class="material-icons">delete</i>
                    <span>Hapus</span>
                </a>
                <a type="button" class="btn waves-effect" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Close</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->



<script>

    $('#vInserPegawai').validate();
    $('#vEditPegawai').validate();

    // insert mask rupiah
    var dengan_rupiah1 = document.getElementById('GajiKaryawanPost');
    dengan_rupiah1.addEventListener('keyup', function(e)
    {
        dengan_rupiah1.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah1.value);
    });

    // edit mask rupiah
    var dengan_rupiah = document.getElementById('gajiKaryawan');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah.value);
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
    
    // get fine One Update
    $(".btn-edit").click(function(){
        console.log(this.id);
        var idKaryawan = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_karyawan/editKaryawan') ?>",
    {
        id: idKaryawan
    },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);
             $("#idKaryawan").val(data_objek.karyawan[0].id_karyawan);
             $("#namaKaryawan").val(data_objek.karyawan[0].nama);
             $("#alamatKaryawan").val(data_objek.karyawan[0].alamat);
             $("#umurKaryawan").val(data_objek.karyawan[0].umur);
             $("#noHpKaryawan").val(data_objek.karyawan[0].no_handphone);
             $("#gajiKaryawan").val(data_objek.karyawan[0].gaji);
             $("#jabatanKaryawan").val(data_objek.karyawan[0].jabatan);
            
             $('#modal_large').modal('toggle');
        });
    });


    // get fine One delete
    $(".btn-delete").click(function(){
        console.log(this.id);
        var idKaryawan = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_karyawan/editKaryawan') ?>",
    {
        id: idKaryawan
    },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);
            document.getElementById("NamaKaryawanDel").innerHTML = data_objek.karyawan[0].nama;
            document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.karyawan[0].id_karyawan);
            document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.karyawan[0].id_karyawan);
            document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/Pengelolaan_karyawan/hapusKaryawan/') ?>"+data_objek.karyawan[0].id_karyawan);
            $('#modal_large').modal('toggle');
        });
    });


</script>
