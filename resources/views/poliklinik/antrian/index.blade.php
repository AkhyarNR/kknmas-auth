@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
<style>
    div.k-window-titlebar {
      width: 520px;
      height: auto;
    }
    div.k-popup-edit-form {
      width: 520px;
      height: auto;
    }
    div.k-edit-form-container {
      width: auto;
      height: auto;
    }
</style>

<!-- Data Kamar -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Daftar Antrian</h3>
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
    <!-- <div class="k-edit-label"><label for="Employee_Id">Petugas :</label></div>
    <div data-container-for="Employee_Id" class="k-edit-field" >
        <input name="Employee_Id" style="margin-left:10px">
    </div> -->
    
    <div class="k-edit-label"><label for="Pasien_Id">Pasien :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" style="margin-left:10px" id="Pasien_Id" style="width: 100%;">
    </div>

    <div class="k-edit-label"><label for="Shift_Id">Shift :</label></div>
    <div data-container-for="Shift_Id" class="k-edit-field" >
        <input name="Shift_Id" style="margin-left:10px" id="Shift_Id">
    </div>

    <div class="k-edit-label"><label for="Dokter_Id">Dokter :</label></div>
    <div data-container-for="Dokter_Id" class="k-edit-field" >
        <input name="Dokter_Id" style="margin-left:10px" id="Dokter_Id">
    </div>

    <div class="k-edit-label"><label for="Poliklinik_Id">Poliklinik :</label></div>
    <div data-container-for="Poliklinik_Id" class="k-edit-field" >
        <input name="Poliklinik_Id" style="margin-left:10px" id="Poliklinik_Id">
    </div>
</script>


<script type="text/x-kendo-template" id="toolbarTemplate">
     <div class="float-left">
      <a role="button" class="k-button k-button-icontext k-grid-add" href="javascript:"><span class="k-icon k-i-plus"></span> Tambah Data</a>
    </div>

    <input id="dropdown" name="dropdown">

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="searchBox" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>  
</script>

<script type="text/x-kendo-template" id="PopupTemplate">
    #if(data.isNew()) {#
        #var createTemp = kendo.template($("\#createPopupTemplate").html());#
        #=createTemp(data)#
    #} else {#
        #var editTemp = kendo.template($("\#editPopupTemplate").html());#
        #=editTemp(data)#
    #}#
</script>

<script type="text/x-kendo-template" id="createPopupTemplate">
    <div id='tabstrip'>
      <ul>
        <li class='k-state-active'>Poliklinik</li>
        <li>Laboratorium</li>
        <li>Radiologi</li>
      </ul>
        
      <div>
        <div class="k-edit-label"><label for="Pasien_Id">Pasien :</label></div>
        <div data-container-for="Pasien_Id" class="k-edit-field" >
            <input name="Pasien_Id" style="margin-left:10px; width: 220px;" id="Pasien_Id" style="width: 100%;" data-bind="value:Pasien_Id">
        </div>
        <div class="k-edit-label"><label for="Poliklinik_Id">Poliklinik :</label></div>
        <div data-container-for="Poliklinik_Id" class="k-edit-field" >
            <input name="Poliklinik_Id" style="margin-left:10px; width: 220px;" id="Poliklinik_Id" data-bind="value:Work_Unit_Id">
        </div>
        <div class="k-edit-label"><label for="Shift_Id">Jadwal :</label></div>
        <div data-container-for="Shift_Id" class="k-edit-field" >
            <input name="Shift_Id" style="margin-left:10px; width: 220px;" id="Shift_Id" data-bind="value:Shift_Id">
        </div>

        <div class="k-edit-label"><label for="Dokter_Id">Dokter :</label></div>
        <div data-container-for="Dokter_Id" class="k-edit-field" >
            <input name="Dokter_Id" style="margin-left:10px; width: 220px;" id="Dokter_Id" data-bind="value:Dokter_Id">
        </div>
      </div>
      <div>
        <div class="k-edit-label"><label for="Pasien_Laboratorium">Pasien :</label></div>
        <div data-container-for="Pasien_Laboratorium" class="k-edit-field" >
            <input name="Pasien_Laboratorium" style="margin-left:10px; width: 220px;" id="Pasien_Laboratorium" style="width: 100%;">
        </div>
        <div class="k-edit-label"><label for="Jenis_Pemeriksaan_Id">Laboratorium :</label></div>
        <div data-container-for="Jenis_Pemeriksaan_Id" class="k-edit-field" >
            <input name="Jenis_Pemeriksaan_Id" style="margin-left:10px; width: 220px;" id="Jenis_Pemeriksaan_Id">
        </div>
        <div class="k-edit-label"><label for="Tindakan_Id">Tindakan Pemeriksaan :</label></div>
        <div data-container-for="Tindakan_Id" class="k-edit-field" >
            <input name="Tindakan_Id" style="margin-left:10px; width: 220px;" id="Tindakan_Id">
        </div>
      </div>
      <div>
        <div class="k-edit-label"><label for="Pasien_Radiologi">Pasien :</label></div>
        <div data-container-for="Pasien_Radiologi" class="k-edit-field" >
            <input name="Pasien_Radiologi" style="margin-left:10px; width: 220px;" id="Pasien_Radiologi" style="width: 100%;">
        </div>
        <div class="k-edit-label"><label for="Dokter_Id">Tindakan Perawatan :</label></div>
        <div data-container-for="Dokter_Id" class="k-edit-field" >
            <input name="Dokter_Id" style="margin-left:10px; width: 220px;" id="Dokter_Id">
        </div>
      </div>
    </div>
</script>

<script type="text/x-kendo-template" id="editPopupTemplate">
<div class="k-edit-label"><label for="Pasien_Id">Pasien :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" style="margin-left:10px" id="Pasien_Id" style="width: 100%;" data-bind="value:Pasien_Id" readonly="true">
    </div>
    <div class="k-edit-label"><label for="Poliklinik_Id">Poliklinik :</label></div>
    <div data-container-for="Poliklinik_Id" class="k-edit-field" >
        <input name="Poliklinik_Id" style="margin-left:10px" id="Poliklinik_Id" data-bind="value:Work_Unit_Id">
    </div>
    <div class="k-edit-label"><label for="Shift_Id">Jadwal :</label></div>
    <div data-container-for="Shift_Id" class="k-edit-field" >
        <input name="Shift_Id" style="margin-left:10px" id="Shift_Id" data-bind="value:Shift_Id">
    </div>

    <div class="k-edit-label"><label for="Dokter_Id">Dokter :</label></div>
    <div data-container-for="Dokter_Id" class="k-edit-field" >
        <input name="Dokter_Id" style="margin-left:10px" id="Dokter_Id" data-bind="value:Dokter_Id">
    </div>
</script>

<div id="hapusDialog"></div>

<script type="text/javascript">
var hapusDialog,
	record = 0,
	templateHapusDialog;
  var dropdown = null;
$(document).ready(function () {
    $("#grid").kendoGrid({
        dataSource: {
            transport: {
              read: function(options){
                options.data.dropdown = dropdown;
                $.ajax({
                  url: "{{asset('antrian_poli/read')}}",
                  type: "GET",
                  data: options.data,
                  dataType: "json",
                  success: function (res) {
                    options.success(res);
                  }
                });
              },
              create: function(options){
                options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoComboBox').value();
                options.data.Pasien_Laboratorium = $('input[name="Pasien_Laboratorium"]').data('kendoComboBox').value();
                options.data.Pasien_Radiologi = $('input[name="Pasien_Radiologi"]').data('kendoComboBox').value();
                options.data.Poliklinik_Id = $('input[name="Poliklinik_Id"]').data('kendoDropDownList').value();
                options.data.Shift_Id = $('input[name="Shift_Id"]').data('kendoDropDownList').value();
                options.data.Dokter_Id = $('input[name="Dokter_Id"]').data('kendoDropDownList').value();
                options.data.Jenis_Pemeriksaan_Id = $('input[name="Jenis_Pemeriksaan_Id"]').data('kendoDropDownList').value();
                options.data.Tindakan_Id = $('input[name="Tindakan_Id"]').data('kendoMultiSelect').value();

                $.ajax({
                  headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                  url: "{{ route('Poliklinik.create') }}",
                  type: "POST",
                  dataType: "json",
                  data: options.data,
                  success: function (res) {
                    options.success(res);
                    $("#grid").data("kendoGrid").dataSource.read();
                    swal({
                        title: "Success!",
                        type: "success",
                        timer: 2000
                      });
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    kendo.alert("Gagal .");
                  }
                });
              },
              update: function(options){
                options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoComboBox').value();
                options.data.Pasien_Laboratorium = $('input[name="Pasien_Laboratorium"]').data('kendoComboBox').value();
                options.data.Pasien_Radiologi = $('input[name="Pasien_Radiologi"]').data('kendoComboBox').value();
                options.data.Poliklinik_Id = $('input[name="Poliklinik_Id"]').data('kendoDropDownList').value();
                options.data.Shift_Id = $('input[name="Shift_Id"]').data('kendoDropDownList').value();
                options.data.Dokter_Id = $('input[name="Dokter_Id"]').data('kendoDropDownList').value();
                options.data.Jenis_Pemeriksaan_Id = $('input[name="Jenis_Pemeriksaan_Id"]').data('kendoDropDownList').value();
                options.data.Tindakan_Id = $('input[name="Tindakan_Id"]').data('kendoMultiSelect').value();

                $.ajax({
                  headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                  url: "{{ route('Poliklinik.Update') }}",
                  type: "POST",
                  dataType: "json",
                  data: options.data,
                  success: function (res) {
                    options.success(res);
                    $("#grid").data("kendoGrid").dataSource.read();
                    kendo.alert("Berhasil !!");
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    kendo.alert("Gagal .");
                  }
                });
              },
            },
            schema: {
              data: "data",
              total: "total",
              model: {
                id: "Antrian_Pasien_Id",
                fields: {
                  Pasien_Id: {
                    type: "number",
									},
                  
                  Work_Unit_Id: {
                    type: "number",
									},
                  No_Urut: {
                    type: "number",
									},
                  Tanggal_Periksa: {
                    type: "text",
									},
                  
                  Created_Date: {
                    type: "date",
									},
                  Modified_By: {
                    type: "text",
									},
                  Modified_Date: {
                    type: "date",
									},
                }
              }
            },
            pageSize: 10
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        editable: {
          mode: "popup",
          template: $("#PopupTemplate").html()
        },
        edit: function (e) {

          $("#tabstrip").kendoTabStrip({
            animation: {
              open: {
                effects: "fadeIn"
              }
            },
          });

          $(e.container).parent().css({
                    width: '500px'
                });

          $("#Pasien_Id").kendoComboBox({
            optionLabel: "-Pilih Pasien-",
            dataTextField: "Nama",
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_pasien')}}",
                        dataType: "json"
                    }
                }
            },
          });

          $("#Pasien_Laboratorium").kendoComboBox({
            optionLabel: "-Pilih Pasien-",
            dataTextField: "Nama",
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_pasien')}}",
                        dataType: "json"
                    }
                }
            },
          });

          $("#Pasien_Radiologi").kendoComboBox({
            optionLabel: "-Pilih Pasien-",
            dataTextField: "Nama",
            dataValueField: "Pasien_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_pasien')}}",
                        dataType: "json"
                    }
                }
            },
          });

          $("#Shift_Id").kendoDropDownList({
            optionLabel: "-Pilih Jadwal-",
            dataTextField: "Time_Start_End",
            dataValueField: "Shift_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_shift')}}",
                        dataType: "json"
                    }
                }
               
            },
            change:function(e){
                pasien = $('#Shift_Id').val()
                $('#Dokter_Id').data('kendoDropDownList').dataSource.read({shift_id:pasien});
                console.log( $('input[name="Shift_Id"]').data('kendoDropDownList').value())
            },
          });

          $("#Dokter_Id").kendoDropDownList({
            optionLabel: "-Pilih Dokter-",
            dataTextField: "Full_Name",
            dataValueField: "Employee_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_dokter')}}",
                        dataType: "json"
                    }
                }
            }
          });

          $("#Poliklinik_Id").kendoDropDownList({
            optionLabel: "-Pilih Poliklinik-",
            dataTextField: "Work_Unit_Name",
            dataValueField: "Work_Unit_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('Poliklinik.Dropdown')}}",
                        dataType: "json"
                    }
                }
            },
            change:function(e){
              
                poli = $('#Poliklinik_Id').val()
                $('#Shift_Id').data('kendoDropDownList').dataSource.read({poli:poli});
            },
          });

          $("#Jenis_Pemeriksaan_Id").kendoDropDownList({
            optionLabel: "-Pilih Laboratorium-",
            dataTextField: "Jenis_Pemeriksaan",
            dataValueField: "Jenis_Pemeriksaan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('Lab.Dropdown')}}",
                        dataType: "json"
                    }
                }
            },
            change:function(e){
              
                lab = $('#Jenis_Pemeriksaan_Id').val()
                $('#Tindakan_Id').data('kendoMultiSelect').dataSource.read({lab:lab});
            },
          });

          $("#Tindakan_Id").kendoMultiSelect({
            // cascadeForm: "Jenis_Pemeriksaan_Id",
            placeholder: "Pilih Tindakan...",
            dataTextField: "Deskripsi_Pendek",
            dataValueField: "Prosedur_Medis_Biaya_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{url('antrian_poli/read_tindakan')}}",
                        dataType: "json"
                    }
                }
               
            }
          });

				$('.k-window-title').text(e.model.isNew() ? "Tambah" : "Edit");
      },
        columns: [
          { template: "#= ++record #", title: "No", width: 50},
          {
              field: "Nama",
              title: "Nama Pasien",width:120
          },
          {
              field: "Work_Unit_Name",
              title: "Poliklinik"
          },
          {
              field: "Dokter_Id",
              title: "Dokter",
              template:"#if(data.Dokter_Id == null){# - #}else{# #=data.Full_Name# #}#"
          },
          {
              field: "No_Urut",
              title: "No Urut Pasien", width: 75
          },
          {
              field: "Tanggal_Periksa",
              title: "Tanggal Periksa"
          },
          {
            headerTemplate: "<span class='k-icon k-i-gear'></span>",
            headerAttributes: { class: "table-header-cell", style: "text-align: center" },
            attributes: { class: "table-cell", style: "text-align: center" },
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
                  name: "customDelete",
                  iconClass: "k-icon k-i-close",
                  text: "Batalkan",
                  click: hapusData
                },
                {
                  name: "CetakLink",
                  iconClass: "k-icon k-i-print",
                  text: "Cetak",
                  click: CetakLink
                }
            ]
          }
      ],
      toolbar: kendo.template($("#toolbarTemplate").html()),
      dataBinding: function() {
				if(this.dataSource.pageSize() != null){
					record = (this.dataSource.page() -1) * this.dataSource.pageSize();
				}else{
					record = (this.dataSource.page() -1);
				}
        },
    });

    $('#dropdown').kendoDropDownList({
            optionLabel: "-Pilih Status Periksa-",
            dataTextField: "Status_Periksa",
            dataValueField: "Status_Periksa_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getStatusPeriksa')}}",
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
						field   : "Nama",
						operator: "contains",
						value   : searchValue
					}
				]
			});
		}); 

  
});

function CetakLink(e) {
    e.preventDefault();
    var tr = $(e.target).closest("tr"),
      data = this.dataItem(tr);

    window.open('{{ url('antrian_poli/cetak/') }}'+'/'+data.id, '_blank');
  }

function hapusData(e) {
		e.preventDefault();

		var tr = $(e.target).closest("tr"),
			data = this.dataItem(tr);

		hapusDialog = $("#hapusDialog").kendoDialog({
			width: "350px",
			title: "Batalkan Antrian",
			visible: true,
			content:"Apakah anda yakin ingin membatalkan Antrian : "+data.Nama+"?",
			buttonLayout: "stretched",
			actions: [
				{
					text: "Batalkan",
					primary: true,
					action: function (e) {
						var id = {id: data.id};

						$.ajax({
							headers: {
						        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
						    },
							url: "{{ asset('antrian_poli/delete') }}",
							type: "GET",
							data: id,
							dataType: "json",
              complete: function (e) {
                  $("#grid").data("kendoGrid").dataSource.read();
              },
							error: function (xhr, ajaxOptions, thrownError) {
									swal('Error!! '+xhr.status, thrownError, 'error');
							}
						});
					}
				},
				{text: "Batal"}
			]
		}).data("kendoDialog");
	}
	</script>

@endsection