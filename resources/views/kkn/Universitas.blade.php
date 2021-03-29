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
            <h3>Master Universitas</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="grid"></div>
            <script type="text/x-kendo-template" id="templateDetail">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Obat/BHP
                        </li>
                    </ul>
                    <div>
                      <div class="Detaildata">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="private-separator mb-2"></div>
                                <ul class="obat-detail">
                                    <li class="row">
                                        <label class="d-block col-md-3">No KTP</label>
                                        <p class="col-md-6 private-content">
                                        : # if (No_Ktp_Pj == null) {# - #} else {# #= No_Ktp_Pj # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Jenis Kelamin</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Jenis_Kelamin == null) {# - #} else {# #= Jenis_Kelamin # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Tanggal Lahir</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Tanggal_Lahir_Pj == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Lahir_Pj, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kewarganegaraan</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Kewarganegaraan == null) {# - #} else {# #= Kewarganegaraan # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Provinsi</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Nama_Provinsi == null) {# - #} else {# #= Nama_Provinsi # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kabupaten</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Nama_Kabupaten == null) {# - #} else {# #= Nama_Kabupaten # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kecamatan</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Nama_Kecamatan == null) {# - #} else {# #= Nama_Kecamatan # #} #
                                        </p>
                                    </li>
                                    <li class="row">
                                        <label class="d-block col-md-3">Kelurahan</label>
                                        <p class="col-md-6 private-content">
                                        : # if (Kelurahan == null) {# - #} else {# #= Kelurahan # #} #
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </script>
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
    <div class="k-edit-label"><label for="Nama_Penanggung_Jawab">Kode Universitas :</label></div>
    <div data-container-for="Nama_Penanggung_Jawab" class="k-edit-field" >
        <input name="Nama_Penanggung_Jawab" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Nama_Penanggung_Jawab">Nama Universitas:</label></div>
    <div data-container-for="Nama_Penanggung_Jawab" class="k-edit-field" >
        <input name="Nama_Penanggung_Jawab" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
</script>

<script type="text/x-kendo-template" id="templatecopy">
    <div class="k-edit-label"><label for="Pasien_Id">Nama Pasien :</label></div>
    <div data-container-for="Pasien_Id" class="k-edit-field" >
        <input name="Pasien_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Nama_Penanggung_Jawab">Nama Peserta :</label></div>
    <div data-container-for="Nama_Penanggung_Jawab" class="k-edit-field" >
        <input name="Nama_Penanggung_Jawab" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Nama_Penanggung_Jawab">Email :</label></div>
    <div data-container-for="Nama_Penanggung_Jawab" class="k-edit-field" >
        <input name="Nama_Penanggung_Jawab" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Jenis_Kelamin_Id">Jenis Kelamin :</label></div>
    <div data-container-for="Jenis_Kelamin_Id" class="k-edit-field" >
        <input name="Jenis_Kelamin_Id" class="input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Tanggal_Lahir_Pj">Tanggal Lahir :</label></div>
    <div data-container-for="Tanggal_Lahir_Pj" class="k-edit-field" >
        <input name="Tanggal_Lahir_Pj" class="input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="No_Ktp_Pj">No Identitas (SIM/KTP/Pasport) :</label></div>
    <div data-container-for="No_Ktp_Pj" class="k-edit-field" >
        <input name="No_Ktp_Pj" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Hubungan_Kerabat_Id">Hubungan Dengan Pasien :</label></div>
    <div data-container-for="Hubungan_Kerabat_Id" class="k-edit-field" >
        <input name="Hubungan_Kerabat_Id" class="input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="No_Hp">No HP :</label></div>
    <div data-container-for="No_Hp" class="k-edit-field">
        <input name="No_Hp" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Pekerjaan">Pekerjaan :</label></div>
    <div data-container-for="Pekerjaan" class="k-edit-field">
        <input name="Pekerjaan" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Alamat">Alamat :</label></div>
    <div data-container-for="Alamat" class="k-edit-field" >
        <input name="Alamat" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kewarganegaraan_Id">Kewarganegaraan :</label></div>
    <div data-container-for="Kewarganegaraan_Id" class="k-edit-field" >
        <input name="Kewarganegaraan_Id" class="input-width-modal" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Provinsi_Id">Provinsi :</label></div>
    <div data-container-for="Provinsi_Id" class="k-edit-field" >
        <input id="Provinsi_Id" name="Provinsi_Id" class="input-width-modal" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kabupaten_Id">Kabupaten :</label></div>
    <div data-container-for="Kabupaten_Id" class="k-edit-field" >
        <input id="Kabupaten_Id" name="Kabupaten_Id" class="input-width-modal" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Kecamatan_Id">Kecamatan :</label></div>
    <div data-container-for="Kecamatan_Id" class="k-edit-field" >
        <input id="Kecamatan_Id" name="Kecamatan_Id" class="input-width-modal" style="margin-left:10px" type="number">
    </div>
    <div class="k-edit-label"><label for="Kelurahan">Kelurahan :</label></div>
    <div data-container-for="Kelurahan" class="k-edit-field" >
        <input name="Kelurahan" type="text" class="k-input k-textbox input-width-modal" style="margin-left:10px">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    
    <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button>
   <a id="exportpdf" class="k-button k-button-icontext" href='{{asset("/cetak_listpasien")}}' target='_blank'><span class="k-icon k-i-file-pdf"></span>Export PDF</a>


  <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocomplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
    <span class="k-input-icon"></span>
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
          options.data.Tanggal_Lahir_Pj = (options.data.Tanggal_Lahir_Pj == null) ? "" : formatDate(options.data.Tanggal_Lahir_Pj);
          options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoComboBox').value();
          options.data.Provinsi_Id = $('input[name="Provinsi_Id"]').data('kendoDropDownList').value();
          options.data.Kabupaten_Id = $('input[name="Kabupaten_Id"]').data('kendoDropDownList').value();
          options.data.Kecamatan_Id = $('input[name="Kecamatan_Id"]').data('kendoDropDownList').value();
          options.data.Kewarganegaraan_Id = $('input[name="Kewarganegaraan_Id"]').data('kendoDropDownList').value();
          options.data.Hubungan_Kerabat_Id = $('input[name="Hubungan_Kerabat_Id"]').data('kendoDropDownList').value();
          options.data.Jenis_Kelamin_Id = $('input[name="Jenis_Kelamin_Id"]').data('kendoDropDownList').value();
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
          options.data.Tanggal_Lahir_Pj = (options.data.Tanggal_Lahir_Pj == null) ? "" : formatDate(options.data.Tanggal_Lahir_Pj);
          options.data.Pasien_Id = $('input[name="Pasien_Id"]').data('kendoComboBox').value();
          options.data.Provinsi_Id = $('input[name="Provinsi_Id"]').data('kendoDropDownList').value();
          options.data.Kabupaten_Id = $('input[name="Kabupaten_Id"]').data('kendoDropDownList').value();
          options.data.Kecamatan_Id = $('input[name="Kecamatan_Id"]').data('kendoDropDownList').value();
          options.data.Kewarganegaraan_Id = $('input[name="Kewarganegaraan_Id"]').data('kendoDropDownList').value();
          options.data.Hubungan_Kerabat_Id = $('input[name="Hubungan_Kerabat_Id"]').data('kendoDropDownList').value();
          options.data.Jenis_Kelamin_Id = $('input[name="Jenis_Kelamin_Id"]').data('kendoDropDownList').value();
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
    toolbar: kendo.template($("#toolbarTemplate").html()),
    columns:[
      {field: 'Agama', title: 'No'},
        {field: 'Agama', title: 'Kode Universitas'},
        {field: 'Agama', title: 'Nama Universitas'},
     {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:[
            {
                   name: "edit",
                        text: {
                        edit: "Edit",
                        update: "Simpan",
                        cancel: "Batal"
                        }
                },
               'destroy'
                ]
        },
      ],
    pageable: true,
    detailTemplate: kendo.template($("#templateDetail").html()),
    detailInit: detailInit,
    editable: {
      mode:"popup",
      template: $("#template").html(),
    },

    edit : function(e) {
      $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

      e.container.find("[name='Tanggal_Lahir_Pj']").kendoDatePicker({
        format: "dd-MM-yyyy"
      });

      e.container.parent().find('input[name="Pasien_Id"]').kendoComboBox({
          optionLabel: "-Pilih Pasien-",
          dataTextField: "Nama",
          dataValueField: "Pasien_Id",
          filter: "contains",
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

      e.container.parent().find('input[name="Kewarganegaraan_Id"]').kendoDropDownList({
          optionLabel: "-Pilih Kewarganegaraan-",
          dataTextField: "Kewarganegaraan",
          dataValueField: "Kewarganegaraan_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getKewarganegaraan')}}",
                      dataType: "json"
                  }
              }
          }
      })

      e.container.parent().find('input[name="Hubungan_Kerabat_Id"]').kendoDropDownList({
          optionLabel: "-Pilih Hubungan Keluarga-",
          dataTextField: "Keluarga",
          dataValueField: "Keluarga_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getKeluarga')}}",
                      dataType: "json"
                  }
              }
          }
      })

      e.container.parent().find('input[name="Jenis_Kelamin_Id"]').kendoDropDownList({
          optionLabel: "-Pilih Universitas-",
          dataTextField: "Jenis_Kelamin",
          dataValueField: "Jenis_Kelamin_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getJenis_Kelamin')}}",
                      dataType: "json"
                  }
              }
          }
      })

      $("#Provinsi_Id").kendoDropDownList({
          optionLabel: "-Pilih Provinsi-",
          dataTextField: "Nama_Provinsi",
          dataValueField: "Provinsi_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getProvinsi')}}",
                      dataType: "json"
                  }
              }
          }
      })

      $("#Kabupaten_Id").kendoDropDownList({
          cascadeFrom: "Provinsi_Id",
          cascadeFromField: "Provinsi_Id",
          optionLabel: "-Pilih Kabupaten-",
          dataTextField: "Nama_Kabupaten",
          dataValueField: "Kabupaten_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getKabupaten')}}",
                      dataType: "json"
                  }
              }
          }
      })

      $("#Kecamatan_Id").kendoDropDownList({
          cascadeFrom: "Kabupaten_Id",
          cascadeFromField: "Kabupaten_Id",
          optionLabel: "-Pilih Kecamatan-",
          dataTextField: "Nama_Kecamatan",
          dataValueField: "Kecamatan_Id",
          filter: "contains",
          dataSource:{
              transport:{
                  read:{
                      type: "GET",
                      url: "{{route('dropdown.getKecamatan')}}",
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

})

function formatDate(date) {
  var d = new Date(date),
  month = "" + (d.getMonth() + 1),
  day = "" + d.getDate(),
  year = d.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  return [year, month, day].join("-");
}

function detailInit(e) {
  var detailRow = e.detailRow;
  var data = e.data;
  console.log(data);

  detailRow.find(".tabstrip").kendoTabStrip({
      animation: {
          open: { effects: "fadeIn" }
      }
  });

}


</script>

@endsection
