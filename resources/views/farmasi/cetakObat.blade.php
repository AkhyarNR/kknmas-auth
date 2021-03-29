<!DOCTYPE html>
<html>
<head>
	<title>Data Inventory Obat/BHP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Inventoy Obat dan BHP RS Asri Medical Center Yogyakarta</h4>
		<!-- <h6>Per </h5> -->
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th style="text-align:center;">Kode</th>
				<th style="text-align:center;">Nama Obat/BHP</th>
				<th style="text-align:center;">Jenis Obat/BHP</th>
				<th style="text-align:center;">Kategori Obat/BHP</th>
				<th style="text-align:center;">Golongan Obat/BHP</th>
				<th style="text-align:center;">Satuan Obat/BHP</th>
				<th style="text-align:center;">Harga</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
			<tr>
				<td>{{$item->Kode_Obat}}</td>
				<td>{{$item->Nama_Obat}}</td>
				<td>{{$item->Jenis_Obat}}</td>
				<td>{{$item->Kategori_Obat}}</td>
				<td>{{$item->Golongan_Obat}}</td>
				<td>{{$item->Satuan_Obat}}</td>
				<td style="text-align:right;">Rp. {{$item->Harga}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>