<section>
  
    @foreach ($Umum as $item)
        @if($item->Indikator_Pemeriksaan_Id != 2 )
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $item->Indikator_Pemeriksaan}} <span class="required">:</span>
                </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" name="umum['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" class="form-control ">
            </div>
            </div>
        @endif    
        @if($item->Indikator_Pemeriksaan_Id == 2 )
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $item->Indikator_Pemeriksaan}} <span class="required">:</span>
                </label>
            <div class="col-md-6 col-sm-6 ">
                <textarea id="message" class="form-control" name="umum['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
            </div>
            </div>
        @endif
    @endforeach
     
    <br>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Diagnosa <span>:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <select type="text" class="form-control" name="Diagnosa_Id[]" id="selectDiagnosaPra" multiple></select>
        </div>
    </div>
    <br>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tindakan <span>:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <select type="text"  class="form-control" id="selectProsedurPra" name="Prosedur_Medis_Biaya_Id[]" multiple data-placeholder="Select Tindakan..."></select>
        </div>
    </div>
       
    </section>