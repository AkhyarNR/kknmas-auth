@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Satuan Lab -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Satuan Lab</h3>
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
              url : '{{ url('master/Satuan/read') }}',
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
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Satuan/create') }}',
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
              url : '{{ url('master/Satuan/update') }}',
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
              url : '{{ url('master/Satuan/hapus') }}',
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
            id: 'Satuan_Id'
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'Kode_Satuan', title: 'Kode', width: 100, headerAttributes:{style: "text-align: center;"}},
        {field: 'Satuan', title: 'Satuan Lab', headerAttributes:{style: "text-align: center;"}},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy'],
        attributes:{style: "text-align: center;"}
        }
        ],
      pageable: true,
      editable: {
        mode:"inline"
      },

      
      edit : function(e) {
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

      }
    })

})

</script>

@endsection