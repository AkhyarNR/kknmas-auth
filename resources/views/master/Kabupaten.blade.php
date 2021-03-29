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
            <h3>Master Kabupaten</h3>
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
              url : '{{ url('master/Kabupaten/read') }}',
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
            options.data.Provinsi_Id = $('input[name="Provinsi_Id"]').data('kendoDropDownList').value()
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Kabupaten/create') }}',
              type: 'post',
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
              url : '{{ url('master/Kabupaten/update') }}',
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
              url : '{{ url('master/Kabupaten/hapus') }}',
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
            id: 'Kabupaten_Id',
            fields:{
               no:{ editable:false}
            }
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      
      columns:[
        {field: 'no', title: 'No'},
        {field: 'Provinsi_Id', title: 'Provinsi',template:'#: data.Nama_Provinsi#'},
        {field: 'Nama_Kabupaten', title: 'Kabupaten'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

        ],
      pageable: true,
      editable: 'inline',
      edit : function(e) {
        e.container.parent().find('input[name="Provinsi_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Provinsi-",
            dataTextField: "Nama_Provinsi",
            dataValueField: "Provinsi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getProvinsi')}}",
                        dataType: "json"
                    }
                }
            }
        })
      }
    })

  }) 
    

</script>

@endsection