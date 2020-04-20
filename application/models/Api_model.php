<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
	public function getfileinfo($filename) {
		$query = "SELECT * FROM gravacao WHERE NomeFile LIKE '%".$filename."'";
		return $this->db->query($query)->result_array();
	}

	public function getnoanswer($date) {
		$query = "SELECT * FROM gravacao WHERE Coment = 'LIGAÇÃO NÃO ATENDIDA' AND HoraIni BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' ORDER BY HoraIni ASC";
		return $this->db->query($query)->result_array();
	}
}