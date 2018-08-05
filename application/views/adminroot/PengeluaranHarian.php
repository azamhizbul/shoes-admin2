<!-- title container -->
<div class="block-header">
    <h2>Pengeluaran Harian</h2>
</div>
<!-- end title container -->

 <!-- Colored Card - With Loading -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Grafik Pengeluaran Karyawan Bulan <?= date('M'); ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="wrapper col-2"><canvas id="chart-pengeluaran-harian"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat Pengeluaran
                </h2>
                    <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModal">
                        <i class="material-icons">add</i>
                        <span>Tambah Pengeluaran</span>
                    </button>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Kategori Pengeluaran</th>
                                <th>Jumlah Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Nama Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($pengeluaran)) {
                                    $no = 1;

                                    foreach ($pengeluaran as $pengeluaran): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $pengeluaran->tgl_pengeluaran; ?></td>
                                        <td><?= $pengeluaran->kategori_pengeluaran; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($pengeluaran->jumlah_pengeluaran)),3))); ?></td>
                                        <td><?= $pengeluaran->keterangan; ?></td>
                                        <td><?= $pengeluaran->nama; ?></td> 
                                        <td>
                                            <button type="button" id="<?php echo $pengeluaran->id_pengeluaran ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#updateModal">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $pengeluaran->id_pengeluaran ?>"  data-toggle="modal" data-target="#modalDelete">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-warning">
                                        <td colspan="7" align="center">Tidak ada pengeluaran</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                        
        </div>
    </div>
</div>


<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Pengeluaran Karyawan</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('adminroot/PengeluaranHarian/insertPengeluaran'); ?>" method="post">
                    <label>Tanggal Pengeluaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input id="date" type="text" class="form-control date" placeholder="Ex: 30/07/2016" name="tglPengeluaranPost">
                        </div>
                    </div>
                    <label>Kategori Pengeluaran</label>
                    <div class="form-group">
                        <select class="form-control show-tick" name="kategoriPengeluaranPost">
                            <option value="">-- Pilih Pengeluaran --</option>
                            <option value="Gaji">Gaji Karyawan</option>
                            <option value="Akomodasi">Akomodasi</option>
                            <option value="Transport">Transport</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <label>Karyawan</label>
                    <div class="form-group">
                        <select class="form-control show-tick" name="idKaryawanPost">
                            <option value="">-- Pilih Karyawan --</option>
                            <?php 
                                foreach ($karyawan as $kar): ?>
                                    <option value='<?= $kar->id_karyawan; ?>'><?= $kar->nama; ?></option>
                                <?php 
                                endforeach;
                             ?>
                                
                        </select>
                    </div>
                    <label>Jumlah Pengeluaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="" class="form-control" placeholder="Masukan Jumlah Pengeluaran" name="jumlahPengeluaranPost">
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="" class="form-control" placeholder="Masukan Gaji" name="keteranganPost"></textarea>
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

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Update Pengeluaran Karyawan</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('adminroot/PengeluaranHarian/saveUpdate'); ?>" method="post">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" id="idPengeluaran" name="idPengeluaran" class="form-control" placeholder="Masukan Nama Merk">
                        </div>
                    </div>
                    <label>Tanggal Pengeluaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input id="tglPengeluaran" type="text" class="form-control date" placeholder="Ex: 30/07/2016" name="tglPengeluaran">
                        </div>
                    </div>
                    <label>Kategori Pengeluaran</label>
                    <div class="form-group">
                        <select class="form-control show-tick" id="kategoriPengeluaran" name="kategoriPengeluaran">
                            <option value="">-- Pilih Pengeluaran --</option>
                            <option value="Gaji">Gaji Karyawan</option>
                            <option value="Akomodasi">Akomodasi</option>
                            <option value="Transport">Transport</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <label>Karyawan</label>
                    <div class="form-group" id="uniqe">
                        <select class="form-control show-tick" id="idKaryawan" name="idKaryawan">
                            <option value="">-- Pilih Karyawan --</option>
                            <?php 
                                foreach($karyawan as $kr): ?>
                                   <option value='<?= $kr->id_karyawan; ?>'><?= $kr->nama; ?></option>
 
                            <?php endforeach; ?>
                                
                        </select>
                    </div>

                    <label>Jumlah Pengeluaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" id="jumlahPengeluaran" class="form-control" placeholder="Masukan Jumlah Pengeluaran" name="jumlahPengeluaran">
                        </div>
                    </div>
                    <label>Keterangan</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea id="keterangan" class="form-control" placeholder="Masukan Gaji" name="keterangan"></textarea>
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

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Transaksi Pengeluaran</h4>
            </div>
            <div class="modal-body">
                <h4 class="h4">Apakah anda yakin akan menghapus transaksi pada tanggal <b id="PengeluaranDel"></b> ini ?</h4>
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
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- jquery-autocomplete Js -->
    <script src="<?php echo base_url('assets/js/EasyAutocomplete/jquery.easy-autocomplete.js'); ?>"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>

            <!-- Chart Js -->
            <script src="<?php echo base_url('assets/js/Chartjs/Chart.js'); ?>"></script>

            <script>
                $('#date').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', time: false });      

        // document.getElementById('tanggalNow').innerHTML(fullDate);


            var options = {
                url: "<?php echo base_url('reseller.json'); ?>",

                getValue: "name",

            template: {
                        type: "description",
                        fields: {
                            description: "email"
                         }
            },

            list: {
                match: {
                    enabled: true
                },
            },

            theme: "plate-dark"
            };

            var chartPengeluaranHarian = document.getElementById('chart-pengeluaran-harian').getContext('2d');

            var gajiUrl = '<?php echo base_url('adminroot/PengeluaranHarian/getDataGaji'); ?>';
            var akomodasiUrl = '<?php echo base_url('adminroot/PengeluaranHarian/getDataAkomodasi'); ?>';
            var transportUrl = '<?php echo base_url('adminroot/PengeluaranHarian/getDataTransport'); ?>';
            var lainlainUrl = '<?php echo base_url('adminroot/PengeluaranHarian/getDataLainlain'); ?>';

            var gaji, akomodasi, transport, lainlain;

            $.when(
                    $.getJSON(gajiUrl, function(data) {
                        gaji = data;
            }),
                    $.getJSON(akomodasiUrl, function(data) {
                        akomodasi = data;
            }),
                    $.getJSON(transportUrl, function(data) {
                        transport = data;
            }),
                    $.getJSON(lainlainUrl, function(data) {
                        lainlain = data;
            })

            ).then(function() {

                 var chart = new Chart(chartPengeluaranHarian, {
                    // The type of chart we want to create

                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: ["01","02","03","04","05","06","07","08","09","10",
                        "11","12","13","14","15","16","17","18","19","20",
                        "21","22","23","24","25","26","27","28","29","30","31"],
                        datasets: [
                            {
                                label: "Gaji",
                                backgroundColor: 'rgb(33, 150, 243, 0.3)',
                                borderColor: 'rgb(33, 150, 243)',
                                data: [
                                    gaji["01"],
                                    gaji["02"],
                                    gaji["03"],
                                    gaji["04"],
                                    gaji["05"],
                                    gaji["06"],
                                    gaji["07"],
                                    gaji["08"],
                                    gaji["09"],
                                    gaji["10"],
                                    gaji["11"],
                                    gaji["12"],
                                    gaji["13"],
                                    gaji["14"],
                                    gaji["15"],
                                    gaji["16"],
                                    gaji["17"],
                                    gaji["18"],
                                    gaji["19"],
                                    gaji["20"],
                                    gaji["21"],
                                    gaji["22"],
                                    gaji["23"],
                                    gaji["24"],
                                    gaji["25"],
                                    gaji["26"],
                                    gaji["27"],
                                    gaji["28"],
                                    gaji["29"],
                                    gaji["30"],
                                    gaji["31"]

                            ]},
                            {
                                label: "Akomodasi",
                                backgroundColor: 'rgba(243, 188, 33, 0.3)',
                                borderColor: 'rgba(243, 188, 33)',
                                data: [
                                    akomodasi["01"],
                                    akomodasi["02"],
                                    akomodasi["03"],
                                    akomodasi["04"],
                                    akomodasi["05"],
                                    akomodasi["06"],
                                    akomodasi["07"],
                                    akomodasi["08"],
                                    akomodasi["09"],
                                    akomodasi["10"],
                                    akomodasi["11"],
                                    akomodasi["12"],
                                    akomodasi["13"],
                                    akomodasi["14"],
                                    akomodasi["15"],
                                    akomodasi["16"],
                                    akomodasi["17"],
                                    akomodasi["18"],
                                    akomodasi["19"],
                                    akomodasi["20"],
                                    akomodasi["21"],
                                    akomodasi["22"],
                                    akomodasi["23"],
                                    akomodasi["24"],
                                    akomodasi["25"],
                                    akomodasi["26"],
                                    akomodasi["27"],
                                    akomodasi["28"],
                                    akomodasi["29"],
                                    akomodasi["30"],
                                    akomodasi["31"]

                            ]},
                            {
                                label: "Transport",
                                backgroundColor: 'rgba(36, 243, 33, 0.3)',
                                borderColor: 'rgba(36, 243, 33)',
                                data: [
                                    transport["01"],
                                    transport["02"],
                                    transport["03"],
                                    transport["04"],
                                    transport["05"],
                                    transport["06"],
                                    transport["07"],
                                    transport["08"],
                                    transport["09"],
                                    transport["10"],
                                    transport["11"],
                                    transport["12"],
                                    transport["13"],
                                    transport["14"],
                                    transport["15"],
                                    transport["16"],
                                    transport["17"],
                                    transport["18"],
                                    transport["19"],
                                    transport["20"],
                                    transport["21"],
                                    transport["22"],
                                    transport["23"],
                                    transport["24"],
                                    transport["25"],
                                    transport["26"],
                                    transport["27"],
                                    transport["28"],
                                    transport["29"],
                                    transport["30"],
                                    transport["31"]

                            ]},
                            {
                                label: "Lain-lain",
                                backgroundColor: 'rgba(255,0,255,0.3)',
                                borderColor: 'rgba(255,0,255)',
                                data: [
                                    lainlain["01"],
                                    lainlain["02"],
                                    lainlain["03"],
                                    lainlain["04"],
                                    lainlain["05"],
                                    lainlain["06"],
                                    lainlain["07"],
                                    lainlain["08"],
                                    lainlain["09"],
                                    lainlain["10"],
                                    lainlain["11"],
                                    lainlain["12"],
                                    lainlain["13"],
                                    lainlain["14"],
                                    lainlain["15"],
                                    lainlain["16"],
                                    lainlain["17"],
                                    lainlain["18"],
                                    lainlain["19"],
                                    lainlain["20"],
                                    lainlain["21"],
                                    lainlain["22"],
                                    lainlain["23"],
                                    lainlain["24"],
                                    lainlain["25"],
                                    lainlain["26"],
                                    lainlain["27"],
                                    lainlain["28"],
                                    lainlain["29"],
                                    lainlain["30"],
                                    lainlain["31"]

                            ]}
                        ]
                    },

                    // Configuration options go here
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });
            </script>
            <script>
            
            // get fine One Update
            $(".btn-edit").click(function(){
                console.log(this.id);
                var idPengeluaran = this.id;
                $.post("<?php echo base_url('adminroot/PengeluaranHarian/editPengeluaran') ?>",
            {
                id: idPengeluaran
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);
                
                 $("#idPengeluaran").val(data_objek.editpengeluaran[0].id_pengeluaran);
                 $("#tglPengeluaran").val(data_objek.editpengeluaran[0].tgl_pengeluaran);
                 $("#kategoriPengeluaran").val(data_objek.editpengeluaran[0].kategori_pengeluaran).change();
                 $("#idKaryawan").val(data_objek.editpengeluaran[0].id_karyawan).change();
                 $("#jumlahPengeluaran").val(data_objek.editpengeluaran[0].jumlah_pengeluaran);
                 $("#keterangan").val(data_objek.editpengeluaran[0].keterangan);

                $('#modal_large').modal('toggle');
            });
                         })


            // get fine One delete
            $(".btn-delete").click(function(){
                console.log(this.id);
                var idPengeluaran = this.id;
                $.post("<?php echo base_url('adminroot/PengeluaranHarian/editPengeluaran') ?>",
            {
                id: idPengeluaran
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);
                document.getElementById("PengeluaranDel").innerHTML = data_objek.editpengeluaran[0].tgl_pengeluaran;
                document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.editpengeluaran[0].id_pengeluaran);
                document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.editpengeluaran[0].id_pengeluaran);
                document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/PengeluaranHarian/deletePengeluaran/') ?>"+data_objek.editpengeluaran[0].id_pengeluaran);
                $('#modal_large').modal('toggle');
            });
                         })


            </script>

