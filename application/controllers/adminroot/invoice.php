 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	function __construct() {
		parent::__construct();

		// Load Model
		$this->load->model('AdminModelInvoice');

		// Cek hak akses
		if ($this->session->userdata('username') == "") {
			flashMessage('warning' ,'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('gudang/home');
		} elseif ($this->session->userdata('level') == "3") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('penjualan/home');
		}
	}

	public function index()
	{
		$data['title'] = 'Invoice';
		$data['invoiceReseller'] = $this->AdminModelInvoice->getInvoiceReseller();
		$data['invoiceMerk'] = $this->AdminModelInvoice->getInvoiceMerk();
		$this->render_admin('adminroot/invoice', $data);
	}

	public function getDataInvoiceReseller()
	{
		$id = $this->input->post('id');
		$data['invoiceReseller'] = $this->AdminModelInvoice->getInvoiceResellerById($id);

		echo json_encode($data);
	}

	public function  getDetailBarang(){
        $idInvoice = $this->input->post('id');
        $this->load->model('AdminModelInvoice');
        $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceReseller($idInvoice);

        echo json_encode($data);
    }

    public function getDataInvoiceResellerById()
    {
        $id = $this->input->post('id');
        $data['invoiceReseller'] = $this->AdminModelInvoice->getInvoiceResellerById($id);

        echo json_encode($data);
    }

	public function getDataInvoiceMerk()
	{
		$id = $this->input->post('id');
		$data['invoiceMerk'] = $this->AdminModelInvoice->getInvoiceMerkById($id);

		echo json_encode($data);
	}

    public function getDataInvoiceMerkById()
    {
        $id = $this->input->post('id');
        $data['invoiceMerk'] = $this->AdminModelInvoice->getInvoiceMerkById($id);

        echo json_encode($data);
    }

    public function insertHistoryInvoice()
    {
        $sisaTagihan = $this->input->post('sisaTagihanReseller');
        $data['id_history'] = null;
        $data['id_invoice'] = $this->input->post('inIdInvoice');
        $data['total_tagihan'] = $this->input->post('totalTagihanReseller');
        $data['pembayaran_tagihan'] = $this->input->post('inPembayaran');
        $data['tanggal_pembayaran'] = $this->input->post('inTglBayar');
        $data['sisa_tagihan'] = $this->input->post('sisaTagihanReseller');


        $sukses = $this->AdminModelInvoice->insertHistoryInvoice($data);

        if (!$sukses) {
            if ($sisaTagihan == "0"){
                $statusUpdate = $this->AdminModelInvoice->updateStatusInvoice($this->input->post('inIdInvoice'));
            }

            flashMessage('success', 'Invoice berhasil diupdate.');
            redirect('adminroot/invoice');
        } else {
            flashMessage('error', 'Invoice gagal diupdate! Silahkan coba lagi');
            redirect('adminroot/invoice');
        }
    }

    public function insertHistoryInvoiceMerk()
    {
        $sisaTagihan = $this->input->post('sisaTagihanMerk');
        $data['id_history'] = null;
        $data['id_invoice'] = $this->input->post('inIdInvoiceMerk');
        $data['total_tagihan'] = $this->input->post('totalTagihanMerk');
        $data['pembayaran_tagihan'] = $this->input->post('inPembayaranMerk');
        $data['tanggal_pembayaran'] = $this->input->post('inTglBayarMerk');
        $data['sisa_tagihan'] = $this->input->post('sisaTagihanMerk');


        $sukses = $this->AdminModelInvoice->insertHistoryInvoice($data);

        if (!$sukses) {
            if ($sisaTagihan == "0"){
                $statusUpdate = $this->AdminModelInvoice->updateStatusInvoice($this->input->post('inIdInvoice'));
            }

            flashMessage('success', 'Invoice berhasil diupdate.');
            redirect('adminroot/invoice');
        } else {
            flashMessage('error', 'Invoice gagal diupdate! Silahkan coba lagi');
            redirect('adminroot/invoice');
        }
    }

	public function cetakInvoice($id)
	{
		$this->load->library("EscPos");

		$data['cetakInvoiceReseller'] = $this->AdminModelInvoice->getInvoiceResellerById($id);

		echo json_encode($data);

		try {

			$connector = new Mike42\Escpos\PrintConnectors\CupsPrintConnector("Printer_USB_Thermal_Printer");
			$printer = new Mike42\Escpos\Printer($connector);

			$printer->text("Thank you for shopping at ExampleMart\n");
			$printer->text("For trading hours, please visit example.com\n");

			// // Cut the receipt and open the cash drawer
			$printer->cut();
			// $printer->pulse();

			$printer->close();

		} catch(Exception $e) {

			echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
		
		}
		
	}

}