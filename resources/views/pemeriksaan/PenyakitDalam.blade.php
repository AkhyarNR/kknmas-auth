@extends('layouts.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Poli Penyakit Dalam</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

        <form id="msform" action="{{url('pemeriksaan/penyakitdalam/createperiksa')}}" method="POST">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="pasien"><strong>Data Pasien</strong></li>
                <li id="umum"><strong>Umum</strong></li>
                <li id="terapi"><strong>Terapi</strong></li>
                <li id="obat"><strong>Resep Obat</strong></li>
                <li id="rujukan"><strong>Rujukan</strong></li>
            </ul> 
            @csrf
            @method('POST')
                <input type="text" value="{{ $val->Employee_Id }}" name="Employee_Id" hidden>
                <input type="text" value="{{ $val->No_Perawatan }}" name="No_Perawatan" hidden>
                <input type="text" value="{{ $val->Pasien_Id }}" name="Pasien_Id" hidden>
                <input type="text" value="{{ $val->Pasien_Rawat_Jalan_Id }}" name="Pasien_Rawat_Jalan_Id" hidden>
                <input type="text" value="{{ $val->Pemeriksaan_Id }}" name="Pemeriksaan_Id" hidden>
            <fieldset>  
                <br>
                <div class="form-card">              
                    @include('pemeriksaan.Form_Detail')
                </div>
 
                   <button type="button" name="batal1" onclick="batal({{ $val->Pasien_Rawat_Jalan_Id }})" class="batal action-button-previous">Batal</button>
                    <input type="button" name="next" class="next action-button" value="Next Step" />                        </fieldset>
            <fieldset>  
                <br>
                <div class="form-card">              
                    @include('pemeriksaan.Form_Umum')
                </div>
                
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />           
            </fieldset>

            <fieldset>
                <br>
                <div class="form-card">
                    @include('pemeriksaan.Form_Terapi')
                   
                </div> 
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
            </fieldset>

            <fieldset>
                <br>
                <div class="form-card">
                    @include('pemeriksaan.Form_Resep_Obat')
                </div> 
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
            </fieldset>

            <fieldset>
                <br>
                <div class="form-card">
                    @include('pemeriksaan.Form_Jenis_Rujukan')
                    <br><div class="x_title"></div><br>
                    @include('pemeriksaan.Form_Catatan')
                </div> 
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input id="submit" type="button" class="action-button" value="Simpan">
            </fieldset>

        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#grad1 {
    background-color: : #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
}

#msform {
    text-align: center;
    position: relative;
    font-size: 14px;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    text-align: left;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}


#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    outline-width: 0;
}

#msform .action-button {
    width: 100px;
    background: #2a3f53;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #2a3f53
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid #2a3f53
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 19%;
    float: left;
    position: relative
}
#progressbar #pasien:before {
    font-family: FontAwesome;
    content: "\f007"
}
#progressbar #umum:before {
    font-family: FontAwesome;
    content: "\f0f0"
}

#progressbar #obat:before {
    font-family: FontAwesome;
    content: "\f0fa"
}

#progressbar #terapi:before {
    font-family: FontAwesome;
    content: "\f21e"
}
#progressbar #rujukan:before {
    font-family: FontAwesome;
    content: "\f0ec"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #2a3f53
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}


 #Obat_Id {
    display: block;
    margin: 2em auto;
    }
    .k-readonly
    {
        color: gray;
    }

    
 #Obat_Id_Resep {
    display: block;
    margin: 2em auto;
    }
    .k-readonly
    {
        color: gray;
    }

    .diagnosa-id {
    display: inline-block;
    min-width: 60px;
    }
    .prosedur-id {
    display: inline-block;
    min-width: 60px;
    }

</style>

<script>

    function batal(id) {
    $.ajax({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "{{ route('batal') }}",
      type: "POST",
      data: {
        Pasien_Rawat_Jalan_Id: id
      },
      success : function(){
            window.open('{{ url("pemeriksaan/polipenyakitdalam") }}/','_self');
        }
    });
}

</script>
<script>
$(document).ready(function(){

    
        $("#Obat_Id").kendoComboBox({
            dataTextField: "Nama_Obat",
            dataValueField: "Obat_Id",
            filter: "contains",
            suggest: true,
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
            dataSource: {
                transport: {
                    read: {
                        type: "GET",
                        url: "{{route('dropdown.getObat')}}",
                        dataType: "json"
                    }
                }
            }
          
        });

        $("#Obat_Id_Resep").kendoComboBox({
            dataTextField: "Nama_Obat",
            dataValueField: "Obat_Id",
            filter: "contains",
            suggest: true,
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
            dataSource: {
                transport: {
                    read: {
                        type: "GET",
                        url: "{{route('dropdown.getObat')}}",
                        dataType: "json"
                    }
                }
            }
          
        });

        // $("#selectPenanganan").kendoMultiSelect({
        //     optionLabel: "-Pilih Penanganan-",
        //     dataTextField: "Nama_Perawatan",
        //     template: '#:Nama_Perawatan#  |  #:Nama_Kategori# ',
        //     dataValueField: "Penanganan_Pasien_Id",
        //     dataSource: {
        //         transport: {
        //             read: {
        //                 type: "GET",
        //                 url: "{{route('dropdown.getPenanganan')}}",
        //                 dataType: "json"
        //             }
        //         }
        //     }
        // });
        
        $("#Jenis_Rujukan_Id").kendoDropDownList({
            optionLabel: "-Pilih Rujukan-",
            autoBind: false,
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

        function convertValues(value) {
            var data = {};

            value = $.isArray(value) ? value : [value];

            for (var idx = 0; idx < value.length; idx++) {
                data["values[" + idx + "]"] = value[idx];
            }

            return data;
        }
        
})    
</script>


<script type="text/javascript">
$(document).ready(function(){
    

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;


    $(".next").click(function(){


    current_fs = $(this).parent();
    next_fs = $(this).parent().next();


    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");


    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;


    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });


    $(".previous").click(function(){


    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();


    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");


    //show the previous fieldset
    previous_fs.show();


    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;


    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });


    $('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    });

      //Save button click function
    //   $('#submit').click(function () {
    //             //validation of order
    //             var isAllValid = true;

    //             //Save if valid
    //             if (isAllValid) {
                   
    //                 var data_array = JSON.stringify( ObatDetails );
    //                 var form = $('#msform').serializeArray();
    //                 var uniquekey = {
    //                     name: "ObatDetails",
    //                     value: data_array
    //                 };
    //                 var resep = {
    //                     name: "ObatDetailsResep",
    //                     value: JSON.stringify(ObatDetailsResep)
    //                 }
    //                 form.push(uniquekey);
    //                 form.push(resep);
    //                 $(this).val('Please wait...');

    //                 $.ajax({
    //                   headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                   },
    //                     // url: $('#url').val(),
    //                     // url:'http://localhost:8080/stkip_muhammadiyah_bb/public/set_biaya_registrasi/create_post',
    //                     // type: "POST",
    //                     // data: JSON.stringify(data),
    //                     // dataType: "JSON",
    //                     // contentType: "application/json",
    //                     data : form,
    //                     type: "POST",
    //                     url: "{{ url('pemeriksaan/umum/createperiksa') }}",
    //                     success: function (d) {
    //                         //check is successfully save to database
    //                         if (d.status == 1) {
    //                             //will send status from server side
    //                             //alert('Successfully done.');
    //                             swal('Selesai!', d.exp, 'success');
    //                             //clear form
    //                             ObatDetails = [];
                              
    //                             $('#ObatDetails').empty();
    //                             window.open('{{ url("pemeriksaan/poliumum") }}/','_self');
    //                         }
    //                         else {
    //                            // alert('Failed');
    //                             swal('Gagal simpan!!', d.exp, 'error');
    //                         }
    //                         $('#submit').val('Save');
    //                     },
    //                     error: function (xhr, ajaxOptions, thrownError) {
    //                         swal('Error!! '+xhr.status, thrownError, 'error');
    //                         $('#submit').val('Save');
    //                     }
    //                 });
    //             }

    //     });

});

</script>

       
<script type="text/javascript">
  
    $(document).ready(function () {
      var ObatDetails = [];
              //Remove button click function
              $('#remove').click(function () {
                  ObatDetails.pop();
  
                  //populate order items
                  GeneratedItemsTable();
              });
  
              //Add button click function
              $('#add').click(function () {
  
                  //Check validation of order item
                  var isValidItem = true;
                  var pesan = $('#Obat_Id').val();
                  if ($('#Obat_Id').val().trim() == '') {
                      isValidItem = false;
                      $('#Obat_Id_message').css('visibility', 'visible');
                  }
                  else {
                      $('#Obat_Id_message').css('visibility', 'hidden');
                  }
  
                  if ($('#Dosis').val().trim() == '') {
                      isValidItem = false;
                      $('#Dosis').siblings('span.error').css('visibility', 'visible');
                  }
                  else {
                      $('#Dosis').siblings('span.error').css('visibility', 'hidden');
                  }
  
                  if ($('#Jumlah_Obat').val().trim() == '') {
                      isValidItem = false;
                      $('#Jumlah_Obat').siblings('span.error').css('visibility', 'visible');
                  }
                  else {
                      $('#Jumlah_Obat').siblings('span.error').css('visibility', 'hidden');
                  }
  
                  //Add item to list if valid
                  if (isValidItem) {
                      ObatDetails.push({
                          Obat_Id: parseInt($('#Obat_Id').val().trim()),
                          Nama_Obat: $("#Obat_Id option:selected").text(),
                          Dosis: $('#Dosis').val().trim(),
                          Jumlah_Obat: $('#Jumlah_Obat').val().trim(),
                      });
                      //Clear fields
                      $('#Obat_Id').val('').focus();
                      $('#Dosis').val('');
                      $('#Jumlah_Obat').val('');
  
                  }
                  //populate order items
                  GeneratedItemsTable();
  
              });
              //Save button click function
              
  
              //function for show added items in table
              function GeneratedItemsTable() {
                  if (ObatDetails.length > 0) {
                   
                      var $table = $('<table class="table table-striped table-bordered table-hover table-sm table-font-sm">');
                      $table.append('<thead class="thead-default thead-green"><tr><th>Nama Obat</th><th>Dosis</th><th>Jumlah Obat</th><th align="center"><i class="glyphicon glyphicon-cog"></i></th></tr></thead>');
                      var $tbody = $('<tbody/>');
                      var $total = 0;
                      $.each(ObatDetails, function (i, val) {
                          var $row = $('<tr/>');
                          $row.append($('<td/>').html(val.Nama_Obat));
                          $row.append($('<td/>').attr('align', 'right').html(val.Dosis));
                          $row.append($('<td/>').attr('align', 'right').html(val.Jumlah_Obat));
                          var $remove = $('<a href="#" class="btn-sm btn-danger">Hapus <span class="glyphicon glyphicon-trash"></span></a>');
                          $remove.click(function (e) {
                              e.preventDefault();
                              ObatDetails.splice(i, 1);
                              GeneratedItemsTable();
                          });
                          $row.append($('<td/>').attr('align', 'center').html($remove));
                          $tbody.append($row);
                          $total += val.Jumlah_Obat;
                      });
                      var $frow = $('<tr/>');
                      // $frow.append($('<td/>').attr('align', 'right').html('<b>Total</b>'));
                      // $frow.append($('<td/>').attr('align', 'right').html(thousandFormat($total)));
                      // $frow.append($('<td/>').html(''));
                      $tbody.append($frow);
                      console.log("current", ObatDetails);
                      $table.append($tbody);
                      $('#ObatDetails').html($table);
  
                  }
                  else {
                      $('#ObatDetails').html('');
                  }
              }
              
        function replaceAll(find, replace, str) {
                while (str.indexOf(find) > -1) {
                    str = str.replace(find, replace);
                }
                return str;
            }
    
            function thousandFormat(n) {
                var rx = /(\d+)(\d{5})/;
                return String(n).replace(/^\d+/, function (w) {
                    while (rx.test(w)) {
                        w = w.replace(rx, '$1.$2.$3.$4');
                    }
                    return w;
                });
            }
            
                var ObatDetailsResep = [];
    
                //removeItem button click function
                $('#removeItem').click(function () {
                    ObatDetailsResep.pop();
    
                    //populate order items
                    GeneratedTable();
                });
    
                //addItem button click function
                $('#addItem').click(function () {
    
                    //Check validation of order item
                    var isValidItem = true;
                    var pesan = $('#Obat_Id_Resep').val();
                    if ($('#Obat_Id_Resep').val().trim() == '') {
                        isValidItem = false;
                        $('#Obat_Id_Resep_message').css('visibility', 'visible');
                    }
                    else {
                        $('#Obat_Id_Resep_message').css('visibility', 'hidden');
                    }
    
                    if ($('#Dosis_Resep').val().trim() == '') {
                        isValidItem = false;
                        $('#Dosis_Resep').siblings('span.error').css('visibility', 'visible');
                    }
                    else {
                        $('#Dosis_Resep').siblings('span.error').css('visibility', 'hidden');
                    }
    
                    if ($('#Jumlah_Obat_Resep').val().trim() == '') {
                        isValidItem = false;
                        $('#Jumlah_Obat_Resep').siblings('span.error').css('visibility', 'visible');
                    }
                    else {
                        $('#Jumlah_Obat_Resep').siblings('span.error').css('visibility', 'hidden');
                    }
                    
                    if ($('#Aturan_Pakai').val().trim() == '') {
                        isValidItem = false;
                        $('#Aturan_Pakai').siblings('span.error').css('visibility', 'visible');
                    }
                    else {
                        $('#Aturan_Pakai').siblings('span.error').css('visibility', 'hidden');
                    }
  
    
                    //addItem item to list if valid
                    if (isValidItem) {
                        ObatDetailsResep.push({
                            Obat_Id_Resep: parseInt($('#Obat_Id_Resep').val().trim()),
                            Nama_Obat: $("#Obat_Id_Resep option:selected").text(),
                            Dosis_Resep: $('#Dosis_Resep').val().trim(),
                            Jumlah_Obat_Resep: $('#Jumlah_Obat_Resep').val().trim(),
                            Aturan_Pakai: $('#Aturan_Pakai').val().trim(),
                        });
                        //Clear fields
                        $('#Obat_Id_Resep').val('').focus();
                        $('#Dosis_Resep').val('');
                        $('#Jumlah_Obat_Resep').val('');
                        $('#Aturan_Pakai').val('');
    
                    }
                    //populate order items
                    GeneratedTable();
    
                });
                
                //Save button click function
                $('#submit').click(function () {
                  //validation of order
                  var isAllValid = true;
  
                  //Save if valid
                  if (isAllValid) {
                     
                      var data_array = JSON.stringify( ObatDetails );
                      var form = $('#msform').serializeArray();
                      var uniquekey = {
                          name: "ObatDetails",
                          value: data_array
                      };
                      var resep = {
                          name: "ObatDetailsResep",
                          value: JSON.stringify(ObatDetailsResep)
                      }
                      form.push(uniquekey);
                      form.push(resep);
                      $(this).val('Please wait...');
  
                      $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                          data : form,
                          type: "POST",
                          url: "{{ url('pemeriksaan/penyakitdalam/createperiksa') }}",
                          success: function (d) {
                              //check is successfully save to database
                              if (d.status == 1) {
                                  //will send status from server side
                                  //alert('Successfully done.');
                                  swal('Selesai!', d.exp, 'success');
                                  //clear form
                                  ObatDetails = [];
                                
                                  $('#ObatDetails').empty();
                                  window.open('{{ url("pemeriksaan/polipenyakitdalam") }}/','_self');
                              }
                              else {
                                 // alert('Failed');
                                  swal('Gagal simpan!!', d.exp, 'error');
                              }
                              $('#submit').val('Save');
                          },
                          error: function (xhr, ajaxOptions, thrownError) {
                              swal('Error!! '+xhr.status, thrownError, 'error');
                              $('#submit').val('Save');
                          }
                      });
                  }
  
              });
    
                //function for show addItemed items in table
                function GeneratedTable() {
                    if (ObatDetailsResep.length > 0) {
                     
                        var $table = $('<table class="table table-striped table-bordered table-hover table-sm table-font-sm">');
                        $table.append('<thead class="thead-default thead-green"><tr><th>Nama Obat</th><th>Dosis_Resep</th><th>Jumlah Obat</th><th>Aturan Pakai</th><th align="center"><i class="glyphicon glyphicon-cog"></i></th></tr></thead>');
                        var $tbody = $('<tbody/>');
                        var $total = 0;
                        $.each(ObatDetailsResep, function (i, val) {
                            var $row = $('<tr/>');
                            $row.append($('<td/>').html(val.Nama_Obat));
                            $row.append($('<td/>').attr('align', 'right').html(val.Dosis_Resep));
                            $row.append($('<td/>').attr('align', 'right').html(val.Jumlah_Obat_Resep));
                            $row.append($('<td/>').attr('align', 'right').html(val.Aturan_Pakai));
                            var $removeItem = $('<a href="#" class="btn-sm btn-danger">Hapus <span class="glyphicon glyphicon-trash"></span></a>');
                            $removeItem.click(function (e) {
                                e.preventDefault();
                                ObatDetailsResep.splice(i, 1);
                                GeneratedTable();
                            });
                            $row.append($('<td/>').attr('align', 'center').html($removeItem));
                            $tbody.append($row);
                            $total += val.Jumlah_Obat_Resep;
                        });
                        var $frow = $('<tr/>');
                        // $frow.append($('<td/>').attr('align', 'right').html('<b>Total</b>'));
                        // $frow.append($('<td/>').attr('align', 'right').html(thousandFormat($total)));
                        // $frow.append($('<td/>').html(''));
                        $tbody.append($frow);
                        console.log("current", ObatDetailsResep);
                        $table.append($tbody);
                        $('#ObatDetailsResep').html($table);
    
                    }
                    else {
                        $('#ObatDetailsResep').html('');
                    }
                }
            });
        </script>
@endsection