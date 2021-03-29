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
            <h3>Master Agama</h3>
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
          // read : function(options) {
          //   $.ajax({
          //     url : '{{ url('master/Agama/read') }}',
          //     type: 'GET',
          //     dataType: 'json',
          //     data: options.data,
          //     success: function(res) {
          //       options.success(res);
          //       console.log(res);
          //     }
          //   })
            
          // },

          create : function(options) {
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Agama/create') }}',
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
              url : '{{ url('master/Agama/update') }}',
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
              url : '{{ url('master/Agama/hapus') }}',
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
            id: 'Agama_Id'
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      
      columns:[
        {field: 'Agama', title: 'No'},
        {field: 'Agama', title: 'Nim'},
        {field: 'Agama', title: 'Nama'},
        {field: 'Agama', title: 'Prodi'},
        {field: 'Agama', title: 'Jenis Kelamin'},
        {field: 'Agama', title: 'Kelengkapan Dokumen'},
        {field: 'Agama', title: 'Validasi'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

        ],
      pageable: true,
      editable: 'inline'
      // edit : function(e) {
      //   e.container.parent().find('name["Kode_Jenis_Kelamin"]')
      //}
    })

  }) 
    

</script>

@endsection