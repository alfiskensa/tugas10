<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class CetakNilai extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		
		$this->load->model('nilaimodel');
	  }

	public function index()
	{
		$this->load->view('cetak_nilai');

		
	}

	public function generateFile(){

		$kode_mk = $this->input->post('kode_mk');
		$output = $this->input->post('output');
		
		if($output == 'xls'){
			$this->exportExcel();
		}else{
			$this->exportPDF();
		}
	}

	public function exportPDF(){
		
		$this->load->library('pdfgenerator');
				
		
		$this->data['title_pdf'] = 'Laporan Nilai Mahasiswa';


		$kode_mk = $this->input->post('kode_mk');



		$this->data['list_nilai'] = $this->nilaimodel->getDataNilai($kode_mk);
		$this->data['kode_mk'] = $kode_mk;
		// var_dump($this->nilaimodel->getNamaMataKuliahByKodeMk($kode_mk)->nama);
		$this->data['nama_mtk'] = $this->nilaimodel->getNamaMataKuliahByKodeMk($kode_mk)->nama;

		

		
		$file_pdf = 'Nilai Mahasiswa';
		
		$paper = 'A4';
		
		$orientation = "portrait";

		$html = $this->load->view('laporan_pdf',$this->data, true);
		

		
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}

	public function exportExcel(){
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		
		$style_col = [
		  'font' => ['bold' => true], 
		  'alignment' => [
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
		  ],
		  'borders' => [
			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
		  ]
		];
		
		$style_row = [
		  'alignment' => [
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
		  ],
		  'borders' => [
			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
		  ]
		];
		$sheet->setCellValue('A1', "DATA NILAI MAHASISWA");
		$sheet->mergeCells('A1:E1');
		$kode_mk = $this->input->post('kode_mk');
		$sheet->setCellValue('A2', "Kode MTK : ".$kode_mk);
		$sheet->mergeCells('A2:E2');
		$nama_mk = $this->nilaimodel->getNamaMataKuliahByKodeMk($kode_mk)->nama;
		$sheet->setCellValue('A3', "Matakuliah : ".$nama_mk);
		$sheet->mergeCells('A3:E3');
		
		$sheet->getStyle('A1')->getFont()->setBold(true);
		
		$sheet->setCellValue('A4', "No.");
		$sheet->setCellValue('B4', "NIM");
		$sheet->setCellValue('C4', "Nama");
		$sheet->setCellValue('D4', "Tugas");
		$sheet->setCellValue('E4', "UTS");
		$sheet->setCellValue('F4', "UAS");
		$sheet->setCellValue('G4', "Akhir");
		$sheet->setCellValue('H4', "Grade");
		
		$sheet->getStyle('A4')->applyFromArray($style_col);
		$sheet->getStyle('B4')->applyFromArray($style_col);
		$sheet->getStyle('C4')->applyFromArray($style_col);
		$sheet->getStyle('D4')->applyFromArray($style_col);
		$sheet->getStyle('E4')->applyFromArray($style_col);
		$sheet->getStyle('F4')->applyFromArray($style_col);
		$sheet->getStyle('G4')->applyFromArray($style_col);
		$sheet->getStyle('H4')->applyFromArray($style_col);

		
		

		$siswa = $this->nilaimodel->getDataNilai($kode_mk);
		// var_dump($siswa);
		// exit;
		$no = 1; 
		$numrow = 5; 
		if(!empty($data)){
			foreach($siswa as $data){ 
				$sheet->setCellValue('A'.$numrow, $no);
				$sheet->setCellValue('B'.$numrow, $data->nim);
				$sheet->setCellValue('C'.$numrow, $data->nama);
				$sheet->setCellValue('D'.$numrow, $data->tugas);
				$sheet->setCellValue('E'.$numrow, $data->uts);
				$sheet->setCellValue('F'.$numrow, $data->uas);
				$sheet->setCellValue('G'.$numrow, $data->nilai_akhir);
				$sheet->setCellValue('H'.$numrow, $data->grade);
				
				
				$sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
	  
				
				$no++; 
				$numrow++; 
			  }
		}
		
		
		$sheet->getColumnDimension('A')->setWidth(5); 
		$sheet->getColumnDimension('B')->setWidth(15); 
		$sheet->getColumnDimension('C')->setWidth(25); 
		$sheet->getColumnDimension('D')->setWidth(20); 
		$sheet->getColumnDimension('E')->setWidth(30); 
		$sheet->getColumnDimension('F')->setWidth(30);
		$sheet->getColumnDimension('G')->setWidth(30); 
		$sheet->getColumnDimension('H')->setWidth(30); 

		
		
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		
		$sheet->setTitle("Laporan Nilai");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Nilai Mahasiswa.xls"'); 
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	  }


	 
}
