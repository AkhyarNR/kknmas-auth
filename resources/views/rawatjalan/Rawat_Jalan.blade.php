@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<style>
.bottomright {
  position: absolute;
  bottom: 8px;
  right: 16px;
}
</style>

<input type="hidden" id="Jenisindikator">

<!-- Data Pasien IGD -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Rawat Jalan</h3>
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
                                        <ul class="pasien-datalist">
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
                      <div class="PemeriksaanPasien">
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

<script type="text/x-kendo-template" id="DetailTemplate">
    <a id="Pemeriksaan" class="k-button k-button-icontext" onclick="Pemeriksaan()"><span class="k-icon k-i-add"></span>Pemeriksaan</a>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>   
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>   
</script>

<div id="modalpemeriksaan">
    <a id="Pemeriksaan_Umum" class="k-button k-button-icontext " href='{{asset("/")}}'><span class="k-icon k-i-paste"></span>Pemeriksaan Umum</a>

    <a id="Pemeriksaan_Obstetri" class="k-button k-button-icontext" href='{{asset("/")}}'><span class="k-icon k-i-paste"></span>Pemeriksaan Obstetri</a>

    <a id="Pemeriksaan_Ginekologi" class="k-button k-button-icontext" href='{{asset("/")}}'><span class="k-icon k-i-paste"></span>Pemeriksaan Ginekologi</a>
</div>

<div id="jenispemeriksaan">
   <div id="umum"></div>
</div>

<script>

  $(function(){

      var cari = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
            $.ajax({
              url : '{{ url('rawatjalan/Rawat_Jalan/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
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
            template: "#=  (Waktu_Registrasi == null)? '' : kendo.toString(kendo.parseDate(Waktu_Registrasi, 'yyyy-MM-dd HH:mm:ss'), 'dd-MM-yyyy hh:mm:ss') #", 
            title: 'Waktu Registrasi'
        },
        {   field: 'Kode_Pasien', 
            title: 'No RM'
        },
        {   field: 'Nama', 
            title: 'Nama'
        }
      ],
      pageable: true,
      detailTemplate: kendo.template($("#template").html()),
      detailInit: detailInit,
      editable: {
        mode:"popup",
        template: $("#RawatJalanTemplate").html(),
      },
    })

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
    })

  })

  var djs = $("#modalpemeriksaan")
                .kendoWindow({
                    title: "Pilih Pemeriksaan",
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 300
                }).data("kendoWindow");

  function DetailJenis(e) {
        wnk.center().open();
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

      var PemeriksaanPasien = new kendo.data.DataSource({
        transport:{
          read: function(options){
            var Pasien_Id = data.Pasien_Id;
            $.ajax({
              url: '{{ url('rawatjalan/Rawat_Jalan/readdetail') }}',
              type: "GET",
              data: {Pasien_Id :Pasien_Id},
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

      $('.PemeriksaanPasien').on("click", ".Jenispemeriksaan", function (e) {
                e.preventDefault();
                var dataItem = $(".PemeriksaanPasien").getKendoGrid().dataItem($(e.currentTarget).closest("tr"));
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

      detailRow.find(".PemeriksaanPasien").kendoGrid({
        dataSource : PemeriksaanPasien,
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
                title: 'No Pemeriksaan'},

              { field: '',
                template: "#=  (Created_Date == null)? '' : kendo.toString(kendo.parseDate(Created_Date, 'yyyy-MM-dd'), 'dd-MM-yyyy') #", 
                title: 'Tanggal'},

              { field: '', 
                template: "#=  (Created_Date == null)? '' : kendo.toString(kendo.parseDate(Created_Date, 'yyyy-MM-dd HH:mm:ss'), 'hh:mm:ss') #",
                title: 'Jam'},

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
                template:'# if ( diagnosa_pemeriksaan == null) {# - #} else {# #= diagnosa_pemeriksaan.diagnosa.Nama_Penyakit # #} #'
              },

              { field: '', 
                title: 'Tindakan',
                template:'# if (tindakan_medis == null) {# - #} else {# #= tindakan_medis.tindakan_perawatan.Nama_Tindakan_Perawatan # #} #'
              },

              { field: '',
                title: 'Tindakan Lanjut',
                 template:'# if (rawat_jalan[0].tindakan_lanjut == null) {# - #} else { # #= rawat_jalan[0].tindakan_lanjut.Tindakan_Lanjut # #} #'
              }
          ]
      });

  }

</script>

@endsection