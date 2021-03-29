<!DOCTYPE html>
<html>
<head>
	<title>Data Penjualan Obat/BHP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 12pt;
		}
	</style>
	<center>
		<h5>Data Penjualan Obat dan BHP RS Asri Medical Center Yogyakarta</h4>
		<br>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th style="text-align:center;">Kode</th>
				<th style="text-align:center;">Nama Obat/BHP</th>
				<th style="text-align:center;">Jenis Obat/BHP</th>
				<th style="text-align:center;">Jumlah Penjualan</th>
				<th style="text-align:center;">Jumlah Pendapatan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			?>
			@foreach($data as $item)
			<tr>
				<td>{{$item->Kode_Obat}}</td>
				<td>{{$item->Nama_Obat}}</td>
				<td>{{$item->Jenis_Obat}}</td>
				<td style="text-align:center;">{{$item->penjualanObat}}</td>
				<td style="text-align:right;">Rp. {{$item->pendapatanObat}}</td>
			</tr>
			<?php $total = $total+$item->pendapatanObat?>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" style="text-align:right;">Total</td>
				<td style="text-align:right;">Rp. {{$total}}</td>
			</tr>
		</tfoot>
	</table>

</body>
</html>