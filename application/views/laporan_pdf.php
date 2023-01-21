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
        <div style="text-align:center">
            <h3> Laporan Nilai</h3>
        </div>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nilai Tugas</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td scope="row">1</td>
                    <td>Kacang Goreng</td>
                    <td>Rp5.000,-</td>
                    <td>1</td>
                    <td>25 Oktober 2020, 17:01:03</td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>Kopi Hitam</td>
                    <td>Rp5.000,-</td>
                    <td>1</td>
                    <td>25 Oktober 2020, 16:01:03</td>
                </tr>
                <tr>
                    <td scope="row">3</td>
                    <td>Gorengan Bakwan</td>
                    <td>Rp3.000,-</td>
                    <td>3</td>
                    <td>25 Oktober 2020, 15:01:02</td>
                </tr>
                <tr>
                    <td scope="row">4</td>
                    <td>Nasi uduk</td>
                    <td>Rp14.000,-</td>
                    <td>2</td>
                    <td>25 Oktober 2020, 14:04:03</td>
                </tr> -->
				<tr>
				<?php for ($i = 0; $i <count($list_nilai); $i++) {
					$dataNilai = $list_nilai[$i];
					?>
					<td scope="row"> <?php echo ($i+1); ?> </td>
					<td > <?php echo $dataNilai->nim; ?> </td>
					<td > <?php echo $dataNilai->tugas; ?> </td>
					<td > <?php echo $dataNilai->uts; ?> </td>
					<td > <?php echo $dataNilai->uas; ?> </td>
				</tr>
				<?php } ?>
				
            </tbody>
        </table>

    </body>
</html>
