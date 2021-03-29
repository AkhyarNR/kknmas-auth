@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
<style>
    #my_camera{
     width: 240px;
     height: 160px;
     border: 1px solid black;
    }
    .bottomright {
      position: absolute;
      bottom: 8px;
      right: 16px;
    }
    div.k-edit-form-container {
        width: auto;
        height: auto;
    }
</style>
<script src="{{ asset('js') }}/webcam.min.js"></script>
<script language="JavaScript">
function newDate(date) {
    var d = new Date(date),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    
    return [year, month ,day].join(",");
}
function hitungUmur(Tanggal_Lahir){

    var date1 = new Date(Tanggal_Lahir);
    var date2 = new Date(Date.now());

    var miliday = 24 * 60 * 60 * 1000;

    var tglPertama = Date.parse(date1);
    var tglKedua = Date.parse(date2);
    var selisih = (tglKedua - tglPertama) / miliday;
    var tahun = Math.floor(selisih / 365);
    var sisaHari = (selisih % 365);
    var bulan = Math.floor(sisaHari / 30);
    var hari = Math.floor(sisaHari % 30);

    console.log(tahun + " tahun "+bulan+" bulan "+hari+" hari");
    return (tahun + " tahun "+bulan+" bulan "+hari+" hari");
}
</script>

<!-- Data Pasien IGD -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Pasien IGD</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="grid"></div>
            <script type="text/x-kendo-template" id="template">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Pasien
                        </li>
                    </ul>
                    <div>
                      <div class="DetailPasien">
                        <div class="row">
                          <div class="col-md-3" style="position: relative">
                            <div class="pasien-photo">
                              <img src="{{asset('/storage/photos')}}/#= Kode_Pasien #.jpeg" alt="No Image" style="width: 250px; height: 350px">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-20">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-3">No.RM Pasien </label>
                                                <p class="col-md-6 private-content">
                                                : # if (Kode_Pasien == null) {# - #} else {# #= Kode_Pasien # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nama Pasien</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama == null) {# - #} else {# #= Nama # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Jenis Kelamin</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Jenis_Kelamin == null) {# - #} else {# #= Jenis_Kelamin # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Golongan Darah</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Gol_Darah == null) {# - #} else {# #= Gol_Darah # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Cacat Fisik</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Jenis == null) {# - #} else {# #= Jenis # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Riwayat Alergi</label>
                                                <p class="col-md-6 private-content" id="listAlergi#= Kode_Pasien #">:   
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Tempat Lahir</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Tempat_Lahir == null) {# - #} else {# #= Tempat_Lahir # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Tanggal Lahir</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Tanggal_Lahir == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Lahir, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Tanggal Daftar</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Tanggal_Daftar == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Daftar, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Umur</label>
                                                <p class="col-md-6 private-content">
                                                : # if (hitungUmur(Tanggal_Lahir) == null) {# - #} else {# #= hitungUmur(Tanggal_Lahir) # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nama Ibu</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Ibu == null) {# - #} else {# #= Nama_Ibu # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">No Identitas
                                                (SIM/KTP/Pasport)</label>
                                                <p class="col-md-6 private-content">
                                                : # if (No_Ktp == null) {# - #} else {# #= No_Ktp # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">No Telp</label>
                                                <p class="col-md-6 private-content">
                                                : # if (No_HP == null) {# - #} else {# #= No_HP # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Kewarganegaraan</label>
                                                <p class="col-md-6 private-content">
                                                :  # if (Kewarganegaraan == null) {# - #} else {# #= Kewarganegaraan # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Alamat</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Alamat == null) {# - #} else {# #= Alamat # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Provinsi</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Provinsi == null) {# - #} else {# #= Nama_Provinsi # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Kabupaten</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Kabupaten == null) {# - #} else {# #= Nama_Kabupaten # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Kecamatan</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Kecamatan == null) {# - #} else {# #= Nama_Kecamatan # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Kelurahan</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Kelurahan == null) {# - #} else {# #= Kelurahan # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Status Nikah</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Status_Pernikahan == null) {# - #} else {# #= Status_Pernikahan # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Agama</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Agama == null) {# - #} else {# #= Agama # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pendidikan</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Pendidikan == null) {# - #} else {# #= Pendidikan # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pekerjaan</label>
                                                <p class="col-md-6">
                                                : # if (Pekerjaan == null) {# - #} else {# #= Pekerjaan # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Status Pasien</label>
                                                <p class="col-md-6">
                                                :  # if (Status == null) {# - #} else {# #= Status # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Asuransi</label>
                                                <p class="col-md-6" id="listAsuransi#= Kode_Pasien #">:
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nomor Asuransi</label>
                                                <p class="col-md-6">
                                                : # if (Nomer_Asuransi == null) {# - #} else {# #= Nomer_Asuransi # #} #
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-6">Suku/Bangsa</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Ras == null) {# - #} else {# #= Ras # #} #  
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Bahasa Dipakai</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Nama_Bahasa == null) {# - #} else {# #= Nama_Bahasa # #} #  
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Email</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Email == null) {# - #} else {# #= Email # #} #
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Penanggung Jawab</label>
                                                <p class="col-md-6 private-content"><strong>
                                                 # if (Nama_Penanggung_Jawab == null) {# - #} else {# #= Nama_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Pekerjaan</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Pekerjaan_Penanggung_Jawab == null) {# - #} else {# #= Pekerjaan_Penanggung_Jawab # #} #     
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">No_Hp</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (No_Hp == null) {# - #} else {# #= No_Hp # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Kewarganegaraan</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Kewarganegaraan_Penanggung_Jawab == null) {# - #} else {# #= Kewarganegaraan_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Alamat</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (alamat_Penanggung_Jawab == null) {# - #} else {# #= alamat_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Provinsi</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Provinsi_Penanggung_Jawab == null) {# - #} else {# #= Provinsi_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Kabupaten</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Kabupaten_Penanggung_Jawab == null) {# - #} else {# #= Kabupaten_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Kecamatan</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Kecamatan_Penanggung_Jawab == null) {# - #} else {# #= Kecamatan_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-6">Kelurahan</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (Kelurahan_Penanggung_Jawab == null) {# - #} else {# #= Kelurahan_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                </div>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/x-kendo-template" id="IgdTemplate">
     <div class="row">
        <div class="col-md-6">
            <div class="k-edit-label"><label for="Nama">Nama Pasien</label></div>
            <div data-container-for="Nama" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" data-bind="value:Nama" name="Nama" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Jenis_Kelamin_Id">Jenis Kelamin</label></div>
            <div data-container-for="Jenis_Kelamin_Id" class="k-edit-field">
                <input name="Jenis_Kelamin_Id" class="input-width-modal" data-bind="value:Jenis_Kelamin_Id" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Gol_Darah_Id">Golongan Darah</label></div>
            <div data-container-for="Gol_Darah_Id" class="k-edit-field">
                <input name="Gol_Darah_Id" class="input-width-modal" data-bind="value:Gol_Darah_Id" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Disabilitas_Id">Disabilitas</label></div>
            <div data-container-for="Disabilitas_Id" class="k-edit-field">
                <input name="Disabilitas_Id" class="input-width-modal" data-bind="value:Disabilitas_Id" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Alergi_Id">Riwayat Alergi</label></div>
            <div data-container-for="Alergi_Id" class="k-edit-field">
                <select name="Alergi_Id" data-bind="value:Alergi_Id" id="Alergi_Id" class="form-control" multiple="multiple" data-placeholder="Select Alergi"></select>
            </div>
            <div class="k-edit-label"><label for="Tempat_Lahir">Tempat Lahir</label></div>
            <div data-container-for="Tempat_Lahir" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" data-bind="value:Tempat_Lahir" name="Tempat_Lahir" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Tanggal_Lahir">Tanggal Lahir</label></div>
            <div data-container-for="Tanggal_Lahir" class="k-edit-field">
                <input name="Tanggal_Lahir" class="input-width-modal" data-bind="value:Tanggal_Lahir" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Tanggal_Daftar">Tanggal Daftar</label></div>
            <div data-container-for="Tanggal_Daftar" class="k-edit-field">
                <input name="Tanggal_Daftar" class="input-width-modal" data-bind="value:Tanggal_Daftar" required validationMessage="Field tidak boleh kosong">
            </div>
            <div class="k-edit-label"><label for="Umur">Umur</label></div>
            <div data-container-for="Umur" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Umur" data-bind="value:Umur" disabled>
                <span class="k-invalid-msg" data-for="Umur"></span>
            </div>
            <div class="k-edit-label"><label for="Nama_Ibu">Nama Ibu</label></div>
            <div data-container-for="Nama_Ibu" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Nama_Ibu" data-bind="value:Nama_Ibu" required validationMessage="Field tidak boleh kosong">
                <span class="k-invalid-msg" data-for="Nama_Ibu"></span>
            </div>
            <div class="k-edit-label"><label for="No_Ktp">No Identitas
            (SIM/KTP/Pasport)</label></div>
            <div data-container-for="No_Ktp" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="No_Ktp" data-bind="value:No_Ktp" required validationMessage="Field tidak boleh kosong">
                <span class="k-invalid-msg" data-for="No_Ktp"></span>
            </div>
            <div class="k-edit-label"><label for="No_HP">No. HP</label></div>
            <div data-container-for="No_HP" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="No_HP" data-bind="value:No_HP">
            </div>
            <div class="k-edit-label"><label for="Kewarganegaraan_Id">Kewarganegaraan</label></div>
            <div data-container-for="Kewarganegaraan_Id" class="k-edit-field">
                <input id="Kewarganegaraan_Id" name="Kewarganegaraan_Id" class="input-width-modal" data-bind="value:Kewarganegaraan_Id">
            </div>
            <div class="k-edit-label"><label for="Alamat">Alamat</label></div>
            <div data-container-for="Alamat" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Alamat" data-bind="value:Alamat">
            </div>
            <div class="k-edit-label"><label for="Provinsi_Id">Provinsi</label></div>
            <div data-container-for="Provinsi_Id" class="k-edit-field">
                <input id="Provinsi_Id" name="Provinsi_Id" class="input-width-modal" data-bind="value:Provinsi_Id">
            </div>
            <div class="k-edit-label"><label for="Kabupaten_Id">Kabupaten</label></div>
            <div data-container-for="Kabupaten_Id" class="k-edit-field">
                <input id="Kabupaten_Id" name="Kabupaten_Id" class="input-width-modal" data-bind="value:Kabupaten_Id">
            </div>
            <div class="k-edit-label"><label for="Kecamatan_Id">Kecamatan</label></div>
            <div data-container-for="Kecamatan_Id" class="k-edit-field">
                <input id="Kecamatan_Id" name="Kecamatan_Id" class="input-width-modal" data-bind="value:Kecamatan_Id">
            </div>
            <div class="k-edit-label"><label for="Kelurahan">Kelurahan</label></div>
            <div data-container-for="Kelurahan" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Kelurahan" data-bind="value:Kelurahan">
                <span class="k-invalid-msg" data-for="Kelurahan"></span>
            </div>
            <div class="k-edit-label"><label for="Status_Pernikahan_Id">Status Nikah</label></div>
            <div data-container-for="Status_Pernikahan_Id" class="k-edit-field">
                <input name="Status_Pernikahan_Id" class="input-width-modal" data-bind="value:Status_Pernikahan_Id">
            </div>
            <div class="k-edit-label"><label for="Agama_Id">Agama</label></div>
            <div data-container-for="Agama_Id" class="k-edit-field">
                <input name="Agama_Id" class="input-width-modal" data-bind="value:Agama_Id">
            </div>
            <div class="k-edit-label"><label for="Pendidikan_Id">Pendidikan</label></div>
            <div data-container-for="Pendidikan_Id" class="k-edit-field">
                <input name="Pendidikan_Id" class="input-width-modal" data-bind="value:Pendidikan_Id">
            </div>
            <div class="k-edit-label"><label for="Pekerjaan">Pekerjaan</label></div>
            <div data-container-for="Pekerjaan" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Pekerjaan" data-bind="value:Pekerjaan">
                <span class="k-invalid-msg" data-for="Pekerjaan"></span>
            </div>
            <div class="k-edit-label"><label for="Status_Id">Status Pasien</label></div>
            <div data-container-for="Status_Id" class="k-edit-field">
                <input name="Status_Id" class="input-width-modal" data-bind="value:Status_Id">
            </div>
            <div class="k-edit-label"><label for="Asuransi_Id">Asuransi</label></div>
            <div data-container-for="Asuransi_Id" class="k-edit-field">
                <select Name="Asuransi_Id" id="Asuransi_Id" data-bind="value:Asuransi_Id" class="form-control" multiple="multiple" data-placeholder="Select Asuransi"></select>
            </div>
            <div class="k-edit-label"><label for="Nomer_Asuransi">Nomor Asuransi</label></div>
            <div data-container-for="Nomer_Asuransi" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Nomer_Asuransi" data-bind="value:Nomer_Asuransi">
                <span class="k-invalid-msg" data-for="Nomer_Asuransi"></span>
            </div>
        </div>
        <div>
            <div class="k-edit-label"><label for="Email">Email</label></div>
            <div data-container-for="Email" class="k-edit-field">
                <input type="email" class="k-input k-textbox input-width-modal" name="Email" data-bind="value:Email" data-email-msg="Format email tidak valid">
            </div>
            <div class="k-edit-label"><label for="Bahasa_Pasien_Id">Bahasa Pasien</label></div>
            <div data-container-for="Bahasa_Pasien_Id" class="k-edit-field">
                <input name="Bahasa_Pasien_Id" class="input-width-modal" data-bind="value:Bahasa_Pasien_Id">
            </div>
            <div class="k-edit-label"><label for="Ras_Id">Ras</label></div>
            <div data-container-for="Ras_Id" class="k-edit-field">
                <input name="Ras_Id" class="input-width-modal" data-bind="value:Ras_Id">
            </div>
            <div class="k-edit-label"><label for="Nama_Penanggung_Jawab">Nama Penanggung Jawab</label></div>
            <div data-container-for="Nama_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Nama_Penanggung_Jawab" data-bind="value:Nama_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="Nama_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Keluarga_Id">Hubungan Dengan Pasien</label></div>
            <div data-container-for="Keluarga_Id" class="k-edit-field">
                <input name="Keluarga_Id" class="input-width-modal" data-bind="value:Keluarga_Id">
            </div>
            <div class="k-edit-label"><label for="No_Hp">No Hp</label></div>
            <div data-container-for="No_Hp" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="No_Hp" data-bind="value:No_Hp">
                <span class="k-invalid-msg" data-for="No_Hp"></span>
            </div>
            <div class="k-edit-label"><label for="Pekerjaan_Penanggung_Jawab">Pekerjaan</label></div>
            <div data-container-for="Pekerjaan_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Pekerjaan_Penanggung_Jawab" data-bind="value:Pekerjaan_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="Pekerjaan_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Alamat_Penanggung_Jawab">Alamat</label></div>
            <div data-container-for="Alamat_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Alamat_Penanggung_Jawab" data-bind="value:Alamat_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="Alamat_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Kewarganegaraan_Penanggung_Jawab">Kewarganegaraan</label></div>
            <div data-container-for="Kewarganegaraan_Penanggung_Jawab" class="k-edit-field">
                <input id="Kewarganegaraan_Penanggung_Jawab" name="Kewarganegaraan_Penanggung_Jawab" class="input-width-modal" data-bind="value:Kewarganegaraan_Penanggung_Jawab">
            </div>
            <div class="k-edit-label"><label for="Provinsi_Penanggung_Jawab">Provinsi</label></div>
            <div data-container-for="Provinsi_Penanggung_Jawab" class="k-edit-field">
                <input id="Provinsi_Penanggung_Jawab" name="Provinsi_Penanggung_Jawab" class="input-width-modal" data-bind="value:Provinsi_Penanggung_Jawab">
            </div>
            <div class="k-edit-label"><label for="Kabupaten_Penanggung_Jawab">Kabupaten</label></div>
            <div data-container-for="Kabupaten_Penanggung_Jawab" class="k-edit-field">
                <input id="Kabupaten_Penanggung_Jawab" name="Kabupaten_Penanggung_Jawab" class="input-width-modal" data-bind="value:Kabupaten_Penanggung_Jawab">
            </div>
            <div class="k-edit-label"><label for="Kecamatan_Penanggung_Jawab">Kecamatan</label></div>
            <div data-container-for="Kecamatan_Penanggung_Jawab" class="k-edit-field">
                <input id="Kecamatan_Penanggung_Jawab" name="Kecamatan_Penanggung_Jawab" class="input-width-modal" data-bind="value:Kecamatan_Penanggung_Jawab">
            </div>
            <div class="k-edit-label"><label for="Kelurahan_Penanggung_Jawab">Kelurahan</label></div>
            <div data-container-for="Kelurahan_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Kelurahan_Penanggung_Jawab" data-bind="value:Kelurahan_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="Kelurahan_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Shift_Id">Shift</label></div>
            <div data-container-for="Shift_Id" class="k-edit-field">
                <input id="Shift_Id" name="Shift_Id" class="input-width-modal" data-bind="value:Shift_Id">
            </div>
            <div class="k-edit-label"><label for="Employee_Id">Dokter</label></div>
            <div data-container-for="Employee_Id" class="k-edit-field">
                <input id="Employee_Id" name="Employee_Id" class="input-width-modal" data-bind="value:Employee_Id">
            </div>
            <div class="k-edit-label"><label for="Foto">Foto</label></div>
            <div data-container-for="Foto" class="k-edit-field">
                <div class="form-group" style="">
                    <div id="my_camera" class="rounded"></div>
                </div>
                <div class="form-group">
                    <a href="javascript:void(take_snapshot())" class="btn btn-primary">Ambil foto</a>
                    <input type="hidden" id="foto"  name="foto" value="" >
                </div>
                <div class="form-group">
                    <div id="my_result" ></div>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>

<script type="text/x-kendo-template" id="DetailTemplate">
    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>   
</script>

<div id="hapusDialog"></div>

<script>

  $(function(){
      var hapusDialog,
          cari = null;
      var dropdown = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
              options.data.dropdown = dropdown;
            $.ajax({
              url : '{{ url('pemeriksaan/igd/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
              }
            })
            
          },

          create : function(options) {
            options.data.foto = $('#foto').val();
            options.data.Tanggal_Lahir = (options.data.Tanggal_Lahir == null) ? "" : formatDate(options.data.Tanggal_Lahir);
            options.data.Tanggal_Daftar = (options.data.Tanggal_Daftar == null) ? "" : formatDate(options.data.Tanggal_Daftar);
            options.data.Jenis_Kelamin_Id = $('input[name="Jenis_Kelamin_Id"]').data('kendoDropDownList').value();
            options.data.Gol_Darah_Id = $('input[name="Gol_Darah_Id"]').data('kendoDropDownList').value();
            options.data.Status_Pernikahan_Id = $('input[name="Status_Pernikahan_Id"]').data('kendoDropDownList').value();
            options.data.Agama_Id = $('input[name="Agama_Id"]').data('kendoDropDownList').value();
            options.data.Pendidikan_Id = $('input[name="Pendidikan_Id"]').data('kendoDropDownList').value();
            options.data.Keluarga_Id = $('input[name="Keluarga_Id"]').data('kendoDropDownList').value();
            options.data.Bahasa_Pasien_Id = $('input[name="Bahasa_Pasien_Id"]').data('kendoDropDownList').value();
            options.data.Ras_Id = $('input[name="Ras_Id"]').data('kendoDropDownList').value();
            options.data.Alergi_Id = $('select[name="Alergi_Id"]').data('kendoMultiSelect').value();
            options.data.Status_Id = $('input[name="Status_Id"]').data('kendoDropDownList').value();
            options.data.Asuransi_Id = $('select[name="Asuransi_Id"]').data('kendoMultiSelect').value();
            options.data.Disabilitas_Id = $('input[name="Disabilitas_Id"]').data('kendoDropDownList').value();
            options.data.Provinsi_Id = $('input[name="Provinsi_Id"]').data('kendoDropDownList').value();
            options.data.Kabupaten_Id = $('input[name="Kabupaten_Id"]').data('kendoDropDownList').value();
            options.data.Kecamatan_Id = $('input[name="Kecamatan_Id"]').data('kendoDropDownList').value();
            options.data.Kewarganegaraan_Id = $('input[name="Kewarganegaraan_Id"]').data('kendoDropDownList').value();
            options.data.Provinsi_Penanggung_Jawab = $('input[name="Provinsi_Penanggung_Jawab"]').data('kendoDropDownList').value();
            options.data.Kabupaten_Penanggung_Jawab = $('input[name="Kabupaten_Penanggung_Jawab"]').data('kendoDropDownList').value();
            options.data.Kecamatan_Penanggung_Jawab = $('input[name="Kecamatan_Penanggung_Jawab"]').data('kendoDropDownList').value();
            options.data.Kewarganegaraan_Penanggung_Jawab = $('input[name="Kewarganegaraan_Penanggung_Jawab"]').data('kendoDropDownList').value();
            options.data.Shift_Id = $('input[name="Shift_Id"]').data('kendoDropDownList').value();
            options.data.Employee_Id = $('input[name="Employee_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('pemeriksaan/igd/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                if(res){
                  
                  options.success(res);
                  swal({
                           title: 'Success',
                           text: 'Berhasil Ditambahkan!!',
                           type: "success",
                           confirmButtonColor: "#2a3f53",
                           confirmButtonText: "Ok!",   
                       })
                }else{
                  swal({
                           title: 'Error',
                           text: 'Sudah Terisi!!',
                           type: "error",
                           confirmButtonColor: "#2a3f53",
                           confirmButtonText: "Pilih Ulang!",   
                       })
                }
                $('#grid').data('kendoGrid').dataSource.read();
              }
            }) 
          },

        },
        serverPaging: true,
        pageSize: 20,
        schema:{
          data:'data',
          total:'total',
          model:{
            id: 'Pasien_Rawat_Jalan_Id'
          }
        }
      },
      toolbar: kendo.template($("#toolbarTemplate").html()),

      columns:[
        {   field: 'No_Perawatan', 
            title: 'No Perawatan'
        },
        {   field: 'Nama', 
            title: 'Nama Pasien'
        },
        {   field: 'Full_Name', 
            title: 'Nama Dokter'
        },
        {   field: 'Status_Periksa', 
            title: 'Status Periksa'
        },
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:[   { iconClass: "k-icon k-i-track-changes-enable",
                      text: "Pra Pemeriksaan",
                      click: PraPeriksa,
                      visible: function(dataItem) { return dataItem.Status_Periksa === "Belum" }
                    },
                    { iconClass: "k-icon k-i-change-manually",
                      text: "Periksa",
                      click: Periksa,
                      visible: function(dataItem) { return dataItem.Status_Periksa === "Sedang Diproses" }
                    },
                    {
                      iconClass: "k-icon k-i-cancel-outline",
                      text: "Batalkan Pemeriksaan",
                      click: BatalkanPemeriksaan
                    },
                    
                ]
        }
      ],
      pageable: true,
      detailTemplate: kendo.template($("#template").html()),
      detailInit: detailInit,
      editable: {
        mode:"popup",
        template: $("#IgdTemplate").html(),
      },
      edit : function(e) {
        $(e.container).parent().css({
                    width: '800px'
                });
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.find("[name='Tanggal_Lahir']").kendoDatePicker({
                format: "dd-MM-yyyy"
            });
        e.container.find("[name='Tanggal_Daftar']").kendoDatePicker({
                format: "dd-MM-yyyy"
            });

        e.container.find("[name='Tanggal_Lahir']").change(function(){
            var tglLahir = kendo.toString(e.container.find("[name='Tanggal_Lahir']").val(), "MMddyyyy");
            var d1 =newDate(e.container.find("[name='Tanggal_Lahir']").data('kendoDatePicker').value());
            console.log(d1,e.container.find("[name='Tanggal_Lahir']").val());
             if(d1 != null || d2 != null){
                   date1 = new Date(d1.replace('"', ''));
                   date2 = new Date(Date.now());

                  var miliday = 24 * 60 * 60 * 1000;

                  var tglPertama = Date.parse(date1);
                  var tglKedua = Date.parse(date2);
                  var selisih = (tglKedua - tglPertama) / miliday;
                  var tahun = Math.floor(selisih / 365);
                    var sisaHari = (selisih % 365);
                    var bulan = Math.floor(sisaHari / 30);
                    var hari = Math.floor(sisaHari % 30);
                    e.container.find("[name='Umur']").val(tahun + " tahun "+bulan+" bulan "+hari+" hari");
             }
        });

        Webcam.set({
          width: 240,
          height: 180,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );

        e.container.parent().find('input[name="Jenis_Kelamin_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Jenis Kelamin-",
            dataTextField: "Jenis_Kelamin",
            dataValueField: "Jenis_Kelamin_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getJenis_Kelamin')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Provinsi_Id").kendoDropDownList({
            optionLabel: "-Pilih Provinsi-",
            dataTextField: "Nama_Provinsi",
            dataValueField: "Provinsi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getProvinsi')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Kabupaten_Id").kendoDropDownList({
            cascadeFrom: "Provinsi_Id",
            cascadeFromField: "Provinsi_Id",
            optionLabel: "-Pilih Kabupaten-",
            dataTextField: "Nama_Kabupaten",
            dataValueField: "Kabupaten_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKabupaten')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Kecamatan_Id").kendoDropDownList({
            cascadeFrom: "Kabupaten_Id",
            cascadeFromField: "Kabupaten_Id",
            optionLabel: "-Pilih Kecamatan-",
            dataTextField: "Nama_Kecamatan",
            dataValueField: "Kecamatan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKecamatan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Gol_Darah_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Golongan Darah-",
            dataTextField: "Gol_Darah",
            dataValueField: "Gol_Darah_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getGol_Darah')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Status_Pernikahan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Status-",
            dataTextField: "Status_Pernikahan",
            dataValueField: "Status_Pernikahan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getStatus_Pernikahan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Agama_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Agama-",
            dataTextField: "Agama",
            dataValueField: "Agama_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getAgama')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Kewarganegaraan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kewarganegaraan-",
            dataTextField: "Kewarganegaraan",
            dataValueField: "Kewarganegaraan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKewarganegaraan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Asuransi_Id").kendoMultiSelect({
            optionLabel: "-Pilih Asuransi-",
            dataTextField: "Nama_Asuransi",
            dataValueField: "Asuransi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getAsuransi')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Status_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Status-",
            dataTextField: "Status",
            dataValueField: "Status_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getStatus')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Ras_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Ras-",
            dataTextField: "Ras",
            dataValueField: "Ras_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getRas')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Alergi_Id").kendoMultiSelect({
            optionLabel: "-Pilih Alergi-",
            dataTextField: "Alergi",
            dataValueField: "Alergi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getAlergi')}}",
                        dataType: "json"
                    }
                }
            }
        })      

        e.container.parent().find('input[name="Keluarga_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Hubungan-",
            dataTextField: "Keluarga",
            dataValueField: "Keluarga_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKeluarga')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Pendidikan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Pendidikan-",
            dataTextField: "Pendidikan",
            dataValueField: "Pendidikan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPendidikan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Bahasa_Pasien_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Bahasa-",
            dataTextField: "Nama_Bahasa",
            dataValueField: "Bahasa_Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getBahasa')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Disabilitas_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Disabilitas-",
            dataTextField: "Jenis",
            dataValueField: "Disabilitas_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getDisabilitas')}}",
                        dataType: "json"
                    }
                }
            }
        })


        $("#Provinsi_Penanggung_Jawab").kendoDropDownList({
            optionLabel: "-Pilih Provinsi-",
            dataTextField: "Nama_Provinsi",
            dataValueField: "Provinsi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getProvinsi')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Kabupaten_Penanggung_Jawab").kendoDropDownList({
            cascadeFrom: "Provinsi_Penanggung_Jawab",
            cascadeFromField: "Provinsi_Id",
            optionLabel: "-Pilih Kabupaten-",
            dataTextField: "Nama_Kabupaten",
            dataValueField: "Kabupaten_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKabupaten')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Kecamatan_Penanggung_Jawab").kendoDropDownList({
            cascadeFrom: "Kabupaten_Penanggung_Jawab",
            cascadeFromField: "Kabupaten_Id",
            optionLabel: "-Pilih Kecamatan-",
            dataTextField: "Nama_Kecamatan",
            dataValueField: "Kecamatan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKecamatan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Kewarganegaraan_Penanggung_Jawab"]').kendoDropDownList({
            optionLabel: "-Pilih Kewarganegaraan-",
            dataTextField: "Kewarganegaraan",
            dataValueField: "Kewarganegaraan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKewarganegaraan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Shift_Id").kendoDropDownList({
            optionLabel: "-Pilih Shift-",
            dataTextField: "Shift_Name",
            dataValueField: "Shift_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getShiftIGD')}}",
                        dataType: "json"
                    }
                }
            }
        })

        $("#Employee_Id").kendoDropDownList({
            cascadeFrom: "Shift_Id",
            cascadeFromField: "Shift_Id",
            optionLabel: "-Pilih Dokter-",
            dataTextField: "Full_Name",
            dataValueField: "Employee_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getDokterIGD')}}",
                        dataType: "json"
                    }
                }
            }
        })
      }

    })

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
    })

    $('#dropdown').kendoDropDownList({
            optionLabel: "-Pilih Status Periksa-",
            dataTextField: "Status_Periksa",
            dataValueField: "Status_Periksa_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getStatusPeriksa')}}",
                        dataType: "json"
                    }
                }
            },
            change:function(e){
                dropdown = $('#dropdown').val();
                $('#grid').data('kendoGrid').dataSource.read();
            }
    })

  })

  function BatalkanPemeriksaan(e) {
        e.preventDefault();

        var tr = $(e.target).closest("tr"),
            data = this.dataItem(tr);

        hapusDialog = $("#hapusDialog").kendoDialog({
                    width: "350px",
                    title: "Batalkan Pemeriksaan",
                    visible: true,
                    content:"Apakah anda yakin ingin Membatalkan Pemeriksaan?",
                    buttonLayout: "stretched",
                    actions: [
                        {
                            text: "Hapus",
                            primary: true,
                            action: function (e) {
                                var id = {Pasien_Rawat_Jalan_Id: data.Pasien_Rawat_Jalan_Id};

                                $.ajax({
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                    },
                                    url: "{{ asset('pemeriksaan/igd/hapus') }}",
                                    type: "GET",
                                    data: id,
                                    dataType: "json",
                                    complete: function (e) {
                                        $("#grid").data("kendoGrid").dataSource.read();
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                            swal('Error!! '+xhr.status, thrownError, 'error');
                                    }
                                });
                            }
                        },
                        {text: "Batal"}
                    ]
        }).data("kendoDialog");
    }

    function PraPeriksa(e) {
    e.preventDefault();
        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        console.log(data)
        var id = {Antrian_Pasien_Id: data.Antrian_Pasien_Id, Pasien_Id : data.Pasien_Id, Work_Unit_Id : data.Work_Unit_Id,Dokter_Id : data.Dokter_Id, Shift_Id : data.Shift_Id, Pasien_Rawat_Jalan_Id : data.Pasien_Rawat_Jalan_Id};
        window.open('{{ url("pemeriksaan/poliigd/pra_igd") }}/'+data.Pasien_Rawat_Jalan_Id,'_self');

    }

  function Periksa(e) {
    e.preventDefault();
        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        console.log('e')
        console.log(data)
        var id = {Pemeriksaan_Id: data.Pemeriksaan_Id, Employee : data.Employee_Id, Pasien_Id : data.Pasien_Id, Pasien_Rawat_Jalan_Id : data.Pasien_Rawat_Jalan_Id};

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "{{ asset('pemeriksaan/igd/update') }}",
                type: "POST",
                data: id,
                dataType: "json",
                success : function(res){
                          window.open('{{ url("pemeriksaan/igd") }}/'+res,'_self');
                  }
              });
  }

  function take_snapshot() {
        Webcam.snap( function(data_uri, canvas, context) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            document.getElementById('foto').value = raw_image_data;
            console.log(raw_image_data);
        } );
  }

  function formatDate(date) {
    var d = new Date(date),
          month = "" + (d.getMonth() + 1),
          day = "" + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) month = "0" + month;
      if (day.length < 2) day = "0" + day;

      return [year, month, day].join("-");
  }

  function detailInit(e) {
      var detailRow = e.detailRow;
      var data = e.data;

      $.ajax({
              url : '{{ url('pemeriksaan/igd/alergipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : data.Pasien_Id},
              success:function(res){
                var stri = "";
                $.each(res , function(index, val) { 
                  stri = stri + "<li>"+val['Alergi']+"</li>"
                });
                $('#listAlergi'+data.Kode_Pasien).append(stri);
              }
            })

      $.ajax({
              url : '{{ url('pemeriksaan/igd/asuransipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : data.Pasien_Id},
              success:function(res){
                var stin = "";
                $.each(res , function(index, val) { 
                  stin = stin + "<li>"+val['Nama_Asuransi']+"</li>"
                });
                $('#listAsuransi'+data.Kode_Pasien).append(stin);
              }
            })

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });
  }

</script>

@endsection