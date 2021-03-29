@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Tindakan Medis -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Tindakan Medis</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="grid"></div>
            <script type="text/x-kendo-template" id="templateDetail">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Tindakan Medis
                        </li>
                    </ul>
                    <div>
                      <div class="Detaildata">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="private-separator mb-2"></div>
                                <ul class="tindakanmedis-detail">
                                    <li class="row">
                                        <label class="d-block col-md-3">Unit </label>
                                        <p class="col-md-6 private-content">
                                        : # if (unit == null) {# - #} else {# #= kendo.toString(unit, "c0") # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">KSO</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Kso == null) {# - #} else {# #= kendo.toString(Kso, "c0") # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Paket Obat</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Paket_Obat == null) {# - #} else {# #= kendo.toString(Paket_Obat, "c0") # #} #  
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Jasa RS</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Jasa_Rs == null) {# - #} else {# #= kendo.toString(Jasa_Rs, "c0") # #} # 
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Manajemen</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Manajemen == null) {# - #} else {# #= kendo.toString(Manajemen, "c0") # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Jasa Medis Dokter</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Jasa_Medis_Dokter == null) {# - #} else {# #= kendo.toString(Jasa_Medis_Dokter, "c0") # #} # 
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Jasa Medis Perawat</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Jasa_Medis_Perawat == null) {# - #} else {# #= kendo.toString(Jasa_Medis_Perawat, "c0") # #} # 
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Total Biaya Dokter</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Total_Biaya_Dokter == null) {# - #} else {# #= kendo.toString(Total_Biaya_Dokter, "c0") # #} # 
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Total Biaya Perawat</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Total_Biaya_Perawat == null) {# - #} else {# #= kendo.toString(Total_Biaya_Perawat, "c0") # #} # 
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
    <div class="k-edit-label"><label for="Kode_Tindakan_Perawatan">Kode Tindakan Medis :</label></div>
    <div data-container-for="Kode_Tindakan_Perawatan" class="k-edit-field" >
        <input name="Kode_Tindakan_Perawatan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Nama_Tindakan_Perawatan">Nama Tindakan Medis :</label></div>
    <div data-container-for="Nama_Tindakan_Perawatan" class="k-edit-field" >
        <textarea name="Nama_Tindakan_Perawatan" style="margin-left:10px; width:145px;"></textarea>
    </div>
    <div class="k-edit-label"><label for="Kategori_Tindakan_Id">Kategori Tindakan :</label></div>
    <div data-container-for="Kategori_Tindakan_Id" class="k-edit-field" >
        <input name="Kategori_Tindakan_Id" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="unit">Unit :</label></div>
    <div data-container-for="unit" class="k-edit-field" >
        <input name="unit" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Kso">KSO :</label></div>
    <div data-container-for="Kso" class="k-edit-field" >
        <input name="Kso" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Paket_Obat">Paket Obat :</label></div>
    <div data-container-for="Paket_Obat" class="k-edit-field" >
        <input name="Paket_Obat" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Jasa_Rs">Jasa RS :</label></div>
    <div data-container-for="Jasa_Rs" class="k-edit-field" >
        <input name="Jasa_Rs" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Manajemen">Manajemen :</label></div>
    <div data-container-for="Manajemen" class="k-edit-field" >
        <input name="Manajemen" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Jasa_Medis_Dokter">Jasa Medis Dokter :</label></div>
    <div data-container-for="Jasa_Medis_Dokter" class="k-edit-field" >
        <input name="Jasa_Medis_Dokter" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Jasa_Medis_Perawat">Jasa Medis Perawat :</label></div>
    <div data-container-for="Jasa_Medis_Perawat" class="k-edit-field" >
        <input name="Jasa_Medis_Perawat" style="margin-left:10px" type="number">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>
</script>

<script>

 $(function(){

    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            $.ajax({
              url : '{{ url('master/TindakanMedis/read') }}',
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
            options.data.Kategori_Tindakan_Id = $('input[name="Kategori_Tindakan_Id"]').data('kendoDropDownList').value();
            options.data.Total_Biaya = options.data.unit + options.data.Kso + options.data.Paket_Obat + options.data.Jasa_Rs + options.data.Manajemen + options.data.Jasa_Medis_Dokter + options.data.Jasa_Medis_Perawat;
            options.data.Total_Biaya_Dokter = options.data.Total_Biaya - options.data.Jasa_Medis_Perawat;
            options.data.Total_Biaya_Perawat = options.data.Total_Biaya - options.data.Jasa_Medis_Dokter;

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/TindakanMedis/create') }}',
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
            options.data.Total_Biaya = options.data.unit + options.data.Kso + options.data.Paket_Obat + options.data.Jasa_Rs + options.data.Manajemen + options.data.Jasa_Medis_Dokter + options.data.Jasa_Medis_Perawat;
            options.data.Total_Biaya_Dokter = options.data.Total_Biaya - options.data.Jasa_Medis_Perawat;
            options.data.Total_Biaya_Perawat = options.data.Total_Biaya - options.data.Jasa_Medis_Dokter;

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/TindakanMedis/update') }}',
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
              url : '{{ url('master/TindakanMedis/hapus') }}',
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
            id: 'Tindakan_Perawatan_Id',
            fileds:{
              unit: {type:"number" },
              Kso: {type:"number" },
              Paket_Obat: {type:"number" },
              Jasa_Rs: {type:"number" },
              Manajemen: {type:"number" },
              Jasa_Medis_Dokter: {type:"number" },
              Jasa_Medis_Perawat: {type:"number" },
              Total_Biaya_Dokter: {type:"number" },
              Total_Biaya_Perawat: {type:"number" },
            }
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'Kode_Tindakan_Perawatan', title: 'Kode', width: 100, headerAttributes:{style: "text-align: center;"}},
        {field: 'Nama_Tindakan_Perawatan', title: 'Nama Perawatan', headerAttributes:{style: "text-align: center;"}},
        {field: 'Nama_Kategori', title: 'Kategori Perawatan', headerAttributes:{style: "text-align: center;"}},
        {field: 'Total_Biaya', title: 'Tarif / Biaya', format:'{0:c}',attributes:{style: "text-align: right;",},headerAttributes:{style: "text-align: center;"}},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

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

        e.container.parent().find('input[name="Kategori_Tindakan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Nama_Kategori",
            dataValueField: "Kategori_Tindakan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKategoriTindakan')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="unit"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Kso"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Paket_Obat"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Jasa_Rs"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Manajemen"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Jasa_Medis_Dokter"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Jasa_Medis_Perawat"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Total_Biaya_Dokter"]').kendoNumericTextBox({ format: "c"});
        e.container.parent().find('input[name="Total_Biaya_Perawat"]').kendoNumericTextBox({ format: "c"});

      }
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