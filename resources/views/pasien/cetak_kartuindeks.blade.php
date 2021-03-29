<!DOCTYPE html>
<html>
<head>
	<title>Kartu Indeks</title>
	    <style type="text/css">
        body {
            width: 100%;
            font-size: 12px;
        }
        table { 
            width: 100%;
        }
        tr, td {
            width: 100%;
        }
        #kiri
        {
        width:50%;
        height:100px;
        float:left;
        }
        #kanan
        {
        width:50%;
        height:100px;
        float:right;
        }
        #td
            {
            padding-top: 20px;
            }  
        </style>
</head>
    <body>
        <table id="kiri">
            <thead>
                <tr>
                    <td colspan="2" >
                        <div style="font-size: 20px"><strong>ASRI MEDICAL CENTER</strong></div>
                        <div>Jl. HOS Cokroaminoto 17 Yogyakarta</div>
                        <div>Telp. (0274)618400, fax (0274)618055</div>
                        <div>E-mail : asrimedicalcenter@gmail.com</div>
                        <div>www.asrimedicalcenter.com</div>
                    </td>
                    <td id="left"style="font-size: 15px;" colspan="2">
                        <strong>KARTU INDEKS UTAMA PASIEN</strong>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                    $getNama = $data->Nama;
                    $getUmur = $data->Umur;
                    $getJenis_Kelamin = $data->Jenis_Kelamin;
                    @endphp
                    <td id="td"><strong>NAMA</strong></td>
                    <td id="td"><strong>: {{$getNama}}</strong></td>
                    <td id="td"><strong>{{$getJenis_Kelamin}} UMUR : {{$getUmur}} Th </strong></td>
                </tr>
                <tr>
                    @php
                    $getAlamat = $data->Alamat
                    @endphp
                    <td><strong>ALAMAT</strong></td>
                    <td><strong>: {{$getAlamat}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getAgama = $data->agama;
                    $getPekerjaan = $data->Pekerjaan
                    @endphp
                    <td><strong>AGAMA</strong></td>
                    <td><strong>: {{$getAgama}}</strong></td>
                    <td><strong>PEKERJAAN</strong></td>
                    <td><strong>: {{$getPekerjaan}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getPendidikan = $data->pendidikan;
                    $getStatus_Pernikahan = $data->Status_Pernikahan
                    @endphp
                    <td><strong>PENDIDIKAN</strong></td>
                    <td><strong>: {{$getPendidikan}}</strong></td>
                    <td><strong>STATUS PERKAWINAN</strong></td>
                    <td><strong>: {{$getStatus_Pernikahan}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getNo_Ktp = $data->No_Ktp;
                    $getNo_HP = $data->No_HP
                    @endphp
                    <td><strong>NO.KTP</strong></td>
                    <td><strong>: {{$getNo_Ktp}}</strong></td>
                    <td><strong>NO.TELP</strong></td>
                    <td><strong>: {{$getNo_HP}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getGol_Darah = $data->Gol_Darah;
                    $getTanggal_Daftar = $data->Tanggal_Daftar
                    @endphp
                    <td><strong>GOL.DARAH</strong></td>
                    <td><strong>: {{$getGol_Darah}}</strong></td>
                    <td><strong>PERTAMA DAFTAR</strong></td>
                    <td><strong>: {{date('d-m-Y',strtotime($getTanggal_Daftar))}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getNama_Ibu = $data->Nama_Ibu
                    @endphp
                    <td><strong>IBU</strong></td>
                    <td><strong>: {{$getNama_Ibu}}</strong></td>
                </tr>
                <tr>
                    <td><strong>NO.RM</strong></td>
                    <td><strong>:</strong></td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="3">
                    @php
                    $tokenIn = $data->Kode_Pasien;
                    @endphp
                    <img style="display: block;" src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(125)->generate("$tokenIn")) !!}'></td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size: 20px;" colspan="3">
                    @php
                    $getKode_Pasien = $data->Kode_Pasien
                    @endphp
                    {{$getKode_Pasien}}
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="kanan">
            <tbody>
                <tr>
                    <td colspan="1">
                        <div style="font-size: 20px"><strong>ASRI MEDICAL CENTER</strong></div>
                        <div>Jl. HOS Cokroaminoto 17 Yogyakarta</div>
                        <div>Telp. (0274)618400, fax (0274)618055</div>
                        <div>E-mail : asrimedicalcenter@gmail.com</div>
                        <div>www.asrimedicalcenter.com</div>
                    </td>
                    <td align="right" colspan="2" style="font-size: 15px;"><strong>KARTU INDEKS UTAMA PASIEN</strong></td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size: 15px;"><strong> NOMOR RM : </strong></p>   
                    </td>
                    <td>
                        @php
                        $tokenIn = $data->Kode_Pasien;
                        @endphp
                        <img src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(125)->generate("$tokenIn")) !!}'>    
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="text-align: center; font-size: 20px;">
            @php
            $getKode_Pasien = $data->Kode_Pasien
            @endphp
            {{$getKode_Pasien}} 
        </div>
        <table style="border-collapse: collapse; border: 0px;border: 1px solid; padding-left: 50%">
            <tbody>
                <tr rowspan="2">
                    <td colspan="2" style="border: 1px solid;padding: 8px!important; text-align: center;">TANGGAL</td>
                    <td rowspan="2" style="border: 1px solid;border-bottom: none; padding: 8px!important; text-align: center; ">RUANG</td>
                    <td rowspan="2" style="border: 1px solid;border-bottom: none; padding: 8px!important; text-align: center;">DOKTER</td>
                    <td colspan="2" style="border: 1px solid;padding: 8px!important; text-align: center;">KODE</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important; text-align: center;">MASUK</td>
                    <td style="border: 1px solid;padding: 8px!important; text-align: center;">KELUAR</td>
                    <td style="border: 1px solid;padding: 8px!important; text-align: center;">ICD X</td>
                    <td style="border: 1px solid;padding: 8px!important; text-align: center;">ICOPIM</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                    <td style="border: 1px solid;padding: 8px!important;"></td>
                </tr>
            </tbody>
        </table>
        <div style="float: right;">
            Tulislah Dengan huruf Kapital
        </div>
    </body>
</html>