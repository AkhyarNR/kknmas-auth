@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Penjualan Obat -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Penjualan Obat</h3>
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

  .k-footer-template td:nth-child(1) {
    overflow: visible;
    white-space: nowrap;
  }

  .k-footer-template td:nth-child(1),
  .k-footer-template td:nth-child(2),
  .k-footer-template td:nth-child(3),
  .k-footer-template td:nth-child(4) {
    border-width: 0;
  }
</style>

<script type="text/x-kendo-template" id="template">
    <div class="k-edit-label"><label for="Kode_Tindakan_Perawatan">Kode Tindakan Medis :</label></div>
    <div data-container-for="Kode_Tindakan_Perawatan" class="k-edit-field" >
        <input name="Kode_Tindakan_Perawatan" style="margin-left:10px">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <input id="dropdown" name="dropdown">
    <label class="search-label" for="tglMulai">Mulai :</label>
    <input id="tglMulai" style="width: 100px;"/>
    <label class="search-label" for="tglSelesai">Sampai :</label>
    <input id="tglSelesai" style="width: 100px;"/>

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
      <input autocom"k-button k-grid-addplete="off" id="searchBox" placeholder="Search..." title="Search..." class="k-input">
      <span class="k-input-icon"></span>
    </span>

    <span style="float:right;>
    <a id="exportpdf" class="k-button k-button-icontext" onClick="cetakData()"><span class="k-icon k-i-file-pdf"></span>Cetak Data</a>
    </span>
</script>

<script type="text/javascript">

 $(function(){

    var dropdown = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            options.data.dropdown = dropdown;
            options.data.startDate = $("#tglMulai").val();
            options.data.endDate = $("#tglSelesai").val();
            $.ajax({
              url : '{{ url('farmasi/Penjualan_Obat/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
                console.log(res);
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
            // id: 'Obat_Id',
            fields:{
              penjualanObat: {type:"number" },
              pendapatanObat: {type:"number" }
            }
          }
        },
        aggregate: [{field: 'pendapatanObat', aggregate: "sum"}]
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'Kode_Obat', title: 'Kode', width: 100, headerAttributes:{style: "text-align: center;"}, attributes:{style: "text-align: center;"}},
        {field: 'Nama_Obat', title: 'Nama Obat', headerAttributes:{style: "text-align: center;"}, attributes:{style: "text-align: center;"}},
        {field: 'Jenis_Obat', title: 'Jenis Obat', headerAttributes:{style: "text-align: center;"}, attributes:{style: "text-align: center;"}, footerTemplate: "Total", footerAttributes: {style: "text-align: center;"}},
        {field: 'penjualanObat', title: 'Jumlah Penjualan', headerAttributes:{style: "text-align: center;"}, attributes:{style: "text-align: center;"}},
        {field: 'pendapatanObat', title: 'Jumlah Pendapatan', format:'{0:c}', attributes:{style: "text-align: right;"},
        headerAttributes:{style: "text-align: center;"},
        aggregates: ["sum"],
        footerTemplate: function (data) {
          console.log(data);
          return "<div>" + kendo.toString(data.pendapatanObat.sum, 'c') + "</div>";
        }, footerAttributes:{style: "text-align: right;"}}
        ],
      pageable: true,
      editable: false
    });

    function startChange() {
      var startDate = start.value(),
      endDate = end.value();

      $("#grid").data("kendoGrid").dataSource.read();

      if (startDate) {
          startDate = new Date(startDate);
          startDate.setDate(startDate.getDate());
          end.min(startDate);
      }else if (endDate) {
          start.max(new Date(endDate));
      }else {
          endDate = new Date();
          start.max(endDate);
          end.min(endDate);
        }
      }

    function endChange() {
      var endDate = end.value(),
      startDate = start.value();
      $("#grid").data("kendoGrid").dataSource.read();
      if (endDate) {
          endDate = new Date(endDate);
          endDate.setDate(endDate.getDate());
          start.max(endDate);
      }else if (startDate) {
          end.min(new Date(startDate));
      }else {
          endDate = new Date();
          start.max(endDate);
          end.min(endDate);
        }
      }

    var start = $("#tglMulai").kendoDatePicker({
      change: startChange,
      format: "dd-MM-yyyy"
    }).width(100).data("kendoDatePicker");

    var end = $("#tglSelesai").kendoDatePicker({
      change: endChange,
      format: "dd-MM-yyyy"
    }).width(100).data("kendoDatePicker");

    start.max(end.value());
    end.min(start.value());

    $('#dropdown').kendoDropDownList({
      optionLabel: "-Pilih Jenis Obat-",
      dataTextField: "Jenis_Obat",
      dataValueField: "Jenis_Obat_Id",
      dataSource:{
          transport:{
              read:{
                  type: "GET",
                  url: "{{route('dropdown.getJenisObat')}}",
                  dataType: "json"
              }
          }
      },
      change:function(e){
          dropdown = $('#dropdown').val();
          $('#grid').data('kendoGrid').dataSource.read();
        }
      })
    
    $("#searchBox").keyup(function () {
      var searchValue = $('#searchBox').val();
      $("#grid").data("kendoGrid").dataSource.filter({
        logic  : "or",
        filters: [
          {
            field   : "Nama_Obat",
            operator: "contains",
            value   : searchValue
          }
        ]
      });
    });

})

function cetakData(){
  var dropdown = $('#dropdown').val();
  var startDate = $("#tglMulai").val();
  var endDate = $("#tglSelesai").val();

  window.open('{{ url('cetak_Penjualan_Obat') }}?dropdown='+dropdown+'&startDate='+startDate+'&endDate='+endDate, '_blank')
}

</script>

@endsection