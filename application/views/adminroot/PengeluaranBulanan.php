<!-- title container -->
<div class="block-header">
    <h2>Pengeluaran Perusahaan</h2>
</div>
<!-- end title container -->

 <!-- Colored Card - With Loading -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Grafik Pengeluaran Perusahaan Bulan <?= date('M'); ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="wrapper col-2"><canvas id="chart-pengeluaran-bulanan"></canvas></div>
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
                                        <td>
                                            <button type="button" id="<?php echo $pengeluaran->id_pengeluaran_kantor ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#updateModal">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $pengeluaran->id_pengeluaran_kantor ?>"  data-toggle="modal" data-target="#modalDelete">
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
                    <h4 class="modal-title" id="defaultModalLabel">Form Pengeluaran Kantor</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('adminroot/PengeluaranBulanan/insertPengeluaran'); ?>" method="post">
                        <label>Tanggal Pengeluaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input id="date" name="tglPengeluaranPost" type="text" class="form-control date" placeholder="Ex: 30/07/2016">
                            </div>
                        </div>
                        <label>Kategori Pengeluaran</label>
                        <div class="form-group">
                            <select class="form-control show-tick" name="kategoriPengeluaranPost">
                                <option value="">-- Pilih Pengeluaran --</option>
                                <option value="Bayar Air">Biaya Air</option>
                                <option value="Bayar Listrik">Biaya Listrik</option>
                                <option value="Biaya Internet">Biaya Internet</option>
                                <option value="Biaya Sewa">Biaya Sewa</option>
                                <option value="Biaya ATK">Biaya ATK</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <label>Jumlah Pengeluaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="" class="form-control" placeholder="Masukan Nominal Pengeluaran" name="jumlahPengeluaranPost">
                            </div>
                        </div>
                        <label>Keterangan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="" class="form-control" placeholder="Masukan Keterangan" name="keteranganPost"></textarea>
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
                    <h4 class="modal-title" id="defaultModalLabel">Form Edit Pengeluaran Kantor</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('adminroot/PengeluaranBulanan/saveUpdate'); ?>" method="post">
                        <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                            <div class="form-line">
                                <input type="text" id="idPengeluaran" name="idPengeluaran" class="form-control" placeholder="Masukan Nama Merk">
                            </div>
                        </div>
                        <label>Tanggal Pengeluaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input id="tglPengeluaran" name="tglPengeluaran" type="text" class="form-control date" placeholder="Ex: 30/07/2016">
                            </div>
                        </div>
                        <label>Kategori Pengeluaran</label>
                        <div class="form-group">
                            <select class="form-control show-tick" id="kategoriPengeluaran" name="kategoriPengeluaran">
                                <option value="">-- Pilih Pengeluaran --</option>
                                <option value="Bayar Air">Biaya Air</option>
                                <option value="Bayar Listrik">Biaya Listrik</option>
                                <option value="Biaya Internet">Biaya Internet</option>
                                <option value="Biaya Sewa">Biaya Sewa</option>
                                <option value="Biaya ATK">Biaya ATK</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <label>Jumlah Pengeluaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="jumlahPengeluaran" class="form-control" placeholder="Masukan Nominal Pengeluaran" name="jumlahPengeluaran">
                            </div>
                        </div>
                        <label>Keterangan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="keterangan" class="form-control" placeholder="Masukan Keterangan" name="keterangan"></textarea>
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

            var ctx = document.getElementById('chart-pengeluaran-bulanan').getContext('2d');

            var airUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataAir') ?>';
            var listrikUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataListrik') ?>';
            var sewaUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataSewa') ?>';
            var internetUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataInternet') ?>';
            var atkUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataAtk') ?>';
            var lainLainUrl = '<?php echo base_url('adminroot/PengeluaranBulanan/getDataLainLain') ?>';
            var air, listrik, sewa, internet, atk, lainLain;

            $.when(
                    $.getJSON(airUrl, function(data) {
                        air = data;
            }),
                    $.getJSON(listrikUrl, function(data) {
                        listrik = data;
            }),
                    $.getJSON(sewaUrl, function(data) {
                        sewa = data;
            }),
                    $.getJSON(internetUrl, function(data) {
                        internet = data;
            }),
                    $.getJSON(atkUrl, function(data) {
                        atk = data;
            }),
                    $.getJSON(lainLainUrl, function(data) {
                        lainLain = data;
            })
            ).then(function() {

                 var chart = new Chart(ctx, {
                    // The type of chart we want to create

                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: ["01","02","03","04","05","06","07","08","09","10",
                        "11","12","13","14","15","16","17","18","19","20",
                        "21","22","23","24","25","26","27","28","29","30","31"],
                        datasets: [{
                            label: "Air",
                            backgroundColor: 'rgb(33, 150, 243, 0.3)',
                            borderColor: 'rgb(33, 150, 243)',
                            data: [
                                air["01"],
                                air["02"],
                                air["03"],
                                air["04"],
                                air["05"],
                                air["06"],
                                air["07"],
                                air["08"],
                                air["09"],
                                air["10"],
                                air["11"],
                                air["12"],
                                air["13"],
                                air["14"],
                                air["15"],
                                air["16"],
                                air["17"],
                                air["18"],
                                air["19"],
                                air["20"],
                                air["21"],
                                air["22"],
                                air["23"],
                                air["24"],
                                air["25"],
                                air["26"],
                                air["27"],
                                air["28"],
                                air["29"],
                                air["30"],
                                air["31"]

                            ],

                        },
                            {label: "Listrik",
                            backgroundColor: 'rgba(243, 188, 33, 0.3)',
                            borderColor: 'rgba(243, 188, 33)',
                            data: [
                                listrik["01"],
                                listrik["02"],
                                listrik["03"],
                                listrik["04"],
                                listrik["05"],
                                listrik["06"],
                                listrik["07"],
                                listrik["08"],
                                listrik["09"],
                                listrik["10"],
                                listrik["11"],
                                listrik["12"],
                                listrik["13"],
                                listrik["14"],
                                listrik["15"],
                                listrik["16"],
                                listrik["17"],
                                listrik["18"],
                                listrik["19"],
                                listrik["20"],
                                listrik["21"],
                                listrik["22"],
                                listrik["23"],
                                listrik["24"],
                                listrik["25"],
                                listrik["26"],
                                listrik["27"],
                                listrik["28"],
                                listrik["29"],
                                listrik["30"],
                                listrik["31"]

                            ]},{label: "Sewa",
                            backgroundColor: 'rgba(36, 243, 33, 0.3)',
                            borderColor: 'rgba(36, 243, 33)',
                            data: [
                                sewa["01"],
                                sewa["02"],
                                sewa["03"],
                                sewa["04"],
                                sewa["05"],
                                sewa["06"],
                                sewa["07"],
                                sewa["08"],
                                sewa["09"],
                                sewa["10"],
                                sewa["11"],
                                sewa["12"],
                                sewa["13"],
                                sewa["14"],
                                sewa["15"],
                                sewa["16"],
                                sewa["17"],
                                sewa["18"],
                                sewa["19"],
                                sewa["20"],
                                sewa["21"],
                                sewa["22"],
                                sewa["23"],
                                sewa["24"],
                                sewa["25"],
                                sewa["26"],
                                sewa["27"],
                                sewa["28"],
                                sewa["29"],
                                sewa["30"],
                                sewa["31"],

                            ]},{label: "Internet",
                            backgroundColor: 'rgba(255,0,255,0.3)',
                            borderColor: 'rgba(255,0,255)',
                            data: [
                                internet["01"],
                                internet["02"],
                                internet["03"],
                                internet["04"],
                                internet["05"],
                                internet["06"],
                                internet["07"],
                                internet["08"],
                                internet["09"],
                                internet["10"],
                                internet["11"],
                                internet["12"],
                                internet["13"],
                                internet["14"],
                                internet["15"],
                                internet["16"],
                                internet["17"],
                                internet["18"],
                                internet["19"],
                                internet["20"],
                                internet["21"],
                                internet["22"],
                                internet["23"],
                                internet["24"],
                                internet["25"],
                                internet["26"],
                                internet["27"],
                                internet["28"],
                                internet["29"],
                                internet["30"],
                                internet["31"],

                            ]},{label: "ATK",
                            backgroundColor: 'rgb(103, 58, 183, 0.3)',
                            borderColor: 'rgb(103, 58, 183)',
                            data: [
                                atk["01"],
                                atk["02"],
                                atk["03"],
                                atk["04"],
                                atk["05"],
                                atk["06"],
                                atk["07"],
                                atk["08"],
                                atk["09"],
                                atk["10"],
                                atk["11"],
                                atk["12"],
                                atk["13"],
                                atk["14"],
                                atk["15"],
                                atk["16"],
                                atk["17"],
                                atk["18"],
                                atk["19"],
                                atk["20"],
                                atk["21"],
                                atk["22"],
                                atk["23"],
                                atk["24"],
                                atk["25"],
                                atk["26"],
                                atk["27"],
                                atk["28"],
                                atk["29"],
                                atk["30"],
                                atk["31"],

                            ]},{label: "Lain Lain",
                            backgroundColor: 'rgb(255, 99, 132,0.3)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: [
                                lainLain["01"],
                                lainLain["02"],
                                lainLain["03"],
                                lainLain["04"],
                                lainLain["05"],
                                lainLain["06"],
                                lainLain["07"],
                                lainLain["08"],
                                lainLain["09"],
                                lainLain["10"],
                                lainLain["11"],
                                lainLain["12"],
                                lainLain["13"],
                                lainLain["14"],
                                lainLain["15"],
                                lainLain["16"],
                                lainLain["17"],
                                lainLain["18"],
                                lainLain["19"],
                                lainLain["20"],
                                lainLain["21"],
                                lainLain["22"],
                                lainLain["23"],
                                lainLain["24"],
                                lainLain["25"],
                                lainLain["26"],
                                lainLain["27"],
                                lainLain["28"],
                                lainLain["29"],
                                lainLain["30"],
                                lainLain["31"],

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

                $.getJSON('<?php echo base_url('adminroot/PengeluaranBulanan/getDataJumlah') ?>', function(data) {
                
               
                }); 


            </script>
            <script>
            
            // get fine One Update
            $(".btn-edit").click(function(){
                console.log(this.id);
                var idPengeluaran = this.id;
                $.post("<?php echo base_url('adminroot/PengeluaranBulanan/editPengeluaran') ?>",
            {
                id: idPengeluaran
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);
                
                 $("#idPengeluaran").val(data_objek.editpengeluaran[0].id_pengeluaran_kantor);
                 $("#tglPengeluaran").val(data_objek.editpengeluaran[0].tgl_pengeluaran);
                 $("#kategoriPengeluaran").val(data_objek.editpengeluaran[0].kategori_pengeluaran).change();
                 $("#jumlahPengeluaran").val(data_objek.editpengeluaran[0].jumlah_pengeluaran);
                 $("#keterangan").val(data_objek.editpengeluaran[0].keterangan);

                $('#modal_large').modal('toggle');
            });
                         })


            // get fine One delete
            $(".btn-delete").click(function(){
                console.log(this.id);
                var idPengeluaran = this.id;
                $.post("<?php echo base_url('adminroot/PengeluaranBulanan/editPengeluaran') ?>",
            {
                id: idPengeluaran
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);
                document.getElementById("PengeluaranDel").innerHTML = data_objek.editpengeluaran[0].tgl_pengeluaran;
                document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.editpengeluaran[0].id_pengeluaran_kantor);
                document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.editpengeluaran[0].id_pengeluaran_kantor);
                document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/PengeluaranBulanan/deletePengeluaran/') ?>"+data_objek.editpengeluaran[0].id_pengeluaran_kantor);
                $('#modal_large').modal('toggle');
            });
                         })


            </script>
