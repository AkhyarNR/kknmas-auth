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
            <h3>Master Shift</h3>
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
    div.k-edit-form-container {
        width: auto;
        height: auto;
    }

</style>

<script type="text/x-kendo-template" id="template">
    <div class="k-edit-label"><label for="Poliklinik_Id">Poliklinik :</label></div>
    <div data-container-for="Poliklinik_Id" class="k-edit-field" >
      <input name="Poliklinik_Id" style="margin-left:10px; width: 400px;">
    </div>

    <div class="k-edit-label"><label for="Hari_Id">Hari :</label></div>
    <div data-container-for="Hari_Id" class="k-edit-field" >
      <input name="Hari_Id" multiple style="margin-left:10px; width: 400px;">
    </div>
    
    <div class="k-edit-label"><label for="Shift_Name">Nama Shift :</label></div>
    <div data-container-for="Shift_Name" class="k-edit-field">
        <input name="Shift_Name" style="margin-left:10px; width: 400px; ">
    </div>

    <div class="k-edit-label"><label for="Time_Start">Waktu Mulai :</label></div>
    <div data-container-for="Time_Start" class="k-edit-field" >
        <input name="Time_Start" data-bind="value:Time_Start" style="margin-left:10px; width: 400px;">
    </div>

    <div class="k-edit-label"><label for="Time_End">Waktu Berakhir :</label></div>
    <div data-container-for="Time_End" class="k-edit-field" >
        <input name="Time_End" style="margin-left:10px; width: 400px;">
    </div>

</script>


<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <input id="dropdown" name="dropdown">
    
</script>

<script>

$(function(){
      var dropdown = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.dropdown = dropdown;
            $.ajax({
              url : '{{ url('master/Shift/read') }}',
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
            options.data.Time_Start = (options.data.Time_Start == null) ? "" : kendo.toString(kendo.parseDate(options.data.Time_Start), 'hh:mm:ss');
            options.data.Time_End = (options.data.Time_End == null) ? "" : kendo.toString(kendo.parseDate(options.data.Time_End), 'hh:mm:ss');
            options.data.Poliklinik_Id = $('input[name="Poliklinik_Id"]').data('kendoDropDownList').value();
            options.data.Hari_Id = $('input[name="Hari_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Shift/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
                if(res){
                  
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Shift Berhasil Ditambahkan!!',
                                       type: "success",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Ok!",   
                                   })
                  // console.log(res);
                }else{
                  swal({
                                       title: 'Error',
                                       text: 'Shift Sudah Terisi!!',
                                       type: "error",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Pilih Ulang!",   
                                   })
                }
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
            
          },

          update: function(options){
            options.data.Time_Start = (options.data.Time_Start == null) ? "" : kendo.toString(kendo.parseDate(options.data.Time_Start), 'hh:mm:ss');
            options.data.Time_End = (options.data.Time_End == null) ? "" : kendo.toString(kendo.parseDate(options.data.Time_End), 'hh:mm:ss');
            options.data.Poliklinik_Id = $('input[name="Poliklinik_Id"]').data('kendoDropDownList').value();
            options.data.Hari_Id = $('input[name="Hari_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/Shift/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                options.success(res);
                if(res){
                  
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Shift Berhasil Diubah!!',
                                       type: "success",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Ok!",   
                                   })
                  // console.log(res);
                }else{
                  swal({
                                       title: 'Error',
                                       text: 'Shift Sudah Terisi!!',
                                       type: "error",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Pilih Ulang!",   
                                   })
                }
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
          },
          
          destroy: function(options){
            $.ajax({
              url : '{{ url('master/Shift/hapus') }}',
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
            id: 'Shift_Id'
          }
        }
      },
      toolbar:[{
      name:'create',text:'Tambah Data'
      }],
      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'no', title: 'No', width: '40px'},
        {field: 'Poliklinik_Id', title: 'Poliklinik',template:'#: data.Nama_Poliklinik #'},
        {field: 'Hari_Id', title: 'Hari',template:'#: data.Hari #'},
        {field: 'Shift_Name', title: 'Nama Shift'},
        {field: 'Time_Start', title: 'Waktu Mulai', template:"#: kendo.toString(kendo.parseDate(data.Time_Start), 'HH:mm tt') #"},
        {field: 'Time_End', title: 'Waktu Berakhir', template:"#: kendo.toString(kendo.parseDate(data.Time_End), 'HH:mm tt') #"},
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

        $(e.container).parent().css({
                    width: '700px',
                    height: 'auto'
        });

        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");


        e.container.parent().find('input[name="Poliklinik_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Poliklinik-",
            dataTextField: "Nama_Poliklinik",
            dataValueField: "Poliklinik_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPoliklinik')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Hari_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Hari-",
            dataTextField: "Hari",
            dataValueField: "Hari_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getHari')}}",
                        dataType: "json"
                    }
                }
            }
        })

        e.container.parent().find('input[name="Time_Start"]').kendoTimePicker({
       
           dateInput: true,
           format: 'hh:mm:ss'
        })

        e.container.parent().find('input[name="Time_End"]').kendoTimePicker({
  
           dateInput: true,
           format: 'hh:mm:ss'
        })

      }
    })

    $('#dropdown').kendoDropDownList({
            optionLabel: "-Pilih Poliklinik-",
            dataTextField: "Nama_Poliklinik",
            dataValueField: "Poliklinik_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPoliklinik')}}",
                        dataType: "json"
                    }
                }
            },
            change:function(e){
                dropdown = $('#dropdown').val();
                $('#grid').data('kendoGrid').dataSource.read();
            }
        })

  }) 

</script>

@endsection