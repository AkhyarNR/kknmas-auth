@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Master Prosedur Medis -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Prosedur Medis</h3>
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

<script type="text/x-kendo-template" id="toolbarTemplate">
  <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

  <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
    <span class="k-input-icon"></span>
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
              url : '{{ url('master/ProsedurMedis/read') }}',
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
              url : '{{ url('master/ProsedurMedis/create') }}',
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
              url : '{{ url('master/ProsedurMedis/update') }}',
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
              url : '{{ url('master/ProsedurMedis/hapus') }}',
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
            id: 'Prosedur_Medis_Id'
            // fields:{
            //     gapok1: {type:"number" }
            // }
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[

        {field: 'Kode_Prosedur', title: 'Kode', width: "100px",headerAttributes:{
            style: "text-align: center;"
        }},
        {field: 'Deskripsi_Panjang', title: 'Deskripsi Panjang', width: "480px",headerAttributes:{
            style: "text-align: center;"
        }},
        {field: 'Deskripsi_Pendek', title: 'Deskripsi Pendek', width: "240px",headerAttributes:{
            style: "text-align: center;"
        }},
        {command:['edit','destroy']}
      ],
      pageable: true,
      editable: 'inline'
      // edit : function(e) {
      //   e.container.parent().find('name["Kode_Jenis_Kelamin"]')
      //}
    })

    $('#cari').keyup(function(e){
      cari = $('#cari').val();
      $('#grid').data('kendoGrid').dataSource.read();
    })

  }) 
    

</script>

@endsection