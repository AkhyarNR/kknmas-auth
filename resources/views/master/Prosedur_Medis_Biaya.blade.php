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
            <h3>Master Biaya Prosedur Medis</h3>
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
  .k-list-container ul {
    overflow: hidden!important;
}
  </style>


<script type="text/x-kendo-template" id="template">
  <div class="k-edit-label"><label for="Prosedur_Medis_Id">Prosedur :</label></div>
  <div data-container-for="Prosedur_Medis_Id" class="k-edit-field" >
    <input name="Prosedur_Medis_Id" style="margin-left:10px; width: 400px;" data-placeholder="Select Prosedur...">
  </div>

  <div class="k-edit-label"><label for="Jenis_Pegawai_Id">Janis Pegawai :</label></div>
  <div data-container-for="Jenis_Pegawai_Id" class="k-edit-field" >
    <input name="Jenis_Pegawai_Id" multiple style="margin-left:10px; width: 400px;" data-placeholder="Select Jenis Pegawai...">
  </div>
  
  <div class="k-edit-label"><label for="Work_Unit_Id">Work Unit :</label></div>
  <div data-container-for="Work_Unit_Id" class="k-edit-field" >
      <input name="Work_Unit_Id" style="margin-left:10px; width: 400px;" data-placeholder="Select Work Unit...">
  </div>

  <div class="k-edit-label"><label for="Jenis_Pemeriksaan_Id">Jenis Pemeriksaan :</label></div>
  <div data-container-for="Jenis_Pemeriksaan_Id" class="k-edit-field" >
      <input name="Jenis_Pemeriksaan_Id" style="margin-left:10px; width: 400px;" data-placeholder="Select Jenis Pemeriksaan...">
  </div>

  <div class="k-edit-label"><label for="Index">Index :</label></div>
  <div data-container-for="Index" class="k-edit-field" >
      <input name="Index" type="number" style="margin-left:10px; width: 400px;">
  </div>

  <div class="k-edit-label"><label for="Jasa_Medis">Jasa Medis :</label></div>
  <div data-container-for="Jasa_Medis" class="k-edit-field" >
      <input name="Jasa_Medis" type="number" style="margin-left:10px; width: 400px;">
  </div>

  <div class="k-edit-label"><label for="Hak_RS">Hak RS :</label></div>
  <div data-container-for="Hak_RS" class="k-edit-field" >
      <input name="Hak_RS" type="number" style="margin-left:10px; width: 400px;">
  </div>

  <div class="k-edit-label"><label for="BHP">BHP :</label></div>
  <div data-container-for="BHP" class="k-edit-field" >
      <input name="BHP" type="number" style="margin-left:10px; width: 400px;" data-placeholder="Select BHP...">
  </div>

  <div class="k-edit-label"><label for="Pajak">Pajak :</label></div>
  <div data-container-for="Pajak" class="k-edit-field" >
      <input name="Pajak" type="number" style="margin-left:10px; width: 400px;" data-placeholder="Select Pajak...">
  </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
  <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>

  <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
  <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
      <span class="k-input-icon">
      </span>
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
              url : '{{ url('master/ProsedurMedisBiaya/read') }}',
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
            options.data.Prosedur_Medis_Id = $('input[name="Prosedur_Medis_Id"]').data('kendoDropDownList').value();
            options.data.Jenis_Pegawai_Id = $('input[name="Jenis_Pegawai_Id"]').data('kendoDropDownList').value();
            options.data.Work_Unit_Id = $('input[name="Work_Unit_Id"]').data('kendoDropDownList').value();
            options.data.Jenis_Pemeriksaan_Id = $('input[name="Jenis_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/ProsedurMedisBiaya/create') }}',
              type: 'POST',
              dataType: 'json',
              data: options.data,
              success:function(res){
                if(res){
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Data Berhasil Ditambah!!',
                                       type: "success",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Ok!",   
                                   })
                  // console.log(res);
                }else{
                  swal({
                                       title: 'Error',
                                       text: 'ERROR!!',
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
            options.data.Prosedur_Medis_Id = $('input[name="Prosedur_Medis_Id"]').data('kendoDropDownList').value();
            options.data.Jenis_Pegawai_Id = $('input[name="Jenis_Pegawai_Id"]').data('kendoDropDownList').value();
            options.data.Work_Unit_Id = $('input[name="Work_Unit_Id"]').data('kendoDropDownList').value();
            options.data.Jenis_Pemeriksaan_Id = $('input[name="Jenis_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/ProsedurMedisBiaya/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                if(res){
                  options.success(res);
                  swal({
                                       title: 'Success',
                                       text: 'Data Berhasil Diubah!!',
                                       type: "success",
                                       confirmButtonColor: "#2a3f53",
                                       confirmButtonText: "Ok!",   
                                   })
                  // console.log(res);
                }else{
                  swal({
                                       title: 'Error',
                                       text: 'ERROR!!',
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
              url : '{{ url('master/ProsedurMedisBiaya/hapus') }}',
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
                        id: 'Prosedur_Medis_Biaya_Id',
                        fields: {
                          no:{ editable:false},
                          
                          Prosedur_Medis_Id: {
                              type: "text",
                          },
                          Jenis_Pegawai_Id: {
                              type: "text",
                          },
                          Work_Unit_Id: {
                              type: "text",
                          },
                          Jenis_Pemeriksaan_Id: {
                              type: "text",
                          },
                          Index: {
                              type: "number",
                          },
                          Jasa_Medis: {
                              type: "number",
                          },
                          Hak_RS: {
                              type: "number",
                          },
                          BHP: {
                              type: "number",
                          },
                          Pajak: {
                              type: "number",
                          },
                        }
                      } 
                    }
          },
      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'no', title: 'No',width:50},
        {field: 'Prosedur_Medis_Id', title: 'Prosedur Medis', template: '#: data.Deskripsi_Panjang#'},
        {field: 'Jenis_Pegawai_Id', title: 'Jenis Pegawai', template: '#: data.Description#'},
        {field: 'Work_Unit_Id', title: 'Work Unit', template: '#: data.Work_Unit_Name#'},
        {field: 'Jenis_Pemeriksaan_Id', title: 'Jenis Pemeriksaan', template: '#: data.Jenis_Pemeriksaan#'},
        {field: 'Index', title: 'Index', format:'{0:c}'},
        {field: 'Jasa_Medis', title: 'Jasa Medis', format:'{0:c}'},
        {field: 'Hak_RS', title: 'Hak RS', format:'{0:c}'},
        {field: 'BHP', title: 'BHP', format:'{0:c}'},
        {field: 'Pajak', title: 'Pajak', format:'{0:c}'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},
      ],
      scrollable: true,
      navigatable: true,
      sortable: true,
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
        
        e.container.parent().find('input[name="Prosedur_Medis_Id"]').kendoDropDownList({
                    optionLabel: "-Pilih Prosedur-",
                    placeholder: "Select Prosedur...",
                    dataTextField: "Deskripsi_Panjang",
                    dataValueField: "Prosedur_Medis_Id",
                    filter: "contains",
                    suggest: true,
                    height: 520,
                      virtual: {
                          itemHeight: 26,
                          valueMapper: function(options) {
                              $.ajax({
                                  url: "https://demos.telerik.com/kendo-ui/service/Orders/ValueMapper",
                                  type: "GET",
                                  dataType: "jsonp",
                                  data: convertValues(options.value),
                                  success: function (data) {
                                      options.success(data);
                                  }
                              })
                          }
                      },
                    dataSource:{
                        transport:{
                            read:{
                                type: "GET",
                                url: "{{route('dropdown.getProsedur')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Prosedur_Medis_Id"]').data('kendoDropDownList').value(e.model.Prosedur_Medis_Id);

                e.container.parent().find('input[name="Jenis_Pegawai_Id"]').kendoDropDownList({
                    optionLabel: "-Pilih Jenis Pegawai-",
                    placeholder: "Select Jenis Pegawai...",
                    dataTextField: "Description",
                    dataValueField: "Jenis_Pegawai_Id",
                    filter: "contains",
                    suggest: true,
                    scrollable:true,
                    height: 520,
                    dataSource:{
                        transport:{
                            read:{
                                type: "GET",
                                url: "{{route('dropdown.getJenisPegawai')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Jenis_Pegawai_Id"]').data('kendoDropDownList').value(e.model.Jenis_Pegawai_Id);
                
                e.container.parent().find('input[name="Work_Unit_Id"]').kendoDropDownList({
                    optionLabel: "-Pilih Poliklinik-",
                    dataTextField: "Work_Unit_Name",
                    dataValueField: "Work_Unit_Id",
                    filter: "contains",
                    suggest: true,
                    scrollable:true,
                    height: 520,
                    dataSource:{
                        transport:{
                            read:{
                                type: "GET",
                                url: "{{route('dropdown.getWorkUnitAll')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Work_Unit_Id"]').data('kendoDropDownList').value(e.model.Work_Unit_Id);
           
                e.container.parent().find('input[name="Jenis_Pemeriksaan_Id"]').kendoDropDownList({
                optionLabel: "-Pilih Jenis Pemeriksaan-",
                    dataTextField: "Jenis_Pemeriksaan",
                    dataValueField: "Jenis_Pemeriksaan_Id",
                    filter: "contains",
                    suggest: true,
                    scrollable:true,
                    height: 520,
                    dataSource:{
                        transport:{
                            read:{
                                type: "GET",
                                url: "{{route('dropdown.getJenisPemeriksaan')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Jenis_Pemeriksaan_Id"]').data('kendoDropDownList').value(e.model.Jenis_Pemeriksaan_Id);
      }    
    })

    function convertValues(value) {
            var data = {};

            value = $.isArray(value) ? value : [value];

            for (var idx = 0; idx < value.length; idx++) {
                data["values[" + idx + "]"] = value[idx];
            }

            return data;
      }

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
    })

  }) 
    

</script>

@endsection