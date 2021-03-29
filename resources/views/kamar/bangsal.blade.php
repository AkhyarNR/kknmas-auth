@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Master Data Bangsal -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Data Bangsal</h3>
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




<script>

  $(function(){

    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            $.ajax({
              url : '{{ url('kamar/Bangsal/read') }}',
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
              url : '{{ url('kamar/Bangsal/create') }}',
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
              url : '{{ url('kamar/Bangsal/update') }}',
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
              url : '{{ url('kamar/Bangsal/hapus') }}',
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
            id: 'Bangsal_Id'
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      
      columns:[

        {field: 'Kode_Bangsal', title: 'Kode Bangsal', headerAttributes:{
          style: "text-align: center;"
        }},
        {field: 'Nama_Bangsal', title: 'Nama Bangsal', headerAttributes:{
          style: "text-align: center;"
        }},
        {field: '', title: 'Kapasitas', template: "#:data.kapasitas_bangsal# Kamar", headerAttributes:{
          style: "text-align: center;"
        }},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']}
      ],
      pageable: true,
      editable: 'inline'
    })

  }) 
    

</script>

@endsection