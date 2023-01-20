<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<body>

<div id="container">
<html>
<style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        table td.tbl_header {
            font-weight: bolder;
            text-align: center;
        }
    </style>
<h1>Cetak Laporan Nilai</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table>
			<tr>
				<td>Matakuliah</td>
				<td>
                <select name="kode_mk">
                                        <option value="TA002">
                        TA002 - Metodologi Penelitian                    </option>
                                        <option value="TI006">
                        TI006 - Kecerdasam Tiruan                    </option>
                                        <option value="TI011">
                        TI011 - Komputasi Bergerak Dan Teknologi Web                    </option>
                                        <option value="TI016">
                        TI016 - Kecerdasan Komputasional Dan Pembelajaran Mesin                    </option>
                                    </select>
            </td>
			</tr>
			<tr>
			<td>Output</td>
				<td>
					<input type="radio" id="output1" name="output" value="pdf">
					<label for="output1">PDF</label>
					<input type="radio" id="output2" name="output" value="xls">
					<label for="output2">XLS</label>
				</td></tr>
			<tr>
            <td><input type="submit" name="cetak" value="Cetak"></input></td>
        	</tr>
		</table>
</form>

</div>

</body>
</html>
