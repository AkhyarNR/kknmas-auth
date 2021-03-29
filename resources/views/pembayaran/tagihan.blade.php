@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Tagihan -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Tagihan</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="grid" class="detailInit"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="container" id="detail">
    <div>
        <h6>Biaya Pemeriksaan</h6>
        <div style="margin-bottom: 30px;" id="biayaPemeriksaan">
    </div>
    <div>
        <h6>Biaya Terapi</h6>
        <div style="margin-bottom: 30px;" id="biayaTerapi"></div>
    </div>
    <div>
        <h6>Biaya Resep Obat</h6>
        <div style="margin-bottom: 30px;" id="biayaResep"></div>
    </div>
</div>

<div id="modalKasir">
    <div class="row" style="margin-left: 10px">
        <button style="margin-bottom: 10px;" id="button_tambahObat" onclick="tambahObat()">Tambah Obat</button>
        <button style="margin-bottom: 10px;" id="button_bayar" onclick="bayar()">Bayar</button>
        <input type="hidden" id="tagihanPasienId"></input>
    </div>
</div>



<style>
    .k-button .k-bare .k-button-icon .k-window-action{
     margin: 200px;   
    }
</style>

<script type="text/x-kendo-template" id="toolbar_date">
  <label class="search-label" for="tglMulai">Mulai :</label>
  <input id="tglMulai" style="width: 100px;"/>
  <label class="search-label" for="tglSelesai">Sampai :</label>
  <input id="tglSelesai" style="width: 100px;"/>
</script>

<script type="text/x-kendo-template" id="toolbar_cari">
  <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>

<script>
  var record = 0;

  $(function(){
    var cari = null;
    $('#grid').kendoGrid({
      dataSource: {
        transport:{
          read : function(options) {
            options.data.cari = cari;
            $.ajax({
              url : '{{ route('tagihan.mainRead') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res.data);                
              }
            });
          },
        },
        serverPaging: true,
        pageSize: 10,
        sschema:{
          data:'data',
          total:'total',
          model:{
            id: 'Pasien_Id'
          }
        }
      },
      sortable: true,
      toolbar: kendo.template($("#toolbar_cari").html()),
      columns:[
        {
          title: "No.",
          template: "#= ++record #.",
          width: 50
        },
        {
          field: 'tr_pasien.Nama',
          title: 'Nama',
          // width: "150px",
          headerAttributes:{
            style: "text-align: center;"
          }
        },
      ],
      dataBinding: function() {
        record = (this.dataSource.page() -1) * this.dataSource.pageSize() ;
      },
      pageable: true,
      editable: 'inline',
      detailInit: detailInit,
    });

    $("#cari").keyup(function () {
      var searchValue = $('#cari').val();
      var grid = $("#grid").data("kendoGrid");
      grid.dataSource.filter({
        logic: "or",
        filters: [
          {
            field: "tr_pasien.Nama",
            operator: "contains",
            value: searchValue
          },
        ]
      });
    });
  });

  //init
  function detailInit(e) {
    var detail_init = $("<div class='detailInit'/>").appendTo(e.detailCell).kendoGrid({
      dataSource: {
        transport:{
          read : function(options) {
            options.data.Pasien_Id = e.data.Pasien_Id;
            // console.log(e.data.Pasien_Id);
            options.data.startDate = $("#tglMulai").val();
            options.data.endDate = $("#tglSelesai").val();
            $.ajax({
              url : '{{ route('tagihan.read') }}',
              type: 'GET',
              dataType: 'json',
              data: options.data,
              success: function(res) {
                options.success(res);
              }
            });
          },
        },
        serverPaging: true,
        pageSize: 10,
        schema:{
          data:'data',
          total:'total',
          model:{
            id: 'Tagihan_Pasien_Id'
          }
        }
      },
      toolbar: kendo.template($("#toolbar_date").html()),
      columns:[
        {
          title: ".#",
          template: "#= ++record #.",
          width: 45
        },
        {
          field: 'tr_pasien.Kode_Pasien',
          title: 'No. RM',
          width: "120px",
          headerAttributes:{
            style: "text-align: center;"
          }
        },
        {
          field: 'tr_pasien.Nama',
          title: 'Nama',
          headerAttributes:{
            style: "text-align: center;"
          }
        },
        {
          field: 'No_Tagihan',
          title: 'No. Tagihan',
          headerAttributes:{
            style: "text-align: center;"
          }
        },
        {
          field: 'Tanggal_Pemeriksaan',
          title: 'Tgl Pemeriksaan',
          width: "150px",
          template: "#: kendo.toString(kendo.parseDate(Tanggal_Pemeriksaan), 'dd-MM-yyyy | HH:mm tt') #",
          headerAttributes:{
            style: "text-align: center;"
          }
        },
        {
          headerTemplate: "<span class='k-icon k-i-gear'></span>",
          headerAttributes: { class: "table-header-cell", style: "text-align: center" },
          command:[
            {
              iconClass: "k-icon k-i-track-changes-enable",
              text: "Detail",
              click: detail
            },
            {
              iconClass: ".k-i-cart.k-i-shopping-cartUnicode: e143",
              text: "Bayar",
              click: kasir
            },
          ]
        }
      ],
      dataBinding: function() {
        record = (this.dataSource.page() -1) * this.dataSource.pageSize();
      },
      pageable: true,
      editable: 'inline'
    });

    function startChange() {
      var startDate = start.value(),
      endDate = end.value();
      $("#grid").data("kendoGrid").dataSource.read();
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
  }

  var DP = $("#detail")
  .kendoWindow({
    position: {
      top: 10, // or "100px"
      left: "20%"
    },
      title: "Detail Pemeriksaan",
      modal: true,
      visible: false,
      resizable: false,
      width: 1000
  }).data("kendoWindow");

  function detail(e) {
    e.preventDefault();
    var tr = $(e.target).closest("tr"),
    data = this.dataItem(tr);
    DP.open();

    // Biaya Pemeriksaan
    $("#biayaPemeriksaan").kendoGrid({
      dataSource: {
          transport:{
            read : function(options) {
              var tagihanPasienId = data.Tagihan_Pasien_Id;
              $.ajax({
                url : '{{ route('biayaPemeriksaan') }}',
                type: 'GET',
                data:{
                  TagihanPasienId: tagihanPasienId
                },
                dataType: 'json',
                success: function(res) {
                  options.success(res);                  
                }
              })
              
            },
          },
            serverPaging: true,
            pageSize: 20,
            schema:{
              data:'data',
              model:{
                id: 'Pemeriksaan_Id',
              } 
            }
        },

        columns: [
          {field: '', title: 'Kode Pemeriksaan', template: '#:data.mstr_prosedur_medis_biaya.mstr_prosedur_medis.Kode_Prosedur#'},
          {field: '', title: 'Nama Pemeriksaan', template: '#:data.mstr_prosedur_medis_biaya.mstr_prosedur_medis.Deskripsi_Panjang#'},
          {
            field: '', title: 'Biaya Pemeriksaan',
            template: 'Rp #:data.mstr_prosedur_medis_biaya.Jasa_Medis + data.mstr_prosedur_medis_biaya.Hak_RS + data.mstr_prosedur_medis_biaya.BHP + data.mstr_prosedur_medis_biaya.Pajak#',
            format:'{0:c}',
            attributes:{
              style: "text-align: right;",
            },
            headerAttributes:{
              style: "text-align: center;"
            }
          },
        ],
    });

    // Biaya Terapi
    $("#biayaTerapi").kendoGrid({
      dataSource: {
          transport:{
            read : function(options) {
              var tagihanPasienId = data.Tagihan_Pasien_Id;
              $.ajax({
                url : '{{ route('biayaTerapi') }}',
                type: 'GET',
                data:{TagihanPasienId : tagihanPasienId},
                dataType: 'json',
                success: function(res) {
                  options.success(res);                  
                }
              })
              
            },
          },
            serverPaging: true,
            pageSize: 20,
            schema:{
              data:'data',
              model:{
                id: 'Pemeriksaan_Id',
              } 
            }
        },

        columns: [
          {field: '', title: 'Kode Obat', template: '#:data.tr_terapi.mstr_obat.Kode_Obat#'},
          {field: '', title: 'Nama Obat', template: '#:data.tr_terapi.mstr_obat.Nama_Obat#'},
          {field: '', title: 'Dosis', template: '#:data.tr_terapi.Dosis#'},
          {field: '', title: 'Jumlah Obat', template: '#:data.tr_terapi.Jumlah_Obat#'},
          {
            field: '', title: 'Harga Obat',
            template: 'Rp #:data.tr_terapi.Jumlah_Obat * data.tr_terapi.mstr_obat.Harga_Dasar#',
            format:'{0:c}',
            attributes:{
              style: "text-align: right;",
            },
            headerAttributes:{
              style: "text-align: center;"
            }
          },
        ],
    });

    // Biaya Resep Obat
    $("#biayaResep").kendoGrid({
      dataSource: {
          transport:{
            read : function(options) {
              var tagihanPasienId = data.Tagihan_Pasien_Id;
              $.ajax({
                url : '{{ route('biayaResep') }}',
                type: 'GET',
                data:{TagihanPasienId : tagihanPasienId},
                dataType: 'json',
                success: function(res) {
                  options.success(res);           
                }
              })
              
            },
          },
            serverPaging: true,
            pageSize: 20,
            schema:{
              data:'data',
              model:{
                id: 'Pemeriksaan_Id',
              } 
            }
        },

        columns: [
          {field: '', title: 'No. Resep', template: '#:data.tr_resep_obat.No_Resep#'},
          {field: '', title: 'Nama Obat', template: '#:data.tr_resep_obat.mstr_obat.Nama_Obat#'},
          {field: '', title: 'Dosis', template: '#:data.tr_resep_obat.Dosis#'},
          {field: '', title: 'Aturan Pakai', template: '#:data.tr_resep_obat.Aturan_Pakai#'},
          {field: '', title: 'Jumlah Obat', template: '#:data.tr_resep_obat.Jumlah#'},
          {
            field: '', title: 'Harga Obat',
            template: 'Rp #:data.tr_resep_obat.Jumlah * tr_resep_obat.mstr_obat.Harga_Dasar#',
            format:'{0:c}',
            attributes:{
              style: "text-align: right;",
            },
            headerAttributes:{
              style: "text-align: center;"
            }
          },
        ],
    });
  }
  
  var payKasir = $("#modalKasir").kendoWindow({
    position: {
      top: 50, // or "100px"
      left: "12%"
    },
    title: "Pembayaran",
    modal: true,
    visible: false,
    resizable: false,
    width: 1200,

  }).data("kendoWindow");

  function kasir(e) {
    e.preventDefault();
    var tr = $(e.target).closest("tr");
    var data = this.dataItem(tr);    
    payKasir.open();
    $('#tagihanPasienId').val(data.Tagihan_Pasien_Id);

    $("#modalKasir").kendoGrid({
      dataSource: {
        transport:{
          read : function(options) {
            var tagihanPasien = data.Tagihan_Pasien_Id;
            
            $.ajax({
              url : "{{ route('tagihan.kasir') }}",
              type: "GET",
              dataType: 'json',
              data: {TagihanPasienId: tagihanPasien},
              success: function(res) {
                options.success(res);
              }
            });
          },
        },
        serverPaging: true,
        pageSize: 20,
        schema:{
          data:'data',
          model:{
            id: 'Kasir',
          } 
        },
        aggregate:[
          {field: 'Harga_Total', aggregate: "sum"}
        ]
      },
      columns: [
        {
          title: ".#",
          template: "#= ++record #.",
          width: 45
        },
        {field: '', title: 'Nama Item', template: '#:data.Item_Biaya#'},
        {field: '', title: 'Jumlah', template: '#:data.Jumlah#'},
        {
          field: '', title: 'Harga Satuan', template: 'Rp #:data.Harga_Satuan#', format:'{0:c}',
          attributes:{
            style: "text-align: right;",
          },
        },
        {
          field: '', title: 'Diskon', template: '#:data.Diskon#',
          footerTemplate: "<div style='text-align: center'>TOTAL</div>", format:'{0:c}',
          attributes:{
            style: "text-align: right;",
          },
        },
        {
          field: '', title: 'Harga Total', template: 'Rp #:data.Harga_Total#',
          format:'{0:c}', footerTemplate: "<div style='float: right'><h6><b>Rp #=data.Harga_Total.sum#</b></h6></div>",
          attributes:{
            style: "text-align: right;",
          },
        }
      ],
      dataBinding: function() {
        record = (this.dataSource.page() -1) * this.dataSource.pageSize() ;
      },
    });
  }

  function bayar() {
    var tagihanPasien = $('#tagihanPasienId').val();
    console.log(tagihanPasien);
    
    $.ajax({
      url : "{{ route('tagihan.bayar') }}",
      type: "GET",
      dataType: 'json',
      data: {TagihanPasienId: tagihanPasien},
      success: function(res) {
        if (res.status == 1) 
          swal({
            title: "Berhasil",
            type: "success",
            text: 'Anda Berhasil Menyimpan Pembayaran',
            button: {
              closeModal: false,
            },
          })
          
          
        else 
          console.log(res.exp);

       

      }
    });
  }
</script>
@endsection