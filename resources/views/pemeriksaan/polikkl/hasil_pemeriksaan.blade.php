@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>Hasil Pemeriksaan Poli Kulit Dan Kelamin</h3>
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

<script type="text/x-kendo-template" id="toolbarTemplate">
  <label class="search-label" for="tglMulai">Mulai :</label>
  <input id="tglMulai" style="width: 100px;"/>
  <label class="search-label" for="tglSelesai">Sampai :</label>
  <input id="tglSelesai" style="width: 100px;"/>

  <span class="k-textbox k-grid-search k-display-flex" style="float:right;">
    <input autocom"k-button k-grid-addplete="off" id="cari" placeholder="Search..." title="Search..." class="k-input">
        <span class="k-input-icon">
        </span>
    </span>
</script>


<script type="text/x-kendo-template" id="ResepTemplate">
    <div class="k-edit-label"><label for="Obat_Id">Obat</label></div>
    <div data-container-for="Obat_Id" class="k-edit-field">
        <input name="Obat_Id" class="input-width-modal" data-bind="value:Obat_Id">
    </div>
    <div class="k-edit-label"><label for="Dosis">Dosis</label></div>
        <div data-container-for="Dosis" class="k-edit-field">
        <input type="text" class="k-input k-textbox input-width-modal" data-bind="value:Dosis" name="Dosis">
    </div>
    <div class="k-edit-label"><label for="Jumlah">Jumlah</label></div>
        <div data-container-for="Jumlah" class="k-edit-field">
        <input type="number" class="k-input k-textbox input-width-modal" data-bind="value:Jumlah" name="Jumlah">
    </div>
    <div class="k-edit-label"><label for="Aturan_Pakai">Aturan Pakai</label></div>
    <div data-container-for="Aturan_Pakai" class="k-edit-field">
    <input type="text" class="k-input k-textbox input-width-modal" data-bind="value:Aturan_Pakai" name="Aturan_Pakai">
    </div>
</script>
  
  <script type="text/x-kendo-template" id="RujukanTemplate">
      <div class="k-edit-label"><label for="Jenis_Rujukan_Id">Jenis Rujukan</label></div>
      <div data-container-for="Jenis_Rujukan_Id" class="k-edit-field">
          <input name="Jenis_Rujukan_Id" id="Jenis_Rujukan_Id" class="input-width-modal" data-bind="value:Jenis_Rujukan_Id">
      </div>
    <div id="poli" style="display:none;">
      <div class="k-edit-label"><label for="Work_Unit_Id">Poliklinik</label></div>
          <div data-container-for="Work_Unit_Id" class="k-edit-field">
          <input class="k-input k-textbox input-width-modal" data-bind="value:Work_Unit_Id" name="Work_Unit_Id" >
      </div>
    </div>
    <div id="tindakan" style="display:none;">
      <div class="k-edit-label"><label for="Tindakan_Rujukan_Id">Tindakan Rujukan</label></div>
          <div data-container-for="Tindakan_Rujukan_Id" class="k-edit-field">
          <input class="k-input k-textbox input-width-modal" data-bind="value:Tindakan_Rujukan_Id" id="Tindakan_Rujukan_Id" name="Tindakan_Rujukan_Id">
      </div>
    </div>
  </script>
  
  <script type="text/x-kendo-template" id="HasilTemplate">
    <form id="HasilForm">
    </form>
  </script>
  

  <div id="Detail">
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



<div id="hapusDialog"></div>


<script>
    $(function(){
        var cari = null;
      $('#grid').kendoGrid({
        dataSource: {
          transport:{
            read : function(options) {
            options.data.cari = cari;
            options.data.startDate = $("#tglMulai").val();
            options.data.endDate = $("#tglSelesai").val();
              $.ajax({
                url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/read') }}',
                type: 'GET',
                dataType: 'json',
                data: options.data,
                success: function(res) {
                  options.success(res);
                }
              })
            },

            destroy: function(options){
            $.ajax({
              url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/Hapus') }}',
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
              id: 'Pemeriksaan_Id'
            }
          }
        },
        toolbar: kendo.template($("#toolbarTemplate").html()),
        columns:[
  

          {field: 'Kode_Pasien', title: 'No RM'},
          {field: 'No_Perawatan', title: 'No Perawatan'},

          {field: 'Waktu_Pemeriksaan', title: 'Waktu Pemeriksaan',template:"#: kendo.toString(kendo.parseDate(data.Waktu_Pemeriksaan), 'dd-MM-yyyy | HH:mm tt') #"},
          {field: 'Nama', title: 'Nama Pasien'},
          {field: 'Full_Name', title: 'Nama Dokter'},

        {headerTemplate: "<span class='k-icon k-i-gear'></span>",
        headerAttributes: { class: "table-header-cell", style: "text-align: center" },
        command:[
                    { iconClass: "k-icon k-i-document-manager",
                      text: "Detail",
                      click: Detail
                    },
                    { iconClass: "k-icon k-i-change-manually",
                      text: "Edit",
                      click: DetailPemeriksaan

                    },
                    { name: "Hapus",
                      iconClass: "k-icon k-i-cancel-outline",
                      text: "Hapus",
                      click: HapusPemeriksaan
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
          editable: {
            mode: "popup",
          },

      });

      $('#cari').keyup(function(e){
            cari = $('#cari').val();
            $('#grid').data('kendoGrid').dataSource.read();

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

  }); //end grid

    function HapusPemeriksaan(e) {
          e.preventDefault();
          var tr = $(e.target).closest("tr"),
          data = this.dataItem(tr);
          hapusDialog = $("#hapusDialog").kendoDialog({
                      width: "350px",
                      title: "Hapus Pemeriksaan",
                      visible: true,
                      content:"Apakah anda yakin ingin Menghapus Pemeriksaan?",
                      buttonLayout: "stretched",
                      actions: [
                          {
                              text: "Hapus",
                              primary: true,
                              action: function (e) {
                                  var id = {Pemeriksaan_Id: data.Pemeriksaan_Id};
                                  $.ajax({
                                      headers: {
                                          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                      },
                                      url: "{{ asset('pemeriksaan/polikkl/hasil_pemeriksaan/Hapus') }}",
                                      type: "GET",
                                      data: id,
                                      dataType: "json",
                                      complete: function (e) {
                                        $('#grid').data('kendoGrid').dataSource.read();
                                      },
                                  });
                              }
                          },
                          {text: "Batal"}
                      ]
          }).data("kendoDialog");
    }

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
              // Hasil Pemeriksaan
          $("#pemeriksaanhasildetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                      $.ajax({
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailHasil') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updatehasil') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailDiagnosa') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailProsedur') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailTerapi') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailResep') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailCatatan') }}',
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
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailRujukan') }}',
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

    }//end detail

    var dtl = $("#DetailPemeriksaan").kendoWindow({
          position: {
            top: 10, // or "100px"
            left: "20%"
          },
            modal: true,
            visible: false,
            resizable: false,
            width: 1000
        }).data("kendoWindow");

  function DetailPemeriksaan(e) {
    e.preventDefault();
        var tr = $(e.target).closest("tr"),
        data = this.dataItem(tr);
        dtl.open();
             // Hasil Pemeriksaan
        $("#pemeriksaanhasil").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailHasil') }}',
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
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updatehasil') }}',
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
                
                update: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updatehasil') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#pemeriksaanhasil').data('kendoGrid').dataSource.read();
                      }
                    })
                  }
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
              toolbar: [{name:'create', text:"Edit Data Pemeriksaan", id:"Hasil"}],

              columns: [
                {field: 'Indikator_Pemeriksaan', title: 'Indikator Pemeriksaan'},
                {field: 'Nilai',title: 'Hasil Pemeriksaan', template:"#if(data.Nilai == null){# #=data.Indikator_Nilai# #}else{# #=data.Nilai# #}#"},
              
              ],
              pageable: true,
              editable: {
                mode:"popup",
                template: $("#HasilTemplate").html(),
              },
              edit: function(ee){
                $('.k-window-title').text("Edit Data");
                var Pemeriksaan_Id = data.Pemeriksaan_Id;
                var inputan ="";
                $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailHasil') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        var triaseval;
                        $.each(res['data'], function(q,value){
                          inputan = inputan+"<div class='k-edit-label'><label for='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"'>"+value.Indikator_Pemeriksaan+"</label></div><div data-container-for='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"' class='k-edit-field'><input name='IndikatorPemeriksaan["+value.Indikator_Pemeriksaan_Id+"]' id='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"' class='input-width-modal' value='"+value.Nilai+"'></div>";
                          if(value.Indikator_Pemeriksaan_Id == 31){
                            triaseval = value.Indikator_Nilai_Id;
                          }
                          console.log('value', value);
                        })
                        
                        $('#HasilForm').append(inputan);

                        $('#IndikatorPemeriksaan31').kendoDropDownList({
                            optionLabel: "-Pilih Triase-",
                                dataTextField: "Nilai",
                                dataValueField: "Indikator_Nilai_Id",
                                dataSource:{
                                    transport:{
                                        read:{
                                            type: "GET",
                                            url: "{{route('dropdown.getTriaseKKL')}}",
                                            dataType: "json"
                                        }
                                    }
                                }
                        });

                        $('#IndikatorPemeriksaan31').data('kendoDropDownList').value(triaseval);

                      }
                });
              }

        }); //FINISH  Hasil Pemeriksaan

     //DIAGNOSA
        $("#diagnosa").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                    
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailDiagnosa') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                        console.log(res);
                      }
                    })
                    
                  },

                  create: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    options.data.Diagnosa_Id = $('input[name="Nama_Penyakit"]').data('kendoComboBox').value();

                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/creatediagnosa') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#diagnosa').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },
                  update: function(options) {
                    options.data.Diagnosa_Id = $('input[name="Nama_Penyakit"]').data('kendoComboBox').value();

                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updatediagnosa') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#diagnosa').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },

                    destroy: function(options){
                      $.ajax({
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deletediagnosa') }}',
                        dataType:'json',
                        type:'GET',
                        data:options.data,
                        success:function(res){
                          options.success(res);
                          
                          $('#diagnosa').data('kendoGrid').dataSource.read();
                        }
                      })
                    }
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

              toolbar: [{name:'create', text:"Tambah Data Diagnosa"}],

              columns: [
                {field: 'Kode_Diagnosa', title: 'Kode Diagnosa'},
                {field: 'Nama_Penyakit', title: 'Nama Penyakit'},
                {field: 'Ciri_Penyakit', title: 'Ciri Penyakit'},
                {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                 headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                 command:['edit','destroy']},
              ],
              pageable: true,
              editable: {
                mode:"inline"
              },
              edit : function(e) {
                $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

                e.container.parent().find('[name="Nama_Penyakit"]').kendoComboBox({
                    placeholder: "Select Diagnosa...",
                    dataTextField: "Nama_Penyakit",
                    dataValueField: "Diagnosa_Id",
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
                                url: "{{route('dropdown.getDiagnosa')}}",
                                dataType: "json"
                            }
                        }
                    }
                });
                e.container.parent().find('input[name="Nama_Penyakit"]').data('kendoComboBox').value(e.model.Diagnosa_Id);
              }
        }); //FINISH DIAGNOSA

        // PROSEDUR
        $("#prosedur").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                 
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailProsedur') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                        console.log(res);
                      }
                    })
                    
                  },

                  create: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    options.data.Prosedur_Medis_Biaya_Id = $('input[name="Deskripsi_Panjang"]').data('kendoComboBox').value();

                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/createprosedur') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#prosedur').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },
                  update: function(options) {
                    options.data.Prosedur_Medis_Biaya_Id = $('input[name="Deskripsi_Panjang"]').data('kendoComboBox').value();

                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updateprosedur') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#prosedur').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },

                    destroy: function(options){
                      $.ajax({
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deleteprosedur') }}',
                        dataType:'json',
                        type:'GET',
                        data:options.data,
                        success:function(res){
                          options.success(res);
                          
                          $('#prosedur').data('kendoGrid').dataSource.read();
                        }
                      })
                    }
                  
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
                        Prosedur_Medis_Biaya_Id: {
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

              toolbar: [{name:'create', text:"Tambah Prosedur"}],


              columns: [
                {field: 'Kode_Prosedur', title: 'Kode Prosedur'},
                {field: 'Deskripsi_Panjang', title: 'Deskripsi Panjang'},
                {field: 'Deskripsi_Pendek', title: 'Deskripsi Pendek'},
                {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                 headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                 command:['edit','destroy']},
              ],
              pageable: true,
              editable: {
                mode:"inline"
              },
              edit : function(e) {
                $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");

                e.container.parent().find('[name="Deskripsi_Panjang"]').kendoComboBox({
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
                e.container.parent().find('input[name="Deskripsi_Panjang"]').data('kendoComboBox').value(e.model.Prosedur_Medis_Biaya_Id);
              }
        }); //FINISH PROSEDUR

         // TERAPI

        $("#terapi").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                   
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailTerapi') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                        console.log(res);
                      }
                    })
                    
                  },

                  create: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    options.data.Obat_Id = $('input[name="Nama_Obat"]').data('kendoComboBox').value();
                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/createterapi') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#terapi').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },
                  update: function(options) {
                    options.data.Obat_Id = $('input[name="Nama_Obat"]').data('kendoComboBox').value();

                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updateterapi') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#terapi').data('kendoGrid').dataSource.read();
                      }
                    })
                    
                  },

                    destroy: function(options){
                      $.ajax({
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deleteterapi') }}',
                        dataType:'json',
                        type:'GET',
                        data:options.data,
                        success:function(res){
                          options.success(res);
                          
                          $('#terapi').data('kendoGrid').dataSource.read();
                        }
                      })
                    }
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

              toolbar: [{name:'create', text:"Tambah Data Terapi"}],

              columns: [
                {field: 'Kode_Obat', title: 'Kode Obat'},
                {field: 'Nama_Obat', title: 'Nama Obat'},
                {field: 'Dosis', title: 'Dosis'},
                {field: 'Jumlah_Obat', title: 'Jumlah_Obat'},
                {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                 headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                 command:['edit','destroy']},
              ],
              pageable: true,
              editable: {
                mode:"inline"
              },
              edit : function(e) {
                $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");


                e.container.on("focus").find('[name="Nama_Obat"]').kendoComboBox({
                    placeholder: "Select Obat...",
                    dataTextField: "Nama_Obat",
                    dataValueField: "Obat_Id",
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
                                url: "{{route('dropdown.getObat')}}",
                                dataType: "json"
                            }
                        }
                    }
                })
                e.container.parent().find('input[name="Nama_Obat"]').data('kendoComboBox').value(e.model.Obat_Id);
              }
        }); //FINISH TERAPI


        //  //RESEP
        $("#resep").kendoGrid({
          dataSource: {
              transport:{
                read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
               
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailResep') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                        // console.log('dafadf',res);
                      }
                    })
                  
                },
                create : function(options) {
                  options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                  options.data.Obat_Id = $('input[name="Obat_Id"]').data('kendoComboBox').value();

                  $.ajax({
                    headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                    url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/createresep') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: options.data,
                    success: function(res) {
                      options.success(res);
                      $('#resep').data('kendoGrid').dataSource.read();
                    }
                  })
                },
                update: function(options) {
                      options.data.Obat_Id = $('input[name="Obat_Id"]').data('kendoComboBox').value();
                      options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                      $.ajax({
                        headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                },
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updateresep') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: options.data,
                        success: function(res) {
                          options.success(res);
                          $('#resep').data('kendoGrid').dataSource.read();
                        }
                      })
                      
                },
                destroy: function(options){
                  $.ajax({
                    url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deleteresep') }}',
                    dataType:'json',
                    type:'GET',
                    data:options.data,
                    success:function(res){
                      options.success(res);
                      
                      $('#resep').data('kendoGrid').dataSource.read();
                    }
                  })
                }
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
          toolbar: [{name:'create', text:"Tambah Data Resep"}],
          columns: [
            {field: 'Kode_Obat', title: 'Kode Obat'},
            {field: 'Nama_Obat', title: 'Nama Obat'},
            {field: 'No_Resep', title: 'No Resep'},
            {field: 'Dosis', title: 'Dosis'},
            {field: 'Jumlah', title: 'Jumlah'},
            {field: 'Aturan_Pakai', title: 'Aturan Pakai'},
            {headerTemplate: "<span class='k-icon k-i-gear'></span>",
             headerAttributes: { class: "table-header-cell", style: "text-align: center" },
             command:['edit','destroy']},
          ],
          pageable: true,
          editable: {
            mode:"popup",
            template: $("#ResepTemplate").html(),
          },
          edit : function(e) {
            $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");
            e.container.parent().find('input[name="Obat_Id"]').kendoComboBox({
                    placeholder: "Select Obat...",
                    dataTextField: "Nama_Obat",
                    dataValueField: "Obat_Id",
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
                                url: "{{route('dropdown.getObat')}}",
                                dataType: "json"
                            }
                        }
                    }
                })
                e.container.parent().find('input[name="Obat_Id"]').data('kendoComboBox').value(e.model.Obat_Id);
          }
        }); //Finish RESEP

        // CATATAN
        $("#catatan").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
        
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailCatatan') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                        console.log(res);
                      }
                    })
                    
                  },

                  create: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/createcatatan') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#catatan').data('kendoGrid').dataSource.read();
                      }
                    })
                  },
                  update: function(options) {
                    options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updatecatatan') }}',
                      type: 'POST',
                      dataType: 'json',
                      data: options.data,
                      success: function(res) {
                        options.success(res);
                        $('#catatan').data('kendoGrid').dataSource.read();
                      }
                    })
                  },

                    destroy: function(options){
                      $.ajax({
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deletecatatan') }}',
                        dataType:'json',
                        type:'GET',
                        data:options.data,
                        success:function(res){
                          options.success(res);
                          
                          $('#catatan').data('kendoGrid').dataSource.read();
                        }
                      })
                    }
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
              toolbar: [{name:'create', text:"Tambah Data Catatan"}],

              columns: [
                {field: 'Rencana', title: 'Rencana'},
                {field: 'Catatan', title: 'Catatan'},
           
                {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                 headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                 command:['edit','destroy']},
              ],
              pageable: true,
              editable: 'inline'

        }); //FINISH CATATAN

        //RUJUKAN
        $("#rujukan").kendoGrid({
          dataSource: {
              transport:{
                read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                    $.ajax({
                      url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/DetailRujukan') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id },
                      dataType: 'json',
                      success: function(res) {
                        options.success(res);
                      }
                    })
                  
                },
                update: function(options) {
                  options.data.Pemeriksaan_Id = data.Pemeriksaan_Id;
                  options.data.Jenis_Rujukan_Id = $('input[name="Jenis_Rujukan_Id"]').data('kendoDropDownList').value();
                  options.data.Tindakan_Rujukan_Id = $('input[name="Tindakan_Rujukan_Id"]').data('kendoDropDownList').value();
                  options.data.Work_Unit_Id = $('input[name="Work_Unit_Id"]').data('kendoDropDownList').value();

                      $.ajax({
                        headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                },
                        url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/updaterujukan') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: options.data,
                        success: function(res) {
                          options.success(res);
                          $('#rujukan').data('kendoGrid').dataSource.read();
                        }
                      })
                      
                },
                destroy: function(options){
                  $.ajax({
                    url : '{{ url('pemeriksaan/polikkl/hasil_pemeriksaan/deleterujukan') }}',
                    dataType:'json',
                    type:'GET',
                    data:options.data,
                    success:function(res){
                      options.success(res);
                      
                      $('#rujukan').data('kendoGrid').dataSource.read();
                    }
                  })
                }
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
          toolbar: [{text:"Data Rujukan"}],
 
          columns: [
            {field: 'Jenis_Rujukan', title: 'Jenis Rujukan'},
            {field: 'Nama_Tindakan', title: 'Tindakan Rujukan'},
            {field: 'Full_Name', title: 'Dokter Perujuk'},
            {field: 'Work_Unit_Name', title: 'Nama Poli'},
            {headerTemplate: "<span class='k-icon k-i-gear'></span>",
             headerAttributes: { class: "table-header-cell", style: "text-align: center" },
             command:['edit','destroy']},
          ],
          pageable: true,
          editable: {
            mode:"popup",
            template: $("#RujukanTemplate").html(),
          },
          edit : function(e) {
            $('.k-window-title').text(e.model.isNew() ? "Tambah Data" : "Edit Data");
            $("#Jenis_Rujukan_Id").kendoDropDownList({
            optionLabel: "-Pilih Rujukan-",
            dataTextField: "Jenis_Rujukan",
            dataValueField: "Jenis_Rujukan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getRujukan')}}",
                        dataType: "json"
                    }
                }
             },
            change: function(e){
                var data = this.dataItem(e.item);
                if (data.Kode_Jenis_Rujukan == 'POL'){
                    $("#poli").show();
                    $("#tindakan").hide();
                }
                else if(data.Kode_Jenis_Rujukan == 'OPS'){
                    $("#poli").hide();
                    $("#tindakan").hide();
                }
                else if(data.Kode_Jenis_Rujukan == 'RDI'){
                    $("#poli").hide();
                    $("#tindakan").show();
                }
                else if(data.Kode_Jenis_Rujukan == 'LAB'){
                    $("#poli").hide();
                    $("#tindakan").show();
                }
            }
        })
        $("#Tindakan_Rujukan_Id").kendoDropDownList({
          cascadeFrom: "Jenis_Rujukan_Id",
          optionLabel: "-Pilih Tindakan-",
            dataTextField: "Nama_Tindakan",
            dataValueField: "Tindakan_Rujukan_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.geTindakanRujukan')}}",
                        dataType: "json"
                    }
                }
            }
        })
        $('input[name="Work_Unit_Id"]').kendoDropDownList({
          optionLabel: "-Pilih Poliklinik-",
            dataTextField: "Work_Unit_Name",
            dataValueField: "Work_Unit_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getWorkUnit')}}",
                        dataType: "json"
                    }
                }
            }
        })
        }
        }); //Finish RUJUKAN
  }

        
  function convertValues(value) {
            var data = {};

            value = $.isArray(value) ? value : [value];

            for (var idx = 0; idx < value.length; idx++) {
                data["values[" + idx + "]"] = value[idx];
            }

            return data;
        }
//Finish Detail Pemeriksaan
  </script>

@endsection