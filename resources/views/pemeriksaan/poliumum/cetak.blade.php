<!DOCTYPE html>
<html>
<head>
<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
 window.focus();
//  window.print();

</script>
</head>
<body>
<div id="print_antrian">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<head>
    <style>
        #header{
            text-align: center;
        }
        #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #2a3f53;
        color: white;
        }
    </style>

</head>
<body>

  <div id="header">
    <div style="font-size: 25px">ASRI MEDICAL CENTER</div>
    <div>Jl. HOS Cokroaminoto 17 Yogyakarta</div>
    <div>Telp. (0274)618400 | fax (0274)618055 | E-mail : asrimedicalcenter@gmail.com</div>
    <div style="border-bottom: 5px solid; "></div>
  </div>

  <br><div class="x_title"></div><br>
  <div id="content">

        <table  style="width:100%; font-size:14px;">
          <tr>
            <td>Nama Pasien</td>
            <td> : {{ $pemeriksaan->Nama}}</td>
            <td>Tgl Lahir</td>
            <td> : {{date('d F Y',strtotime($pemeriksaan->Tanggal_Lahir))}}</td>
          </tr>
          <tr>
            <td>Nomor RM</td>
            <td> : {{$pemeriksaan->Kode_Pasien}}</td>
            <td>Jenis Kelamin</td>
            <td> : {{$pemeriksaan->Jenis_Kelamin}}</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td> : {{$pemeriksaan->Alamat}},  {{$pemeriksaan->Kelurahan}},  {{$pemeriksaan->Nama_Kecamatan}},  {{$pemeriksaan->Nama_Kabupaten}},  {{$pemeriksaan->Nama_Provinsi}}</td>
            <td>Poli</td>
            <td> : {{$pemeriksaan->Work_Unit_Name}}</td>
          </tr>
        </table>
       <br>
       <br>
        <div>
            <div style="font-size: 20px; text-align: center">Hasil Pemeriksaan</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        Indikator Pemeriksaan
                    </th>
                    <th>
                        Nilai Indikator
                    </th>
                </tr>
                @foreach ($hasil as $item)
                <tr>
                    <td>
                        {{ $item->Indikator_Pemeriksaan}}
                    </td>
                    <td>
                    @if($item->Indikator_Nilai_Id == null)
                        {{ $item->nilai_hasil }} 
                    @else
                        {{ $item->nilai_indikator }}
                    @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <br>
        <br>
        <div>
            <div style="font-size: 20px; text-align: center">Hasil Diagnosa</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        Kode Diagnosa
                    </th>
                    <th>
                        Diagnosa
                    </th>
                    <th>
                        Ciri Penyakit
                    </th>
                </tr>
                @foreach ($diagnosa as $item)
                <tr>
                    <td>
                        {{ $item->Nama_Penyakit}}
                    </td>
                    <td>
                        {{ $item->Kode_Diagnosa}}
                    </td>
                    <td>
                        {{ $item->Ciri_Penyakit}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>


        <br>
        <br>
        <div>
            <div style="font-size: 20px; text-align: center">Hasil Prosedur</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        Kode Prosedur
                    </th>
                    <th>
                        Deskripsi Pendek
                    </th>
                    <th>
                        Deskripsi Panjang
                    </th>
                </tr>
                @foreach ($prosedur as $item)
                <tr>
                    <td>
                        {{ $item->Kode_Prosedur}}
                    </td>
                    <td>
                        {{ $item->Deskripsi_Panjang}}
                    </td>
                    <td>
                        {{ $item->Deskripsi_Pendek}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <br>
        <br>
        <div>
            <div style="font-size: 20px; text-align: center">Hasil Terapi</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        Kode Obat
                    </th>
                    <th>
                        Nama Obat
                    </th>
                    <th>
                        Dosis Obat
                    </th>
                    <th>
                        Jumlah Obat
                    </th>
                </tr>
                @foreach ($terapi as $ter)
                <tr>
                    <td>
                        {{ $ter->kd_terapi}}
                    </td>
                    <td>
                        {{ $ter->obat_terapi}}
                    </td>
                    <td>
                        {{ $ter->dosis_terapi}}
                    </td>
                    <td>
                        {{ $ter->Jumlah_Obat}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>


        <br>
        <br>
        <div>
            <div style="font-size: 20px; text-align: center">Resep Obat</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        No Resep
                    </th>
                    <th>
                        Kode Obat
                    </th>
                    <th>
                        Nama Obat
                    </th>
                    <th>
                        Dosis Obat
                    </th>
                    <th>
                        Jumlah Obat
                    </th>
                    <th>
                        Aturan Pakai
                    </th>
                </tr>
                @foreach ($resep as $res)
                <tr>
                    <td>
                        {{ $res->No_Resep}}
                    </td>
                    <td>
                        {{ $res->kd_resep}}
                    </td>
                    <td>
                        {{ $res->obat_resep}}
                    </td>
                    <td>
                        {{ $res->resep_dosis}}
                    </td>
                    <td>
                        {{ $res->Jumlah}}
                    </td>
                    <td>
                        {{ $res->Aturan_Pakai}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <br>
        <br>
        <div>
            <div style="font-size: 20px; text-align: center">Rujukan Pasien</div>
            <br>
            <table id="customers">
                <tr class="headings">
                    <th>
                        Kode Jenis Rujukan
                    </th>
                    <th>
                        Jenis Rujukan
                    </th>
                    <th>
                        Nama Tindakan
                    </th>
                    <th>
                        Nama Dokter Perujuk
                    </th>
                    <th>
                        Poliklinik Rujukan
                    </th>
                
                </tr>
                @foreach ($rujukan as $ruj)
                <tr>
                    <td>
                        {{ $ruj->Kode_Jenis_Rujukan}}
                    </td>
                    <td>
                        {{ $ruj->Jenis_Rujukan}}
                    </td>
                    <td>
                        {{ $ruj->Nama_Tindakan}}
                    </td>
                    <td>
                        {{ $ruj->Full_Name}}
                    </td>
                    <td>
                        {{ $ruj->Work_Unit_Name}}
                    </td>
                    
                </tr>
                @endforeach
            </table>
        </div>

    <br>
  </div>
</body>
</html>


</div>
</body>