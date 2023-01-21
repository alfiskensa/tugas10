<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    <body>
        <div style="text-align:Left">
            <h3><b>Laporan Nilai</b></h3>
        </div>
		<div style="text-align:Left">
            <h3> Kode MTK : <?php echo $kode_mk;?></h3>
        </div>
		<div style="text-align:Left">
            <h3> Matakuliah : <?php echo $nama_mtk;?></h3>
        </div>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
					<th>Nama</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
					<th>Nilai Akhir</th>
					<th>Grade</th>
                </tr>
            </thead>
            <tbody>
                
				<tr>
				<?php if(!empty($list_nilai)){
					for ($i = 0; $i <count($list_nilai); $i++) {
					$dataNilai = $list_nilai[$i];
					?>
					<td scope="row"> <?php echo ($i+1); ?> </td>
					<td > <?php echo $dataNilai->nim; ?> </td>
					<td > <?php echo $dataNilai->nama; ?> </td>
					<td > <?php echo $dataNilai->tugas; ?> </td>
					<td > <?php echo $dataNilai->uts; ?> </td>
					<td > <?php echo $dataNilai->uas; ?> </td>
					<td > <?php echo $dataNilai->nilai_akhir; ?> </td>
					<td > <?php echo $dataNilai->grade; ?> </td>

				</tr>
				<?php } 
				}else{?>
					</tr>
				<?php }
				?>
				
            </tbody>
        </table>

    </body>
</html>
