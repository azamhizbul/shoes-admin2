 <!-- Colored Card - With Loading -->
<div class="block-header">
    <h2>
        Form Pemesanan Barang
    </h2>
</div>

<?= showFlashMessage(); ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                Input Pemesanan Barang
            </h2>
        </div>

        <div class="body">          
                <label>Nama Vendor</label>
                <select class="form-control show-tick" data-live-search="true" id="namaVendor" required>
                    <option value="">-- Pilih Vendor --</option>
                    <?php foreach ($vendor as $v) { ?>
                        <option value="<?= $v->id_vendor; ?>"><?= $v->nama_vendor; ?></option>
                    <?php } ?>
                </select><br><br>
                
                <label>Nama Barang</label>
                <select class="form-control show-tick" data-live-search="true" id="namaBarang" required">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $b) { ?>
                        <option value="<?= $b->id_barang; ?>"><?= $b->produk; ?></option>    
                    <?php } ?>
                </select><br><br>
                
                <label for="email_address">Jumlah Barang</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" id="jumlahBarang" class="form-control" placeholder="Masukan Jumlah Barang" required>
                    </div>
                </div>
                                    
                <div class="form-group cs-rm-margin-btn">
                    <button class="btn btn-block btn-lg btn-primary waves-effect btn-proses" data-toggle="modal" data-target="#defaultModal">
                        <i class="material-icons">add</i>
                        <span>Tambahkan</span> 
                    </button>
                </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->

<!-- modal process -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Pembayaran</h4>
            </div>
            <form id="vInserValidation" action="<?= base_url('adminroot/PemesananAdmin/tambahPemesanan/'); ?>" method="POST">
                <div class="modal-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50%">Jumlah</th>
                                <th>Total Pembelanjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h3 class="h3"><label id="totalItem"></label> Pasang</h3></td>
                                <td><h3 class="h3" id="totalHarga"></h3></td>
                            </tr>
                        </tbody>
                    </table>

                    <label for="email_address">Jumlah Uang</label>
                    <div class="form-group form-group-lg">
                        <div class="form-line">
                            <input type="text" name="jumlahUang" id="jumlahUang" class="form-control" placeholder="Masukan Jumlah Uang" onkeyup="syncJumlahUang();" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label>Sisa Pembayaran</label><br>
                        <label class="h3">Rp <label id="sisaPembayaran" class="h3">0</label></label> 
                    </div> 

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                        <label>Kembalian</label><br>
                        <label class="h3">Rp. <label class="h3" id="kembalian">0</label></label>
                    </div>
                </div><br>

                <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                    <div class="form-line">
                        <input type="text" id="IdBarangPost" name="IdBarangPost">
                        <input type="text" id="IdVendorPost" name="IdVendorPost">
                        <input type="date" name="tglBeliPost" value="<?= date('Y-m-d'); ?>">
                        <input type="text" name="totalBeliPost" id="totalBeliPost">
                        <input type="text" name="hargaSatuanPost" id="hargaSatuanPost" placeholder="harga satuan">
                        <input type="text" id="totalHargaPost" name="totalHargaPost" placeholder="total harga">
                        <input type="number" name="uangKembalianPost" id="uangKembalianPost" placeholder="Uang Kembalian">
                        <input type="text" name="sisaBayarPost" id="sisaBayarPost" placeholder="Sisa Bayar">
                        <input type="number" name="reference2" id="reference2" value="<?= $akun->id_karyawan; ?>">
                    </div>
                </div>
                
                <div class="modal-footer" style="margin-top: 51px">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-blue">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End modal process -->

<script>
    // validation
    $('#vInserValidation').validate();

     var dengan_rupiah5 = document.getElementById('jumlahUang');
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

    var total, harga, sisa;

    $(".btn-proses").click(function() {
        var idVendor = document.getElementById('namaVendor').value;
        var jumlahBarang = document.getElementById('jumlahBarang').value;
        var idBarang = document.getElementById('namaBarang').value;

        $.post("<?= base_url('adminroot/PemesananAdmin/getBarangJson/') ?>",
        {
            id: idBarang
        },
        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);

            var data_obj = JSON.parse(data);

            harga = data_obj.produk[0].harga;
            total = harga * jumlahBarang;
            var rupiah= '';
            var angkaTotal = total.toString().split('').reverse().join('');
            for (var i = 0; i < angkaTotal.length; i++) if (i%3 == 0) rupiah += angkaTotal.substr(i,3)+'.';

            document.getElementById('totalItem').innerHTML = jumlahBarang;
            document.getElementById('totalHarga').innerHTML = 'Rp. '+rupiah.split('', rupiah.length-1).reverse().join('');
            document.getElementById('hargaSatuanPost').value = harga;
            document.getElementById('totalHargaPost').value = total;
        });

        document.getElementById('IdBarangPost').value = idBarang;
        document.getElementById('IdVendorPost').value = idVendor;
        document.getElementById('totalBeliPost').value = jumlahBarang;
    });

    function syncJumlahUang() {
        var x = document.getElementById('jumlahUang').value;
        var sisaPembayaran = document.getElementById('sisaPembayaran');
        var uangKembalian = document.getElementById('kembalian');
        var x1 = x.replace('.','');

        document.getElementById('sisaBayarPost').value = total - x1;
        document.getElementById('uangKembalianPost').value = document.getElementById('jumlahUang').value - total;

        if (document.getElementById('uangKembalianPost').value < 0) {
            uangKembalian.innerHTML = 0
            document.getElementById('uangKembalianPost').value = 0;
        } else {
            uangKembalian.innerHTML = document.getElementById('uangKembalianPost').value;
        }

        if (document.getElementById('uangKembalianPost').value > 0) {
            sisaPembayaran.innerHTML = 0;
            document.getElementById('sisaBayarPost').value = 0;
        } else {
            sisaPembayaran.innerHTML = total - document.getElementById('jumlahUang').value;
            document.getElementById('sisaBayarPost').value = sisaPembayaran.innerHTML;
        }

        var sisa = sisaPembayaran.innerHTML;
        var kembalian = uangKembalian.innerHTML;
        console.log("Sisa Pembayaran : " + sisa + "\nUang Kembalian : " + kembalian);

        var rupiah1 = '';
        var angkaTotal = sisa.toString().split('').reverse().join('');
        for (var i = 0; i < angkaTotal.length; i++) if (i%3 == 0) rupiah1 += angkaTotal.substr(i,3)+'.';

        var rupiah2 = '';
        var angkaKembalian = kembalian.toString().split('').reverse().join('');
        for (var i = 0; i < angkaKembalian.length; i++) if (i%3 == 0) rupiah2 += angkaKembalian.substr(i,3)+'.';

        document.getElementById('sisaPembayaran').innerHTML = rupiah1.split('', rupiah1.length-1).reverse().join('');

        document.getElementById('kembalian').innerHTML = rupiah2.split('', rupiah2.length-1).reverse().join('');
    }

</script>   
