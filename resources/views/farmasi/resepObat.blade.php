@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<style>
div.k-edit-form-container {
        width: auto;
        height: auto;
    }
</style>
<script type="text/javascript">
  function hitungUmur(Tanggal_Lahir){

    var date1 = new Date(Tanggal_Lahir);
    var date2 = new Date(Date.now());

    var miliday = 24 * 60 * 60 * 1000;

    var tglPertama = Date.parse(date1);
    var tglKedua = Date.parse(date2);
    var selisih = (tglKedua - tglPertama) / miliday;
    var tahun = Math.floor(selisih / 365);
    var sisaHari = (selisih % 365);
    var bulan = Math.floor(sisaHari / 30);
    var hari = Math.floor(sisaHari % 30);

    console.log(tahun + " tahun "+bulan+" bulan "+hari+" hari");
    return (tahun + " tahun "+bulan+" bulan "+hari+" hari");
}
</script>

<!-- Data Resep Obat -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Resep Obat</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="grid"></div>
            <script type="text/x-kendo-template" id="templateDetail">
                <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Resep Tebus Pulang
                        </li>
                        <li>
                           Resep Pasien Rawat Inap
                        </li>
                    </ul>
                    <div>
                      <div id="TebusPulang"></div>
                    </div>
                    <div>
                      <div class="RawatInap"></div>
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
    <div class="k-edit-label"><label for="Kode_Obat">Kode Obat/BHP :</label></div>
    <div data-container-for="Kode_Obat" class="k-edit-field" >
        <input name="Kode_Obat" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Nama_Obat">Nama Obat/BHP :</label></div>
    <div data-container-for="Nama_Obat" class="k-edit-field" >
        <input name="Nama_Obat" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Jenis_Obat_Id">Jenis Obat/BHP :</label></div>
    <div data-container-for="Jenis_Obat_Id" class="k-edit-field" >
        <input name="Jenis_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Kategori_Obat_Id">Kategori Obat/BHP :</label></div>
    <div data-container-for="Kategori_Obat_Id" class="k-edit-field" >
        <input name="Kategori_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Golongan_Obat_Id">Golongan Obat/BHP :</label></div>
    <div data-container-for="Golongan_Obat_Id" class="k-edit-field" >
        <input name="Golongan_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Satuan_Obat_Id">Satuan Obat/BHP :</label></div>
    <div data-container-for="Satuan_Obat_Id" class="k-edit-field">
        <input name="Satuan_Obat_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Industri_Farmasi_Id">Industri Farmasi :</label></div>
    <div data-container-for="Industri_Farmasi_Id" class="k-edit-field">
        <input name="Industri_Farmasi_Id" style="margin-left:10px" required validationMessage="Field tidak boleh kosong">
    </div>
    <div class="k-edit-label"><label for="Kandungan">Kandungan :</label></div>
    <div data-container-for="Kandungan" class="k-edit-field" >
        <input name="Kandungan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Kegunaan">Indikasi/Kegunaan :</label></div>
    <div data-container-for="Kegunaan" class="k-edit-field" >
        <input name="Kegunaan" style="margin-left:10px">
    </div>
    <div class="k-edit-label"><label for="Harga">Harga :</label></div>
    <div data-container-for="Harga" class="k-edit-field" >
        <input name="Harga" style="margin-left:10px" type="number">
    </div>
</script>

<script type="text/x-kendo-template" id="toolbarTemplate">
    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>

<div id="modalTebusPulang" style="display: none;">
  <div class="k-edit-label"><label for="Nama">Nama Pasien :</label></div>
  <div data-container-for="Nama" class="k-edit-field" >
      <input name="Nama" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="No_Resep">No Resep :</label></div>
  <div data-container-for="No_Resep" class="k-edit-field" >
      <input name="No_Resep" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="Nama_Obat">Nama Obat :</label></div>
  <div data-container-for="Nama_Obat" class="k-edit-field" >
      <input name="Nama_Obat" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="Dosis">Dosis :</label></div>
  <div data-container-for="Dosis" class="k-edit-field" >
      <input name="Dosis" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="Aturan_Pakai">Aturan Pakai :</label></div>
  <div data-container-for="Aturan_Pakai" class="k-edit-field" >
      <input name="Aturan_Pakai" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="Jumlah">Jumlah :</label></div>
  <div data-container-for="Jumlah" class="k-edit-field" >
      <input name="Jumlah" style="margin-left:10px" readonly disabled>
  </div>
  <div class="k-edit-label"><label for="Satuan_Obat">Satuan Obat :</label></div>
  <div data-container-for="Satuan_Obat" class="k-edit-field" >
      <input name="Satuan_Obat" style="margin-left:10px" readonly disabled>
  </div>
  <div class="col-md-8 col-sm-6 mx-auto">
      <a id="Kartu_Pasien" class="k-button k-button-icontext" href='#' target='_blank'><span class="k-icon k-i-file-pdf"></span>Cetak Label Obat</a>
      <a id="Label_Rm" class="k-button k-button-icontext" href='#' target='_blank'><span class="k-icon k-i-check"></span>Obat Sudah Diambil</a>
      <a id="Identitas_Pasien" class="k-button k-button-icontext" href='#' target='_blank'><span class="k-icon k-i-edit"></span>Ubah Resep</a>
      <a id="Kartu_Indeks_Pasien" class="k-button k-button-icontext" href='#' target='_blank'><span class="k-icon k-i-delete"></span>Hapus Resep</a>
  </div>
</div>

<script>

 $(function(){

    // $("#exportpdf").on("click", function(e){
    //     window.open('{{asset("/cetak_list_obat")}}', '_blank');
    // })

    var cari = null;
    $('#grid').kendoGrid({

      dataSource: {
        transport:{
          read : function(options) {
            options.data.cari = cari;
            $.ajax({
              url : '{{ url('farmasi/Resep_Obat/read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
                console.log(res);
              }
            })
            
          },

          update: function(options){
            $.ajax({
              headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
              url : '{{ url('farmasi/Resep_Obat/update') }}',
              dataType:'json',
              type:'POST',
              data:options.data,
              success:function(res){
                // options.success(res);
                kendo.alert("Data Inventory berhasil diedit");
                $('#grid').data('kendoGrid').dataSource.read();
              }
            })
          },
          
          destroy: function(options){
            $.ajax({
              url : '{{ url('farmasi/Resep_Obat/hapus') }}',
              dataType:'json',
              type:'GET',
              data:options.data,
              success:function(res){
                // options.success(res);
                kendo.alert("Data Inventory berhasil dihapus");
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
            id: 'Resep_Obat_Id'
          }
        }
      },

      toolbar: kendo.template($("#toolbarTemplate").html()),
      columns:[
        {field: 'Kode_Pasien', title: 'No RM', width: '70px', headerAttributes:{style: "text-align: center;"}},
        {field: 'Nama', title: 'Nama Pasien', headerAttributes:{style: "text-align: center;"}},
        {field: 'Umur', title: 'Umur', template: '#= hitungUmur(Tanggal_Lahir) #', headerAttributes:{style: "text-align: center;"}},
        {field: 'Jenis_Kelamin', title: 'Jenis Kelamin', headerAttributes:{style: "text-align: center;"}}
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

        e.container.parent().find('input[name="Jenis_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
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
            }
        });

        e.container.parent().find('input[name="Kategori_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Kategori_Obat",
            dataValueField: "Kategori_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getKategoriObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Golongan_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Golongan_Obat",
            dataValueField: "Golongan_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getGolonganObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Satuan_Obat_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Satuan_Obat",
            dataValueField: "Satuan_Obat_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getSatuanObat')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Industri_Farmasi_Id"]').kendoDropDownList({
            optionLabel: "-Pilih Kategori-",
            dataTextField: "Nama_Industri_Farmasi",
            dataValueField: "Industri_Farmasi_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getIndustriFarmasi')}}",
                        dataType: "json"
                    }
                }
            }
        });

        e.container.parent().find('input[name="Harga"]').kendoNumericTextBox({ format: "c"});

      }
    })
    
    $('#cari').keyup(function(e){
      cari = $('#cari').val();
      $('#grid').data('kendoGrid').dataSource.read();
    })

})

function detailInit(e) {
  var detailRow = e.detailRow;
  var data = e.data;
  console.log(data);

  var TebusPulang = new kendo.data.DataSource({
        transport:{
          read: function(options){
            var Pasien_Id = data.Pasien_Id

            $.ajax({
              url: '{{ url('farmasi/Resep_Obat/TebusPulang') }}',
              type: "GET",
              data: {Pasien_Id: Pasien_Id},
              dataType: "json",
              success: function (res) {
                options.success(res);
              }
            });
          },
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: "Resep_Obat_Id"
          }
        },
        pageSize: 20,
        serverPaging: false
      });

      detailRow.find(".tabstrip").kendoTabStrip({
          animation: {
              open: { effects: "fadeIn" }
          }
      });

      detailRow.find("#TebusPulang").kendoGrid({
        dataSource : TebusPulang,
          scrollable: false,
          sortable: true,
          pageable: {
            pageSizes: false,
            numeric: false,
            input: true,
            refresh: true
          },
          editable: {
            mode: "popup"
          },
          toolbar: kendo.template($("#toolbarTemplate").html()),
          columns: [
              {field: 'No_Resep', title: 'No Resep'},
              {field: 'Nama_Obat', title: 'Nama Obat', width: '100px'},
              {field: 'Full_Name', title: 'Dokter'},
              {field: 'Perawat', title: 'Perawat'},
              {field: '', template: "#=  (Created_Date == null)? '' : kendo.toString(kendo.parseDate(Created_Date, 'yyyy-MM-dd HH:mm:ss'), 'dd-MM-yyyy / hh:mm:ss') #", title: 'Waktu Periksa'},
              {headerTemplate: "<span class='k-icon k-i-gear'></span>",
              headerAttributes: { class: "table-header-cell", style: "text-align: center" },
              command: 
              {text: "Detail",
              click: function(item){
                var tr = $(item.target).closest("tr");
                var data = this.dataItem(tr)

                $("input[name='Nama']").val(data.Nama);
                $("input[name='No_Resep']").val(data.No_Resep);
                $("input[name='Nama_Obat']").val(data.Nama_Obat);
                $("input[name='Dosis']").val(data.Dosis);
                $("input[name='Aturan_Pakai']").val(data.Aturan_Pakai);
                $("input[name='Jumlah']").val(data.Jumlah);
                $("input[name='Satuan_Obat']").val(data.Satuan_Obat);
                wnd.center().open();

              }, 
              iconClass: "k-icon k-i-zoom"},
              attributes:{style: "text-align: center;"},
              }
          ]
      });

      var wnd = $("#modalTebusPulang")
      .kendoWindow({
        title: "Detail Resep Obat",
        modal: true,
        visible: false,
        resizable: false,
        height: 350,
        width: 800
      }).data("kendoWindow");

  var RawatInap = new kendo.data.DataSource({
        transport:{
          read: function(options){
            $.ajax({
              url: '{{ url('farmasi/Resep_Obat/RawatInap') }}',
              type: "GET",
              data: data.Kode_Pasien,
              dataType: "json",
              success: function (res) {
                options.success(res);
              }
            });
          },
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: "Pasien_Id",
            fields: {
                Kode_Pasien: {
                    type: "text",
                },
                Tanggal_Daftar: {
                    type: "date", format: "{0:dd-MM-yyyy}"
                },
                Nama: {
                    type: "text"
                },
                Jenis_Kelamin: {
                    type: "text"
                },
                Alamat: {
                    type: "text"
                }
            }
          }
        },
        pageSize: 20,
        serverPaging: false
      });

      detailRow.find(".RawatInap").kendoGrid({
        dataSource : RawatInap,
          scrollable: false,
          sortable: true,
          pageable: {
            pageSizes: false,
            numeric: false,
            input: true,
            refresh: true
          },
          editable: {
            mode: "popup"
          },
          toolbar: kendo.template($("#toolbarTemplate").html()),
          columns: [
              {field: 'Kode_Pasien', title: 'No Resep'},
              {field: 'Tanggal_Daftar', title: 'Nama Obat'},
              {field: 'Nama', title: 'Dosis', width: '70px'},
              {field: '', title: 'Jumlah', width: '70px'},
              {field: '', title: 'Aturan Pakai'},
              {field: '', title: 'Dokter'},
              {field: '', title: 'Perawat'},
              {field: '', title: 'Waktu Periksa'},
              {headerTemplate: "<span class='k-icon k-i-gear'></span>",
              headerAttributes: { class: "table-header-cell", style: "text-align: center" },
              command: {text: "Detail Resep", iconClass: "k-icon k-i-pencil"}, attributes:{style: "text-align: center;"}}
          ]
      });

}

</script>

@endsection