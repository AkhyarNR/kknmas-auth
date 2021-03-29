@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<style>
  div.k-window-titlebar {
    width: 530px;
    height: auto;
  }
  div.k-popup-edit-form {
    width: 530px;
    height: auto;
  }
  div.k-edit-form-container {
    width: auto;
    height: auto;
  }
  .k-edit-form-container .editor-label, .k-edit-label {
    float: left;
    clear: both;
    width: 30%;
    padding: .4em 0 1em;
    margin-left: 2%;
    text-align: right;
  }
</style>

<!-- Data Indikator Lab Andrologi -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Master Indikator Rujukan Lab Andrologi</h3>
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
        <input name="Indikator_Pemeriksaan_Id" style="margin-left:10px; width: 300px;" data-bind="value:Indikator_Pemeriksaan_Id">
    </div>
    <div class="k-edit-label"><label for="Rujukan_WHO">Rujukan WHO 2010 :</label></div>
    <div data-container-for="Rujukan_WHO" class="k-edit-field" >
        <input name="Rujukan_WHO" style="margin-left:10px; width: 300px;" data-bind="value:Rujukan_WHO">
    </div>
    <div class="k-edit-label"><label for="Rujukan_Persandi">Rujukan PERSANDI 2015 :</label></div>
    <div data-container-for="Rujukan_Persandi" class="k-edit-field" >
        <input name="Rujukan_Persandi" style="margin-left:10px; width: 300px;" data-bind="value:Rujukan_Persandi">
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
              url : '{{ url('master/IndikatorRujukanAndrologi/read') }}',
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
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoComboBox').value();
            options.data.Rujukan_WHO = $('input[name="Rujukan_WHO"]').data('kendoDropDownList').value();
            options.data.Rujukan_Persandi = $('input[name="Rujukan_Persandi"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorRujukanAndrologi/create') }}',
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
            options.data.Indikator_Pemeriksaan_Id = $('input[name="Indikator_Pemeriksaan_Id"]').data('kendoComboBox').value();
            options.data.Rujukan_WHO = $('input[name="Rujukan_WHO"]').data('kendoDropDownList').value();
            options.data.Rujukan_Persandi = $('input[name="Rujukan_Persandi"]').data('kendoDropDownList').value();

            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('master/IndikatorRujukanAndrologi/update') }}',
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
              url : '{{ url('master/IndikatorRujukanAndrologi/hapus') }}',
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
            id: 'Indikator_Rujukan_Lab_Id'
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
          field: 'Nilai_Rujukan1',
          title: 'Rujukan WHO 2010',
          headerAttributes:{style: "text-align: center;"}
        },
        {
          field: 'Nilai_Rujukan2',
          title: 'Rujukan PERSANDI 2015',
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
        console.log(e.model.isNew());
        $('.k-window-title').text(e.model.isNew() ? "kjhjk Data" : "Edit Data");

        e.container.parent().find('input[name="Indikator_Pemeriksaan_Id"]').kendoComboBox({
            optionLabel: "-Pilih Indikator Pemeriksaan-",
            dataTextField: "Indikator_Pemeriksaan",
            dataValueField: "Indikator_Pemeriksaan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getIndikatorPemeriksaanAndrologi')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Rujukan_WHO"]').kendoDropDownList({
            optionLabel: "-Pilih Rujukan-",
            dataTextField: "Nilai_Rujukan",
            dataValueField: "Rujukan_Lab_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getRujukanLab')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Rujukan_Persandi"]').kendoDropDownList({
            optionLabel: "-Pilih Rujukan-",
            dataTextField: "Nilai_Rujukan",
            dataValueField: "Rujukan_Lab_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getRujukanLab')}}",
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