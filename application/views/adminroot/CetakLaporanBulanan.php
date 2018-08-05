<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Bulanan</title>
</head>
<body>

	<center><h1>Admin Shoes</h1>
	<h3>Laporan Bulanan pada bulan <?= $laporanPengeluaranPerBulan[0]->Bulan; ?> pada tahun <?= $laporanPengeluaranPerBulan[0]->Tahun; ?></h3>
	<table border="0.5" cellpadding="20px" align="center">
        <thead>
        	<tr>
        		<th>No</th>
        		<th>Tanggal</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                if (!empty($laporanPengeluaranPerBulan)) {
                    $no = 1;

                    foreach ($laporanPengeluaranPerBulan as $data): ?>

                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $data->Tanggal; ?></td>
                        <td><?= $data->Bulan; ?></td>
                        <td><?= $data->Tahun; ?></td>
                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->Total)),3))); ?></td>
                    </tr>
                    <?php $no++;
                    endforeach;
                } else { ?>
                    <tr class="alert alert-danger">
                        <td colspan="5" align="center">Tidak ada daftar laporan.</td>
                    </tr>   
            <?php } ?>
        </tbody>
    </table></center>

</body>
</html>