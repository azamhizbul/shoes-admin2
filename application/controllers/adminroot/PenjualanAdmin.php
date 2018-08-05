<?php 

use \Escpos\Printer;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * class penjualan admin
 */
class PenjualanAdmin extends MY_Controller
{
	protected $getIDEnd, $getIDReseller, $getIDMerk, $getIDInvoiceMerk, $getIDInvoiceReseller;

	function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModelPenjualan');
		$this->getLastId = $this->AdminModelPenjualan->getLastIdTransaksi();
		$this->getLastIdReseller = $this->AdminModelPenjualan->getLastIdTransaksiReseller();
		$this->getLastIdInvoice = $this->AdminModelPenjualan->getLastIdTransaksiInvoiceReseller();
		$this->getLastIdMerk = $this->AdminModelPenjualan->getLastIdTransaksiMerk();
		$this->getLastIdInvoiceMerk = $this->AdminModelPenjualan->getLastIdTransaksiInvoiceMerk();
		
		$this->getIDEnd = "CODE-".date('Ymd');
		$this->getIDMerk = "TSMRK-".date('YmdHis');
		$this->getIDReseller = "TSRES-".date('YmdHis');
		$this->getIDInvoiceMerk = "TSMRK-INV-".date('YmdHis');
		$this->getIDInvoiceReseller = "TSRES-INV-".date('YmdHis');

		if ($this->session->userdata('logged_in') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} else if ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('gudang/home/');
		} elseif ($this->session->userdata('level') == "3") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('penjualan/home/');
		}
	}

	public function index()
	{
		$data['title'] = 'Penjualan Admin - End User';
		$this->render_admin('adminroot/Penjualan', $data);
	}

	public function getBarangEndJSON()
	{
		$data = $this->AdminModelPenjualan->getBarangEnd();
		echo json_encode($data);
	}

	 public function sub(){
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

	// fungsi simpan transaksi end user ke database
	public function saveTransaksiEndUser() { 
		$ar['id_transaksi_end_user'] = $this->sub();
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
		$ar['reference_1'] = 0;
		$ar['reference_2'] = $this->input->post('reference1');

		$sukses = $this->AdminModelPenjualan->saveTransaksiEndCustomer($ar);
		
		if (!$sukses) {
			flashMessage('success', 'Transaksi berhasil ditambahkan.');

			$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemAdmin($this->sub());

			$this->prosesCetakKeThermal($data['detailpenjualan']);

			$data['title'] = "Bukti Pembayaran - ".$this->sub();
			$this->render_admin('adminroot/AwalBuktiPembayaranEndUser', $data);
			
		} else {
			flashMessage('error', 'Transaksi gagal! Silahkan coba lagi.');
			redirect('adminroot/PenjualanAdmin');
		}
		
	}

	// fungsi simpan transaksi end user peritem ke database
	public function saveTransaksiEndPerItem(){
		$data = json_decode($this->input->post('sendData'));

		foreach($data->dataPerItem as $row) {
			$stok = $row->stokLama;
	        $filter_data = array(
	        	"id_transaksi_end_user"=> $this->sub(),
	            "id_barang" => $row->id_barang,
	            "total_item" => $row->total_item,
	            "total_harga" => $row->total_harga
	        );
			echo $this->AdminModelPenjualan->saveTransaksiEndPerItem($filter_data);
	    }
	}

	public function historyPenjualan()
	{
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan';
		$data['listpenjualanadmin'] = $this->AdminModelPenjualan->riwayatPenjualanEndUserAdmin();
		$data['listpenjualankasir'] = $this->AdminModelPenjualan->riwayatPenjualanEndUserKasir();
		// echo json_encode($data);
		$this->render_admin('adminroot/RiwayatPenjualan', $data);
	}

	public function detailHistoryPenjualanAdmin($id)
	{
		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemAdmin($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranEndUser', $data);
	}

	public function detailHistoryPenjualanKasir($id)
	{
		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemKasir($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranEndUser', $data);
	}

	public function cetakBuktiPembayaranEndUserAdmin($id)
	{	

		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemAdmin($id);
		// echo json_encode($data);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->load->view('adminroot/CetakBuktiPembayaranEndUser', $data);

		$html = $this->output->get_output();

		$filename = $data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->tgl_jual." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));

	}

	public function cetakBuktiPembayaranEndUserKasir($id)
	{	
		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemKasir($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->load->view('adminroot/CetakBuktiPembayaranEndUser', $data);

		$html = $this->output->get_output();

		$filename = $data['detailpenjualan'][0]->nama_pembeli." - ".$data['detailpenjualan'][0]->tgl_jual." - ".$data['detailpenjualan'][0]->id_transaksi_end_user;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));

	}

	private function prosesCetakKeThermal($data) {
		$namaKasir = $data[0]->nama;
		$noTransaksi = $data[0]->id_transaksi_end_user;
		$totalJumlah = $data[0]->total_item;
		$totalHarga = $data[0]->harga_jual;

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

	public function cetakThermalEndUserAdmin($id) {

		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemAdmin($id);

		$this->prosesCetakKeThermal($data['detailpenjualan']);

		redirect('adminroot/PenjualanAdmin/historyPenjualan');
	}

	public function cetakThermalEndUserKasir($id) {

		$data['detailpenjualan'] = $this->AdminModelPenjualan->getDetailPenjualanPerItemKasir($id);

		$this->prosesCetakKeThermal($data['detailpenjualan']);

		redirect('adminroot/PenjualanAdmin/historyPenjualan');

	}

	public function reseller()
	{
		$data['title'] = 'Penjualan Barang - Reseller';
		$this->render_admin('adminroot/PenjualanReseller', $data);
	}

	public function resellerJSON()
	{
		$reseller = $this->AdminModelPenjualan->getResellerInfo();
		echo json_encode($reseller);
	}

	public function getBarangResellJSON()
	{
		$data = $this->AdminModelPenjualan->getBarangResell();
		echo json_encode($data);
	}

	// fungsi simpan transaksi reseller ke database
	public function saveTransaksiResel(){
		// echo $this->getLastIdResell();
		
		// echo $this->getLastIdInvoiceResell();

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
		$ar['reference_1'] = 0;
		$ar['reference_2'] = $this->input->post('reference1');
		$ar['id_reseller'] = $this->input->post('IDReseller');
		$ar['id_invoice'] = $this->getLastIdInvoiceResell();

		$invoice['id_invoice'] = $this->getLastIdInvoiceResell();
		$invoice['tgl_jatuh_tempo'] = $this->input->post('tglJatuhTempo');

		$hisInvoice['id_invoice'] = $this->getLastIdInvoiceResell();
		$hisInvoice['total_tagihan'] = $this->input->post('jumlahPembayaran');
		$hisInvoice['pembayaran_tagihan'] = $this->input->post('uangDiterima');
		$hisInvoice['tanggal_pembayaran'] = $this->input->post('hari');
		$hisInvoice['sisa_tagihan'] = $sisaTagihan;

		$sukses = $this->AdminModelPenjualan->insertTransaksiReseller($ar, $invoice, $hisInvoice);
		
		if (!$sukses) {
			flashMessage('success', 'Transaksi Reseller berhasil.');

			$data['detailpenjualan'] = $this->AdminModelPenjualan->getRiwayatResellerAdminById($this->getLastIdResell());

			$data['title'] = $this->getLastIdResell();
			$this->render_admin('adminroot/AwalBuktiPembayaranReseller', $data);

		} else {
			flashMessage('error', 'Transaksi Reseller gagal! Silahkan coba lagi.');
			redirect('adminroot/PenjualanAdmin/reseller/');
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
	        echo $this->AdminModelPenjualan->insertTransaksiResellPerItem($filter_data);
	    }
	}

	public function historyPenjualanReseller()
	{
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan Reseller';
		$data['listhistorypenjualanreselleradmin'] = $this->AdminModelPenjualan->getRiwayatPenjualanResellerAdmin();
		$data['listhistorypenjualanresellerkasir'] = $this->AdminModelPenjualan->getRiwayatPenjualanResellerKasir();
		$this->render_admin('adminroot/riwayatPenjualanReseller', $data);
	}

	public function detailRiwayatPenjualanResellerAdmin($id)
	{
		$data['detailpenjualan'] = $this->AdminModelPenjualan->getRiwayatResellerAdminById($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_reseller." - ".$data['detailpenjualan'][0]->id_transaksi_reseller;
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranReseller', $data);
	}

	public function detailRiwayatPenjualanResellerKasir($id)
	{
		$data['detailpenjualan'] = $this->AdminModelPenjualan->getRiwayatResellerKasirById($id);
		$data['title'] = 'Bukti Pembayaran - '.$data['detailpenjualan'][0]->nama_reseller." - ".$data['detailpenjualan'][0]->id_transaksi_reseller;
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranReseller', $data);
	}

	public function cetakBuktiPembayaranResellerAdmin($id)
	{	
		$data['invoiceReseller'] = $this->AdminModelPenjualan->getRiwayatResellerAdminById($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceReseller'][0]->nama_reseller." - ".$id;
		$this->load->view('adminroot/CetakBuktiPembayaranReseller', $data);

		$html = $this->output->get_output();

		$filename = $data['invoiceReseller'][0]->nama_reseller." - ".$data['invoiceReseller'][0]->id_transaksi_reseller;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

	public function cetakBuktiPembayaranResellerKasir($id)
	{	
		$data['invoiceReseller'] = $this->AdminModelPenjualan->getRiwayatResellerKasirById($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceReseller'][0]->nama_reseller." - ".$id;
		$this->load->view('adminroot/CetakBuktiPembayaranReseller', $data);

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
		$this->render_admin('adminroot/penjualanMerk', $data);
	}

	// get barang titipan json
	public function getBarangMerkJSON(){
		$data = $this->AdminModelPenjualan->getBarangTitipanEnd();
		echo json_encode($data);
	}

	// fungsi simpan transaksi merk ke database
	public function saveTransaksiMerk()
	{

		//echo $this->getLastIdInvoiceMerk();
		
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
		$ar['referensi_1'] = 0;
		$ar['referensi_2'] = $this->input->post('reference1');
		
		$invoice['id_invoice'] = $this->getLastIdInvoiceMerk();
		$invoice['tgl_jatuh_tempo'] = 0000-00-00;

		$hisInvoice['id_invoice'] = $this->getLastIdInvoiceMerk();
		$hisInvoice['total_tagihan'] = $this->input->post('jumlahPembayaran');
		$hisInvoice['pembayaran_tagihan'] = $this->input->post('uangDiterima');
		$hisInvoice['tanggal_pembayaran'] = $this->input->post('hari');
		$hisInvoice['sisa_tagihan'] = $sisaTagihan;

		$sukses = $this->AdminModelPenjualan->insertTransaksiMerk($ar, $invoice, $hisInvoice);

		if (!$sukses) {
			flashMessage('success', 'Transaksi berhasil ditambahkan.');
			$data['title'] = "Bukti Pembayaran - ".$this->getLastIdMerk();
			$data['invoiceMerk'] = $this->AdminModelPenjualan->getDetailPenjualanMerkPerItemAdmin($this->getLastIdMerk());
			$this->render_admin('adminroot/AwalBuktiPembayaranMerk', $data);
		} else {
			flashMessage('error', 'Transaksi gagal! Silahkan coba lagi.');
			redirect('adminroot/PenjualanAdmin/merk');
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
	        echo $this->AdminModelPenjualan->insertTransaksiMerkPerItem($filter_data);
    	}
	}

	public function historyPenjualanMerk(){
		$data['title'] = 'Penjualan Barang - Riwayat Penjualan Merk';
		$data['riwayatTransaksiMerkAdmin'] = $this->AdminModelPenjualan->riwayatTransaksiMerkAdmin();
		$data['riwayatTransaksiMerkKasir'] = $this->AdminModelPenjualan->riwayatTransaksiMerkKasir();
		$this->render_admin('adminroot/riwayatPenjualanMerk', $data);
	}

	public function detailRiwayatPenjualanMerkAdmin($idTransaksiMerk)
	{
		$data['title'] = "Bukti Pembayaran";
		$data['invoiceMerk'] = $this->AdminModelPenjualan->getDetailPenjualanMerkPerItemAdmin($idTransaksiMerk);
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranMerk', $data);
	}

	public function detailRiwayatPenjualanMerkKasir($idTransaksiMerk)
	{
		$data['title'] = "Bukti Pembayaran";
		$data['invoiceMerk'] = $this->AdminModelPenjualan->getDetailPenjualanMerkPerItemKasir($idTransaksiMerk);
		// echo json_encode($data);
		$this->render_admin('adminroot/BuktiPembayaranMerk', $data);
	}

	public function cetakBuktiPembayaranMerkAdmin($id)
	{	
		$data['invoiceMerk'] = $this->AdminModelPenjualan->getDetailPenjualanMerkPerItemAdmin($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceMerk'][0]->nama_pembeli." - ".$id;

		$this->load->view('adminroot/CetakBuktiPembayaranMerk', $data);

		$html = $this->output->get_output();

		$filename = $data['invoiceMerk'][0]->nama_pembeli." - ".$data['invoiceMerk'][0]->tgl_jual." - ".$data['invoiceMerk'][0]->id_transaksi_merk;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

	public function cetakBuktiPembayaranMerkKasir($id)
	{	
		$data['invoiceMerk'] = $this->AdminModelPenjualan->getDetailPenjualanMerkPerItemKasir($id);
		$data['title'] = "Bukti Pembayaran - ".$data['invoiceMerk'][0]->nama_pembeli." - ".$id;

		$this->load->view('adminroot/CetakBuktiPembayaranMerk', $data);

		$html = $this->output->get_output();

		$filename = $data['invoiceMerk'][0]->nama_pembeli." - ".$data['invoiceMerk'][0]->tgl_jual." - ".$data['invoiceMerk'][0]->id_transaksi_merk;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A5', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
	}

}
