<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class ProfileUserModel extends CI_Model
{
	
	function getAkunId($id_user)
	{
		$this->db->select('id_user, username, password');
		$this->db->where('id_user', $id_user);

		$query = $this->db->get('tb_user');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	function updateUsername($user, $id_user)
	{
		$this->db->set('username', $user);
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user');
	}

	function updatePassword($pass, $id_user)
	{
		$this->db->set('password', do_hash($pass, 'md5'));
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user');
	}
}