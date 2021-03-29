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
            <h3>Hasil Pemeriksaan Lab.Mikrobiologi</h3>
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
  
  <script type="text/x-kendo-template" id="HasilTemplate">
    <form id="HasilForm">
    </form>
  </script>
  

  <div id="Detail">
    <div style="margin-bottom: 30px;" id="pemeriksaanhasildetail"></div>
    <div style="margin-bottom: 30px;" id="prosedurdetail"></div>
    <div style="margin-bottom: 30px;" id="catatandetail"></div>
  </div>

  <div id="DetailPemeriksaan">    
    <div style="margin-bottom: 30px;" id="pemeriksaanhasil"></div>
    <div style="margin-bottom: 30px;" id="prosedur"></div>
    <div style="margin-bottom: 30px;" id="catatan"></div>
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
                url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/read') }}',
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
              url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/Hapus') }}',
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
          {field: 'nama_dokter', title: 'Nama Dokter'},
          {field: 'nama_perawat', title: 'Nama Perawat'},

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
                                      url: "{{ asset('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/Hapus') }}",
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
                        url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailHasil') }}',
                        type: 'GET',
                        data:{Pemeriksaan_Id : Pemeriksaan_Id},
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

          // PROSEDUR
          $("#prosedurdetail").kendoGrid({
              dataSource: {
                  transport:{
                    read : function(options) {
                      var Pemeriksaan_Id = data.Pemeriksaan_Id;
                  
                      $.ajax({
                        url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailProsedur') }}',
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

          $("#catatandetail").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
        
                    $.ajax({
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailCatatan') }}',
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
                {field: 'Kesimpulan', title: 'Interpretasi Hasil',template: '#if(data.Kesimpulan == null){# - #}else{# #:data.Kesimpulan# #}#'},
                {field: 'Catatan', title: 'Catatan',template: '#if(data.Catatan == null){# - #}else{# #:data.Catatan# #}#'},
                {field: 'Saran', title: 'Saran',template: '#if(data.Saran == null){# - #}else{# #:data.Saran# #}#'},
                {field: 'NB', title: 'NB',template: '#if(data.NB == null){# - #}else{# #:data.NB# #}#'},
              ],
              pageable: true,
              editable: 'inline'
        }); //FINISH CATATAN

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
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailHasil') }}',
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
                    $.ajax({
                      headers: {
                                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                              },
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/updatehasil') }}',
                      type: 'POST',
                      dataType: 'json',
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
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/updatehasil') }}',
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
                $(ee.container).parent().css({
                    width: '700px',
                    height: 'auto',
                    top: 10, // or "100px"
                    left: "30%"
                });

                $('.k-window-title').text("Edit Data");
                var Pemeriksaan_Id = data.Pemeriksaan_Id;
                var inputan ="";
                $.ajax({
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailHasil') }}',
                      type: 'GET',
                      data:{Pemeriksaan_Id : Pemeriksaan_Id},
                      dataType: 'json',
                      success: function(res) {
                        $.each(res['data'], function(q,value){
                          inputan = inputan+"<div class='k-edit-label'><label for='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"'>"+value.Indikator_Pemeriksaan+"</label></div><div data-container-for='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"' class='k-edit-field'><input style='margin-left:10px; width: 500px;' name='IndikatorPemeriksaan["+value.Indikator_Pemeriksaan_Id+"]' id='IndikatorPemeriksaan"+value.Indikator_Pemeriksaan_Id+"' class='input-width-modal' value='"+value.Nilai+"'></div>";
                          console.log('value', value);
                        })
                        
                        $('#HasilForm').append(inputan);
                        
                        $('#IndikatorPemeriksaan99,#IndikatorPemeriksaan100').kendoDatePicker({
                          format: "dd/MM/yyyy"
                        });

                      }
                });
              }

        }); //FINISH  Hasil Pemeriksaan

    
        // PROSEDUR
        $("#prosedur").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
                 
                    $.ajax({
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailProsedur') }}',
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
              columns: [
                {field: 'Kode_Prosedur', title: 'Kode Prosedur'},
                {field: 'Deskripsi_Panjang', title: 'Deskripsi Panjang'},
                {field: 'Deskripsi_Pendek', title: 'Deskripsi Pendek'},
              ],
              pageable: true,
              editable: {
                mode:"inline"
              }
        }); //FINISH PROSEDUR

        // CATATAN
        $("#catatan").kendoGrid({
            dataSource: {
                transport:{
                  read : function(options) {
                    var Pemeriksaan_Id = data.Pemeriksaan_Id;
        
                    $.ajax({
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/DetailCatatan') }}',
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
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/createcatatan') }}',
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
                      url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/updatecatatan') }}',
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
                        url : '{{ url('pemeriksaan/labmikrobiologi/hasil_pemeriksaan/deletecatatan') }}',
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
                {field: 'Kesimpulan', title: 'Interpretasi Hasil',template: '#if(data.Kesimpulan == null){# - #}else{# #:data.Kesimpulan# #}#'},
                {field: 'Catatan', title: 'Catatan',template: '#if(data.Catatan == null){# - #}else{# #:data.Catatan# #}#'},
                {field: 'Saran', title: 'Saran',template: '#if(data.Saran == null){# - #}else{# #:data.Saran# #}#'},
                {field: 'NB', title: 'NB',template: '#if(data.NB == null){# - #}else{# #:data.NB# #}#'},
           
                {headerTemplate: "<span class='k-icon k-i-gear'></span>",
                 headerAttributes: { class: "table-header-cell", style: "text-align: center" },
                 command:['edit','destroy']},
              ],
              pageable: true,
              editable: 'inline'

        }); //FINISH CATATAN

  }//Finish Detail Pemeriksaan

        
  

  </script>

@endsection