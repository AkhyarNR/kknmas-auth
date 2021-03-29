@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Kamar -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Diagnosa</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="grid"></div>
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
    <div class="k-edit-label"><label for="Kode_Diagnosa">Kode Penyakit :</label></div>
    <div data-container-for="Kode_Diagnosa" class="k-edit-field" >
        <input name="Kode_Diagnosa" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Nama_Penyakit">Nama Penyakit :</label></div>
    <div data-container-for="Nama_Penyakit" class="k-edit-field" >
        <input name="Nama_Penyakit" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Ciri_Penyakit">Ciri Penyakit :</label></div>
    <div data-container-for="Ciri_Penyakit" class="k-edit-field" >
        <input name="Ciri_Penyakit" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kategori_Penyakit_Id">Keterangan :</label></div>
    <div data-container-for="Keterangan" class="k-edit-field" >
        <input name="Keterangan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kategori_Penyakit_Id">Kategori Penyakit :</label></div>
    <div data-container-for="Kategori_Penyakit_Id" class="k-edit-field" >
        <input name="Kategori_Penyakit_Id" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Ciri_Umum">Ciri Umum :</label></div>
    <div data-container-for="Ciri_Umum" class="k-edit-field" >
        <input name="Ciri_Umum" style="margin-left:10px">
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
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            options.data.cari = cari;
            $.ajax({
              url : '{{ url('master/Diagnosa/read') }}',
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
            options.data.Kategori_Penyakit_Id = $('input[name="Kategori_Penyakit_Id"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Diagnosa/create') }}',
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
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Diagnosa/update') }}',
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
              url : '{{ url('master/Diagnosa/hapus') }}',
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
            id: 'Diagnosa_Id'
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'no', title: 'No',width:50},
        {field: 'Kode_Diagnosa', title: 'Kode'},
        {field: 'Nama_Penyakit', title: 'Nama Penyakit'},
        {field: 'Ciri_Penyakit', title: 'Ciri Penyakit'},
        {field: 'Keterangan', title: 'Keterangan'},
        {field: 'Kategori_Penyakit_Id', title: 'Kategori Penyakit',template:'#: data.Kategori_Penyakit#'},
        {field: 'Ciri_Umum', title: 'Ciri Umum'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

        ],
      pageable: true,
      editable: {
        mode:"popup",
        template: $("#template").html(),
      },

      
      edit : function(e) {
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.parent().find('input[name="Kategori_Penyakit_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Kategori_Penyakit",
            dataValueField: "Kategori_Penyakit_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKategoriPenyakit')}}",
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

})
    

</script>

@endsection