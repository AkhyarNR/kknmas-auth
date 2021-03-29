<!DOCTYPE html>
<html>
<head>
  <title>Kartu Pasien</title>
  <style type="text/css">
  #QrCode{position: absolute;top: 15px; right: 0px}
  #footer{position: absolute;bottom: 0px;}
  #body{position: absolute;}
  #ketentuan_footer{position: absolute;bottom: 0px; text-align: center;}
  #ketentuan_header{position: absolute;top: 0px; text-align: center;}
  </style>
</head>
<body>
      <div class="card">
          <div align="right" style="padding-right: 25px">
            @php
            $getKode_Pasien = $data->Kode_Pasien
            @endphp
            {{$getKode_Pasien}}
          </div>
          <div class="card-body text-success" id="QrCode">
              @php
                $tokenIn = $data->Kode_Pasien
              @endphp
              <img src='data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(100)->generate("$tokenIn")) !!}'>
          </div>
          <div class="card-footer" id="footer"><b>
            @php
            $getNama = $data->Nama
            @endphp
            <div style="font-size: 15px">{{$getNama}}</div>
            @php
            $getTanggal_Lahir = $data->Tanggal_Lahir;
            $getJenis_Kelamin = $data->Jenis_Kelamin
            @endphp
            <div style="font-size: 15px">{{date('j F Y', strtotime($getTanggal_Lahir))}}, {{$getJenis_Kelamin}}</div>
            @php
            $getAlamat = $data->Alamat
            @endphp
            <div style="font-size: 15px">{{$getAlamat}}</div></b>
          </div> 
      </div>    
</body>
</html>
