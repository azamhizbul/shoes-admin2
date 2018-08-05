<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class DetailInvoice extends MY_Controller
{
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
        $data['title'] = 'Detail Invoice';
        $this->render_admin('adminroot/DetailInvoice', $data);
    }

    public function detailInvoice($idInvoice)
    {
        $data['title'] = 'Detail Invoices';
        $ids = explode(".", $idInvoice);
        $invoiceId = $ids[1];
        $jenis = $ids[0];
        $data['id'] = $invoiceId;
        $this->load->model('AdminModelInvoice');
        if ($jenis == 'res'){
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceReseller($invoiceId);
            $data['historyInvoice'] = $this->AdminModelInvoice->getHistoryInvoiceReseller($invoiceId);
        } else if ($jenis == 'merk'){
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceMerk($invoiceId);
            $data['historyInvoice'] = $this->AdminModelInvoice->getHistoryInvoiceReseller($invoiceId);
        }

        $this->render_admin('adminroot/DetailInvoice', $data);
    }

    public function cetakBuktiDetailInvoice($idInvoice)
    {   
        // $data['invoiceReseller'] = $this->AdminModelPenjualan->getHistoryPenjualanResellerPeritemAdmin($id);
        $ids = explode(".", $idInvoice);
        $invoiceId = $ids[1];
        $jenis = $ids[0];
        $data['id'] = $invoiceId;
        $this->load->model('AdminModelInvoice');
        if ($jenis == 'res'){
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceReseller($invoiceId);
            $data['infoReseller'] = $this->AdminModelInvoice->getInfoReseller($invoiceId);
            $data['historyInvoice'] = $this->AdminModelInvoice->getHistoryInvoiceReseller($invoiceId);
        } else if ($jenis == 'merk'){
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceMerk($invoiceId);
            $data['historyInvoice'] = $this->AdminModelInvoice->getHistoryInvoiceReseller($invoiceId);
        }
        $data['title'] = "Bukti Pembayaran - ".$data['detailBarang'][0]->id_reseller." - ".$invoiceId;
        $this->load->view('adminroot/cetakBuktiDetailInvoice', $data);

        $html = $this->output->get_output();

        $filename = $data['detailBarang'][0]->id_reseller." - ".$data['detailBarang'][0]->id_transaksi_reseller;

        $this->dompdf->load_html($html);
        $this->dompdf->set_paper('A5', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream("Bukti Pembayaran - ".$filename.".pdf", array('Attachment' => 0));
    }

    public function buktiPembayaran($id){
        $data['title'] = 'Bukti Pembayaran';
        $ids = explode(".", $id);
        $idInvoice = $ids[1];
        $idHistory = $ids[0];
        $this->load->model('AdminModelInvoice');

        $idInvoices = explode("-", $ids[1]);
        if ($idInvoices[0] == 'TSRES'){
            $data['detailTransaksi'] = $this->AdminModelInvoice->getHistoryTransactionInvoiceReseller($idInvoice);
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceReseller($idInvoice);
            $data['detailHistory'] = $this->AdminModelInvoice->getHistoryInvoiceResellerByIdHistory($idHistory);

        } else if ($idInvoices[0] == 'TSMRK'){
            $data['detailTransaksi'] = $this->AdminModelInvoice->getHistoryTransactionInvoiceMerk($idInvoice);
            $data['detailBarang'] = $this->AdminModelInvoice->getBarangInvoiceMerk($idInvoice);
            $data['detailHistory'] = $this->AdminModelInvoice->getHistoryInvoiceResellerByIdHistory($idHistory);
        }

        $this->render_admin('adminroot/BuktiPembayaranInvoice', $data);

    }




}
?>