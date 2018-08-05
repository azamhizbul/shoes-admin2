<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List barang penjualan
                </h2>
            </div>
            <div class="body table-responsive">
                           
                <table class="table table-striped table-hover" id="mytable">
                    <thead>
                        <tr style="background: #e8e8e8;">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th width="50%">Jumlah Barang</th>
                            <th>Total Pembelanjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h3 class="h3"><label class="h3" id="labelItemTotal">0</label> - pasang</h3></td>
                            <td><h3 class="h3">Rp. <label class="h3" id="labeTotalRupiah">0</label></h3></td>
                        </tr>
                    </tbody>
                </table>
                        
                <div class="pull-right">
                    <button class="btn btn-lg btn-primary waves-effect" data-toggle="modal" data-target="#defaultModal">Proses</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Input barang penjualan
                </h2>
            </div>
            <div class="body">
                <form>
                    <div id="notifInputKosong">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Maaf, kolom harus terisi semua!
                        </div>
                    </div>
                    <div id="notifKurang">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Maaf, stok di gudang tidak mencukupi!
                        </div>
                    </div>

                    <label>Masukan Kode Produk</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="Pro" class="form-control" placeholder="Masukan Kode Barang">
                        </div>
                    </div>

                    <label>Jumlah Barang</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="jumlahBarang" class="form-control" placeholder="Masukan Jumlah Barang" onkeyup="validasi();">
                        </div>
                    </div>

                    <div class="form-group cs-rm-margin-btn">
                        <button type="button" class="btn btn-block btn-lg btn-primary waves-effect" id="addBtn" onclick="myFunction()">
                            <i class="material-icons">add</i>
                            <span>Tambahkan</span> 
                        </button>
                    </div>
                </form>
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
            <form id="insertPenjualanEndUser" action="<?php echo base_url('penjualan/penjualan/saveTransaksiEndUser'); ?>" method="post">
                <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                    <input type="text" name="hari" id="hari" value="" placeholder="hari">
                    <input type="number" name="jumlahItem" id="jumlahItem" value="" placeholder="jumlahItem">
                    <input type="number" name="potongan" id="potongan" value="" placeholder="potongan">
                    <input type="number" name="jumlahPembayaran" id="jumlahPembayaran" value="" placeholder="jumlahPembayaran">
                    <input type="number" name="uangDiterima" id="UangDiterima" value="" placeholder="UangDiterima">
                    <input type="number" name="uangKembalian" id="uangKembalian" value="" placeholder="uangKembalian">
                    <input type="number" name="reference1" placeholder="reference1" id="reference1" value="<?= $akun->id_karyawan?>">
                </div>

                <div class="modal-body">
                    <h5>Tanggal</h5>
                    <h4 class="h4" id="hariLabel"></h4>
                    
                    <label>Nama Pembeli</label>
                    <div class="form-group form-group-lg">
                        <div class="form-line">
                            <input type="text" name="namaPembeli" class="form-control" placeholder="Masukan Nama Pembeli" required>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50%">Jumlah Barang</th>
                                <th>Total Pembelanjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h3 class="h3"><label class="h3" id="modalJumlahBarang" >0</label> - pasang</h3></td>
                                <td><h3 class="h3">Rp. <label class="h3" id="modalTotalPembelanjaan">0</label> <span id="labelAfterDiscount" class="label bg-green" style="font-size: 14px; margin-top: -5px;"></span></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

					<label>Jumlah Potongan Harga</label>
					<div class="form-group">
						<div class="form-line">
							<input type="number" id="jumlahDiscount" class="form-control" placeholder="Masukan Jumlah potongan harga" onkeyup="syncDicount();" required>
						</div>
						<span id="notifJumlahDiscount" class="alert alert-danger"></span>
					</div>

                    <label>Jumlah Uang</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="bayarBelanjaan" class="form-control" placeholder="Masukan Jumlah Uang" onkeyup="syncJumlahUang();" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                        <label>Kembalian</label><br>
                        <label class="h3">Rp. <label class="h3" id="kembalian">0</label></label>
                    </div>   
                </div>

                <div style="clear: both;"></div>
                                
                <div class="modal-footer cs-rm-margin-btn">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect print">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End modal process -->

<script>

    // Validation Form penjualan End User
    $('#insertPenjualanEndUser').validate();

    document.getElementById('notifJumlahDiscount').style.display = "none";

    // transaction script penjualan end user
    var jsonStr = '{"dataPerItem":[]}';

    var no = 1;
    var a;
    var b;
    var c;
    var d;
    var e;
    var f;
    var g;
    var objArray = {idBarang : "", nama_merk: "", produk: "",}
    var jmlArr = [0];
    var hargaArr = [];
    var totalBelnjaArr = [0];
    var totalJumlahBelanjaJSON;
    var stokBarang;

    var hari = new Date();
    var bulan = hari.getMonth()+1;
    document.getElementById("hari").value = hari.getFullYear()+"-"+bulan+"-"+hari.getDate();
    document.getElementById("hariLabel").innerHTML = hari.getDate()+"-"+bulan+"-"+hari.getFullYear();

    var notifKurang = document.getElementById('notifKurang');
    var notifInputKosong = document.getElementById('notifInputKosong');
    notifKurang.style.display = "none";
    notifInputKosong.style.display = "none";

    document.getElementById('addBtn').style.visibility = "hidden";

    var belanjaan = 100000;
    var belanjaanItem = 3;

    var options = {
        url: "<?php echo base_url('penjualan/penjualan/getBarangEndJSON') ?>",

        getValue: "produk",

        list: {

            onClickEvent: function() {
                var id = $("#Pro").getSelectedItemData().id_barang;
                var merk = $("#Pro").getSelectedItemData().nama_merk;
                var produk = $("#Pro").getSelectedItemData().produk;
                var warna = $("#Pro").getSelectedItemData().warna;
                var ukuran = $("#Pro").getSelectedItemData().ukuran;
                var harga = $("#Pro").getSelectedItemData().harga_end_user;
                stokBarang = $("#Pro").getSelectedItemData().stok;
                console.log(id,name,merk,produk,warna,ukuran,harga, stokBarang);
                a = id;
                b = merk;
                c = produk;
                d = warna;
                e = ukuran;
                f = harga;
            },
        }
    };

    function validasi() {
        g = document.getElementById('jumlahBarang').value;

        if (document.getElementById('Pro').value != "" && g != "" && parseInt(g) <= stokBarang) {
            console.log("inputan terisi");
            notifInputKosong.style.display = "none";
            document.getElementById('addBtn').style.visibility = "visible";
        } else if (document.getElementById('Pro').value != "" && g != "" && parseInt(g) >= stokBarang) {
            console.log("stok kurang");
            notifInputKosong.style.display = "none";
            notifKurang.style.display = "block";
            document.getElementById('addBtn').style.visibility = "hidden";
        } else {
            console.log("Inputan kosong");
            notifInputKosong.style.display = "block";
            notifKurang.style.display = "none";
            document.getElementById('addBtn').style.visibility = "hidden";
        }
    }

    function getSum(total, num) {
        return total + num;
    }

    $("#Pro").easyAutocomplete(options);
    function myFunction() {
        g =  document.getElementById('jumlahBarang').value;

        var table = document.getElementById("mytable");
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        cell1.innerHTML = no++;
        cell2.innerHTML = b;
        cell3.innerHTML = g;
        cell4.innerHTML = d;
        cell5.innerHTML = e;
        cell6.innerHTML = f;
        totalJumlahBelanjaJSON = g*f;
        console.log(totalJumlahBelanjaJSON);
        var obj = JSON.parse(jsonStr);
        obj['dataPerItem'].push({"id_barang":parseInt(a),"jumlah":parseInt(g),"harga":parseInt(f),"total_item":parseInt(g),"total_harga":parseInt(totalJumlahBelanjaJSON)});
        jsonStr = JSON.stringify(obj);
        var ps = JSON.parse(jsonStr);
        console.log(ps.dataPerItem);
    
        var hj = ps.dataPerItem;
        var highest = hj[ Object.keys(hj).sort().pop()].harga;
        jmlArr.push(parseInt(g));
        hargaArr.push(parseInt(highest));
        console.log(jmlArr);
        console.log(hargaArr);
        var last_element = jmlArr[jmlArr.length-1];
        var last_element2 = hargaArr[hargaArr.length-1];
        var kaliTotalBelanja = last_element * last_element2;
        console.log(kaliTotalBelanja);
        totalBelnjaArr.push(kaliTotalBelanja);

        document.getElementById('jumlahItem').value = jmlArr.reduce(getSum);
        document.getElementById('jumlahPembayaran').value = totalBelnjaArr.reduce(getSum);
        document.getElementById('labelItemTotal').innerHTML = jmlArr.reduce(getSum);
        document.getElementById('labeTotalRupiah').innerHTML = totalBelnjaArr.reduce(getSum);
        document.getElementById('modalJumlahBarang').innerHTML = jmlArr.reduce(getSum);
        document.getElementById('modalTotalPembelanjaan').innerHTML = totalBelnjaArr.reduce(getSum);
        document.getElementById('Pro').value = "";
        document.getElementById('jumlahBarang').value = "";

		var modalTotalBlnj = document.getElementById('modalTotalPembelanjaan').innerHTML;
		var rupiah = '';
		var angkaModalTotal = modalTotalBlnj.toString().split('').reverse().join('');
		for (var i = 0; i < angkaModalTotal.length; i++) if (i%3 == 0) rupiah += angkaModalTotal.substr(i, 3) + '.';

		document.getElementById('modalTotalPembelanjaan').innerHTML = rupiah.split('', rupiah.length-1).reverse().join('');
    }

    function syncDicount() {
    
        var x =  document.getElementById('jumlahDiscount').value;
        var z = x; 
        document.getElementById('potongan').value = z;

		document.getElementById('labelAfterDiscount').innerHTML = "Termasuk harga diskon";
		var afterDsc = document.getElementById('labelAfterDiscount');
		var notifAlertJmlDsc = document.getElementById('notifJumlahDiscount');

        if (x == "" || x <= 0) {
			document.getElementById('potongan').value = 0;
			afterDsc.style.display = "none";
			document.getElementById('modalTotalPembelanjaan').innerHTML = totalBelnjaArr.reduce(getSum);
			document.getElementById('jumlahPembayaran').value = totalBelnjaArr.reduce(getSum);
		} else if (x > totalBelnjaArr.reduce(getSum)) {
				document.getElementById('modalTotalPembelanjaan').innerHTML = "0";
				afterDsc.style.display = "none";
				notifAlertJmlDsc.style.display = "block";
				notifAlertJmlDsc.innerHTML = "Jumlah Diskon yang dimasukkan melebihi Total Pembelanjaan!";
			} else {
				document.getElementById('jumlahPembayaran').value = totalBelnjaArr.reduce(getSum) - document.getElementById('potongan').value;
				document.getElementById('modalTotalPembelanjaan').innerHTML = document.getElementById('jumlahPembayaran').value;
				afterDsc.style.display = "inline";
				notifAlertJmlDsc.style.display = "none";
			}

		var modalTB = document.getElementById('modalTotalPembelanjaan').innerHTML;
		var rupiah = '';
		var formatRp = modalTB.toString().split('').reverse().join('');
		for (var i = 0; i < formatRp.length; i++) if (i%3 == 0) rupiah += formatRp.substr(i,3)+'.';

		document.getElementById('modalTotalPembelanjaan').innerHTML = rupiah.split('', rupiah.length-1).reverse().join('');
    }

    function syncJumlahUang(){
        var x = document.getElementById('bayarBelanjaan').value;
        var z = x;
        var uangKembalian = document.getElementById('kembalian');
        
        document.getElementById('UangDiterima').value = z;
        document.getElementById('uangKembalian').value = document.getElementById('UangDiterima').value  - document.getElementById('jumlahPembayaran').value;

        if (document.getElementById('uangKembalian').value < 0) {
            uangKembalian.innerHTML = 0;
            document.getElementById('uangKembalian').value = 0;
        } else {
            uangKembalian.innerHTML = document.getElementById('uangKembalian').value;
        }

        var kembalian = uangKembalian.innerHTML;
        var rupiah = '';
        var angkaKembalian = kembalian.toString().split('').reverse().join('');
        for (var i = 0; i < angkaKembalian.length; i++) if (i%3 == 0) rupiah += angkaKembalian.substr(i,3)+'.';

        document.getElementById('kembalian').innerHTML = rupiah.split('', rupiah.length-1).reverse().join('');
    }

    $(".print").click(function() {
        var obj = JSON.parse(jsonStr);
        jsonStr = JSON.stringify(obj);
        console.log(jsonStr);
        $.post("<?php echo base_url('penjualan/penjualan/saveTransaksiEndPerItem'); ?>",
            {
                sendData: jsonStr
            },
            function(data, status){
                console.log(data);
        });
    });
    // END transaction script penjualan end user

</script>


