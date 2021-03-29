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
            <h3>Surat Perijinan KKN</h3>
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
    <!-- <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button> -->

    <!-- <a id="exportpdf" class="k-button k-button-icontext" href='{{asset("/cetak_listpasien")}}' target='_blank'><span class="k-icon k-i-file-pdf"></span>Export PDF</a> -->

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>



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
      // toolbar:[{
      // name:'create',text:'Tambah Data',
      // }],
      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'Agama', title: 'No'},
        {field: 'Agama', title: 'Periode KKN'},
        {field: 'Agama', title: 'Daerah Perijinan'},
        {field: 'Agama', title: 'File'},
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