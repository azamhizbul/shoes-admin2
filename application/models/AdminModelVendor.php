<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModelVendor extends CI_Model {

	function getVendor() {
		$this->db->where('status',0);
		$this->db->order_by('nama_vendor', 'DSC');

		$query = $this->db->get('tb_vendor'); 
		return $query->result();
	}	

	function insertVendor(){
		$ar['nama_vendor'] = $this->input->post('NamaVendorPost');
		$ar['no_handphone'] = $this->input->post('NoHpVendorPost');
		$ar['alamat'] = $this->input->post('AlamatVendorPost');
		$this->db->insert('tb_vendor', $ar);
	}

	function findOne(){
		$this->db->where('id_vendor', $this->input->post('id'));
    	return $this->db->get('tb_vendor')->result();
	}

	function updateVendor(){
		$ar['nama_vendor'] = $this->input->post('NamaVendor');
		$ar['no_handphone'] = $this->input->post('NoHpVendor');
		$ar['alamat'] = $this->input->post('AlamatVendor');
		$this->db->set($ar);
		$this->db->where('id_vendor',$this->input->post('IdVendor'));
		$this->db->update('tb_vendor');
	}

	function deleteVendor($id){
		$ar['status'] = 1;
		$this->db->set($ar);
		$this->db->where('id_vendor',$id);
		$this->db->update('tb_vendor');

	}

}

/* End of file AdminModelVendor.php */
/* Location: ./application/models/AdminModelVendor.php */