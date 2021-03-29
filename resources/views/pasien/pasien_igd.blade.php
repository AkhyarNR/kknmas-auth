@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

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
                        <li>
                            Status Pasien
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
                            <div class="col-md-15">
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
                                                <label class="d-block col-md-3">Tanggal Daftar</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Tanggal_Daftar == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Daftar, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nama</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama == null) {# - #} else {# #= Nama # #} #  
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
                                                <label class="d-block col-md-3">Umur</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Umur == null) {# - #} else {# #= Umur # #= Satuan_Umur # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Jenis Kelamin</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Jenis_Kelamin == null) {# - #} else {# #= Jenis_Kelamin # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">No Ktp</label>
                                                <p class="col-md-6 private-content">
                                                : # if (No_Ktp == null) {# - #} else {# #= No_Ktp # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nama Ibu</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Ibu == null) {# - #} else {# #= Nama_Ibu # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pendidikan</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Pendidikan == null) {# - #} else {# #= Pendidikan # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Suku/Bangsa</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Ras == null) {# - #} else {# #= Ras # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Bahasa Dipakai</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Nama_Bahasa == null) {# - #} else {# #= Nama_Bahasa # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Agama</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Agama == null) {# - #} else {# #= Agama # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Status Nikah</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Status_Pernikahan == null) {# - #} else {# #= Status_Pernikahan # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Cacat Fisik</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Jenis == null) {# - #} else {# #= Jenis # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Alamat</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Alamat == null) {# - #} else {# #= Alamat # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">No Telp</label>
                                                <p class="col-md-6 private-content">
                                                : # if (No_HP == null) {# - #} else {# #= No_HP # #} #  
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-3">Email</label>
                                                <p class="col-md-6">
                                                # if (Email == null) {# - #} else {# #= Email # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pekerjaan</label>
                                                <p class="col-md-6">
                                                # if (Pekerjaan == null) {# - #} else {# #= Pekerjaan # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">NIP</label>
                                                <p class="col-md-6">
                                                # if (nip == null) {# - #} else {# #= nip # #} #   
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Asuransi</label>
                                                <p class="col-md-6">
                                                # if (Nama_Asuransi == null) {# - #} else {# #= Nama_Asuransi # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nomor Asuransi</label>
                                                <p class="col-md-6">
                                                # if (Kode_Asuransi == null) {# - #} else {# #= Kode_Asuransi # #} # 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Penanggung Jawab</label>
                                                <p class="col-md-6">
                                                 
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pekerjaan Penanggung Jawab</label>
                                                <p class="col-md-6">
                                                :     
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Alamat Penanggung Jawab</label>
                                                <p class="col-md-6">
                                                :     
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div>
                      <div class="StatusPasien">
                        <div class="row">
                          <div class="col-md-3" style="position: relative">
                            <div class="pasien-photo">
                              <img src="{{asset('/storage/photos')}}/#= Kode_Pasien #.jpeg" alt="No Image" style="width: 250px; height: 350px">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-15">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-3">Tindakan Lanjut </label>
                                                <p class="col-md-6 private-content">
                                                : # if (Tindakan_Lanjut == null) {# - #} else {# #= Tindakan_Lanjut # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Status Bayar</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Status_Bayar == null) {# - #} else {# #= Status_Bayar # #} #
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Biaya Registrasi</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Biaya_Registrasi == null) {# 0 #} else {# #= Biaya_Registrasi # #} #  
                                                </p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Status Periksa</label>
                                                <p class="col-md-6 private-content">
                                                : # if (Status_Periksa == null) {# 0 #} else {# #= Status_Periksa # #} #  
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-3">Email</label>
                                                <p class="col-md-6">
                                                # if (Email == null) {# - #} else {# #= Email # #} #
                                                </p>
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

<style>
    .k-button .k-bare .k-button-icon .k-window-action{
     margin: 200px;   
    }
</style>

<script type="text/x-kendo-template" id="PasienTemplate">
  #if(data.isNew()) {#
      #var createTemp = kendo.template($("\#createTemplate").html());#
      #=createTemp(data)#
  #} else {#
      #var createTemp = kendo.template($("\#editTemplate").html());#
      #=createTemp(data)#
  #}#
</script>
    
<script type="text/x-kendo-template" id="createTemplate">
    <div class="k-edit-label"><label for="Pasien_Id">No RM :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" style="margin-left:10px">
    </div>

    <div class="k-edit-label"><label for="Status_Periksa_Id">Status Periksa :</label></div>
    <div data-container-for="Status_Periksa_Id" class="k-edit-field" >
        <input name="Status_Periksa_Id" style="margin-left:10px">
    </div>

    <div class="k-edit-label"><label for="Employee_Id">Dokter :</label></div>
    <div data-container-for="Employee_Id" class="k-edit-field" >
        <input name="Employee_Id" style="margin-left:10px">
    </div>
</script>
<script type="text/x-kendo-template" id="editTemplate">
    <div class="k-edit-label"><label for="Pasien_Id">No RM :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" disabled="disabled" style="margin-left:10px">
    </div>

    <div class="k-edit-label"><label for="Status_Periksa_Id">Status Periksa :</label></div>
    <div data-container-for="Status_Periksa_Id" class="k-edit-field" >
        <input name="Status_Periksa_Id" style="margin-left:10px">
    </div>

    <div class="k-edit-label"><label for="Tindakan_Lanjut_Id">Tindakan Lanjut :</label></div>
    <div data-container-for="Tindakan_Lanjut_Id" class="k-edit-field" >
        <input name="Tindakan_Lanjut_Id" style="margin-left:10px">
    </div>

    <div class="k-edit-label"><label for="Employee_Id">Dokter :</label></div>
    <div data-container-for="Employee_Id" class="k-edit-field" >
        <input name="Employee_Id" style="margin-left:10px">
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

<script>

  $(function(){
      var cari = null;
      var dropdown = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
              options.data.dropdown = dropdown;
            $.ajax({
              url : '{{ url('igd/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
                console.log(res);
              }
            })
            
          },

          create : function(options) {
            options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoDropDownList').value();
            options.data.Status_Periksa_Id = $('input[name="Status_Periksa_Id"]').data('kendoDropDownList').value();
            options.data.Poliklinik_Id = '16';
            options.data.Employee_Id = $('input[name="Employee_Id"]').data('kendoDropDownList').value();


            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('igd/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
                console.log(res);
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
            
          },

          update: function(options){
            options.data.Status_Periksa_Id = $('input[name="Status_Periksa_Id"]').data('kendoDropDownList').value();
            options.data.Tindakan_Lanjut_Id = $('input[name="Tindakan_Lanjut_Id"]').data('kendoDropDownList').value();
            options.data.Employee_Id = $('input[name="Employee_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('igd/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                options.success(res);
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
          },
          
          destroy: function(options){
            $.ajax({
              url : '{{ url('igd/hapus') }}',
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
        {field: 'No_Registrasi', title: 'No Registrasi'},
        {field: 'Waktu_Registrasi', title: 'Waktu Registrasi', template: "#=  (Waktu_Registrasi == null)? '' : kendo.toString(kendo.parseDate(Waktu_Registrasi, 'yyyy-MM-dd HH:mm:ss'), 'dd-MM-yyyy hh:mm:ss') #"},
        {field: 'Kode_Pasien', title: 'No RM'},
        {field: 'Nama', title: 'Nama'},
        {field: 'Name', title: 'Dokter'},
        {command:['edit','destroy']}
      ],
      pageable: true,
      detailTemplate: kendo.template($("#template").html()),
      detailInit: detailInit,
      editable: {
        mode:"popup",
        template: $("#PasienTemplate").html(),
      },

      
      edit : function(e) {
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.parent().find('input[name="Pasien_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Pasien-",
            filter: "startswith",
            dataTextField: "Kode_Pasien",
            template: '#:Kode_Pasien#  | #:Nama#',
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPasien')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Status_Periksa_Id"]').kendoDropDownList({
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
            }
        })

        e.container.parent().find('input[name="Tindakan_Lanjut_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Tindakan Lanjut-",
            dataTextField: "Tindakan_Lanjut",
            dataValueField: "Tindakan_Lanjut_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getTindakanLanjut')}}",
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
            optionLabel: "-Pilih Poliklinik-",
            dataTextField: "Nama_Poliklinik",
            dataValueField: "Poliklinik_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPoliklinik')}}",
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

  function detailInit(e) {
      var detailRow = e.detailRow;
      var data = e.data;
      console.log(data);

      var StatusPasien = new kendo.data.DataSource({
        transport:{
          read: function(options){
            $.ajax({
              url: '{{ url('pasien/Pasien/readdetail') }}',
              type: "GET",
              data: data.Kode_Pasien,
              dataType: "json",
              success: function (res) {
                options.success(res);
              }
            });
          },
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: "Pasien_Rawat_Jalan_Id",
            fields: {
                Tanggal_Daftar: {
                    type: "date", format: "{0:dd-MM-yyyy}"
                }
            }
          }
        },
        pageSize: 20,
        serverPaging: false
      });

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });

  }

</script>

@endsection