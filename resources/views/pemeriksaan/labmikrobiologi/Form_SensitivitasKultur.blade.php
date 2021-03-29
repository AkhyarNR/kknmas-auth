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
            <a><i class="fa fa-stethoscope" aria-hidden="true"></i> <b>{{ $pro['Prosedur']}}</b> </a>
        </li>
        <div class="tabs-content">
                <div class="tabs-panel active" id="addTable">
                    <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                        <th><strong>Pemeriksaan</strong></th>
                        <th></th>
                        <th><strong>Hasil</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pro['Indikator'] as $key) { ?>
                        <tr>
                        <td>{{ $key->Indikator_Pemeriksaan}} </td>
                        <td>:</td>
                          @if($key->Indikator_Pemeriksaan == "Mikroskopik Gram")
                            <td>
                            <textarea type="text" name="umum[{{$key->Indikator_Pemeriksaan_Id}}]" id="{{$key->Indikator_Pemeriksaan}}" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                            </td>
                          @elseif($key->Indikator_Pemeriksaan != "Mikroskopik Gram")
                            <td>
                            <input type="text" name="umum[{{$key->Indikator_Pemeriksaan_Id}}]" id="{{$key->Indikator_Pemeriksaan}}" class="form-control">
                            </td>
                          @endif
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    @if($key->Prosedur_Medis_Biaya_Id == 18)
                    <td>
                      <button type="button" onclick="addTable()" class="btn btn-outline-danger btn-rounded waves-effect"><i class="fa fa-plus" aria-hidden="true"></i> Table Indikator</button>
                    </td>
                    @endif
                </div>
        </div>
            <?PHP
                $x++;
                } 
            ?>
      </div>

    <script type="text/javascript">
      function addTable() {
          var data = {!! json_encode($sulfur->toArray()) !!};
          console.log(data);
          var body = "";
          data.forEach(function(item) {
            body += '<tr>'+
            '<td>'+item['Indikator_Pemeriksaan']+'</td>'+
            '<td>:</td>'+
            '<td><input type="text" name="tambah['+item['Indikator_Pemeriksaan_Id']+']" id="'+item['Indikator_Pemeriksaan']+'" class="form-control"></td>'+
            '</tr>';
          });
          $('#addTable').append(
            '<table class="table table-striped table-hover table-condensed">'+
            '<thead>'+
              '<tr>'+
                '<th><strong>Pemeriksaan</strong></th>'+
                '<th></th>'+
                '<th><strong>Hasil</strong></th>'+
              '</tr>'+
            '</thead>'+
            '<tbody>'+body+'</tbody>'+
            '</table>');
      }
      </script>

</section>