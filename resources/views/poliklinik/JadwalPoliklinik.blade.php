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
            <h3>Jadwal Poliklinik</h3>
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
    <div class="k-edit-label"><label for="Employee_Id">Nama Dokter | NIP :</label></div>
    <div data-container-for="Employee_Id" class="k-edit-field" >
      <input name="Dokter" style="margin-left:10px; width: 400px;" data-placeholder="Select Dokter...">
    </div>

    <div class="k-edit-label"><label for="Employee_Id">Nama Perawat | NIP :</label></div>
    <div data-container-for="Employee_Id" class="k-edit-field" >
      <input name="Perawat" multiple style="margin-left:10px; width: 400px;" data-placeholder="Select Perawat...">
    </div>
    
    <div class="k-edit-label"><label for="Shift_Id">Nama Shift | Poliklinik | Hari :</label></div>
    <div data-container-for="Shift_Id" class="k-edit-field" >
        <input name="Shift_Id" style="margin-left:10px; width: 400px;">
    </div>

    <div class="k-edit-label"><label for="Shift_Start">Waktu Mulai :</label></div>
    <div data-container-for="Shift_Start" class="k-edit-field" >
        <input name="Shift_Start" data-bind="value:Shift_Start" style="margin-left:10px; width: 400px;">
    </div>

    <div class="k-edit-label"><label for="Shift_End">Waktu Berakhir :</label></div>
    <div data-container-for="Shift_End" class="k-edit-field" >
        <input name="Shift_End" style="margin-left:10px; width: 400px;">
    </div>

</script>


<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

    <input id="dropdown" name="dropdown">

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>

    
</script>

<script>
  $(function(){
      var cari = null;
      var dropdown = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;
              options.data.dropdown = dropdown;
            $.ajax({
              url : '{{ url('poliklinik/JadwalPoliklinik/read') }}',
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
            
            options.data.Shift_Start = (options.data.Shift_Start == null) ? "" : kendo.toString(kendo.parseDate(options.data.Shift_Start), 'yyyy-MM-dd hh:mm:ss');
            options.data.Shift_End = (options.data.Shift_End == null) ? "" : kendo.toString(kendo.parseDate(options.data.Shift_End), 'yyyy-MM-dd hh:mm:ss');
            options.data.Dokter = $('input[name="Dokter"]').data('kendoDropDownList').value();
            options.data.Perawat = $('input[name="Perawat"]').data('kendoMultiSelect').value();
            options.data.Shift_Id = $('input[name="Shift_Id"]').data('kendoDropDownList').value();
            console.log(options.data);
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('poliklinik/JadwalPoliklinik/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                if(res){
                  
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Jawal Berhasil Ditambahkan!!',
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
            options.data.Shift_Start = (options.data.Shift_Start == null) ? "" : kendo.toString(kendo.parseDate(options.data.Shift_Start), 'yyyy-MM-dd hh:mm:ss');
            options.data.Shift_End = (options.data.Shift_End == null) ? "" : kendo.toString(kendo.parseDate(options.data.Shift_End), 'yyyy-MM-dd hh:mm:ss');
            options.data.Dokter = $('input[name="Dokter"]').data('kendoDropDownList').value();
            options.data.Perawat = $('input[name="Perawat"]').data('kendoMultiSelect').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('poliklinik/JadwalPoliklinik/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                if(res){
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Jadwal Berhasil Diubah!!',
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
              url : '{{ url('poliklinik/JadwalPoliklinik/hapus') }}',
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
            id: 'Employee_Shift_Id'
          }
        }
      },
      toolbar: kendo.template($("#toolbarTemplate").html()),

      columns:[
        {field: 'no', title: 'No',width:50},
        {field: 'Name', title: 'Nama Petugas',template:"#if(data.First_Title == null){# #=data.Name# #}else{# #=data.First_Title# #=data.Name# #}#"},
        {field: 'Poliklinik_Id', title: 'Nama Poliklinik',template:'#: data.Nama_Poliklinik#'},
        {field: 'Shift_Name', title: 'Nama Shift',template:'#: data.Shift_Name#',width:'120px'},
        {field: 'Hari_Id', title: 'Hari',template:'#: data.Hari#',width:90},
        {field: 'Shift_Start', title: 'Waktu Mulai', template:"#: kendo.toString(kendo.parseDate(data.Shift_Start), 'dd-MM-yyyy | HH:mm tt') #"},
        {field: 'Shift_End', title: 'Waktu Berakhir', template:"#: kendo.toString(kendo.parseDate(data.Shift_Start), 'dd-MM-yyyy | HH:mm tt') #"},
        
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

        e.container.parent().find("[name='Shift_Start']").kendoDateTimePicker({
          value: new Date(),
          dateInput: true,
          format: 'yyyy-MM-dd hh:mm:ss'
        })

        e.container.parent().find("[name='Shift_End']").kendoDateTimePicker({
          value: new Date(),
          dateInput: true,
          format: 'yyyy-MM-dd hh:mm:ss'
        })

        e.container.parent().find('input[name="Dokter"]').kendoDropDownList({
            optionLabel: "-Pilih Dokter-",
            dataTextField: "Name",
            dataValueField: "Employee_Id",
            template: '#:Name#  | #:Nip#',
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getDokter')}}",
                        dataType: "json"
                    }
                }
            }
        })

        // console.log(e);
        e.container.parent().find('input[name="Dokter"]').data("kendoDropDownList").value(e.model.Employee_Id);

        e.container.parent().find('input[name="Perawat"]').kendoMultiSelect({
            optionLabel: "-Pilih Dokter-",
            dataTextField: "Name",
            dataValueField: "Employee_Id",
            template: '#:Name#  | #:Nip#',
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getPerawat')}}",
                        dataType: "json"
                    }
                }
            }
        })


        e.container.parent().find('input[name="Shift_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Shift-",
            dataTextField: "Shift_Name",
            template: '#:Shift_Name# | #:Nama_Poliklinik# | #:Hari# ',
            dataValueField: "Shift_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getShift')}}",
                        dataType: "json"
                    }
                }
            }
        })

      }
    })

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
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