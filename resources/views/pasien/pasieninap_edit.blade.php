@extends('layouts.master')

@section('content')

<div class="right_col" role="main"><div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h3>EDIT DATA PASIEN</h3>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <a href="{{ url('/pasienrawat_inap') }}" class="btn btn-danger btn-sm" type="button" aria-hidden="true">Kembali</a>
          <br />
          <br />

          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form method="POST" action="{{ url('/pasienrawat_inap/'.$pasieninap->Pasien_Rawat_Inap_Id) }}" id="demo-form2" name="demo-form2" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Pasien_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Nomer RM <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="pasien" class="form-control js-example-basic-single" name="Pasien_Id" disabled="disabled">
                  <option disabled="disabled" selected placeholder="Pilih Nomer RM" {!! Form::select('Pasien_Id', $pasien, [isset($pasieninap->Pasien_Id) ? $pasieninap->Pasien_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Pasien_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kamar_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kamar <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="kamar" class="form-control js-example-basic-single" name="Kamar_Id" disabled="disabled">
                  <option disabled="disabled" selected placeholder="Pilih Kamar" {!! Form::select('Kamar_Id', $kamar, [isset($pasieninap->Kamar_Id) ? $pasieninap->Kamar_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Kamar_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Bed_Id') ? 'has-error' : ''}}">
              <label for="Bed_Id" class="col-form-label col-md-3 col-sm-3 label-align">No Bed <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="bed" class="form-control js-example-basic-single" name="Bed_Id" disabled="disabled">
                  <option disabled="disabled" selected placeholder="Pilih Bed" {!! Form::select('Bed_Id', $bed, [isset($pasieninap->Bed_Id) ? $pasieninap->Bed_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Bed_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Pasien_Penanggung_jawab_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Penanggung_Jawab_Id" class="col-form-label col-md-3 col-sm-3 label-align">Penanggung Jawab <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Pasien_Penanggung_Jawab_Id" class="form-control js-example-basic-single" name="Pasien_Penanggung_Jawab_Id">
                  <option disabled="disabled" selected placeholder="Pilih Penanggung Jawab" {!! Form::select('Pasien_Penanggung_Jawab_Id', $Penanggung_jawab, [isset($pasieninap->Pasien_Penanggung_Jawab_Id) ? $pasieninap->Pasien_Penanggung_Jawab_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Pasien_Penanggung_jawab_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tarif') ? 'has-error' : ''}}">
              <label for="Tarif" class="col-form-label col-md-3 col-sm-3 label-align">Tarif </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tarif" class="form-control" value="{{ isset($pasieninap->Tarif_Kamar) ? $pasieninap->Tarif_Kamar : '' }}" type="number" name="Tarif" readonly>
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
            <div class="item form-group {{ $errors->has('Diagnosa_Akhir') ? 'has-error' : ''}}">
              <label for="Diagnosa_Akhir" class="col-form-label col-md-3 col-sm-3 label-align">Diagnosa Akhir <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Diagnosa_Akhir" class="form-control" type="text" value="{{ isset($pasieninap->Diagnosa_Akhir) ? $pasieninap->Diagnosa_Akhir : '' }}" name="Diagnosa_Akhir">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tanggal_Masuk') ? 'has-error' : ''}}">
              <label for="Tanggal_Masuk" class="col-form-label col-md-3 col-sm-3 label-align">Tgl Masuk <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tanggal_Masuk" class="date-picker form-control" value="{{ isset($pasieninap->Tanggal_Masuk) ? date('j F Y', strtotime($pasieninap->Tanggal_Masuk)) : '' }}" type="datetime" name="Tanggal_Masuk" required="required" readonly="">
                {!! $errors->first('Tanggal_Masuk', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Jam_Masuk') ? 'has-error' : ''}}">
              <label for="Jam_Masuk" class="col-form-label col-md-3 col-sm-3 label-align">Jam Masuk <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Jam_Masuk" class="form-control" value="{{ isset($pasieninap->Tanggal_Masuk) ? date('H:i:s', strtotime($pasieninap->Tanggal_Masuk)) : '' }}" type="datetime" name="Tanggal_Masuk" required="required" readonly="">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tanggal_Keluar') ? 'has-error' : ''}}">
              <label for="Tanggal_Keluar" class="col-form-label col-md-3 col-sm-3 label-align">Tgl Keluar
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tanggal_Keluar" class="date-picker form-control" value="{{ isset($pasieninap->Tanggal_Keluar) ? date('j F Y', strtotime($pasieninap->Tanggal_Keluar)) : '' }}" type="datetime" name="Tanggal_Keluar" readonly="">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Jam_Keluar') ? 'has-error' : ''}}">
              <label for="Jam_Keluar" class="col-form-label col-md-3 col-sm-3 label-align">Jam Keluar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Jam_Keluar" class="form-control" value="{{ isset($pasieninap->Tanggal_Keluar) ? date('H:i:s', strtotime($pasieninap->Tanggal_Keluar)) : '' }}" type="datetime" name="Tanggal_Keluar" readonly="">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Lama') ? 'has-error' : ''}}">
              <label for="Lama" class="col-form-label col-md-3 col-sm-3 label-align">Lama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Lama" class="form-control" value="{{ isset($pasieninap->Lama) ? $pasieninap->Lama : '' }}" type="number" name="Lama" readonly="">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Total_Biaya') ? 'has-error' : ''}}">
              <label for="Total_Biaya" class="col-form-label col-md-3 col-sm-3 label-align">Total Biaya <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Total_Biaya" class="form-control" value="{{ isset($pasieninap->Total_Biaya) ? $pasieninap->Total_Biaya : '' }}" type="number" name="Lama" readonly="">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Status_Pulang_Id') ? 'has-error' : ''}}">
              <label for="Status_Pulang_Id" class="col-form-label col-md-3 col-sm-3 label-align">Status Pulang <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                 <select id="Status" class="form-control js-example-basic-single" name="Status_Pulang_Id">
                  <option disabled="disabled" selected placeholder="Pilih Nomer RM" {!! Form::select('Status_Pulang_Id', $status, [isset($pasieninap->Status_Pulang_Id) ? $pasieninap->Status_Pulang_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
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