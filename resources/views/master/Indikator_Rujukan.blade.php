@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Indikator Lab Patologi-Klinik -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Indikator Lab Patologi-Klinik</h3>
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
</style>

<script type="text/x-kendo-template" id="template">
    <div class="k-edit-label"><label for="Indikator_Pemeriksaan_Id">Indikator Pemeriksaan :</label></div>
    <div data-container-for="Indikator_Pemeriksaan_Id" class="k-edit-field" >
        <input name="Indikator_Pemeriksaan_Id" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Rujukan_Id">Nilai Rujukan :</label></div>
    <div data-container-for="Rujukan_Id" class="k-edit-field" >
        <input name="Rujukan_Id" style="margin-left:10px;">
    </div>
    <div class="k-edit-label"><label for="Satuan_Id">Satuan :</label></div>
    <div data-container-for="Satuan_Id" class="k-edit-field" >
        <input name="Satuan_Id" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Metode_Id">Metoda :</label></div>
    <div data-container-for="Metode_Id" class="k-edit-field" >
        <input name="Metode_Id" style="margin-left:10px">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>
</script>

<script>

 $(function(){

    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            $.ajax({
              url : '{{ url('master/IndikatorRujukan/read') }}',
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
            options.data.Satuan_Id = $('input[name="Satuan_Id"]').data('kendoDropDownList').value();
            options.data.Metode_Id = $('input[name="Metode_Id"]').data('kendoDropDownList').value();
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            options.data.Rujukan_Id = $('input[name="Rujukan_Id"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorRujukan/create') }}',
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
            options.data.Satuan_Id = $('input[name="Satuan_Id"]').data('kendoDropDownList').value();
            options.data.Metode_Id = $('input[name="Metode_Id"]').data('kendoDropDownList').value();
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoDropDownList').value();
            options.data.Rujukan_Id = $('input[name="Rujukan_Id"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorRujukan/update') }}',
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
              url : '{{ url('master/IndikatorRujukan/hapus') }}',
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
            id: 'Indikator_Rujukan_Id',
            fileds:{
              Nilai_Rujukan: {type:"number" }
            }
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {
          field: 'Indikator_Pemeriksaan',
          title: 'Indikator Pemeriksaan',
          headerAttributes:{style: "text-align: center;"}
        },
        {
          field: 'Rujukan_Id',
          title: 'Nilai Rujukan',
          template:"#if(data.Rujukan_Id == null){# - #}else{# #=data.Nama_Rujukan# #}#",
          headerAttributes:{style: "text-align: center;"}
        },
        {
          field: 'Satuan_Id',
          title: 'Satuan',
          template:"#if(data.Satuan_Id == null){# - #}else{# #=data.Satuan# #}#",
          headerAttributes:{style: "text-align: center;"}
        },
        {
          field: 'Metode_Id',
          title: 'Metoda',
          template:"#if(data.Metode_Id == null){# - #}else{# #=data.Nama_Metode# #}#",
          headerAttributes:{style: "text-align: center;"}
        },
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command: [
        {
          name: "edit",
          text: {
            edit: "Edit",
            update: "Simpan",
            cancel: "Batal"
          }
        },
        {
          name: "destroy",
          iconClass: "k-icon k-i-close",
          text: "Hapus"
        }
        ]},
        ],
      pageable: true,
      editable: {
        mode:"popup",
        template: $("#template").html(),
      },

      
      edit : function(e) {
        $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

        e.container.parent().find('input[name="Indikator_Pemeriksaan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Indikator Pemeriksaan-",
            dataTextField: "Indikator_Pemeriksaan",
            dataValueField: "Indikator_Pemeriksaan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getIndikatorPemeriksaan')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Rujukan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Nilai Rujukan-",
            dataTextField: "Nama_Rujukan",
            dataValueField: "Rujukan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getRujukanSaja')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Satuan_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Satuan-",
            dataTextField: "Satuan",
            dataValueField: "Satuan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getSatuan')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Metode_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Metoda-",
            dataTextField: "Nama_Metode",
            dataValueField: "Metode_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getMetode')}}",
                        dataType: "json"
                    }
                }
            }
        });

      }
    })

})

</script>

@endsection