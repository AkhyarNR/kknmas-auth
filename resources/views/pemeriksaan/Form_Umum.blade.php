<section>
  
@foreach ($Nilai as $item)
    @if($item->Indikator_Pemeriksaan_Id != 2 )
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $item->Indikator_Pemeriksaan}} <span class="required">:</span>
            </label>
        <div class="col-md-6 col-sm-6 ">
            <input type="text" value="{{ $item->Nilai }}" name="umum['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" class="form-control ">
            
            @if($item->Indikator_Pemeriksaan_Id == 1)
            {{-- <input type="text" value="{{$item->Indikator_Nilai}}" name="umum['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" class="form-control "> --}}
            <input type="hidden" hidden value="{{$item->Indikator_Nilai_Id}}" id="valTriase" class="form-control ">
            @endif
            
        </div>
        </div>
    @endif    
    @if($item->Indikator_Pemeriksaan_Id == 2 )
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $item->Indikator_Pemeriksaan}} <span class="required">:</span>
            </label>
        <div class="col-md-6 col-sm-6 ">
            <textarea id="message" class="form-control" name="umum['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ $item->Nilai }}</textarea>
        </div>
        </div>
    @endif
@endforeach
 
<br>

<div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Diagnosa <span>:</span>
    </label>
    <div class="col-md-6 col-sm-6 ">
            <select type="text" class="form-control" name="Diagnosa_Id[]" id="selectDiagnosa" multiple></select>
            @foreach($diagnosa as $items)
                <input type="hiden" hidden name="ValDiagnosa_Id[]" value="{{ $items->Diagnosa_Id }}" class="form-control ">
            @endforeach
    </div>
</div>

<br>

<div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tindakan <span>:</span>
    </label>
    <div class="col-md-6 col-sm-6 ">
            <select type="text"  class="form-control" id="selectProsedur" name="Prosedur_Medis_Biaya_Id[]" multiple data-placeholder="Select Tindakan..."></select>
            @foreach($prosedur as $items)
                <input type="hiden" hidden name="ValProsedur_Id[]" value="{{ $items->Prosedur_Medis_Biaya_Id }}" class="form-control ">
            @endforeach
    </div>
</div>
<script>
    $(document).ready(function(){
        $('input[id="Triase"]').kendoDropDownList({
            optionLabel: "-Pilih Triase-",
            dataTextField: "Nilai",
            dataValueField: "Indikator_Nilai_Id",
            dataSource:{
                transport:{
                    read:{
                        type: "GET",
                        url: "{{route('dropdown.getTriase')}}",
                        dataType: "json",
                    }
                }
            }
        }) 
        var triaseval = $('#valTriase').val();
        $('input[id="Triase"]').data('kendoDropDownList').value(triaseval);

        $("#selectDiagnosa").kendoMultiSelect({
            placeholder: "Select Diagnosa...",
            itemTemplate: '<span class="diagnosa-id">#= Kode_Diagnosa #</span> #= Nama_Penyakit #',
            dataTextField: "Nama_Penyakit",
            dataValueField: "Diagnosa_Id",
            filter: "contains",
            height: 520,
                virtual: {
                    itemHeight: 26,
                    valueMapper: function(options) {
                        $.ajax({
                            url: "https://demos.telerik.com/kendo-ui/service/Orders/ValueMapper",
                            type: "GET",
                            data: convertValues(options.value), // Send value to the server.
                            success: function (data) {
                                options.success(data); // Return the index number of the corresponding data item.
                            }
                        })
                    }
                },
            dataSource: {
                transport: {
                    read: {
                        type: "GET",
                        url: "{{route('dropdown.getDiagnosa')}}",
                        dataType: "json"
                    }
                },
                schema: {
                        model: {
                            fields: {
                                Diagnosa_Id: { type: "number" },
                                Kode_Diagnosa: { type: "string" },
                                Nama_Penyakit: { type: "string" },
                            }
                        }
                    },
                    // pageSize: 80,
                    // serverPaging: true,
                    // serverFiltering: true
            },
            change: function(e){
                console.log(this.value())
            }
        });
        var diag = [];
        $('input[name^="ValDiagnosa_Id"]').each(function() {
            var value = $(this).val();
            diag.push(parseInt(value));
        });
        $("#selectDiagnosa").data("kendoMultiSelect").value(diag);
      
        $("#selectProsedur").kendoMultiSelect({
            placeholder: "Select Prosedur...",
            itemTemplate: '<span class="prosedur-id">#= Kode_Prosedur #</span> #= Deskripsi_Pendek #',
            dataTextField: "Deskripsi_Panjang",
            dataValueField: "Prosedur_Medis_Biaya_Id",
            filter: "contains",
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
            dataSource: {
                transport: {
                    read: {
                        type: "GET",
                        url: "{{route('dropdown.getProsedurBiaya')}}",
                        dataType: "json"
                    }
                },
                schema: {
                        model: {
                            fields: {
                                Prosedur_Medis_Biaya_Id: { type: "number" },
                                Kode_Prosedur: { type: "string" },
                                Deskripsi_Panjang: { type: "string" },
                                Deskripsi_Pendek: { type: "string" },
                            }
                        }
                    },
                    // pageSize: 80,
                    // serverPaging: true,
                    // serverFiltering: true
            },
            change: function(e){
                console.log(this.value())
            }
        });
        var pros = [];
        $('input[name^="ValProsedur_Id"]').each(function() {
            var value = $(this).val();
            pros.push(parseInt(value));
        });
        $("#selectProsedur").data("kendoMultiSelect").value(pros);

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
   
</section>