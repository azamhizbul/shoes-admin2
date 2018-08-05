<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModelReseller extends CI_Model {

	function getReseller(){
		$this->db->where('status',0);
		$this->db->order_by('nama_reseller', 'DSC');

		$query = $this->db->get('tb_reseller'); 
		return $query->result();
	}

	function findOne(){
		$this->db->where('id_reseller', $this->input->post('id'));
    	return $this->db->get('tb_reseller')->result();
	}

	function updateReseller(){
		$ar['nama_reseller'] = $this->input->post('NamaReseller');
		$ar['no_handphone'] = $this->input->post('NoHpReseller');
		$ar['alamat'] = $this->input->post('AlamatReseller');
		$ar['email'] = $this->input->post('EmailReseller');
		$this->db->set($ar);
		$this->db->where('id_reseller',$this->input->post('IdReseller'));
		$this->db->update('tb_reseller');
	}

	function insertReseller(){
		$ar['nama_reseller'] = $this->input->post('NamaResellerPost');
		$ar['no_handphone'] = $this->input->post('NoHpResellerPost');
		$ar['alamat'] = $this->input->post('AlamatResellerPost');
		$ar['email'] = $this->input->post('EmailResellerPost');
		$this->db->insert('tb_reseller', $ar);
	}

	function deleteReseller($id){
		$ar['status'] = 1;
		$this->db->set($ar);
		$this->db->where('id_reseller',$id);
		$this->db->update('tb_reseller');

	}


}

/* End of file AdminModelReseller.php */
/* Location: ./application/models/AdminModelReseller.php */