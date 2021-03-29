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
    // console.log(date1)

    var miliday = 24 * 60 * 60 * 1000;

    var tglPertama = Date.parse(date1);
    var tglKedua = Date.parse(date2);
    var selisih = (tglKedua - tglPertama) / miliday;
    var tahun = Math.floor(selisih / 365);
    var sisaHari = (selisih % 365);
    var bulan = Math.floor(sisaHari / 30);
    var hari = Math.floor(sisaHari % 30);

    // console.log(tahun + " tahun "+bulan+" bulan "+hari+" hari");
    return (tahun + " tahun "+bulan+" bulan "+hari+" hari");
}
</script>

<!-- Data Kamar -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Pasien</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="grid"></div>
            <div id="details"></div>
            <script type="text/x-kendo-template" id="template">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Pasien
                        </li>
                        <!-- <li>
                            Rekam Medis
                        </li> -->
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
                                                <p class="col-md-6 private-content">
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
                      <div class="bottomright">
                        <button class="cetak k-button k-button-icontext cv-button mb-2" id="cetak" onClick="CetakPasien(#= Pasien_Id #)">
                          <span class="k-icon k-i-print"></span>Cetak Kartu Pasien
                        </button>
                        <button class="edit k-button k-button-icontext cv-button mb-2" id="edit">
                          <span class="k-icon k-i-edit"></span>Edit
                        </button>
                        <button class="delete k-button k-button-icontext cv-button mb-2" id="hapus">
                          <span class="k-icon k-i-delete"></span>Hapus
                        </button>
                      </div>
                    </div>
                    <div>
                        <div class="RekamMedis"></div>
                    </div>
                </div>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <a id="exportpdf" class="k-button k-button-icontext" href='{{asset("/cetak_listpasien")}}' target='_blank'><span class="k-icon k-i-file-pdf"></span>Export PDF</a>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>

<script type="text/x-kendo-template" id="DetailPopupTemplate">
    #if(data.isNew()) {#
        #var createTemp = kendo.template($("\#PasienTemplate").html());#
        #=createTemp(data)#
    #} else {#
        #var editTemp = kendo.template($("\#PasienEditTemplate").html());#
        #=editTemp(data)#
    #}#
</script>

<script type="text/x-kendo-template" id="PasienTemplate">
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

<script type="text/x-kendo-template" id="PasienEditTemplate">
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
                <select name="Alergi_Id" id="Alergi_Id" class="form-control" multiple="multiple" data-placeholder="Select Alergi"></select>
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
            <div class="k-edit-label"><label for="alamat_Penanggung_Jawab">Alamat</label></div>
            <div data-container-for="alamat_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="alamat_Penanggung_Jawab" data-bind="value:alamat_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="alamat_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Kewarganegaraan_Penanggung_Jawab">Kewarganegaraan</label></div>
            <div data-container-for="Kewarganegaraan_Penanggung_Jawab" class="k-edit-field">
                <input id="Kewarganegaraan_Penanggung_Jawab" name="Kewarganegaraan_Penanggung_Jawab" class="input-width-modal">
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
                <input id="Kecamatan_Penanggung_Jawab" name="Kecamatan_Penanggung_Jawab" class="input-width-modal">
            </div>
            <div class="k-edit-label"><label for="Kelurahan_Penanggung_Jawab">Kelurahan</label></div>
            <div data-container-for="Kelurahan_Penanggung_Jawab" class="k-edit-field">
                <input type="text" class="k-input k-textbox input-width-modal" name="Kelurahan_Penanggung_Jawab">
                <span class="k-invalid-msg" data-for="Kelurahan_Penanggung_Jawab"></span>
            </div>
            <div class="k-edit-label"><label for="Foto">Foto</label></div>
            <div data-container-for="" class="k-edit-field">
                <img src="{{asset('/storage/photos')}}/#= Kode_Pasien #.jpeg" alt="No Image" style="width: 240px; height: 160px">
            </div>
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

<div id="modalPoli" style="display: none;">
    <div id='tabstrip'>
      <ul>
        <li class='k-state-active'>Poliklinik</li>
        <li>Laboratorium</li>
        <li>Radiologi</li>
      </ul>
        
      <div>
        <p style="text-align: center;">Tambahkan <span id="namapasienmodal" style="font-weight:bold"></span> ke Pelayanan Poliklinik?</p>
        <div class="k-edit-label"><label for="Work_Unit_Id">Poliklinik :</label></div>
        <div data-container-for="Work_Unit_Id" class="k-edit-field" >
            <input name="Pasien_Id" style="margin-left:10px" type="hidden">
            <select name="Work_Unit_Id" id="Work_Unit_Id" style="text-align:center; width:165px; margin-left:10px;">
                <option value="">--Pilih Poliklinik--</option>
                @foreach($poli as $item)
                <option value="{{ $item->Work_Unit_Id }}">{{ $item->Work_Unit_Name }}</option>
                @endforeach
            </select>
        </div>
        <div class="k-edit-label"><label for="Shift_Id">Jadwal :</label></div>
        <div data-container-for="Shift_Id" class="k-edit-field" >
            <select name="Shift_Id" id="Shift_Id" style="text-align:center; width:165px; margin-left:10px;">
                <option selected value="">-- Pilih Jadwal --</option>
            </select>
        </div>
        <div class="k-edit-label"><label for="Employee_Id">Dokter :</label></div>
        <div data-container-for="Employee_Id" class="k-edit-field" >
            <select name="Employee_Id" id="Employee_Id" style="text-align:center; width:165px; margin-left:10px;">
                <option selected value="">-- Pilih Dokter --</option>
            </select>
        </div>
        <div class="col-md-6 col-sm-6 offset-md-5">
            <button class="k-button k-button-icontext" onclick="createPoli()">Ya</button>
            <button class="k-button k-button-icontext" id="closePoli">Tidak</button>
        </div>
      </div>
      <div>
        <p style="text-align: center;">Tambahkan <span id="PasienLaboratorium" style="font-weight:bold"></span> ke Pelayanan Laboratorium?</p>
        <input name="Pasien_Lab" style="margin-left:10px" type="hidden">
        <input name="Laboratorium" value="18" style="margin-left:10px" type="hidden">
        <div class="k-edit-label"><label for="Jenis_Pemeriksaan_Id">Laboratorium :</label></div>
        <div data-container-for="Jenis_Pemeriksaan_Id" class="k-edit-field" >
            <select name="Jenis_Pemeriksaan_Id" id="Jenis_Pemeriksaan_Id" style="margin-left:10px; width:200px;">
                <option selected value="">-- Pilih Laboratorium --</option>
                @foreach($lab as $item)
                <option value="{{ $item->Jenis_Pemeriksaan_Id }}">{{ $item->Jenis_Pemeriksaan }}</option>
                @endforeach
            </select>
        </div>
        <div class="k-edit-label"><label for="Prosedur_Medis_Biaya_Id">Tindakan Pemeriksaan :</label></div>
        <div data-container-for="Prosedur_Medis_Biaya_Id" class="k-edit-field">
            <select name="Prosedur_Medis_Biaya_Id" id="Prosedur_Medis_Biaya_Id" style="text-align:center; width:200px; margin-left:10px;">
                <option selected value="">-- Pilih Tindakan --</option>
            </select>
        </div>
        <div class="col-md-6 col-sm-6 offset-md-5">
            <button class="k-button k-button-icontext" onclick="createLab()">Ya</button>
            <button class="k-button k-button-icontext" id="closeLab">Tidak</button>
        </div>
      </div>
      <div>
        <p style="text-align: center;">Tambahkan <span id="PasienRadiologi" style="font-weight:bold"></span> ke Pelayanan Radiologi?</p>
        <div class="k-edit-label"><label for="Dokter_Id">Tindakan Perawatan :</label></div>
        <div data-container-for="Dokter_Id" class="k-edit-field" >
            <input name="Dokter_Id" style="margin-left:10px" id="Dokter_Id">
        </div>
        <div class="col-md-6 col-sm-6 offset-md-5">
            <button class="k-button k-button-icontext" onclick="createRadiologi()">Ya</button>
            <button class="k-button k-button-icontext" id="closeRad">Tidak</button>
        </div>
      </div>
    </div>
</div>

<div id="modalIGD" style="display: none;">
    <p style="text-align: center;">Tambahkan <span id="pasiennamamodal" style="font-weight:bold"></span> ke pemeriksaan IGD?</p>
    <input name="Pasien_IGD" style="margin-left:10px" type="hidden">
    <input name="Poli_IGD" value="16" style="margin-left:10px" type="hidden">
    <div class="k-edit-label"><label for="Shift_IGD">Jadwal :</label></div>
    <div data-container-for="Shift_IGD" class="k-edit-field" >
        <select name="Shift_IGD" id="Shift_IGD" style="text-align:center; width:165px;">
            <option selected value="">-- Pilih Jadwal --</option>
            @foreach($shift_igd as $item)
            <option value="{{ $item->Shift_Id }}">{{ $item->Shift_Name }}</option>
            @endforeach
        </select>
    </div>
    <div class="k-edit-label"><label for="Employee_IGD">Dokter :</label></div>
    <div data-container-for="Employee_IGD" class="k-edit-field" >
        <select name="Employee_IGD" id="Employee_IGD" style="text-align:center; width:165px;">
            <option selected value="">-- Pilih Dokter --</option>
        </select>
    </div>
    <div class="col-md-6 col-sm-6 offset-md-5">
    <button class="k-button k-button-icontext" id="closeIGD">Tidak</button>
    <button class="k-button k-button-icontext" onclick="createIGD()">Ya</button>
    </div>
</div>
<script>

  $(function(){

    $("#grid").on("click", ".edit", function(e){
        var row = $(e.target.closest('tr')).prev("tr");
        $("#grid").data("kendoGrid").editRow(row);
        // console.log([$('#grid tbody>tr:eq(0)'),row])
      });

    $("#grid").on("click", ".delete", function(e){
        var row = $(e.target.closest('tr')).prev("tr");
        $("#grid").data("kendoGrid").removeRow(row);
        // console.log([$('#grid tbody>tr:eq(0)'),row])
      });

    $("#exportpdf").on("click", function(e){
        window.open('{{asset("/cetak_listpasien")}}', '_blank');
    })

    var cari = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
            $.ajax({
              url : '{{ url('pasien/Pasien/read') }}',
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

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('pasien/Pasien/create') }}',
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

          update: function(options){
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
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('pasien/Pasien/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
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
          
          destroy: function(options){
            $.ajax({
              url : '{{ url('pasien/Pasien/hapus') }}',
              dataType:'json',
              type:'GET',
              data:options.data,
              success:function(res){
                options.success(res);
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
          }

        },
        serverPaging: true,
        pageSize: 10,
        schema:{
          data:'data',
          total:'total',
          model:{
            id: 'Pasien_Id'
          }
        }
      },
      toolbar: kendo.template($("#toolbarTemplate").html()),
      
      columns:[
        {field: 'Kode_Pasien', title: 'No RM',
                width: "100px"},
        {field: 'Nama', title: 'Nama',template:'#: data.Nama#',
                width: "300px"},
        {field: 'No_Ktp', title: 'No Ktp',template:'#: data.No_Ktp#',
                width: "200px"},
        {field: 'Jenis_Kelamin', title: 'Jenis Kelamin',
                width: "150px"},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:[   {
                      iconClass: "k-icon k-i-track-changes-enable",
                      text: "Daftarkan Pelayanan",
                      click: PendaftaranPoli
                    },
                    {
                      iconClass: "k-icon k-i-track-changes-enable",
                      text: "Daftarkan IGD",
                      click: PendaftaranIGD
                    },
                 ]}
      ],
      pageable: true,
      detailTemplate: kendo.template($("#template").html()),
      detailInit: detailInit,
      editable: {
        mode:"popup",
        template: $("#DetailPopupTemplate").html(),
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

        var asurans = [];

        $.ajax({
              url : '{{ url('pasien/Pasien/asuransipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : e.model.Pasien_Id},
              success:function(res){
                $.each(res, function(k, v) {
                    asurans.push(""+v['Asuransi_Id']+"");
                });
                $('#Asuransi_Id').data('kendoMultiSelect').value(asurans);
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

        var alergis = [];

        $.ajax({
              url : '{{ url('pasien/Pasien/alergipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : e.model.Pasien_Id},
              success:function(res){
                $.each(res, function(k, v) {
                    alergis.push(""+v['Alergi_Id']+"");
                });
                $('#Alergi_Id').data('kendoMultiSelect').value(alergis);
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
        e.container.parent().find('input[name="Disabilitas_Id"]').data('kendoDropDownList').value(e.model.Disabilitas_Id);
        e.container.parent().find('input[name="Jenis_Kelamin_Id"]').data('kendoDropDownList').value(e.model.Jenis_Kelamin_Id);
        e.container.parent().find('input[name="Gol_Darah_Id"]').data('kendoDropDownList').value(e.model.Gol_Darah_Id);
        e.container.parent().find('input[name="Kewarganegaraan_Id"]').data('kendoDropDownList').value(e.model.Kewarganegaraan_Id);
        e.container.parent().find('input[name="Provinsi_Id"]').data('kendoDropDownList').value(e.model.Provinsi_Id);
        e.container.parent().find('input[name="Kabupaten_Id"]').data('kendoDropDownList').value(e.model.Kabupaten_Id);
        e.container.parent().find('input[name="Kecamatan_Id"]').data('kendoDropDownList').value(e.model.Kecamatan_Id);
        e.container.parent().find('input[name="Status_Pernikahan_Id"]').data('kendoDropDownList').value(e.model.Status_Pernikahan_Id);
        e.container.parent().find('input[name="Agama_Id"]').data('kendoDropDownList').value(e.model.Agama_Id);
        e.container.parent().find('input[name="Pendidikan_Id"]').data('kendoDropDownList').value(e.model.endidikan_Id);
        e.container.parent().find('input[name="Status_Id"]').data('kendoDropDownList').value(e.model.Status_Id);
        e.container.parent().find('input[name="Bahasa_Pasien_Id"]').data('kendoDropDownList').value(e.model.Bahasa_Pasien_Id);
        e.container.parent().find('input[name="Ras_Id"]').data('kendoDropDownList').value(e.model.Ras_Id);
        e.container.parent().find('input[name="Keluarga_Id"]').data('kendoDropDownList').value(e.model.Keluarga_Id);
        e.container.parent().find('input[name="Kewarganegaraan_Penanggung_Jawab"]').data('kendoDropDownList').value(e.model.Kewarganegaraan_Pj);
        $("#Provinsi_Penanggung_Jawab").data('kendoDropDownList').value(e.model.Provinsi_Pj);
        $("#Kabupaten_Penanggung_Jawab").data('kendoDropDownList').value(e.model.Kabupaten_Pj);
        $("#Kecamatan_Penanggung_Jawab").data('kendoDropDownList').value(e.model.Kecamatan_Pj);
        $("#alamat_Penanggung_Jawab").val(e.model.alamat_Penanggung_Jawab);
        
      }
    })

    $('#cari').keyup(function(e){
            cari = $('#cari').val();
            $('#grid').data('kendoGrid').dataSource.read();
        })
      })

    function CetakPasien(Pasien_Id) {
        // e.preventDefault();
        // var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        // console.log(dataItem)
        var urlPrint = "{{asset('/cetak_kartupasien')}}/"+Pasien_Id;
        // console.log(urlPrint)
        // wnd.content(detailsTemplate);
        // wnd.center().open();
        // $('#Kartu_Pasien').attr("href",urlPrint);
        window.open(urlPrint, '_blank');
    }

    var poli = $("#modalPoli")
        .kendoWindow({
            title: "Pilih Daftar Pelayanan",
            modal: true,
            visible: false,
            resizable: false,
            width: 520
        }).data("kendoWindow");

        $("#closePoli").click(function(e) {
            poli.close();
        });

        $("#closeLab").click(function(e) {
            poli.close();
        });

    function PendaftaranPoli(e) {

        $("#tabstrip").kendoTabStrip({
            animation: {
              open: {
                effects: "fadeIn"
              }
            },
          });

        var grid = $('#grid').data('kendoGrid');
        var tr = $(e.target).closest("tr");
        var data = grid.dataItem(tr)
        $("#namapasienmodal").text(data.Nama);
        $("#PasienLaboratorium").text(data.Nama);
        $("#PasienRadiologi").text(data.Nama);

        $("input[name='Pasien_Id']").val(data.Pasien_Id);
        $("input[name='Pasien_Lab']").val(data.Pasien_Id);
        $("input[name='Laboratorium']").val("18");

        $('select[name="Work_Unit_Id"]').val("");
        $('select[name="Shift_Id"]').val("");
        $('select[name="Employee_Id"]').val("");
        $('select[name="Jenis_Pemeriksaan_Id"]').val("");
        $('select[name="Prosedur_Medis_Biaya_Id"]').val("");
        poli.center().open();
    }

    function createPoli(){
        var Pasien_Id = $('input[name="Pasien_Id"]').val();
        var Work_Unit_Id = $('select[name="Work_Unit_Id"]').val();
        var Shift_Id = $('select[name="Shift_Id"]').val();
        var Employee_Id = $('select[name="Employee_Id"]').val();
        // console.log(Work_Unit_Id);
        if((Work_Unit_Id != '') && (Shift_Id != '') && (Employee_Id != '')){
            $.ajax({ 
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url : '{{ url('pasien/Pasien/daftarPoli') }}',
                type: 'POST',
                dataType: 'json',
                data: {Pasien_Id: Pasien_Id, Work_Unit_Id: Work_Unit_Id, Shift_Id: Shift_Id, Dokter_Id: Employee_Id},
                success: function(res) {
                    window.open('{{url("/pasien/Pasien/cetakAntrian")}}/'+res, '_blank');
                },

                complete: function(){
                    poli.center().close();
                }
            })
        }else{
            kendo.alert("Data tidak boleh kosong!");
        }
    }

    function createLab(){
        var Pasien_Id = $('input[name="Pasien_Lab"]').val();
        var Work_Unit_Id = $('input[name="Laboratorium"]').val();
        var Jenis_Pemeriksaan_Id = $('select[name="Jenis_Pemeriksaan_Id"]').val();
        var Prosedur_Medis_Biaya_Id = $('select[name="Prosedur_Medis_Biaya_Id"]').val();

        if((Jenis_Pemeriksaan_Id != '') && (Prosedur_Medis_Biaya_Id != '')){
            $.ajax({ 
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url : '{{ url('pasien/Pasien/daftarPoli') }}',
                type: 'POST',
                dataType: 'json',
                data: {Pasien_Id: Pasien_Id, Work_Unit_Id: Work_Unit_Id, Jenis_Pemeriksaan_Id: Jenis_Pemeriksaan_Id, Prosedur_Medis_Biaya_Id: Prosedur_Medis_Biaya_Id},
                success: function(res) {
                    window.open('{{url("/pasien/Pasien/cetakAntrian")}}/'+res, '_blank');
                },

                complete: function(){
                    poli.center().close();
                }
            })
        }else{
            kendo.alert("Data tidak boleh kosong!");
        }
    }

    var igd = $("#modalIGD")
        .kendoWindow({
            title: "Pendaftaran IGD",
            modal: true,
            visible: false,
            resizable: false,
            width: 400
        }).data("kendoWindow");

        $("#closeIGD").click(function(e) {
            igd.close();
        });

    function PendaftaranIGD(e) {
        var grid = $('#grid').data('kendoGrid');
        var tr = $(e.target).closest("tr");
        var data = grid.dataItem(tr)
        $("#pasiennamamodal").text(data.Nama);

        $("input[name='Pasien_IGD']").val(data.Pasien_Id);
        $("input[name='Poli_IGD']").val("16");
        $("select[name='Shift_IGD']").val("");
        $("select[name='Employee_IGD']").val("");
        igd.center().open();
    }

    function createIGD(){
        var Pasien_Id = $('input[name="Pasien_IGD"]').val();
        var Work_Unit_Id = $('input[name="Poli_IGD"]').val();
        var Shift_Id = $('select[name="Shift_IGD"]').val();
        var Employee_Id = $('select[name="Employee_IGD"]').val();

        if(Employee_Id != ''){
            $.ajax({ 
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url : '{{ url('pasien/Pasien/daftarIGD') }}',
                type: 'POST',
                dataType: 'json',
                data: {Pasien_Id: Pasien_Id, Work_Unit_Id: Work_Unit_Id, Shift_Id: Shift_Id, Employee_Id: Employee_Id},
                success: function(res) {
                    kendo.alert("Pasien telah ditambahkan ke pemeriksaan IGD");
                },

                complete: function(){
                    igd.center().close();
                }
            })
        }else{
            kendo.alert("Dokter tidak boleh kosong!");
        }

    }

    function take_snapshot() {
        Webcam.snap( function(data_uri, canvas, context) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            document.getElementById('foto').value = raw_image_data;
            // console.log('foto');
        });
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
              url : '{{ url('pasien/Pasien/alergipasien') }}',
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
              url : '{{ url('pasien/Pasien/asuransipasien') }}',
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

      // console.log(data);

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });
  }


</script>

<script type="text/javascript">
    $( document ).ready(function() {
    $("select[name='Work_Unit_Id']").change(function (e) {
      var Work_Unit_Id = $("[name='Work_Unit_Id']").val();
      $.ajax({
        url: "{{ url('') }}/pasien/Pasien/getShift/" + Work_Unit_Id,
        type: "GET",
        dataType:"json",
        success: function (res) {
          // console.log(res);
          var el;

          el='<option value="" readonly>-- Pilih Shift --</option>';

          $.each(res, function (index, val) {
            el += "<option value='" + val.Shift_Id + "'>" + val.Shift_Name + "</option>";
          });

          if (res.length == 0) {
            $("[name='Shift_Id']").html("Data Tidak Ditemukan");
            $("[name='Employee_Id']").html("Data Tidak Ditemukan");
          } else {
            $("[name='Shift_Id']").html(el);
          }

          $("select[name='Shift_Id']").val("")


        }
      })
    });

    $("select[name='Shift_Id']").change(function (e) {
      var Shift_Id = $("[name='Shift_Id']").val();
      // console.log(Shift_Id);
      $.ajax({
        url: "{{ url('') }}/pasien/Pasien/getDokter/" + Shift_Id,
        type: "GET",
        dataType:"json",
        success: function (res) {
          // console.log(res);
          var el;

          el='<option value="" readonly>-- Pilih Dokter --</option>';

          $.each(res, function (index, val) {
            el += "<option value='" + val.Employee_Id + "'>" + val.Full_Name + "</option>";
          });
          // console.log(el);

          if (res.length == 0) {
            $("[name='Employee_Id']").html("Data Tidak Ditemukan");
          } else {
            $("[name='Employee_Id']").html(el);
          }

          $("select[name='Employee_Id']").val("")
        }

      })
      // console.log(res);
    });

    $("select[name='Shift_IGD']").change(function (e) {
      var Shift_Id = $("[name='Shift_IGD']").val();
      // console.log(Shift_Id);
      $.ajax({
        url: "{{ url('') }}/pasien/Pasien/getDokter/" + Shift_Id,
        type: "GET",
        dataType:"json",
        success: function (res) {
          // console.log(res);
          var el;

          el='<option value="" readonly>-- Pilih Dokter --</option>';

          $.each(res, function (index, val) {
            el += "<option value='" + val.Employee_Id + "'>" + val.Full_Name + "</option>";
          });
          // console.log(el);

          if (res.length == 0) {
            $("[name='Employee_IGD']").html("Data Tidak Ditemukan");
          } else {
            $("[name='Employee_IGD']").html(el);
          }

          $("select[name='Employee_IGD']").val("")
        }

      })
      // console.log(res);
    });

    $("select[name='Jenis_Pemeriksaan_Id']").change(function (e) {
      var Jenis_Pemeriksaan_Id = $("[name='Jenis_Pemeriksaan_Id']").val();
      // console.log(Jenis_Pemeriksaan_Id);
      $.ajax({
        url: "{{ url('') }}/pasien/Pasien/getProsedurMedisBiaya/" + Jenis_Pemeriksaan_Id,
        type: "GET",
        dataType:"json",
        success: function (res) {
          // console.log(res);
          var el;

          el='<option value="" readonly>-- Pilih Tindakan --</option>';

          $.each(res, function (index, val) {
            el += "<option value='" + val.Prosedur_Medis_Biaya_Id + "'>" + val.Deskripsi_Pendek + "</option>";
          });
          // console.log(el);

          if (res.length == 0) {
            $("[name='Prosedur_Medis_Biaya_Id']").html("Data Tidak Ditemukan");
          } else {
            $("[name='Prosedur_Medis_Biaya_Id']").html(el);
          }

          $("select[name='Prosedur_Medis_Biaya_Id']").val("")
        }

      })
      // console.log(res);
    });

  });
</script>

@endsection