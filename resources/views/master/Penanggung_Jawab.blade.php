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
            <h3>Master Penanggung Jawab</h3>
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
              url : '{{ url('master/Penanggung_Jawab/read') }}',
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
            options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoDropDownList').value()
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Penanggung_Jawab/create') }}',
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
              url : '{{ url('master/Penanggung_Jawab/update') }}',
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
              url : '{{ url('master/Penanggung_Jawab/hapus') }}',
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
            id: 'Pasien_Penanggung_Jawab_Id',
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
        {field: 'Pasien_Id', title: 'Nama Pasien',template:'#: data.Nama#'},
        {field: 'Nama_Penanggung_Jawab', title: 'Penanggung Jawab'},
        {field: 'Alamat', title: 'Alamat'},
        {field: 'No_Hp', title: 'No Hp'},
        {field: 'Hubungan_Kerabat_Id', title: 'Hubungan Kerabat'},
        {field: 'Pekerjaan', title: 'Pekerjaan'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},

        ],
      pageable: true,
      editable: 'inline',
      edit : function(e) {
        e.container.parent().find('input[name="Pasien_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Pasien-",
            dataTextField: "Nama",
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPasien')}}",
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