<!DOCTYPE html>
<html>
<head>
    <title>Label RM</title>
        <style type="text/css">
        body {
            font-size: 15px;
        }
        table { 
            border: 1px solid;
        }
        tr, td {  
            width : 15%;
        } 
        </style>
</head>
    <body>
        <table style="border-collapse: collapse; border: 0px;">
            <tbody>
                <tr>
                    @php
                    $getNama = $data->Nama;
                    $getKode_Pasien = $data->Kode_Pasien
                    @endphp
                    <td colspan="2"><strong>{{$getNama}}</strong></td>
                    <td><strong>{{$getKode_Pasien}}</strong></td>
                </tr>
                <tr>
                    @php
                    $getTempat_Lahir = $data->Tempat_Lahir;
                    $getTanggal_Lahir = $data->Tanggal_Lahir;
                    $getUmur = $data->Umur;
                    $getJenis_Kelamin = $data->Jenis_Kelamin;
                    @endphp
                    <td colspan="2"><strong>{{$getTempat_Lahir}},{{$getTanggal_Lahir}}</strong></td>
                    <td colspan="2"><strong>{{$getJenis_Kelamin}} {{$getUmur}} Th</strong></td>
                </tr>
                <tr>
                    @php
                    $getAlamat = $data->Alamat
                    @endphp
                    <td><strong>{{$getAlamat}}</strong></td>
                </tr>
                <tr>
                    <td>
                        @php
                        $tokenIn = $data->Kode_Pasien;
                        @endphp
                        <img src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(100)->generate("$tokenIn")) !!}'>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>