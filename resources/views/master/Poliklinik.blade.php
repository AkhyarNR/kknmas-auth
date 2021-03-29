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
            <h3>Master Poliklinik</h3>
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
              url : '{{ url('master/Poliklinik/read') }}',
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
            options.data.Is_Buka = $('input[name="Is_Buka"]').data('kendoDropDownList').value()
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Poliklinik/create') }}',
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
              url : '{{ url('master/Poliklinik/update') }}',
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
              url : '{{ url('master/Poliklinik/hapus') }}',
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
            id: 'Poliklinik_Id',
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
        {field: 'Kode_Poliklinik', title: 'Kode_Poliklinik'},
        {field: 'Nama_Poliklinik', title: 'Nama_Poliklinik'},
        {field: 'Is_Buka', title: 'di buka',width: 100,
               template:function (e) {
                   if (e.Is_Buka==0) {
                       return '<i style="color:red">di Tutup</i>'
                   }
                   if (e.Is_Buka==1) {
                       return '<i style="color:green">di Buka</i>'
                   }
               }},
               {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

        ],
      pageable: true,
      editable: 'inline',
      edit : function(e) {
        e.container.parent().find('input[name="Is_Buka"]').kendoDropDownList({
            dataSource: [
                { Is_Buka: "Tutup", Is_BukaId: 0 },
                { Is_Buka: "Buka", Is_BukaId: 1 }
            ],
            dataTextField: "Is_Buka",
            dataValueField: "Is_BukaId",
            optionLabel: {
                Is_Buka: "-Pilih-",
                Is_BukaId: ""
            }
        })
      }
    })

  }) 
    

</script>

@endsection