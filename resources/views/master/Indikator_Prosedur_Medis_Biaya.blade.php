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
            <h3>Master Indikator Biaya Prosedur Medis</h3>
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
              url : '{{ url('master/IndikatorProsedurMedisBiaya/read') }}',
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
            options.data.Prosedur_Medis_Biaya_Id = $('input[name="Prosedur_Medis_Biaya_Id"]').data('kendoDropDownList').value();
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorProsedurMedisBiaya/create') }}',
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
            options.data.Prosedur_Medis_Biaya_Id = $('input[name="Prosedur_Medis_Biaya_Id"]').data('kendoDropDownList').value();
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorProsedurMedisBiaya/update') }}',
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
              url : '{{ url('master/IndikatorProsedurMedisBiaya/hapus') }}',
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
                        id: 'Prosedur_Indikator_Biaya_Medis_Id',
                        fields: {
                          no:{ editable:false},
                        }
                      } 
                    }
          },
      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'no', title: 'No',width:100},
        {field: 'Indikator_Pemeriksaan_Id', title: 'Indikator Pemeriksaan', template: '#: data.Indikator_Pemeriksaan#'},
        {field: 'Prosedur_Medis_Biaya_Id', title: 'Prosedur Medis', template: '#: data.Deskripsi_Panjang#'},
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:['edit','destroy']},
      ],
      scrollable: true,
      navigatable: true,
      sortable: true,
      pageable: true,
      editable: 'inline',
      edit : function(e) {
        e.container.parent().find('[name="Prosedur_Medis_Biaya_Id"]').kendoDropDownList({
                    placeholder: "Select Prosedur...",
                    dataTextField: "Deskripsi_Panjang",
                    dataValueField: "Prosedur_Medis_Biaya_Id",
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
                                url: "{{route('dropdown.getProsedurBiaya')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Prosedur_Medis_Biaya_Id"]').data('kendoDropDownList').value(e.model.Prosedur_Medis_Biaya_Id);

                e.container.parent().find('[name="Indikator_Pemeriksaan_Id"]').kendoDropDownList({
                    placeholder: "Select Indikator...",
                    dataTextField: "Indikator_Pemeriksaan",
                    dataValueField: "Indikator_Pemeriksaan_Id",
                    filter: "contains",
                    suggest: true,
                    scrollable:true,
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
                                url: "{{route('dropdown.getIndikator')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Indikator_Pemeriksaan_Id"]').data('kendoDropDownList').value(e.model.Indikator_Pemeriksaan_Id);
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