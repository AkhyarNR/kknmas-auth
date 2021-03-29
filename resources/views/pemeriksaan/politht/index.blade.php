@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
<script language="JavaScript">
    function newDate(date) {
        var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();
    
        if (month.length < 2) month = "0" + month;
        if (day.length < 2) day = "0" + day;
    
        
        return [year, month ,day].join(",");
    }
    function hitungUmur(Tanggal_Lahir){
    
        var date1 = new Date(Tanggal_Lahir);
        var date2 = new Date(Date.now());
        // console.log(date1)
    
        var miliday = 24 * 60 * 60 * 1000;
    
        var tglPertama = Date.parse(date1);
        var tglKedua = Date.parse(date2);
        var selisih = (tglKedua - tglPertama) / miliday;
        var tahun = Math.floor(selisih / 365);
        var sisaHari = (selisih % 365);
        var bulan = Math.floor(sisaHari / 30);
        var hari = Math.floor(sisaHari % 30);
    
        // console.log(tahun + " tahun "+bulan+" bulan "+hari+" hari");
        return (tahun + " tahun "+bulan+" bulan "+hari+" hari");
    }
    </script>

<!-- Antrian Poli THT -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Antrian Poli THT</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="grid"></div>
            <script type="text/x-kendo-template" id="template">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Detail Pasien
                        </li>                   
                    </ul>
                    <div>
                        <div class="DetailPasien">
                            <div class="row">
                              <div class="col-md-3" style="position: relative">
                                <div class="pasien-photo">
                                  <img src="{{asset('/storage/photos')}}/#= Kode_Pasien #.jpeg" alt="No Image" style="width: 250px; height: 350px">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-20">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="private-separator mb-2"></div>
                                            <ul class="employee-datalist">
                                                <li class="row">
                                                    <label class="d-block col-md-3">No.RM Pasien </label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Kode_Pasien == null) {# - #} else {# #= Kode_Pasien # #} #
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Nama Pasien</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Nama == null) {# - #} else {# #= Nama # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Jenis Kelamin</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Jenis_Kelamin == null) {# - #} else {# #= Jenis_Kelamin # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Golongan Darah</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Gol_Darah == null) {# - #} else {# #= Gol_Darah # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Cacat Fisik</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Jenis == null) {# - #} else {# #= Jenis # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Riwayat Alergi</label>
                                                    <p class="col-md-6 private-content" id="listAlergi#= Kode_Pasien #">:   
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Tempat Lahir</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Tempat_Lahir == null) {# - #} else {# #= Tempat_Lahir # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Tanggal Lahir</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Tanggal_Lahir == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Lahir, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Tanggal Daftar</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Tanggal_Daftar == null) {# - #} else {# #= kendo.toString(kendo.parseDate(Tanggal_Daftar, 'yyyy-MM-dd'), 'dd-MM-yyyy') # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Umur</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (hitungUmur(Tanggal_Lahir) == null) {# - #} else {# #= hitungUmur(Tanggal_Lahir) # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Nama Ibu</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Nama_Ibu == null) {# - #} else {# #= Nama_Ibu # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">No Identitas
                                                    (SIM/KTP/Pasport)</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (No_Ktp == null) {# - #} else {# #= No_Ktp # #} # 
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">No Telp</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (No_HP == null) {# - #} else {# #= No_HP # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Kewarganegaraan</label>
                                                    <p class="col-md-6 private-content">
                                                    :  # if (Kewarganegaraan == null) {# - #} else {# #= Kewarganegaraan # #} #
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Alamat</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Alamat == null) {# - #} else {# #= Alamat # #} # 
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
                                                <li class="row">
                                                    <label class="d-block col-md-3">Status Nikah</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Status_Pernikahan == null) {# - #} else {# #= Status_Pernikahan # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Agama</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Agama == null) {# - #} else {# #= Agama # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Pendidikan</label>
                                                    <p class="col-md-6 private-content">
                                                    : # if (Pendidikan == null) {# - #} else {# #= Pendidikan # #} #  
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Pekerjaan</label>
                                                    <p class="col-md-6">
                                                    : # if (Pekerjaan == null) {# - #} else {# #= Pekerjaan # #} #
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Status Pasien</label>
                                                    <p class="col-md-6">
                                                    :  # if (Status == null) {# - #} else {# #= Status # #} #
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Asuransi</label>
                                                    <p class="col-md-6" id="listAsuransi#= Kode_Pasien #">:
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3">Nomor Asuransi</label>
                                                    <p class="col-md-6">
                                                    :  # if (Nomer_Asuransi == null) {# - #} else {# #= Nomer_Asuransi # #} #
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="private-separator mb-2"></div>
                                            <ul class="employee-datalist">
                                                <li class="row">
                                                    <label class="d-block col-md-6">Suku/Bangsa</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Ras == null) {# - #} else {# #= Ras # #} #  
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Bahasa Dipakai</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Nama_Bahasa == null) {# - #} else {# #= Nama_Bahasa # #} #  
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Email</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Email == null) {# - #} else {# #= Email # #} #
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Penanggung Jawab</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                     # if (Nama_Penanggung_Jawab == null) {# - #} else {# #= Nama_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Pekerjaan</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Pekerjaan_Penanggung_Jawab == null) {# - #} else {# #= Pekerjaan_Penanggung_Jawab # #} #     
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">No_Hp</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (No_Hp == null) {# - #} else {# #= No_Hp # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Kewarganegaraan</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Kewarganegaraan_Penanggung_Jawab == null) {# - #} else {# #= Kewarganegaraan_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Alamat</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (alamat_Penanggung_Jawab == null) {# - #} else {# #= alamat_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Provinsi</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Provinsi_Penanggung_Jawab == null) {# - #} else {# #= Provinsi_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Kabupaten</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Kabupaten_Penanggung_Jawab == null) {# - #} else {# #= Kabupaten_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Kecamatan</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Kecamatan_Penanggung_Jawab == null) {# - #} else {# #= Kecamatan_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-6">Kelurahan</label>
                                                    <p class="col-md-6 private-content"><strong>
                                                    # if (Kelurahan_Penanggung_Jawab == null) {# - #} else {# #= Kelurahan_Penanggung_Jawab # #} # 
                                                    </strong></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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

<script type="text/x-kendo-template" id="toolbarTemplate">
    <!-- <button class="k-button k-button-icontext k-grid-add"><i class="k-icon k-i-plus"></i>Tambah Data</button> -->

    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>


<div id="ModalPra"  style="display: none;">
    <div class="k-edit-label"><label for="Tensi">Tensi :</label></div>
        <div data-container-for="Tensi" class="k-edit-field">
        <input type="text" class="k-input k-textbox input-width-modal" name="Tensi">
    </div>
    <div class="k-edit-label"><label for="Suhu">Suhu :</label></div>
        <div data-container-for="Suhu" class="k-edit-field">
        <input type="text" class="k-input k-textbox input-width-modal" name="Suhu">
    </div>
    <div class="k-edit-label"><label for="Berat_Badan">Berat Badan :</label></div>
        <div data-container-for="Berat_Badan" class="k-edit-field">
        <input type="text" class="k-input k-textbox input-width-modal" name="Berat_Badan">
    </div>
    <div class="k-edit-label"><label for="Tinggi_Badan">Tinggi Badan :</label></div>
        <div data-container-for="Tinggi_Badan" class="k-edit-field">
        <input type="text" class="k-input k-textbox input-width-modal" name="Tinggi_Badan">
    </div>
    <button class="k-button k-button-icontext" id="closePra">Cancel</button>
    <button class="k-button k-button-icontext" onclick="createPra()">Simpan</button>
</div>
<div id="hapusDialog"></div>


<script>

  $(function(){
      var hapusDialog,
          cari = null;

    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
              options.data.cari = cari;

            $.ajax({
              url : '{{ url('pemeriksaan/politht/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
              }
            })
            
          },
          //create
        },
        serverPaging: true,
        sortable: true,
        pageSize: 20,
        schema:{
          data:'data',
          total:'total',
          model:{
            id: 'Antrian_Pasien_Id'
          }
        }
      },
      toolbar: kendo.template($("#toolbarTemplate").html()),

      columns:[
        {field: 'No_Urut', title: 'No Urut Antrian'},
        {field: 'Pasien_Id', title: 'Nama Pasien',template:"#: data.Nama#"},
        {field: 'Dokter_Id', title: 'Nama Dokter',template:'#: data.Full_Name#'},
        {field: 'Status_Periksa_Id', title: 'Status Periksa',template:'#: data.Status_Periksa#'},
        
        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },

        command:[   
                    { iconClass: "k-icon k-i-track-changes-enable",
                      text: "Pra Pemeriksaan",
                      click: PraPeriksa,
                      visible: function(dataItem) { return dataItem.Status_Periksa === "Belum" }
                    },
                    { iconClass: "k-icon k-i-change-manually",
                      text: "Periksa",
                      click: Periksa,
                      visible: function(dataItem) { return dataItem.Status_Periksa === "Sedang Diproses" }
                    },
                    {
                      iconClass: "k-icon k-i-arrow-end-right",
                      text: "Skip Antrian",
                      click: Skip
                    },
                    {
                      iconClass: "k-icon k-i-cancel-outline",
                      text: "Batalkan Pemeriksaan",
                      click: BatalkanPemeriksaan
                    },
                    
                ]
        }
      ],
      pageable: {
            pageSizes: false,
            numeric: false,
            input: true,
            refresh: true
          },
      detailTemplate: kendo.template($("#template").html()),
      detailInit: detailInit,
    })

    $('#cari').keyup(function(e){
        cari = $('#cari').val();
        $('#grid').data('kendoGrid').dataSource.read();
    })


  })

  function BatalkanPemeriksaan(e) {
        e.preventDefault();

        var tr = $(e.target).closest("tr"),
            data = this.dataItem(tr);

        hapusDialog = $("#hapusDialog").kendoDialog({
                    width: "350px",
                    title: "Batalkan Pemeriksaan",
                    visible: true,
                    content:"Apakah anda yakin ingin Membatalkan Pemeriksaan?",
                    buttonLayout: "stretched",
                    actions: [
                        {
                            text: "Hapus",
                            primary: true,
                            action: function (e) {
                                var id = {Antrian_Pasien_Id: data.Antrian_Pasien_Id};

                                $.ajax({
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                    },
                                    url: "{{ asset('pemeriksaan/politht/hapus') }}",
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

    function PraPeriksa(e) {
    e.preventDefault();
        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        console.log(data)
        var id = {Antrian_Pasien_Id: data.Antrian_Pasien_Id, Pasien_Id : data.Pasien_Id, Work_Unit_Id : data.Work_Unit_Id,Dokter_Id : data.Dokter_Id, Shift_Id : data.Shift_Id, Pasien_Rawat_Jalan_Id : data.Pasien_Rawat_Jalan_Id};

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "{{ asset('pemeriksaan/politht/create') }}",
                type: "POST",
                data: id,
                dataType: "json",
                success : function(res){
                          window.open('{{ url("pemeriksaan/politht/pra_tht") }}/'+res,'_self');
                  }
              });
  }

  function Periksa(e) {
    e.preventDefault();
        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        console.log(data)
        var id = {Pemeriksaan_Id: data.Pemeriksaan_Id, Employee : data.Employee_Id, Pasien_Id : data.Pasien_Id, Pasien_Rawat_Jalan_Id : data.Pasien_Rawat_Jalan_Id};

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "{{ asset('pemeriksaan/politht/update') }}",
                type: "POST",
                data: id,
                dataType: "json",
                success : function(res){
                          window.open('{{ url("pemeriksaan/tht") }}/'+res,'_self');
                  }
              });
  }

  function Skip(e) {
    e.preventDefault();

        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        var id = {Antrian_Pasien_Id: data.Antrian_Pasien_Id, Pasien_Id : data.Pasien_Id, Work_Unit_Id : data.Work_Unit_Id,Dokter_Id : data.Dokter_Id, Shift_Id : data.Shift_Id};

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "{{ asset('pemeriksaan/politht/skip') }}",
                type: "POST",
                data: id,
                dataType: "json",
                success : function(res){
                  swal({
                        title: "Success!",
                        type: "success",
                        timer: 2000
                      });
                      $("#grid").data("kendoGrid").dataSource.read();
                  }
              });
  }

  function detailInit(e) {
      var detailRow = e.detailRow;
      var data = e.data;

      $.ajax({
              url : '{{ url('pemeriksaan/politht/alergipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : data.Pasien_Id},
              success:function(res){
                var stri = "";
                $.each(res , function(index, val) { 
                  stri = stri + "<li>"+val['Alergi']+"</li>"
                });
                $('#listAlergi'+data.Kode_Pasien).append(stri);
              }
            })

      $.ajax({
              url : '{{ url('pemeriksaan/politht/asuransipasien') }}',
              dataType:'json',
              type:'GET',
              data:{'Pasien_Id' : data.Pasien_Id},
              success:function(res){
                var stin = "";
                $.each(res , function(index, val) { 
                  stin = stin + "<li>"+val['Nama_Asuransi']+"</li>"
                });
                $('#listAsuransi'+data.Kode_Pasien).append(stin);
              }
            })

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });

  }

</script>

@endsection