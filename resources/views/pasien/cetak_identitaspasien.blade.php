<!DOCTYPE html>
<html>
<head>
	<title>Identitas Pasien</title>
		<style type="text/css">
                body {
                	width: 100%;
                    font-size: 12px;
                }
                table {
                	border-collapse: collapse; border: 0px;
                    width: 100%;
                    border: 1px solid;
                    font-size: 12px;
                }
                tr, td {
                	width: 100%;
                    border: 1px solid;
                    border-right: none; 
                    border-left: none;
                    padding: 8px!important;
                }
            	#right {
                	text-align: right;
	            }
	            #left {
	               text-align: left;
	            }
                .tgh {
                    text-align: center;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }

            }
        </style>
</head>
<body>
    <table width="100%" class="bordered" id="tbl">
        <tbody >
            <tr>
                <td id="left" colspan="0" ><img src="images/logo.png" width="100" height="100"></td>
                <td class="tgh" id="lbr" colspan="9">
                	<div style="font-size: 25px">ASRI MEDICAL CENTER</div>
                	<div>Jl. HOS Cokroaminoto 17 Yogyakarta</div>
                	<div>Telp. (0274)618400, fax (0274)618055</div>
                	<div>E-mail : asrimedicalcenter@gmail.com</div>
                	<div>www.asrimedicalcenter.com</div>
                </td>
                <td id="right">
                	@php
                	$tokenIn = $data->Kode_Pasien;
              		@endphp
              	<img src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(125)->generate("$tokenIn")) !!}'></td>
            </tr>
            <tr>
            	<td class="tgh" id="lbr" colspan="11">IDENTITAS PASIEN</td>
            </tr>
            <tr>
                <td id="left"style="font-size: 20px"><strong>NOMOR REKAM MEDIK</strong></td>
                @php
            	$getKode_Pasien = $data->Kode_Pasien
            	@endphp
                <td class="tgh" id="lbr" style="border-left: 1px solid #444; font-size: 25px" colspan="9"><b>{{$getKode_Pasien}}</b></td>
                <td id="left" colspan="1"></td>
            </tr>
            <tr>
                <td id="left"><strong>NAMA PASIEN</strong></td>
                @php
            	$getNama = $data->Nama;
            	$getNamaIBU = $data->Nama_Ibu
            	@endphp
                <td id="left" colspan="8">: {{$getNama}}</td>
                <td id="left" colspan="2"><strong>NAMA IBU</strong> : {{$getNamaIBU}} </td>
            </tr>
            <tr>
            	@php
            	$getNo_KTP = $data->No_Ktp;
            	$getUmur = $data->Umur
            	@endphp
                <td id="left"><strong>NO Identitas (KTP/SIM/Paspor)</strong></td>
                <td id="left" colspan="9">: {{$getNo_KTP}} </td>
                <td id="left" colspan="1"><strong>Umur</strong>: {{$getUmur}}</td>
            </tr>
            <tr>
            	@php
            	$getTgl_Lahir = $data->Tanggal_Lahir;
            	$getAgama = $data->agama
            	@endphp
                <td id="left"><strong>Agama</strong></td>
                <td id="left" colspan="9" style="border-right: 1px solid #444;">: {{$getAgama}} </td>
                <td id="left" colspan="1"><strong>Tanggal Lahir</strong> : {{date('d-m-Y',strtotime($getTgl_Lahir))}}</td>
            </tr>
            <tr>
            	@php
            	$getStatus_Pernikahan = $data->Status_Pernikahan;
            	$getJenis_Kelamin = $data->Jenis_Kelamin
            	@endphp
                <td id="left"><strong>Status</strong></td>
                <td id="left" colspan="9" style="border-right: 1px solid #444;">: {{$getStatus_Pernikahan}} </td>
                <td id="left" colspan="1"><strong>Jenis Kelamin</strong> : {{$getJenis_Kelamin}}</td>
            </tr>
            <tr>
            	@php
            	$getPekerjaan = $data->Pekerjaan;
            	$getPendidikan = $data->pendidikan
            	@endphp
                <td id="left"><strong>Pekerjaan</strong></td>
                <td id="left" colspan="9" style="border-right: 1px solid #444;">: {{$getPekerjaan}} </td>
                <td id="left" colspan="1" ><strong>Pendidikan</strong> : {{$getPendidikan}} </td>
            </tr>
            <tr>
            	@php
            	$getAlamat = $data->Alamat
            	@endphp
                <td id="left"><strong>Alamat</strong></td>
                <td id="left" colspan="10">: {{$getAlamat}}</td>
            </tr>
            <tr>
            	@php
            	$getNama_Keluarga = $data->Nama_Keluarga;
            	$getKeluarga = $data->Keluarga
            	@endphp
                <td id="left"><strong>Nama Keluarga</strong></td>
                <td id="left" colspan="8">: {{$getNama_Keluarga}}</td>
                <td id="left" colspan="2" ><strong>Hubungan Keluarga</strong> : {{$getKeluarga}}</td>
            </tr>
            <tr>
                <td id="left"><strong>Pekerjaan</strong></td>
                <td id="left" colspan="10">: </td>
            </tr>
            <tr>
                <td id="left"><strong>Alamat</strong></td>
                <td id="left" colspan="10">: </td>
            </tr>
            <tr>
                <td id="left" style="border-right: 1px solid #444;" rowspan="3"><strong>Bila Ada Sesuatu Menghubungi</strong></td>
                <td id="left" colspan="10"><strong>Nama</strong>    :</td>
            </tr>
            <tr>
            	<td id="left" colspan="10"><strong>Alamat</strong> :</td>
            </tr>
            <tr>
            	<td id="left" colspan="10"><strong>No Telp (Rumah/HP)</strong> :</td>
            </tr>
            <tr>
                <td id="left" colspan="11"><strong>*)Lingkari Yang Sesuai</strong></td>
            </tr>
        </tbody>
        </table>
</body>
</html>