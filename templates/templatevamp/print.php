<?php
// index.php
// include autoloader

require_once 'dev/application/libraries/dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

// initialize dompdf class

$document = new Dompdf();

$connect = mysqli_connect("localhost", "root", "", "transvision");

$query = "
	SELECT * FROM tbl_pemakaian 
	INNER JOIN tbl_permohonan ON tbl_permohonan.permohonan_id = tbl_pemakaian.id_permohonan
	INNER JOIN tbl_mobil ON tbl_mobil.mobil_id = tbl_pemakaian.id_mobil
	INNER JOIN tbl_user ON tbl_user.user_id = tbl_permohonan.id_user
	WHERE pemakaian_id = $id
";

$result = mysqli_query($connect, $query);

$output = '
<style>
	table {
	    font-family: arial, sans-serif;
	    border-collapse: collapse;
	    table-layout: fixed;
	    width: 100%;
	}

	td {
	    border: 0px solid black;
	    font-size: 12px;
	}
</style>
<table>
	<tr>
		<td colspan="7" rowspan="5"><img src="logo.png" alt="Logo Transvision" style="width:250px;"></td>
		<td colspan="5" align="right"><b>Gedung TRANSVISION</b></td>
	</tr>
	<tr>
		<td colspan="5" align="right" style="font-size: 8px;">Jl. Kapten Tendean No. 88C</td>
	</tr>
	<tr>
		<td colspan="5" align="right" style="font-size: 8px;">Mampang Prapatan - Jakarta 12710</td>
	</tr>
	<tr>
		<td colspan="5" align="right" style="font-size: 8px;">T : +62 21 2912 2080 | F : +62 21 2912 2081</td>
	</tr>
	<tr>
		<td colspan="5" align="right" style="font-size: 8px;">www.transvision.co.id</td>
	</tr>
	<tr>
		<td colspan="12" align="center" style="padding-top: 12px; font-size: 13px;"><b>PERMOHONAN PEMAKAIAN KENDARAAN BERMOTOR (KBM)</b></td>
	</tr>
	<tr>
		<td colspan="12" align="center" style="font-size: 13px; padding-bottom: 6px; border-bottom: solid"><b>UNTUK KEPERLUAN DINAS<b></td>
	</tr>
';

while($row = mysqli_fetch_array($result))
{
	$output .= '
		<tr>
			<td colspan="3" style="padding-top: 12px;">Nama</td>
			<td colspan="4" style="padding-top: 12px;">: '.$row["username"].'</td>
			<td colspan="2" style="padding-top: 12px;">Jabatan : .......</td>
			<td colspan="3" align="right" style="padding-top: 12px;">..................................</td>
		</tr>
		<tr>
			<td colspan="3">Divisi</td>
			<td colspan="4">: ...........................................</td>
			<td colspan="2">Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: .......</td>
			<td colspan="3">..................................</td>
		</tr>
		<tr>
			<td colspan="3">Tujuan</td>
			<td colspan="9">: '.$row["tujuan"].'</td>
		</tr>
		<tr>
			<td colspan="3">Keperluan</td>
			<td colspan="9">: '.$row["keperluan"].'</td>
		</tr>
		<tr>
			<td colspan="3">Jumlah Penumpang</td>
			<td colspan="9">: '.$row["jum_penumpang"].'</td>
		</tr>
		<tr>
			<td colspan="3">Tanggal Pemakaian</td>
			<td colspan="9">: '.$row["tgl_pemakaian"].'</td>
		</tr>
		<tr>
			<td colspan="3">Lama Pemakaian</td>
			<td colspan="5">: '.$row["lama_pemakaian"].'</td>
			<td colspan="2">Jam/Hari : .....</td>
			<td colspan="2">......................</td>
		</tr>
		<tr>
			<td colspan="3">Dasar Pemakaian</td>
			<td colspan="9">: '.$row["dasar_pemakaian"].'</td>
		</tr>
		<tr>
			<td colspan="8"></td>
			<td colspan="4" style="padding-top: 6px;">.............. , ............................</td>
		</tr>
		<tr align="center">
			<td colspan="4" style="padding-top: 6px;">Menyetujui,</td>
			<td colspan="4" style="padding-top: 6px;">Mengetahui,</td>
			<td colspan="4" style="padding-top: 6px;">Pemohon,</td>
		</tr>
		<tr align="center">
			<td colspan="4" style="padding-top: 24px;">..................................</td>
			<td colspan="4" style="padding-top: 24px;">..................................</td>
			<td colspan="4" style="padding-top: 24px;">..................................</td>
		</tr>
		<tr align="center">
			<td colspan="4" style="font-size: 10px;">Mgr. Logistik/GA</td>
			<td colspan="4" style="font-size: 10px;">Atasan Pemohon</td>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td colspan="12" align="center" style="font-size: 13px; padding-top: 10px"><b>PERINTAH JALAN</b></td>
		</tr>
		<tr>
			<td colspan="12" align="center" style="padding-bottom: 10px">(Diisi Petugas / Koordinator KBM)</td>
		</tr>
		<tr>
			<td colspan="3">Jenis KBM</td>
			<td colspan="3">: .............................</td>
			<td colspan="3">No. Polisi</td>
			<td colspan="3">: '.$row["nopol"].'</td>
		</tr>
		<tr>
			<td colspan="3">Pengemudi</td>
			<td colspan="3">: '.$row["username"].'</td>
			<td colspan="3">NIK</td>
			<td colspan="3">: ................................</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">Jumlah BBM</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">: .............................</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">Litter/Rp</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">: ................................</td>
		</tr>
		<tr align="center">
			<td colspan="6" style="padding-top: 12px; padding-bottom: 12px;">Waktu :</td>
			<td colspan="6" style="padding-top: 12px; padding-bottom: 12px;">Standard Kilometer :</td>
		</tr>
		<tr>
			<td colspan="3">Berangkat Jam</td>
			<td colspan="3">: '.$row["berangkat"].'</td>
			<td colspan="3">Berangkat</td>
			<td colspan="3">: '.$row["km_awal"].'</td>
		</tr>
		<tr>
			<td colspan="3">Kembali Jam</td>
			<td colspan="3">: '.$row["kembali"].'</td>
			<td colspan="3">Kembali</td>
			<td colspan="3">: '.$row["km_akhir"].'</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">Lama Pemakaian</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">: .............................</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">KM yang ditempuh</td>
			<td colspan="3" style="padding-bottom: 12px; border-bottom: solid;">: '.($row["km_akhir"]-$row["km_awal"]).'</td>
		</tr>
		<tr>
			<td colspan="8" style="padding-top: 10px;"></td>
			<td colspan="4" style="padding-top: 10px;">................. , .........................</td>
		</tr>
		<tr>
			<td colspan="8" style="padding-top: 6px;"></td>
			<td colspan="4" align="center" style="padding-top: 6px;">Petugas/Koordinator KBM</td>
		</tr>
		<tr>
			<td colspan="12" style="font-size: 10px;"><b>Keterangan:</b></td>
		</tr>
		<tr>
			<td colspan="12" style="font-size: 10px;">Setelah kembali dari perjalanan, Pengemudi</td>
		</tr>
		<tr>
			<td colspan="12" style="font-size: 10px;">wajib mengisi data waktu dan data standar KM</td>
		</tr>
		<tr>
			<td colspan="8" style="font-size: 10px;">dan data diserahkan kepada Koordinator KBM.</td>
			<td colspan="4" align="center">(.......................................)</td>
		</tr>
	';
}

$output .= '</table>';

$document->loadHtml($output);

// set page size and orientation
$document->setPaper('A5', 'portrait');

// Render the HTML as PDF
$document->render();

// Get output of generated pdf in Browser
$document->stream("Transvision", array("Attachment" => 0));
// 1 = Download
// 0 = Preview

?>