<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NilaiModel extends CI_Model {
  public function view(){
    return $this->db->get('trx_nilai')->result(); 
  }

	public function getByKodeMk($kode_mk)
    {
        return $this->db->get_where('trx_nilai', ["kode_mk" => $kode_mk])->row();
    }
}
