<?php

use \Escpos\Printer;

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends MY_Controller {

	protected $getIDEnd, $getID, $getIDReseller, $getIdInvoiceMerk, $getIdInvoiceReseller;

	function __construct() {
		parent::__construct();
		$this->load->model('PenjualanEndCustomer');
		$this->load->model('PenjualanReseller');
		$this->load->model('PenjualanMerk');

		$this->getLastId = $this->PenjualanEndCustomer->getLastIdTransaksi();
		$this->getLastIdReseller = $this->PenjualanReseller->getLastIdTransaksiReseller();
		$this->getLastIdInvoice = $this->PenjualanReseller->getLastIdTransaksiInvoiceReseller();
		$this->getLastIdMerk = $this->PenjualanMerk->getLastIdTransaksiMerk();
		$this->getLastIdInvoiceMerk = $this->PenjualanMerk->getLastIdTransaksiInvoiceMerk();

		$this->getIDEnd = "CODE-".date("YmdHis");
		$this->getID = "TSMRK-".date("YmdHis");
		$this->getIDReseller = "TSRES-".date("YmdHis");
		$this->getIdInvoiceMerk = "TSMRK-INV-".date("YmdHis");
		$this->getIdInvoiceReseller = "TSRES-INV-".date("YmdHis");

		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('gudang/home');
		}
	}

	public function index()
	{
		$data['title'] = 'Penjualan Barang - Pembeli';
		
		$this->render_penjualan('penjualan/penjualan', $data);
	}

	public function getLastIdEnd(){
	 	$x = substr($this->getLastId, 5);
	 	$y = (int)$x + 1;
	 	$z = "CODE-".(string)$y;
		
		return $z;
	}

	 public function getLastIdResell(){
	 	$x = substr($this->getLastIdReseller, 6);
	 	$y = (int)$x + 1;
	 	$z = "TSRES-".(string)$y;
		
		return $z;
	}

	public function getLastIdMerk(){
	 	$x = substr($this->getLastIdMerk, 6);
	 	$y = (int)$x + 1;
	 	$z = "TSMRK-".(string)$y;
		
		return $z;
	}

	public function getLastIdInvoiceResell(){
	 	$x = substr($this->getLastIdInvoice, 10);
	 	$y = (int)$x + 1;
	 	$z = "TSRES-INV-".(string)$y;
		
		return $z;
	}
	public function getLastIdInvoiceMerk(){
	 	$x = substr($this->getLastIdInvoiceMerk, 10);
	 	$y = (int)$x + 1;
	 	$z = "TSMRK-INV-".(string)$y;
		
		return $z;
	}

	public function historyPenjualan()
	{
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan';
		$data['listpenjualan'] = $this->PenjualanEndCustomer->riwayatPenjualanEndUser();
		// echo json_encode($data);
		$this->render_penjualan('penjualan/riwayatPenjualan', $data);
	}

	public function detailHistoryPenjualan($id)
	{
		$data['detailpenjualan'] = $this->PenjualanEndCustomer->getDetailPenjualanPerItem($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;
		// echo json_encode($data);
		$this->render_penjualan('penjualan/BuktiPembayaranEndUser', $data);
	}

	public function cetakBuktiPembayaranEndUser($id)
	{	
		$data['detailpenjualan'] = $this->PenjualanEndCustomer->getDetailPenjualanPerItem($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->load->view('penjualan/CetakBuktiPembayaranEndUser', $data);

		$html = $this->output->get_output();

		$filename = $data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->tgl_jual." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

	private function prosesCetakKeThermal($data) {

		$totalJumlah = $data[0]->jumlah_jual;
		$totalHarga = $data[0]->harga_jual;
		$namaKasir = $data[0]->nama;
		$noTransaksi = $data[0]->id_transaksi_end_user;

		try {
			$connector = new Escpos\PrintConnectors\WindowsPrintConnector("posprinter");
			$printer = new Escpos\Printer($connector);
			$printer->initialize();

			$date = date('D j M Y H:i:s');

			// Header
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			$printer->text("SHOES - POS\n");
			$printer->selectPrintMode();
			$printer->setUnderline(1);
			$printer->text("ALAMAT TOKO");
			$printer->setUnderline();
			$printer->feed(2);

			// Content
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$printer->setUnderline(0);
			$printer->text("No. Transaksi : {$noTransaksi}\n");
			$printer->text("Kasir : {$namaKasir}\n");
			$printer->feed();

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$printer->text("Produk : ");
			$printer->setJustification();
			$printer->feed(1);

			$printer->text("--------------------------------\n");
			foreach ($data as $penjualan) {
				$printer->text("{$penjualan->produk} ($penjualan->total_item) Rp. {$penjualan->harga_end_user}\n");
				$printer->text("--------------------------------\n");
			}

			$printer->feed();
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$printer->text("Total Barang : ");
			$printer->text("{$totalJumlah}.\n");
			$printer->text("Total Harga : ");
			$printer->text("Rp. {$totalHarga}.\n");
			$printer->feed();

			// Footer
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$printer->text("Terima kasih telah membeli di Toko kami.\n");
			$printer->text("Selamat berbelanja kembali\n");
			$printer->feed(1);
			$printer->text($date);
			$printer->feed(3);
			$printer->cut();
			$printer->close();
		} catch (Exception $ex) {
			echo '<script type="text/javascript">';
			echo 'alert("Tidak dapat cetak struk ke printer!\nSilahkan cek printer mungkin terjadi kesalahan dan coba lagi.");';
			echo 'window.history.go(-1)';
			echo '</script>';
		}

	}

	public function cetakThermalEndUser($id) {

		$data['detailpenjualan'] = $this->PenjualanEndCustomer->getDetailPenjualanPerItem($id);

		$this->prosesCetakKeThermal($data['detailpenjualan']);

		redirect('penjualan/penjualan/historyPenjualan');

	}
	
	public function reseller()
	{
		$data['title'] = 'Penjualan Barang - Reseller';
		$this->render_penjualan('penjualan/penjualanReseller', $data);
	}

	public function resellerJSON()
	{
		$reseller = $this->PenjualanReseller->getResellerInfo();

		echo json_encode($reseller);
	}

	// get barang json
	public function getBarangEndJSON(){
		$data = $this->PenjualanEndCustomer->getBarangEnd();
		echo json_encode($data);
	}

	// get barang titipan json
	public function getBarangMerkJSON(){
		$data = $this->PenjualanMerk->getBarangTitipanEnd();
		echo json_encode($data);
	}

	// get barang untuk reseller JSON
	public function getBarangResellJSON(){
		$data = $this->PenjualanReseller->getBarangResell();
		echo json_encode($data);
	}

	// fungsi simpan transaksi end user ke database
	public function saveTransaksiEndUser() {
		$ar['id_transaksi_end_user'] = $this->getLastIdEnd();
		$ar['tgl_jual'] = $this->input->post('hari');
		$ar['jumlah_jual'] = $this->input->post('jumlahItem');
		$ar['potongan_harga'] = $this->input->post('potongan');
		$ar['harga_jual'] = $this->input->post('jumlahPembayaran');

		if ($this->input->post('uangDiterima') >= $this->input->post('jumlahPembayaran')) {
			$ar['status_transaksi'] = 1;
		} else {
			$ar['status_transaksi'] = 0;
		}

		$ar['uang_diterima'] = $this->input->post('uangDiterima');
		$ar['uang_kembalian'] = $this->input->post('uangKembalian');
		$ar['nama_pembeli'] = $this->input->post('namaPembeli');
		$ar['reference_1'] = $this->input->post('reference1');
		$ar['reference_2'] = 0;

		$sukses = $this->PenjualanEndCustomer->saveTransaksiEndCustomer($ar);
		
		if (!$sukses) {
			flashMessage('success', 'Transaksi berhasil ditambahkan.');

			$data['detailpenjualan'] = $this->PenjualanEndCustomer->getDetailPenjualanPerItem($this->getLastIdEnd());

			$this->prosesCetakKeThermal($data['detailpenjualan']);

			$data['title'] = "Bukti Pembayaran - " . $this->getLastIdEnd();
			$this->render_penjualan('penjualan/AwalBuktiPembayaranEndUser', $data);

		} else {
			flashMessage('error', 'Transaksi gagal! Silahkan coba lagi.');
			redirect('penjualan/penjualan');
		}
		
	}

	// fungsi simpan transaksi end user peritem ke database
	public function saveTransaksiEndPerItem(){
		$data = json_decode($this->input->post('sendData'));

		foreach($data->dataPerItem as $row) {
			$stok = $row->stokLama;
	        $filter_data = array(
	        	"id_transaksi_end_user"=> $this->getLastIdEnd(),
	            "id_barang" => $row->id_barang,
	            "total_item" => $row->total_item,
	            "total_harga" => $row->total_harga
	        );
			echo $this->PenjualanEndCustomer->saveTransaksiEndPerItem($filter_data);
	    }
	}

	// fungsi simpan transaksi reseller ke database
	public function saveTransaksiResel(){
		$sisaTagihan = $this->input->post('sisaTagihan');

		$ar['id_transaksi_reseller'] = $this->getLastIdResell();
		$ar['tgl_jual'] = $this->input->post('hari');
		$ar['jumlah_jual'] = $this->input->post('jumlahItem');
		$ar['potongan_harga'] = $this->input->post('potongan');
		$ar['harga_jual'] = $this->input->post('jumlahPembayaran');
		
		if ($sisaTagihan == 0) {
			$ar['status_transaksi'] = 1;
			$invoice['status_invoice'] = 1;
		} else {
			$ar['status_transaksi'] = 0;
			$invoice['status_invoice'] = 0;
		}

		$ar['uang_diterima'] = $this->input->post('uangDiterima');
		$ar['uang_kembalian'] = $this->input->post('uangKembalian');
		$ar['reference_1'] = $this->input->post('reference1');
		$ar['reference_2'] = 0;
		$ar['id_reseller'] = $this->input->post('IDReseller');
		$ar['id_invoice'] = $this->getLastIdInvoiceResell();

		$invoice['id_invoice'] = $this->getLastIdInvoiceResell();
		$invoice['tgl_jatuh_tempo'] = $this->input->post('tglJatuhTempo');

		$hisInvoice['id_invoice'] = $this->getLastIdInvoiceResell();
		$hisInvoice['total_tagihan'] = $this->input->post('jumlahPembayaran');
		$hisInvoice['pembayaran_tagihan'] = $this->input->post('uangDiterima');
		$hisInvoice['tanggal_pembayaran'] = $this->input->post('hari');
		$hisInvoice['sisa_tagihan'] = $sisaTagihan;

		$sukses = $this->PenjualanReseller->insertTransaksiReseller($ar, $invoice, $hisInvoice);
		
		if (!$sukses) {
			flashMessage('success', 'Transaksi Reseller berhasil.');
			$data['title'] = $this->getLastIdResell();
			$data['detailpenjualan'] = $this->PenjualanReseller->getRiwayatResellerById($this->getLastIdResell());
			$this->render_penjualan('penjualan/AwalBuktiPembayaranReseller', $data);
		} else {
			flashMessage('error', 'Transaksi Reseller gagal! Silahkan coba lagi.');
			redirect('penjualan/penjualan/reseller');
		}
		
	}

	// fungsi simpan transaksi reseller peritem ke database
	public function saveTransaksiResellPerItem(){
		$data = json_decode($this->input->post('sendData'));
		
		foreach($data->dataPerItem as $row) {
	        $filter_data = array(
	        	"id_transaksi_reseller"=> $this->getLastIdResell(),
	            "id_barang" => $row->id_barang,
	            "total_item" => $row->total_item,
	            "total_harga" => $row->total_harga
	        );
	        echo $this->PenjualanReseller->insertTransaksiResellPerItem($filter_data);
	    }
	}

	public function historyPenjualanReseller()
	{
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan Reseller';
		$data['listhistorypenjualanreseller'] = $this->PenjualanReseller->getRiwayatPenjualanReseller();
		$this->render_penjualan('penjualan/riwayatPenjualanReseller', $data);
	}

	public function detailRiwayatPenjualanReseller($id)
	{
		$data['detailpenjualan'] = $this->PenjualanReseller->getRiwayatResellerById($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_reseller." - ".$data['detailpenjualan'][0]->id_transaksi_reseller;
		// echo json_encode($data);
		$this->render_penjualan('penjualan/BuktiPembayaranReseller', $data);
	}

	public function cetakBuktiPembayaranReseller($id)
	{	
		$data['invoiceReseller'] = $this->PenjualanReseller->getRiwayatResellerById($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceReseller'][0]->nama_reseller." - ".$id;
		$this->load->view('penjualan/CetakBuktiPembayaranReseller', $data);

		$html = $this->output->get_output();

		$filename = $data['invoiceReseller'][0]->nama_reseller." - ".$data['invoiceReseller'][0]->id_transaksi_reseller;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

	// fungsi menampilkan form transaksi merk
	public function merk() {
		$data['title'] = 'Penjualan Barang - Merk';
		$this->render_penjualan('penjualan/penjualanMerk', $data);
	}

	// fungsi simpan transaksi merk ke database
	public function saveTransaksiMerk()
	{
		$sisaTagihan = $this->input->post('sisaTagihan');

		$ar['id_transaksi_merk'] = $this->getLastIdMerk();
		$ar['tgl_jual'] = $this->input->post('hari');
		$ar['jumlah_jual'] = $this->input->post('jumlahItem');
		$ar['harga_jual'] = $this->input->post('jumlahPembayaran');
		$ar['potongan_harga'] = $this->input->post('potongan');
		$ar['uang_diterima'] = $this->input->post('uangDiterima');
		$ar['uang_kembalian'] = $this->input->post('uangKembalian');
		
		if ($sisaTagihan == 0) {
			$ar['status_transaksi'] = 1;
			$invoice['status_invoice'] = 1;
		} else {
			$ar['status_transaksi'] = 0;
			$invoice['status_invoice'] = 0;
		}

		$ar['nama_pembeli'] = $this->input->post('namaPembeli');
		$ar['id_invoice'] = $this->getLastIdInvoiceMerk();
		$ar['referensi_1'] = $this->input->post('reference1');
		$ar['referensi_2'] = 0;
		
		$invoice['id_invoice'] = $this->getLastIdInvoiceMerk();
		$invoice['tgl_jatuh_tempo'] = 0000-00-00;

		$hisInvoice['id_invoice'] = $this->getLastIdInvoiceMerk();
		$hisInvoice['total_tagihan'] = $this->input->post('jumlahPembayaran');
		$hisInvoice['pembayaran_tagihan'] = $this->input->post('uangDiterima');
		$hisInvoice['tanggal_pembayaran'] = $this->input->post('hari');
		$hisInvoice['sisa_tagihan'] = $sisaTagihan;

		$sukses = $this->PenjualanMerk->insertTransaksiMerk($ar, $invoice, $hisInvoice);

		if (!$sukses) {
			flashMessage('success', 'Transaksi berhasil ditambahkan.');
			$data['title'] = "Bukti Pembayaran - ".$this->getLastIdMerk();
			$data['invoiceMerk'] = $this->PenjualanMerk->invoiceMerkById($this->getLastIdMerk());
			$this->render_penjualan('penjualan/AwalBuktiPembayaranMerk', $data);
		} else {
			flashMessage('error', 'Transaksi gagal! Silahkan coba lagi.');
			redirect('penjualan/penjualan/merk');
		}
	}

	public function saveTransaksiMerkPerItem()
	{
		$data = json_decode($this->input->post('sendData'));
		
		foreach($data->dataPerItem as $row) {
	        $filter_data = array(
	        	"id_transaksi_merk"=> $this->getLastIdMerk(),
	            "id_barang" => $row->id_barang,
	            "total_item" => $row->total_item,
	            "total_harga" => $row->total_harga
	        );
	        echo $this->PenjualanMerk->insertTransaksiMerkPerItem($filter_data);
    	}
	}

	public function historyPenjualanMerk(){
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan Merk';
		$data['riwayatTransaksiMerk'] = $this->PenjualanMerk->riwayatTransaksiMerk();
		$this->render_penjualan('penjualan/riwayatPenjualanMerk', $data);
	}

	public function detailRiwayatPenjualanMerk($idTransaksiMerk)
	{
		$data['invoiceMerk'] = $this->PenjualanMerk->invoiceMerkById($idTransaksiMerk);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceMerk'][0]->nama_pembeli." - ".$idTransaksiMerk;
		// echo json_encode($data);
		$this->render_penjualan('penjualan/BuktiPembayaranMerk', $data);
	}

	public function cetakBuktiPembayaranMerk($id)
	{	
		$data['invoiceMerk'] = $this->PenjualanMerk->invoiceMerkById($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceMerk'][0]->nama_pembeli." - ".$id;

		$this->load->view('penjualan/CetakBuktiPembayaranMerk', $data);

		$html = $this->output->get_output();

		$filename = $data['invoiceMerk'][0]->nama_pembeli." - ".$data['invoiceMerk'][0]->tgl_jual." - ".$data['invoiceMerk'][0]->id_transaksi_merk;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */
