@extends('layouts.master')

@section('content')

<div class="right_col" role="main"><div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h3>DATA PASIEN PINDAH</h3>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <a href="{{ url('/pasienkamar_inap') }}" class="btn btn-danger btn-sm" type="button" aria-hidden="true">Kembali</a>
          <br />
          <br />

          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form method="POST" action="{{ url('/pasienkamar_inap/'.$pasieninap->Pasien_Kamar_Inap_Id) }}" id="demo-form2" name="demo-form2" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Pasien_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Nomer RM <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="pasien" class="form-control js-example-basic-single" name="Pasien_Id">
                  <option disabled="disabled" selected placeholder="Pilih Nomer RM" {!! Form::select('Pasien_Id', $pasien, [isset($pasieninap->Pasien_Id) ? $pasieninap->Pasien_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Pasien_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kamar_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kamar <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="kamar" class="form-control js-example-basic-single" name="Kamar_Id">
                  <option disabled="disabled" selected placeholder="Pilih Kamar" {!! Form::select('Kamar_Id', $kamar, [isset($pasieninap->Kamar_Id) ? $pasieninap->Kamar_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Kamar_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tarif') ? 'has-error' : ''}}">
              <label for="Tarif" class="col-form-label col-md-3 col-sm-3 label-align">Tarif </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tarif" class="form-control" value="{{ isset($pasieninap->Tarif_Kamar) ? $pasieninap->Tarif_Kamar : '' }}" type="number" name="Tarif">
                {!! $errors->first('Tarif', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Diagnosa_Awal') ? 'has-error' : ''}}">
              <label for="Diagnosa_Awal" class="col-form-label col-md-3 col-sm-3 label-align">Diagnosa Awal <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Diagnosa_Awal" class="form-control" type="text" value="{{ isset($pasieninap->Diagnosa_Awal) ? $pasieninap->Diagnosa_Awal : '' }}" name="Diagnosa_Awal" required="required">
                {!! $errors->first('Diagnosa_Awal', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tanggal_Masuk') ? 'has-error' : ''}}">
              <label for="Tanggal_Masuk" class="col-form-label col-md-3 col-sm-3 label-align">Tgl Masuk <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tanggal_Masuk" class="date-picker form-control" value="{{ isset($pasieninap->Tanggal_Masuk) ? $pasieninap->Tanggal_Masuk : '' }}" type="date" name="Tanggal_Masuk" required="required">
                {!! $errors->first('Tanggal_Masuk', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Lama') ? 'has-error' : ''}}">
              <label for="Lama" class="col-form-label col-md-3 col-sm-3 label-align">Lama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Lama" class="form-control" value="{{ isset($pasieninap->Lama) ? $pasieninap->Lama : '' }}" type="number" name="Lama" required="required">
                {!! $errors->first('Lama', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
              <div class="col-md-6 col-sm-6 offset-md-5">
                <button class="btn btn-warning" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
            
@endsection