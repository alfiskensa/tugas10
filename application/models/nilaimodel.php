<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NilaiModel extends CI_Model {
  public function view(){
    return $this->db->get('trx_nilai')->result(); 
  }

	public function getDataByKodeMk($kode_mk)
    {
			
			$this->db->select('trx_nilai.nim, mst_mhs.nama as nama, trx_nilai.tugas, trx_nilai.uts, trx_nilai.uas'); 
			$this->db->from('trx_nilai');
			$this->db->join('mst_mhs', 'mst_mhs.nim = trx_nilai.nim');
			$this->db->join('mst_mata_kuliah', 'mst_mata_kuliah.kode_mk = trx_nilai.kode_mk');
			$this->db->where('trx_nilai.kode_mk', $kode_mk);
			return $this->db->get()->result();

    }

		public function getNilaiAkhir($tugas, $uts, $uas) {
			return (0.3*$tugas) + (0.3*$uts) + (0.4*$uas);
	}


	public function getGrade($nilaiAkhir){
				if($nilaiAkhir >= 90) {
						return "A";
				} else if($nilaiAkhir >= 85 && $nilaiAkhir < 90) {
						return "A-";
				} else if($nilaiAkhir >= 80 && $nilaiAkhir < 85) {
						return "B+";
				} else if($nilaiAkhir >= 75 && $nilaiAkhir < 80) {
						return "B";
				} else if($nilaiAkhir >= 70 && $nilaiAkhir < 75) {
						return "B-";
				} else if($nilaiAkhir >= 65 && $nilaiAkhir < 70) {
						return "C+";
				} else if($nilaiAkhir >= 60 && $nilaiAkhir < 65) {
						return "C-";
				} else if($nilaiAkhir >= 50 && $nilaiAkhir < 60) {
						return "D";
				} else if($nilaiAkhir >= 40 && $nilaiAkhir < 50) {
						return "E";
				} else if($nilaiAkhir >= 0 && $nilaiAkhir < 40) {
						return "T";
				} else {
						return "N/A";
				}
		}


		public function getDataNilai($kode_mk){
			$data = $this->getDataByKodeMk($kode_mk);
			$listNilai = [];
			for ($i = 0; $i < count($data); $i++) {
				$value = $data[$i];
				$value->nilai_akhir = $this->getNilaiAkhir($value->tugas, $value->uts, $value->uas);
				$value->grade = $this->getGrade($value->nilai_akhir);
				$listNilai[$i] = $value;
			}
			return $listNilai;

		}

		public function getNamaMataKuliahByKodeMk($kode_mk)
    {
			
			$this->db->select('nama'); 
			$this->db->from('mst_mata_kuliah');
			$this->db->where('kode_mk', $kode_mk);
			return $this->db->get()->row();

    }
}
