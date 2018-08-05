<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Tahunan</title>
</head>
<body>

    <center><h1>Admin Shoes</h1>
    <h3>Laporan Tahunan pada tahun <?= $laporanPengeluaranPerTahun[0]->Tahun; ?></h3>
	<table border="0.5" cellpadding="10px" align="center">
        <thead>
        	<tr>
        		<th>No</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                if (!empty($laporanPengeluaranPerTahun)) {
                    $no = 1;

                    foreach ($laporanPengeluaranPerTahun as $data): ?>

                    <tr>
                        <th scope="row"><?= $no; ?></th>
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