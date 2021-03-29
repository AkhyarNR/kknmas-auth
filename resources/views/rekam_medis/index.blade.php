@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<style>
.bottomright {
  position: absolute;
  bottom: 8px;
  right: 16px;
}
</style>

<input type="hidden" id="Jenisindikator">

<!-- Data Pasien IGD -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Rekam Medis</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="grid"></div>
            <script type="text/x-kendo-template" id="template">
            <div class="tabstrip">
                    <ul>
                        <li class="k-state-active">
                           Daftar Pasien
                        </li>                   
                    </ul>
                    <div>
                        <div class="DetailPasien">
                            <div class="detailgrid"></div>
                        </div>
                    </div>
                   
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/x-kendo-template" id="toolbarTemplate">

    <span style="float:left;>
    <input id="dropdown" name="dropdown">
      <label class="search-label" for="tglMulai">Mulai :</label>
      <input id="tglMulai" style="width: 100px;"/>
      <label class="search-label" for="tglSelesai">Sampai :</label>
      <input id="tglSelesai" style="width: 100px;"/>
    
      <a id="exportpdf" class="k-button k-button-icontext" onClick="eksporData()"><span class="k-icon k-i-file-excel"></span>Ekspor Data</a>
    </span>
    <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
      <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
      <span class="k-input-icon"></span>
    </span>
</script>

<style>
    .k-button .k-bare .k-button-icon .k-window-action{
     margin: 200px;   
    }
</style>


<div id="Detail">
  <br>
      <a id="linkCetak" class="k-button k-primary" target="_blank"><span class='k-icon k-i-print'></span> Cetak</a>
  <br>
    <div style="margin-bottom: 30px;" id="pemeriksaanhasildetail"></div>
    <div style="margin-bottom: 30px;" id="diagnosadetail"></div>
    <div style="margin-bottom: 30px;" id="prosedurdetail"></div>
    <div style="margin-bottom: 30px;" id="terapidetail"></div>
    <div style="margin-bottom: 30px;" id="resepdetail"></div>
    <div style="margin-bottom: 30px;" id="catatandetail"></div>
    <div style="margin-bottom: 30px;" id="rujukandetail"></div>
  </div>

  <div id="DetailPemeriksaan">    
    <div style="margin-bottom: 30px;" id="pemeriksaanhasil"></div>
    <div style="margin-bottom: 30px;" id="diagnosa"></div>
    <div style="margin-bottom: 30px;" id="prosedur"></div>
    <div style="margin-bottom: 30px;" id="terapi"></div>
    <div style="margin-bottom: 30px;" id="resep"></div>
    <div style="margin-bottom: 30px;" id="catatan"></div>
    <div style="margin-bottom: 30px;" id="rujukan"></div>
  </div>



<script>
        $(document).ready(function () {
            // var hapusDialog,
            record = 0,
            cari = null;
        
            $("#grid").kendoGrid({
                dataSource: {
                    transport:{
                    read : function(options) {
                        // options.data.cari = cari;
                        options.data.startDate = $("#tglMulai").val();
                        options.data.endDate = $("#tglSelesai").val();  
                        $.ajax({
                        url : '{{ url('rekam_medis/read') }}',
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
                        id: 'Diagnosa_Pasien_Id'
                    }
                    }
                },
                pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
                toolbar: kendo.template($("#toolbarTemplate").html()),
                dataBinding: function() {
                  if(this.dataSource.pageSize() != null){
                    record = (this.dataSource.page() -1) * this.dataSource.pageSize();
                  }else{
                    record = (this.dataSource.page() -1);
                  }
                },
                sortable: {
                    mode: "single",
                    allowUnsort: false
                },
                columns: [
                  { template: "#= ++record #", title: "No", width: 50},
                {
                    field: "Kode_Diagnosa",
                    title: "Kode ICD-9",
                    width: "200px"
                }, {
                    field: "Nama_Penyakit",
                    title: "Nama Penyakit"
                }, {
                    field: "Jumlah",
                    title: "Jumlah",
                    width: "150px"
                }],
            detailTemplate: kendo.template($("#template").html()),
            detailInit: detailInit,
            excel: {
              fileName: "Laporan Rekam Medis.xlsx",
              filterable:true,
              allPages:true,
            },
            });

            //export

            $("#cari").keyup(function () {
            var searchValue = $('#cari').val();
              $("#grid").data("kendoGrid").dataSource.filter({
                logic  : "or",
                filters: [
                  {
                    field   : "Kode_Diagnosa",
                    operator: "contains",
                    value   : searchValue
                  },
                  {
                    field   : "Nama_Penyakit",
                    operator: "contains",
                    value   : searchValue
                  }
                ]
              });
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

        });

        
            
        
        
        function detailInit(e) {
          var detailRow = e.detailRow;
          var data = e.data;
          console.log(data);

          detailRow.find(".tabstrip").kendoTabStrip({
              animation: {
                  open: { effects: "fadeIn" }
              }
          });

          detailRow.find(".detailgrid").kendoGrid({
              dataSource: {
                  // type: "data",                  
                  transport:{
                    read : function(options) {
                      $.ajax({
                          url : '{{ url('rekam_medis/read_detail') }}',
                          type: 'GET',
                          dataType: 'json',
                          // data: options.data,
                          data:{Diagnosa_Id : data.Diagnosa_Id},
                          success: function(res) {
                            // window.open('{{ url('rekam_medis') }}')
                              options.success(res);
                              // console.log(res);
                          }
                        })
                        
                    },
                    //create
                    },
                  serverPaging: true,
                  serverSorting: true,
                  serverFiltering: true,
                  pageSize: 7,
                  schema:{
                      data:'data',
                      total:'total',
                      model:{
                        id: 'Pemeriksaan_Id'
                      }
                    }
              },
              pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
              columns: [
                  { field: "No_Perawatan", title:"No Perawatan", width: "70px" },
                  { field: "Kode_Pasien", title:"No Rekam Medis", width: "70px" },
                  { field: "Nama", title:"Nama Pasien", width: "70px" },
                  { field: "Waktu_Pemeriksaan", title:"Waktu Pemeriksaan Pasien", width: "110px" },
                  {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                      width:"30px",
                      headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                      command:[
                        { iconClass: "k-icon k-i-document-manager",
                          text: "Detail",
                          click: Detail
                        },
                      ]
                  }
              ]
          });

        }


        // Modal Kendo
        var DP = $("#Detail")
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

        function Detail(e) {
        e.preventDefault();
          var tr = $(e.target).closest("tr"),
          data = this.dataItem(tr);
          DP.open();

          $('#linkCetak').attr("href",'rekam_medis/cetak?Pemeriksaan_Id='+data.Pemeriksaan_Id);
          
          console.log('inidata',data.Pemeriksaan_Id);
              // Hasil Pemeriksaan
          $("#pemeriksaanhasildetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailHasil') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          
                        }
                      })
                      
                    },
                    create: function(options) {
                      options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                      // var IndikatorPemeriksaan = $("input[name='IndikatorPemeriksaan[]']").map(function(){
                      //   return this.value;
                      // }).get;
                      $.ajax({
                        headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                },
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/updatehasil') }}',
                        type: 'POST',
                        dataType: 'json',
                        // data: {
                        //   "data" : options.data,
                        //   "IndikatorPemeriksaan[]": $('#HasilForm').serialize() 
                        // },
                        data: $('#HasilForm').serialize() +'&Pemeriksaan_Id='+data.Pemeriksaan_Id,
                        success: function(res) {
                          options.success(res);
                          $('#pemeriksaanhasil').data('kendoGrid').dataSource.read();
                        }
                      })
                    },
                  },
                    serverPaging: true,
                    pageSize: 20,
                    schema:{
                      data:'data',
                      model:{
                          id: 'Pemeriksaan_Hasil_Id',
                          fields: {
                            Pemeriksaan_Id: {
                          type: "text",
                          },
                          Pemeriksaan_Hasil_Id: {
                              type: "text",
                          },
                          Indikator_Pemeriksaan: {
                              type: "text",
                              editable: false
                          },
                          Nilai: {
                              type: "text",
                          }
                        }
                      } 
                    }
                },
                columns: [
                  {field: 'Indikator_Pemeriksaan', title: 'Indikator Pemeriksaan'},
                  {field: 'Nilai',title: 'Hasil Pemeriksaan', template:"#if(data.Nilai == null){# #=data.Indikator_Nilai# #}else{# #=data.Nilai# #}#"},
                
                ],

          }); //FINISH  Hasil Pemeriksaan


      //DIAGNOSA
          $("#diagnosadetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                      
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailDiagnosa') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          console.log(res);
                        }
                      })
                      
                    },
                  },
                    serverPaging: true,
                    pageSize: 20,
                    schema:{
                      data:'data',
                      model:{

                        id: 'Diagnosa_Pasien_Id',
                        fields: {
                          Pemeriksaan_Id: {
                              type: "text",
                          },
                          Diagnosa_Pasien_Id: {
                              type: "text",
                          },
                          Kode_Diagnosa: {
                              type: "text",
                              editable: false
                          },
                          Ciri_Penyakit: {
                              type: "text",
                              editable: false
                          }
                      }
                      } 
                    }
                },

                columns: [
                  {field: 'Kode_Diagnosa', title: 'Kode Diagnosa'},
                  {field: 'Nama_Penyakit', title: 'Nama Penyakit'},
                  {field: 'Ciri_Penyakit', title: 'Ciri Penyakit'},
                ],
          }); //FINISH DIAGNOSA

          // PROSEDUR
          $("#prosedurdetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                  
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailProsedur') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          console.log(res);
                        }
                      })
                      
                    },
                    
                  },

                    serverPaging: true,
                    pageSize: 20,
                    schema:{
                      data:'data',
                      model:{

                        id: 'Prosedur_Medis_Pasien_Id',
                        fields: {
                          Pemeriksaan_Id: {
                              type: "text",
                          },
                          Prosedur_Medis_Pasien_Id: {
                              type: "text",
                          },
                          Deskripsi_Pendek: {
                              type: "text",
                              editable: false
                          },
                          Kode_Prosedur: {
                              type: "text",
                              editable: false
                          }
                      }
                      } 
                    }
                  
                },

                columns: [
                  {field: 'Kode_Prosedur', title: 'Kode Prosedur'},
                  {field: 'Deskripsi_Panjang', title: 'Deskripsi Panjang'},
                  {field: 'Deskripsi_Pendek', title: 'Deskripsi Pendek'},
                ],
          }); //FINISH PROSEDUR

          // TERAPI

          $("#terapidetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                    
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailTerapi') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          console.log(res);
                        }
                      })
                      
                    },
                  },
                    serverPaging: true,
                    pageSize: 20,
                    schema:{
                      data:'data',
                      model:{

                        id: 'Terapi_Pasien_Id',
                        fields: {
                          Pemeriksaan_Id: {
                              type: "text",
                          },
                          Terapi_Pasien_Id: {
                              type: "text",
                          },
                          Dosis: {
                              type: "text",
                          },
                          Jumlah_Obat: {
                              type: "text", 
                          },
                          Kode_Obat: {
                              type: "text",
                              editable: false
                          }
                      }
                      } 
                    }
                },

                columns: [
                  {field: 'Kode_Obat', title: 'Kode Obat'},
                  {field: 'Nama_Obat', title: 'Nama Obat'},
                  {field: 'Dosis', title: 'Dosis'},
                  {field: 'Jumlah_Obat', title: 'Jumlah_Obat'},
                ],
          }); //FINISH TERAPI


          //  //RESEP
          $("#resepdetail").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailResep') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          // console.log('dafadf',res);
                        }
                      })
                    
                  },
                },
                serverPaging: true,
                pageSize: 20,
                schema:{
                  data:'data',
                  model:{
                        id: 'Resep_Obat_Id',
                        fields: {
                          Resep_Obat_Id: {
                              type: "text",
                          },
                          Obat_Id: {
                              type: "text",
                          },
                          No_Resep: {
                              type: "text",
                          },
                          Dosis: {
                              type: "text",
                          },
                          Jumlah: {
                              type: "text", 
                          },
                          Aturan_Pakai: {
                              type: "text", 
                          },
                          Kode_Obat: {
                              type: "text",
                              editable: false
                          }
                        }
                  } 
                }
            }, 
            columns: [
              {field: 'Kode_Obat', title: 'Kode Obat'},
              {field: 'Nama_Obat', title: 'Nama Obat'},
              {field: 'No_Resep', title: 'No Resep'},
              {field: 'Dosis', title: 'Dosis'},
              {field: 'Jumlah', title: 'Jumlah'},
              {field: 'Aturan_Pakai', title: 'Aturan Pakai'},
            ],
          }); //Finish RESEP

          // CATATAN
          $("#catatandetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
          
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailCatatan') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
                        dataType: 'json',
                        success: function(res) {
                          options.success(res);
                          console.log(res);
                        }
                      })
                      
                    },
                  },
                    serverPaging: true,
                    pageSize: 20,
                    schema:{
                      data:'data',
                      model:{
                        id: 'Pasien_Catatan_Id',
                        fields: {
                          Pemeriksaan_Id: {
                              type: "text",
                          },
                          Pasien_Catatan_Id: {
                              type: "text",
                          },
                          Rencana: {
                              type: "text",
                          },
                          Catatan: {
                              type: "text", 
                          }     
                        }
                      } 
                    }
                },

                columns: [
                  {field: 'Rencana', title: 'Rencana'},
                  {field: 'Catatan', title: 'Catatan'},
                ],

          }); //FINISH CATATAN

          //RUJUKAN
          $("#rujukandetail").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                      $.ajax({
                        url : '{{ url('pemeriksaan/poliumum/hasil_pemeriksaan/DetailRujukan') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id },
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
                        id: 'Pasien_Rujukan_Id',
                        fields: {
                          Pasien_Rujukan_Id: {
                              type: "text",
                          },
                          Pemeriksaan_Id: {
                              type: "text",
                          },
                          Jenis_Rujukan_Id: {
                              type: "text",
                          },
                          Tindakan_Rujukan_Id: {
                              type: "text",
                          },
                          Employee_Id: {
                              type: "text",
                          },
                          Work_Unit_Id: {
                              type: "text", 
                          }
                        }
                  } 
                }
            }, 

            columns: [
              {field: 'Jenis_Rujukan', title: 'Jenis Rujukan'},
              {field: 'Nama_Tindakan', title: 'Tindakan Rujukan'},
              {field: 'Full_Name', title: 'Dokter Perujuk'},
              {field: 'Work_Unit_Name', title: 'Nama Poli'},
            ],
      }); //Finish RUJUKAN
    }

    function eksporData(){
      var dataSource = $("#grid").data("kendoGrid").dataSource;
      total = dataSource.total();
      dataSource.pageSize(total);
      $("#grid").getKendoGrid().saveAsExcel('Laporan Rekam Medis.xlsx');
      dataSource.pageSize(20);        
    }

    
  </script>
@endsection