<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NilaiModel extends CI_Model {
  public function view(){
    return $this->db->get('trx_nilai')->result(); // Tampilkan semua data yang ada di tabel siswa
  }
}
