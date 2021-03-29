@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Master Data Kelas -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Data Kelas</h3>
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
              url : '{{ url('kamar/Kelas/read') }}',
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
              url : '{{ url('kamar/Kelas/create') }}',
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
              url : '{{ url('kamar/Kelas/update') }}',
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
              url : '{{ url('kamar/Kelas/hapus') }}',
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
            id: 'Kelas_Id',
            fields:{
                Tarif_Dasar: {type:"number" }
            }
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      
      columns:[

        {field: 'Kode_Kelas', title: 'Kode Kelas', headerAttributes:{
          style: "text-align: center;"
        }},
        {field: 'Kelas', title: 'Kelas', headerAttributes:{
          style: "text-align: center;"
        }},
        {field: 'Tarif_Dasar', title: 'Tarif', format:'{0:c}', headerAttributes:{
          style: "text-align: center;"
        }, attributes:{
          style: "text-align: right;"
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