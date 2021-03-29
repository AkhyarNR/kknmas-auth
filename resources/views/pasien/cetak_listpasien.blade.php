<!DOCTYPE html>
<html>
<head>
	<title>List Data Pasien</title>
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
		<h5>Daftar Data Pasien RS Asri Medical Center Yogyakarta</h4>
		<!-- <h6>Per </h5> -->
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th style="text-align:center;">No RM</th>
				<th style="text-align:center;">Nama Pasien</th>
				<th style="text-align:center;">No KTP</th>
				<th style="text-align:center;">Alamat</th>
				<th style="text-align:center;">No HP</th>
				<th style="text-align:center;">TTL</th>
				<th style="text-align:center;">Jenis Kelamin</th>
				<th style="text-align:center;">Tanggal Daftar</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
			<tr>
				<td>{{$item->Kode_Pasien}}</td>
				<td>{{$item->Nama}}</td>
				<td>{{$item->No_Ktp}}</td>
				<td>{{$item->Alamat}}</td>
				<td>{{$item->No_HP}}</td>
				<td>{{$item->Tempat_Lahir}}, {{date('j F Y', strtotime($item->Tanggal_Lahir))}}</td>
				<td>{{$item->Jenis_Kelamin}}</td>
				<td>{{date('j F Y', strtotime($item->Tanggal_Daftar))}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>