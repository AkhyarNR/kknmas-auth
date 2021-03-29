<section>
<style>
    #menu {
      background-color: #192d41; 
      padding: 20px;
      text-align: left; 
      margin: auto;
      color: white;
      font-size: 16px;
      list-style-type: none;

    }
    .tabs-container {
      max-width: 1000px;
      padding: 20px;
    }
    
    .tabs {
      display: flex;
    }
    
    .tabs li:not(:last-child) {
      margin-right: 7px;
    }
    
    .tabs li a {
      display: block;
      position: relative;
      top: 4px;
      padding: 10px 25px;
      border-radius: 2px 2px 0 0;
      background: white;
      opacity: 0.7;
      transition: all 0.1s ease-in-out;
    }
    
    .tabs li.active a,
    .tabs li a:hover {
      opacity: 1;
      top: 0;
    }
    
    .tabs-content {
      position: relative;
      z-index: 2;
      padding: 25px;
      border-radius: 0 4px 4px 4px;
      background: white;
    }
    
    .tabs-panel {
      display: none;
    }
    
    .tabs-panel.active {
      display: block;
    }
    
    .tabs-panel p + div {
      margin-top: 15px;
    }
</style>

<div class="tabs-container">
    <?php 
        $x = 0;
        foreach($data as $pro){ 
    ?>

    <li id="menu">
        <input type="text" value="{{ $pro['Prosedur_Id'] }}" name="prosedurmedis[]" hidden>
        <a><i class="fa fa-stethoscope" aria-hidden="true"></i> Prosedur/Tindakan - <b>{{ $pro['Prosedur']}}</b> </a>
    </li>
    <div class="tabs-content">
            <div class="tabs-panel active">
                <table class="table table-striped table-hover table-condensed">
                <thead>
                    <tr>
                    <th><strong>Pemeriksaan</strong></th>
                    <th></th>
                    <th><strong>Hasil</strong></th>
                    <th><strong>Rujukan WHO 2010</strong></th>
                    <th><strong>Rujukan Persandi 2015</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pro['Indikator'] as $key) { ?>
                    <tr>
                    <td>{{ $key->Indikator_Pemeriksaan}} </td>
                    <td>:</td>
                        <td>
                        <input type="text" name="umum['{{$key->Indikator_Pemeriksaan_Id}}']" id="{{$key->Indikator_Pemeriksaan}}" class="form-control ">
                        </td>
                    <td>{{ $key->Nilai_Rujukan1}}</td>
                    <td>{{ $key->Nilai_Rujukan2}}</td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>


    </div>
    <?PHP
        $x++;
        } 
    ?>
</div>

<script>
$(document).ready(function(){

    $('input[id="Aglutinasi"]').kendoDropDownList({
            optionLabel: "-Pilih Aglutinasi-",
            dataTextField: "Nilai",
            dataValueField: "Indikator_Nilai_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getAglutinasi')}}",
                        dataType: "json",
                    }
                }
            }
        })

    $('input[id="Agregasi"]').kendoDropDownList({
            optionLabel: "-Pilih Agregasi-",
            dataTextField: "Nilai",
            dataValueField: "Indikator_Nilai_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getAgregasi')}}",
                        dataType: "json",
                    }
                }
            }
        })

    $('input[id="ALH (Amplitudo Literal Head)"]').kendoDropDownList({
        optionLabel: "-Pilih Amplitudo Literal Head-",
        dataTextField: "Nilai",
        dataValueField: "Indikator_Nilai_Id",
        dataSource:{
            transport:{
                read:{
                    type: "GET",
                    url: "{{route('dropdown.getALH')}}",
                    dataType: "json",
                }
            }
        }
    })  

    $('input[id="Tgl Terima"]').kendoDatePicker({
        value: new Date(),
        format: 'dd/MM/yyyy',
        dateInput: true
    });
    $('input[id="Jam Ambil"],[id="Selesai"]').kendoTimePicker({
        // value: new Date(),
        // dateInput: true
    });
    $('[id="Jam Periksa"]').kendoTimePicker({
        value: new Date(),
        dateInput: true
    });

});  
</script>
</section>