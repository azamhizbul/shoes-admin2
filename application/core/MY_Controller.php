<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller{
    function render_admin($content, $data = NULL){
        $data['akun'] = $this->LoginModel->getNamaUser($this->session->userdata('uid'));
        $data['header'] = $this->load->view('layout/headerAdmin', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', $data, TRUE);
        $this->load->view('layout/indexAdmin', $data);
    }

     function render_penjualan($content, $data = NULL){
        $data['akun'] = $this->LoginModel->getNamaUser($this->session->userdata('uid'));
        $data['header'] = $this->load->view('layout/headerPenjualan', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', $data, TRUE);
        $this->load->view('layout/indexPenjualan', $data);
    }

     function render_gudang($content, $data = NULL){
        $data['akun'] = $this->LoginModel->getNamaUser($this->session->userdata('uid'));
        $data['header'] = $this->load->view('layout/headerGudang', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', $data, TRUE);
        $this->load->view('layout/indexGudang', $data);
    }

    function render_login($content, $data = NULL){
        $data['header'] = $this->load->view('layout/headerLogin', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('layout/footer', $data, TRUE);
        $this->load->view('layout/indexLogin', $data);
    }
}