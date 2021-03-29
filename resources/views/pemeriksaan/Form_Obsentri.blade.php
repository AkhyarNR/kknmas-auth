<section>

    @foreach ($obsentri as $item)
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">{{ $item->Indikator_Pemeriksaan}} <span class="required">:</span>
            </label>
        <div class="col-md-6 col-sm-6 ">
            <input type="text" name="ginekologi['{{$item->Indikator_Pemeriksaan_Id}}']" id="{{$item->Indikator_Pemeriksaan}}" class="form-control ">
        </div>
        </div>
    @endforeach
    
    </section>