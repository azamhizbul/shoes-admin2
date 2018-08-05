<!-- title container -->
<div class="block-header">
    <h2>Pengelolaan Barang Titipan</h2>
</div>
<!-- end title container -->

<?= showFlashMessage(); ?>

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header cs-header-tambah-barang">
                <h2>
                    Daftar Barang
                </h2>
                <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModalPost">
                    <i class="material-icons">add</i>
                    <span>Tambah Barang</span>
                </button>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MERK</th>
                                <th>ID BARANG</th>
                                <th>JENIS SEPATU</th>
                                <th>WARNA</th>
                                <th>UKURAN</th>
                                <th>HARGA</th>
                                <th>STOK</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($listbarang)) {
                                    $no = 1;

                                    foreach ($listbarang as $barang): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $barang->nama_merk; ?></td>
                                        <td><?= $barang->produk; ?></td>
                                        <td><?= $barang->jenis_sepatu; ?></td>
                                        <td><?= $barang->warna; ?></td>
                                        <td><?= $barang->ukuran; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->harga)),3))); ?></td>
                                        <td><?= $barang->stok; ?>
                                        <td>
                                    <button type="button" id="<?php echo $barang->id_barang ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#defaultModal">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $barang->id_barang ?>"  data-toggle="modal" data-target="#modalDelete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    
                                </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="9" align="center">Tidak ada daftar barang.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="defaultModalPost" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Tambah Barang</h4>
            </div>
            <div class="modal-body">

                <form id="vInserBarang" action="<?php echo base_url('adminroot/Pengelolaan_barang/tambahBarangTitipan'); ?>" method="post">
                    <label>Nama Merk</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NamaMerkPost" class="form-control" placeholder="Masukan Nama Merk" required>
                        </div>
                    </div>
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" name="NamaJenisPost" class="form-control" placeholder="Masukan Nama Jenis" required>
                        </div>
                    </div>
                    <label>Jenis Sepatu</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="JenisSepatuPost" class="form-control" placeholder="Masukan Jenis Sepatu" required>
                        </div>
                    </div>
                    <label>Warna</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="WarnaPost" class="form-control" placeholder="Masukan Warna" required>
                        </div>
                    </div>
                    <label>Ukuran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="UkuranPost" class="form-control" placeholder="Masukan Jenis Sepatu" required>
                        </div>
                    </div>
                    <label>Harga pembuatan / item</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaPembuatanPost" name="HargaPembuatanPost" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>

                    <label>Harga End User</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaEndPost" name="HargaEndPost" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>
                    <label>Harga Reseller</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaResellPost" name="HargaResellPost" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>
                     <label>Harga Jual Vendor</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaJualVemdorPost" name="HargaJualVemdorPost" class="form-control" placeholder="Masukan Harga Jual Vendor" required>
                        </div>
                    </div>
                     <label>Harga Packing</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaPackingPost" name="HargaPackingPost" class="form-control" placeholder="Masukan Harga Packing" required>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Edit Barang</h4>
            </div>
            <div class="modal-body">

                <form id="vEditBarang" action="<?php echo base_url('adminroot/Pengelolaan_barang/saveUpdateTitipan'); ?>" method="post">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" id="idBarang" name="idBarang" class="form-control" placeholder="Masukan Nama Merk">
                        </div>
                    </div>
                    <label>Nama Merk</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="NamaMerk" name="NamaMerk" class="form-control" placeholder="Masukan Nama Merk" required>
                        </div>
                    </div>
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" id="NamaJenis" name="NamaJenis" class="form-control" placeholder="Masukan Nama Jenis" required>
                        </div>
                    </div>
                    <label>Jenis Sepatu</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="JenisSepatu" name="JenisSepatu" class="form-control" placeholder="Masukan Jenis Sepatu" required>
                        </div>
                    </div>
                    <label>Warna</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="Warna" name="Warna" class="form-control" placeholder="Masukan Warna" required>
                        </div>
                    </div>
                    <label>Ukuran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="Ukuran" name="Ukuran" class="form-control" placeholder="Masukan Jenis Sepatu" required>
                        </div>
                    </div>
                    <label>Harga pembuatan / item</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaPembuatan" name="HargaPembuatan" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>

                    <label>Harga End User</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaEnd" name="HargaEnd" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>

                    <label>Harga Reseller</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaResell" name="HargaResell" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>

                    <label>Harga Jual Vendor</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaVendor" name="HargaVendor" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>

                    <label>Harga Packing</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="HargaPacking" name="HargaPacking" class="form-control" placeholder="Masukan Harga" required>
                        </div>
                    </div>
                    <br>

                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content"">
            <div class="modal-header modal-col-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Barang</h4>
            </div>
            <div class="modal-body">
                <h4 class="h4">Apakah anda yakin akan menghapus barang <b id="NamaMerkDel"></b> ?</h4>
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-danger waves-effect hapus" id="">
                    <i class="material-icons">delete</i>
                    <span>Hapus</span>
                </a>
                <a type="button" class="btn btn-default btn-sm waves-effect" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Close</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->
<!-- Jquery Core Js -->
    

<script>

    // validation
    $('#vInserBarang').validate();    
    $('#vEditBarang').validate();
    
    





 // insert mask rupiah
    var dengan_rupiah6 = document.getElementById('HargaPembuatanPost');
    dengan_rupiah6.addEventListener('keyup', function(e)
    {
        dengan_rupiah6.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah6.value);
    });

    var dengan_rupiah7 = document.getElementById('HargaEndPost');
    dengan_rupiah7.addEventListener('keyup', function(e)
    {
        dengan_rupiah7.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah7.value);
    });

    var dengan_rupiah8 = document.getElementById('HargaResellPost');
    dengan_rupiah8.addEventListener('keyup', function(e)
    {
        dengan_rupiah8.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah8.value);
    });

     var dengan_rupiah9 = document.getElementById('HargaJualVemdorPost');
    dengan_rupiah9.addEventListener('keyup', function(e)
    {
        dengan_rupiah9.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah9.value);
    });

    var dengan_rupiah10 = document.getElementById('HargaPackingPost');
    dengan_rupiah10.addEventListener('keyup', function(e)
    {
        dengan_rupiah10.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah10.value);
    });


     // edit mask rupiah
    var dengan_rupiah1 = document.getElementById('HargaVendor');
    dengan_rupiah1.addEventListener('keyup', function(e)
    {
        dengan_rupiah1.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah1.value);
    });

    var dengan_rupiah2 = document.getElementById('HargaPacking');
    dengan_rupiah2.addEventListener('keyup', function(e)
    {
        dengan_rupiah2.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah2.value);
    });

    var dengan_rupiah3 = document.getElementById('HargaPembuatan');
    dengan_rupiah3.addEventListener('keyup', function(e)
    {
        dengan_rupiah3.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah3.value);
    });

     var dengan_rupiah4 = document.getElementById('HargaEnd');
    dengan_rupiah4.addEventListener('keyup', function(e)
    {
        dengan_rupiah4.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah4.value);
    });

    var dengan_rupiah5 = document.getElementById('HargaResell');
    dengan_rupiah5.addEventListener('keyup', function(e)
    {
        dengan_rupiah5.value = formatRupiah(this.value, '');
        console.log(dengan_rupiah5.value);
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
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_barang/editBarang') ?>",
        {
            id: idBarang
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);
             $("#idBarang").val(data_objek.editbarang[0].id_barang);
             $("#NamaMerk").val(data_objek.editbarang[0].nama_merk);
             $("#NamaJenis").val(data_objek.editbarang[0].produk);
             $("#JenisSepatu").val(data_objek.editbarang[0].jenis_sepatu);
             $("#Warna").val(data_objek.editbarang[0].warna);
             $("#Ukuran").val(data_objek.editbarang[0].ukuran);
             $("#HargaPembuatan").val(data_objek.editbarang[0].harga);
             $("#HargaEnd").val(data_objek.editbarang[0].harga_end_user);
             $("#HargaResell").val(data_objek.editbarang[0].harga_reseller);
             $("#HargaVendor").val(data_objek.editbarang[0].harga_jual_vendor);
             $("#HargaPacking").val(data_objek.editbarang[0].harga_packing);

            $('#modal_large').modal('toggle');
        });
    });


    // get fine One delete
    $(".btn-delete").click(function(){
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_barang/editBarang') ?>",
        {
            id: idBarang
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);
            document.getElementById("NamaMerkDel").innerHTML = data_objek.editbarang[0].produk;
            document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.editbarang[0].id_barang);
            document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.editbarang[0].id_barang);
            document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/Pengelolaan_barang/hapusBarangTitipan/') ?>"+data_objek.editbarang[0].id_barang);
            $('#modal_large').modal('toggle');
        });
    })


</script>
