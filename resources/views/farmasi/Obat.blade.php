@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Obat -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Inventory Obat & BHP</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="grid"></div>
            <script type="text/x-kendo-template" id="templateDetail">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Obat/BHP
                        </li>
                    </ul>
                    <div>
                      <div class="Detaildata">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="private-separator mb-2"></div>
                                <ul class="obat-detail">
                                    <li class="row">
                                        <label class="d-block col-md-3">Industri Farmasi</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Nama_Industri_Farmasi == null) {# - #} else {# #= Nama_Industri_Farmasi # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kandungan</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Kandungan == null) {# - #} else {# #= Kandungan # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kegunaan / Indikasi</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Kegunaan == null) {# - #} else {# #= Kegunaan # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Harga Dasar</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Harga_Dasar == null) {# - #} else {# #= kendo.toString(Harga_Dasar, "c0") # #} #
                                        </p>
                                    </li>
                                </ul>
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

<script type="text/x-kendo-template" id="template">
    <div class="k-edit-label"><label for="Kode_Obat">Kode Obat/BHP :</label></div>
    <div data-container-for="Kode_Obat" class="k-edit-field" >
        <input name="Kode_Obat" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Nama_Obat">Nama Obat/BHP :</label></div>
    <div data-container-for="Nama_Obat" class="k-edit-field" >
        <input name="Nama_Obat" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Jenis_Obat_Id">Jenis Obat/BHP :</label></div>
    <div data-container-for="Jenis_Obat_Id" class="k-edit-field" >
        <input name="Jenis_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Kategori_Obat_Id">Kategori Obat/BHP :</label></div>
    <div data-container-for="Kategori_Obat_Id" class="k-edit-field" >
        <input name="Kategori_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Golongan_Obat_Id">Golongan Obat/BHP :</label></div>
    <div data-container-for="Golongan_Obat_Id" class="k-edit-field" >
        <input name="Golongan_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Satuan_Obat_Id">Satuan Obat/BHP :</label></div>
    <div data-container-for="Satuan_Obat_Id" class="k-edit-field">
        <input name="Satuan_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Industri_Farmasi_Id">Industri Farmasi :</label></div>
    <div data-container-for="Industri_Farmasi_Id" class="k-edit-field">
        <input name="Industri_Farmasi_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Kandungan">Kandungan :</label></div>
    <div data-container-for="Kandungan" class="k-edit-field" >
        <input name="Kandungan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kegunaan">Indikasi/Kegunaan :</label></div>
    <div data-container-for="Kegunaan" class="k-edit-field" >
        <input name="Kegunaan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Harga_Dasar">Harga :</label></div>
    <div data-container-for="Harga_Dasar" class="k-edit-field" >
        <input name="Harga_Dasar" style="margin-left:10px" type="number">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <a id="exportpdf" class="k-button k-button-icontext" href='{{asset("/cetak_list_obat")}}' target='_blank'><span class="k-icon k-i-file-pdf"></span>Cetak Data</a>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
      <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
      <span class="k-input-icon"></span>
    </span>
</script>

<script>

 $(function(){

    $("#exportpdf").on("click", function(e){
        window.open('{{asset("/cetak_list_obat")}}', '_blank');
    })

    var cari = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            options.data.cari = cari;
            $.ajax({
              url : '{{ url('farmasi/Inventory_Obat/read') }}',
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
            options.data.Jenis_Obat_Id = $('input[name="Jenis_Obat_Id"]').data('kendoDropDownList').value();
            options.data.Kategori_Obat_Id = $('input[name="Kategori_Obat_Id"]').data('kendoDropDownList').value();
            options.data.Golongan_Obat_Id = $('input[name="Golongan_Obat_Id"]').data('kendoDropDownList').value();
            options.data.Satuan_Obat_Id = $('input[name="Satuan_Obat_Id"]').data('kendoDropDownList').value();
            options.data.Industri_Farmasi_Id = $('input[name="Industri_Farmasi_Id"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('farmasi/Inventory_Obat/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                // options.success(res);
                // console.log(res);
                kendo.alert("Data Inventory berhasil ditambahkan");
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
            
          },

          update: function(options){
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('farmasi/Inventory_Obat/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                // options.success(res);
                kendo.alert("Data Inventory berhasil diedit");
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
          },
          
          destroy: function(options){
            $.ajax({
              url : '{{ url('farmasi/Inventory_Obat/hapus') }}',
              dataType:'json',
              type:'GET',
              data:options.data,
              success:function(res){
                // options.success(res);
                kendo.alert("Data Inventory berhasil dihapus");
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
            id: 'Obat_Id'
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {
          field: 'Kode_Obat',
          title: 'Kode',
          width: '70px',
          headerAttributes:{style: "text-align: center;"}
        },
        {
          field: 'Nama_Obat',
          title: 'Nama',
          headerAttributes:{style: "text-align: center;"},
          attributes:{style: "text-align: center;"}
        },
        {
          field: 'Jenis_Obat_Id',
          title: 'Jenis Obat/BHP',
          template:"#if(data.Jenis_Obat_Id == null){# - #}else{# #=data.Jenis_Obat# #}#",
          headerAttributes:{style: "text-align: center;"},
          attributes:{style: "text-align: center;"}
        },
        {
          field: 'Kategori_Obat_Id',
          title: 'Kategori Obat/BHP',
          template:"#if(data.Kategori_Obat_Id == null){# - #}else{# #=data.Kategori_Obat# #}#",
          headerAttributes:{style: "text-align: center;"},
          attributes:{style: "text-align: center;"}
        },
        {
          field: 'Golongan_Obat_Id',
          title: 'Golongan Obat/BHP',
          template:"#if(data.Golongan_Obat_Id == null){# - #}else{# #=data.Golongan_Obat# #}#",
          headerAttributes:{style: "text-align: center;"},
          attributes:{style: "text-align: center;"}
        },
        {
          field: 'Satuan_Obat_Id',
          title: 'Satuan Obat/BHP',
          template:"#if(data.Satuan_Obat_Id == null){# - #}else{# #=data.Satuan_Obat# #}#",
          headerAttributes:{style: "text-align: center;"},
          attributes:{style: "text-align: center;"}
        },
        {
          field: 'Harga_Dasar',
          title: 'Harga',
          width: '100px',
          headerAttributes:{style: "text-align: center;"},
          format:'{0:c}',
          attributes:{style: "text-align: right;"}
        },
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command: [
        {
          name: "edit",
          text: {
            edit: "Edit",
            update: "Simpan",
            cancel: "Batal"
          }
        },
        {
          name: "destroy",
          iconClass: "k-icon k-i-close",
          text: "Hapus"
        }
        ],
        width: '180px'},

        ],
      pageable: true,
      detailTemplate: kendo.template($("#templateDetail").html()),
      detailInit: detailInit,
      editable: {
        mode:"popup",
        template: $("#template").html(),
      },

      
      edit : function(e) {
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.parent().find('input[name="Jenis_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Jenis_Obat",
            dataValueField: "Jenis_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getJenisObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Kategori_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Kategori_Obat",
            dataValueField: "Kategori_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKategoriObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Golongan_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Golongan_Obat",
            dataValueField: "Golongan_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getGolonganObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Satuan_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Satuan_Obat",
            dataValueField: "Satuan_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getSatuanObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Industri_Farmasi_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Nama_Industri_Farmasi",
            dataValueField: "Industri_Farmasi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getIndustriFarmasi')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Harga_Dasar"]').kendoNumericTextBox({ format: "c"});

      }
    })
    
    $('#cari').keyup(function(e){
      cari = $('#cari').val();
      $('#grid').data('kendoGrid').dataSource.read();
    })

})

function detailInit(e) {
  var detailRow = e.detailRow;
  var data = e.data;
  console.log(data);

  detailRow.find(".tabstrip").kendoTabStrip({
      animation: {
          open: { effects: "fadeIn" }
      }
  });

}

</script>

@endsection