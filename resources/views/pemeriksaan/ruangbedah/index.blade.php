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
            <h3>Data Pasien Ruang Bedah</h3>
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
                            Riwayat Pemeriksaan
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
                                    <div class="col-md-8">
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
                                                : # if (Umur == null) {# - #} else {# #= Umur # #} # 
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
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="private-separator mb-2"></div>
                                        <ul class="employee-datalist">
                                            <li class="row">
                                                <label class="d-block col-md-5">No Telp</label>
                                                <p class="col-md-6 private-content"><strong>
                                                # if (No_HP == null) {# - #} else {# #= No_HP # #} #  
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-5">Email</label>
                                                <p class="col-md-6"><strong>
                                                # if (Email == null) {# - #} else {# #= Email # #} #
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pekerjaan</label>
                                                <p class="col-md-6"><strong>
                                                # if (Pekerjaan == null) {# - #} else {# #= Pekerjaan # #} #
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">NIP</label>
                                                <p class="col-md-6"><strong>
                                                # if (nip == null) {# - #} else {# #= nip # #} #   
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Asuransi</label>
                                                <p class="col-md-6"><strong>
                                                # if (Nama_Asuransi == null) {# - #} else {# #= Nama_Asuransi # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Nomor Asuransi</label>
                                                <p class="col-md-6"><strong>
                                                # if (Kode_Asuransi == null) {# - #} else {# #= Kode_Asuransi # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Penanggung Jawab</label>
                                                <p class="col-md-6"><strong>
                                                 # if (Nama_Penanggung_Jawab == null) {# - #} else {# #= Nama_Penanggung_Jawab # #} # 
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Pekerjaan Penanggung Jawab</label>
                                                <p class="col-md-6"><strong>
                                                  # if (Pekerjaan == null) {# - #} else {# #= Pekerjaan # #} #     
                                                </strong></p>
                                            </li>
                                            <li class="row">
                                                <label class="d-block col-md-3">Alamat Penanggung Jawab</label>
                                                <p class="col-md-6"><strong>
                                                 # if (Alamat == null) {# - #} else {# #= Alamat # #} #    
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
                    <div>
                      <div class="RiwayatPemeriksaan">
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

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>

<script type="text/x-kendo-template" id="IgdTemplate">
    <div class="k-edit-label"><label for="Pasien_Id">Pasien :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" style="margin-left:10px" id="Pasien_Id" style="width: 100%;">
    </div>

    <div class="k-edit-label"><label for="Shift_Id">Shift :</label></div>
    <div data-container-for="Shift_Id" class="k-edit-field" >
        <input name="Shift_Id" style="margin-left:10px" id="Shift_Id">
    </div>

    <div class="k-edit-label"><label for="Dokter_Id">Dokter :</label></div>
    <div data-container-for="Dokter_Id" class="k-edit-field" >
        <input name="Dokter_Id" style="margin-left:10px" id="Dokter_Id">
    </div>
</script>

<script type="text/x-kendo-template" id="DetailTemplate">
    <a id="Pemeriksaan" class="k-button k-button-icontext" onclick="Pemeriksaan()"><span class="k-icon k-i-add"></span>Pemeriksaan</a>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>   
</script>

<div id="modalpemeriksaan">
    <a id="Pemeriksaan_Umum" class="k-button k-button-icontext " href='{{asset("/")}}'><span class="k-icon k-i-paste"></span>Pemeriksaan Umum</a>
</div>

<div id="jenispemeriksaan">
   <div id="umum"></div>
</div>

<div id="hapusDialog"></div>


<script>

  $(function(){
      var hapusDialog,
          cari = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
            $.ajax({
              url : '{{ url('pemeriksaan/ruangbedah/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
              }
            })
            
          },

          create : function(options) {
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('pemeriksaan/ruangbedah/create') }}',
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
                  // console.log(res);
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
        {   field: 'No_Registrasi', 
            title: 'No Registrasi'
        },
        {   field: 'Waktu_Registrasi', 
            title: 'Waktu Registrasi', 
            template:"#: kendo.toString(kendo.parseDate(data.Waktu_Registrasi), 'dd-MM-yyyy | HH:mm tt') #"
        },
        {   field: 'Kode_Pasien', 
            title: 'No RM'},
        {   field: 'Nama', 
            title: 'Nama'
        },
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:[   { iconClass: "k-icon k-i-change-manually",
                      text: "Periksa",
                      click: Periksa
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
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.parent().find("[name='Waktu_Registrasi']").kendoDateTimePicker({
          value: new Date(),
          dateInput: true,
          format: 'yyyy-MM-dd hh:mm:ss'
        })

         $("#Pasien_Id").kendoDropDownList({
            optionLabel: "-Pilih Pasien-",
            dataTextField: "Nama",
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('pemeriksaan/ruangbedah/getPasien')}}",
                        dataType: "json"
                    }
                }
            },
          });
          $("#Shift_Id").kendoDropDownList({
            optionLabel: "-Pilih Shift-",
            dataTextField: "Time_Start_End",
            dataValueField: "Shift_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_shift')}}",
                        dataType: "json"
                    }
                }
               
            },
            change:function(e){
                pasien = $('#Shift_Id').val()
                $('#Dokter_Id').data('kendoDropDownList').dataSource.read({shift_id:pasien});
                console.log( $('input[name="Shift_Id"]').data('kendoDropDownList').value())
            },
          });
          $("#Dokter_Id").kendoDropDownList({
            optionLabel: "-Pilih Dokter-",
            dataTextField: "Full_Name",
            dataValueField: "Employee_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('poliklinik/JadwalPoliklinik/getDokter')}}",
                        dataType: "json"
                    }
                }
            }
          });
      }

    })

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
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
                                    url: "{{ asset('pemeriksaan/ruangbedah/hapus') }}",
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

  function Periksa(e) {
    e.preventDefault();

        var tr = $(e.target).closest("tr"),
            data = this.dataItem(tr);
        var id = {Pasien_Rawat_Jalan_Id: data.Pasien_Rawat_Jalan_Id,Pasien_Id : data.Pasien_Id};

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                    url: "{{ asset('pemeriksaan/umum/{Pasien_Rawat_Jalan_Id}') }}",
                type: "GET",
                data: id,
                dataType: "json",
            });
  }

  var wnk = $("#modalpemeriksaan")
                .kendoWindow({
                    title: "Pilih Pemeriksaan",
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 300
                }).data("kendoWindow");

  function Pemeriksaan(e) {
        wnk.center().open();
    }

  function detailInit(e) {
      var detailRow = e.detailRow;
      var data = e.data;
      console.log(data);

      var RiwayatPemeriksaan = new kendo.data.DataSource({
        transport:{
          read: function(options){
            var Pasien_Id = data.Pasien_Id;
            $.ajax({
              url: '{{ url('pemeriksaan/ruangbedah/readdetail') }}',
              type: "GET",
              data: {Pasien_Id :Pasien_Id},
              dataType: "json",
              success: function (res) {
                options.success(res);
                console.log(options);
              }
            });
          },
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: "Pemeriksaan_Id",
            fields: {
                Pemeriksaan_Id: {
                    type: "text",
                },
                Pasien_Rawat_Jalan_Id: {
                    type: "text",
                },
                Pasien_Id: {
                    type: "text",
                },
                Pasien_Rawat_Inap_Id: {
                    type: "text",
                },
                Igd_Id: {
                    type: "text",
                },
                Indikator_Pemeriksaan_Id: {
                    type: "text",
                },
                Indikator_Nilai_Id: {
                    type: "text",
                },
                Nilai: {
                    type: "text",
                }
            }
          }
        },
        pageSize: 20,
        serverPaging: false
      });

      var wnd = $("#jenispemeriksaan")
        .kendoWindow({
            title: "Data Pemeriksaan",
            modal: true,
            visible: false,
            resizable: false,
            width: 600
        }).data("kendoWindow");

      $('.RiwayatPemeriksaan').on("click", ".Jenispemeriksaan", function (e) {
                e.preventDefault();
                var dataItem = $(".RiwayatPemeriksaan").getKendoGrid().dataItem($(e.currentTarget).closest("tr"));
                console.log(dataItem)

                wnd.center().open();
                // $('#Jenisindikator').val(dataItem.Jenis_Pemeriksaan_Id)
                $("#umum").kendoGrid({

                    dataSource: {
                        transport:{
                          read : function(options) {
                            $.ajax({
                              url : '{{ url('rawatjalan/Rawat_Jalan/jenisdetail') }}',
                              type: 'GET',
                              data:{Jenis_Pemeriksaan_Id : dataItem.pemeriksaan_hasil.Jenis_Pemeriksaan_Id,Pemeriksaan_Id: dataItem.Pemeriksaan_Id},
                              dataType: 'json',
                              success: function(res) {
                                options.success(res);
                                console.log(res);
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
                            id: 'Pemeriksaan_Hasil_Id'
                          }
                        }
                    },
                    columns: [
                      { 
                        field : "",
                        template:'# if ( indikator_pemeriksaan[0] == null) {# - #} else {# #= indikator_pemeriksaan[0].Indikator_Pemeriksaan # #} #',
                        title: "Indikator Pemeriksaan",
                        headerAttributes:{
                            style: "text-align: center; color: black;" 
                        }
                      },
                      { 
                        field : "",
                        template:'# if ( Indikator_Nilai_Id == null) {# #= Nilai # #} else {# #= indikator_nilai[0].Nilai # #} #',
                        title: "Hasil",
                        headerAttributes:{
                            style: "text-align: center; color: black;" 
                        }
                      }
                    ]
                });
            
        });

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });

      detailRow.find(".RiwayatPemeriksaan").kendoGrid({
        dataSource : RiwayatPemeriksaan,
          scrollable: false,
          sortable: true,
          pageable: {
            pageSizes: false,
            numeric: false,
            input: true,
            refresh: true
          },
          editable: {
            mode: "popup",
            template: $("#modalpemeriksaan").html(),
          },
          toolbar: kendo.template($("#DetailTemplate").html()),
          columns: [
              { field: '', 
                template: '# if (No_Pemeriksaan== null) {# - #} else {# #= No_Pemeriksaan # #} #', 
                title: 'No Pemeriksaan'
              },
              { field: '',
                template: "#=  (Created_Date == null)? '' : kendo.toString(kendo.parseDate(Created_Date, 'yyyy-MM-dd'), 'dd-MM-yyyy') #", 
                title: 'Tanggal'
              },
              { field: '', 
                template: "#=  (Created_Date == null)? '' : kendo.toString(kendo.parseDate(Created_Date, 'yyyy-MM-dd HH:mm:ss'), 'hh:mm:ss') #",
                title: 'Jam'
              },
              { template: "<button class='btn btn-link Jenispemeriksaan'># if (pemeriksaan_hasil.jenis_pemeriksaan[0] == null) {# - #} else {# #= pemeriksaan_hasil.jenis_pemeriksaan[0].Jenis_Pemeriksaan # #} #</button>", 
                title:"Jenis Pemeriksaan"
              },
              { field: '', 
                title: 'Nama Dokter',
                template: '# if (rawat_jalan[0].shift.employee_shift.dokter == null) {# - #} else {# #= rawat_jalan[0].shift.employee_shift.dokter.Name # #} #'
              },

              { field: '', 
                title: 'Nama Petugas',
                template: '# if (rawat_jalan[0].shift.employee_shift.petugas == null) {# - #} else {# #= rawat_jalan[0].shift.employee_shift.petugas.Name # #} #'
              },

              { field: '', 
                title: 'Diagnosa',
                template:'# if (diagnosa_pemeriksaan == null) {# - #} else {# #= diagnosa_pemeriksaan.diagnosa.Nama_Penyakit # #} #'
              },

              { field: '', 
                title: 'Tindakan',
                template:'# if (tindakan_medis == null) {# - #} else {# #= tindakan_medis.tindakan_perawatan.Nama_Tindakan_Perawatan # #} #'
              },

              { field: '',
                title: 'Tindakan Lanjut',
                 template:'# if (rawat_jalan == null) {# - #} else { # #= rawat_jalan[0].tindakan_lanjut.Tindakan_Lanjut # #} #'
              }
          ]
      });


  }

</script>

@endsection