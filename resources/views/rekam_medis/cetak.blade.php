<!DOCTYPE html>
<html>
<head>
  <style>
    /* @page { margin: 180px 60px 190px 60px; } */
    @page :first {  margin: 50px 60px 190px 60px;}
    #footer { position: fixed; left: 0px; bottom: -10px; right: 0px; height: 10px; }

    p{
      font-size: 13px;
    }

    .tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0lax{text-align:left;vertical-align:top}
  </style>

  <?php
  function tanggal_indo($tanggal, $cetak_hari = false)
  {
  	$hari = array ( 1 =>    'Senin',
  				'Selasa',
  				'Rabu',
  				'Kamis',
  				'Jumat',
  				'Sabtu',
  				'Minggu'
  			);

  	$bulan = array (1 =>   'Januari',
  				'Februari',
  				'Maret',
  				'April',
  				'Mei',
  				'Juni',
  				'Juli',
  				'Agustus',
  				'September',
  				'Oktober',
  				'November',
  				'Desember'
  			);
  	$split 	  = explode('-', $tanggal);
  	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

  	if ($cetak_hari) {
  		$num = date('N', strtotime($tanggal));
  		return $hari[$num] . ', ' . $tgl_indo;
  	}
  	return $tgl_indo;
  }
  ?>

  <table style="width:100%; font-size:15px;">
      <tr>
        <td width=" 15%"><img src="{{url('images/logo.png')}}" style="width:70px;" alt=""></td>
        <td width=" 2%"></td>
        <td width=" 60%"><center><b>KLINIK UTAMA<br>ASRI MEDICAL CENTER<br>YOGYAKARTA</td>
        <td width=" 2%"></td>
        <td width=" 15%"></td>
      </tr>
    </table>
</head>
<body>

<hr style="border:2px solid #000;">
  <table style="width:100%; font-size:15px;">
      <tr>
        <td width=" 15%"></td>
        <td width=" 70%"><center><b>
          BERKAS REKAM MEDIS
        </td>
        <td width=" 15%"></td>
      </tr>
    </table>

  <br><br>
  <table  style="width:100%; font-size:12px;">
    <tr>
      <td style="width:15%;">Nama Pasien</td><td style="width:1%;">:</td>
      <td style="width:34%;"><b>{{$data_pasien->Nama}}</b></td>
      <td style="width:15%;">Nomor Rekam Medis</td><td style="width:1%;">:</td>
      <td style="width:34%;"><b>{{$data_pasien->Kode_Pasien}}</b></td>
    </tr>
    <tr>
      <td>Nomor Perawatan</td><td>:</td>
      <td><b>{{$data_pasien->No_Perawatan}}</b></td>
      <td>Nama Dokter</td><td>:</td>
      <td><b>{{$data_pasien->Full_Name}}</b></td>
    </tr>
    <tr>
      <td>Waktu Pemeriksaan</td><td>:</td>
      <td><b>{{$data_pasien->Waktu_Pemeriksaan}}</b></td>
      <td>&nbsp;</td><td></td>
      <td>     </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td><td> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td><td>     </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td><td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <br>
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
    <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">1. Hasil Pemeriksaan</div>
    <tr>
      <th><center>No</center></th>
      <th><center>Indikator Pemeriksaan</center></th>
      <th><center>Hasil Pemeriksaan</center></th>
    </tr>

<?php 
$no =1;
foreach($IndikatorPemeriksaan as $indi){?>  

    <tr>
      <td style="text-align:center;">{{$no++}}</td>
      <td>{{$indi->Indikator_Pemeriksaan}}</td>
      <td>
        <?php if($indi->Nilai == null){?>
        {{$indi->Indikator_Nilai}}
        <?php }else{ ?>
          {{$indi->Nilai}}
        <?php } ?>
      </td>
    </tr>
<?php } ?> 
  </table>
    <br>
    
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
  <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">2. Diagnosa Penyakit</div>

    <tr>
      <th><center>No</center></th>
      <th><center>Kode Diagnosa</center></th>
      <th><center>Nama Penyakit</center></th>
      <th><center>Ciri Penyakit</center></th>
    </tr>

    <?php
    $no = 1;
      foreach($Diagnosa as $diag){
    ?>

    <tr>
      <td>{{$no++}}</td>
      <td>{{$diag->Kode_Diagnosa}}</td>
      <td>{{$diag->Nama_Penyakit}}</td>
      <td>{{$diag->Ciri_Penyakit}}</td>
    </tr>
      <?php } ?>
  </table>
    <br>
    
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
  <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">3. Prosedur</div>

    <tr>
      <th><center>No</center></th>
      <th><center>Kode Prosedur</center></th>
      <th><center>Deskripsi Panjang</center></th>
      <th><center>Deskripsi Pendek</center></th>
    </tr>

    <?php
    $no = 1;
      foreach($detail_prosedur as $pro){
    ?>

    <tr>
      <td>{{$no++}}</td>
      <td>{{$pro->Kode_Prosedur}}</td>
      <td>{{$pro->Deskripsi_Panjang}}</td>
      <td>{{$pro->Deskripsi_Pendek}}</td>
    </tr>
      <?php } ?>
  </table>
    <br>
    
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
  <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">4. Terapi</div>

    <tr>
      <th><center>No</center></th>
      <th><center>Kode Obat</center></th>
      <th><center>Nama Obat</center></th>
      <th><center>Dosis</center></th>
      <th><center>Jumlah_Obat</center></th>
    </tr>

    <?php
    $no = 1;
      foreach($DetailTerapi as $ter){
    ?>

    <tr>
      <td>{{$no++}}</td>
      <td>{{$ter->Kode_Obat}}</td>
      <td>{{$ter->Nama_Obat}}</td>
      <td>{{$ter->Dosis}}</td>
      <td>{{$ter->Jumlah_Obat}}</td>
    </tr>
      <?php } ?>
  </table>
    <br>
    
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
  <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">5. Obat</div>

    <tr>
      <th><center>No</center></th>
      <th><center>Kode Obat</center></th>
      <th><center>Nama Obat</center></th>
      <th><center>No Resep</center></th>
      <th><center>Dosis</center></th>
      <th><center>Jumlah_Obat</center></th>
      <th><center>Aturan Pakai</center></th>
    </tr>

    <?php
    $no = 1;
      foreach($DetailResep as $res){
    ?>

    <tr>
      <td>{{$no++}}</td>
      <td>{{$res->Kode_Obat}}</td>
      <td>{{$res->Nama_Obat}}</td>
      <td>{{$res->No_Resep}}</td>
      <td>{{$res->Dosis}}</td>
      <td>{{$res->Jumlah}}</td>
      <td>{{$res->Aturan_Pakai}}</td>
    </tr>
      <?php } ?>
  </table>
    <br>
    
  <table border="1px" style="border-collapse : collapse; width:100%; font-size:13px;">
  <div style="text-align:left;font-size:14px;font-weight:bold;margin-bottom:10px;text-transform:uppercase;">6. Rujukan</div>

    <tr>
      <th><center>No</center></th>
      <th><center>Jenis Rujukan</center></th>
      <th><center>Tindakan Rujukan</center></th>
      <th><center>Dokter Perujuk</center></th>
      <th><center>Nama Poli</center></th>
    </tr>

    <?php
    $no = 1;
      foreach($DetailRujukan as $ruj){
    ?>

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
      <?php } ?>
  </table>
<br>
  <table border="1px" class="tg" style="border-collapse : collapse; width:100%; font-size:13px;">
  <tr>
      <th class="tg-0lax"><span style="font-weight:bold">RENCANA : </span>
      <ul>
      <?php foreach($DetailCatatan as $ren){ ?>
        <li{{$ren->Rencana}}</li>
      <?php } ?>
      </ul>
      <br><br><br><br>
      </th>
      <th class="tg-0lax"><span style="font-weight:bold">CATATAN : </span>
      <ul>
      <?php foreach($DetailCatatan as $ren){ ?>
        <li{{$ren->Catatan}}</li>
      <?php } ?>
      </ul>
      <br><br><br><br>
      </th>
    </tr>

  </table>
  <br>
  <table style="width:100%;">
    <tr>
      <td style="width:40%;">dadadad</td>
      <td style="width:20%;">
        <label for="" style="font-size:13px;">Yogyakarta, {{tanggal_indo(date('Y-m-d'), false)}}</label>
      </td>
    </tr>
  </table>
  <br>
  <table  style="width:100%; font-size:13px;">
    <tr>
      <td style="width:33%;">
        
      </td>
      <td style="width:33%;">
        
      </td>
      <td style="width:33%;">
        <div style="height:80px;"> Dokter </div>

        <hr style="width:80%; margin-left:0%;">
      </td>
    </tr>
    <tr>
      
      <td><label for=""></label></td>
      <td><label for=""></label></td>
      <td><label for="">{{$data_pasien->Full_Name}}</label></td>
    </tr>
  </table>
</body>
</html>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Data Rekam Medis</title>
  </head>
  <body>
    
    <br>

    <center><h4>BERKAS INI HARAP DIBERIKAN KEPADA PETUGAS</h4></center>
    <br>


  </body>
</html>
