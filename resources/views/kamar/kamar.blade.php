@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Kamar -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>KELOLA DATA KAMAR</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm"><i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data</a>
                      <select class="btn btn-sm btn-success js-example-basic-single" id="filter_bangsal" name="filter_bangsal">
                        <option value="0">-- Semua Bangsal --</option>
                        @foreach($bangsalOption as $key => $value)
                        <option value="{{ $key }}" {{($bangsalPilih == $value ? 'selected' : '' )}}>{{ $value }}</option>
                        @endforeach
                      </select>

                      @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                      </div>
                      @endif

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                        <thead>
                          <tr>
                            <th>Kode Kamar</th>
                            <th>Nama Kamar</th>
                            <th>Nama Bangsal</th>
                            <th>Kelas</th>
                            <th>Kapasitas</th>
                            <th>Tarif Kamar</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($kamar as $item)
                        <tr>
                            <td>{{ $item->Kode_Kamar }}</td>
                            <td>{{ $item->Nama_Kamar }}</td>
                            <td>{{ $item->Nama_Bangsal }}</td>
                            <td>{{ $item->Kelas }}</td>
                            <td><a href="{{ url('/bed'.'?kamar_id='.$item->Kamar_Id) }}">{{ $item->kapasitas_kamar }} bed</a></td>
                            <td style="text-align:right;">@currency($item->Tarif_Dasar)</td>
                            <td style="text-align:center;" width="200px">
                                <a href="{{$item->Kamar_Id}}" data-toggle="modal" data-target="#updateModal{{$item->Kamar_Id}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form method="POST" action="{{ url('/kamar' . '/' . $item->Kamar_Id) }}" accept-charset="UTF-8" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i></button> 
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="x_content">
          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form method="POST" action="{{ url('/kamar') }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Nama_Kamar') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Kamar">Nama Kamar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Nama_Kamar" name="Nama_Kamar"  class="form-control" required="required">
                {!! $errors->first('Nama_Kamar', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Bangsal_Id') ? 'has-error' : ''}}">
              <label for="Bangsal_Id" class="col-form-label col-md-3 col-sm-3 label-align">Nama Bangsal <span class="">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Bangsal_Id" class="form-control" type="text" name="Bangsal_Id" required="required">
                  <option disabled value="">-- Pilih Salah Satu --</option>
                  @foreach($bangsalOption as $key => $value)
                  <option value="{{ $key }}" {{($bangsalPilih == $key ? 'selected' : '' )}}>{{ $value }}</option>
                  @endforeach
                </select>
                {!! $errors->first('Bangsal_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kelas') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kelas">Kelas/Tarif <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Kelas_Id" class="form-control" type="text" name="Kelas_Id" required="required">
                  <option selected disabled value="">-- Pilih Salah Satu --</option>
                  @foreach($kelasOption as $item)
                  <option value="{{ $item->Kelas_Id }}">{{ $item->Kelas }} / @currency($item->Tarif_Dasar)</option>
                  @endforeach
                </select>
                {!! $errors->first('Kelas', '<p class="help-block">:message</p>') !!}
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

<!-- Update Modal -->
@foreach($kamar as $item)
<div class="modal fade" id="updateModal{{$item->Kamar_Id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="x_content">

          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form method="POST" action="{{ url('/kamar/'.$item->Kamar_Id) }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kode_Kamar">Kode Kamar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kode_Kamar" name="Kode_Kamar" class="form-control" value="{{ isset($item->Kode_Kamar) ? $item->Kode_Kamar : '' }}" readonly>
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Nama_Kamar') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Kamar">Nama Kamar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Nama_Kamar" name="Nama_Kamar"  class="form-control" value="{{ isset($item->Nama_Kamar) ? $item->Nama_Kamar : '' }}" required="required">
                {!! $errors->first('Nama_Kamar', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Bangsal_Id') ? 'has-error' : ''}}">
              <label for="Bangsal_Id" class="col-form-label col-md-3 col-sm-3 label-align">Nama Bangsal <span class="">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Bangsal_Id" class="form-control" type="text" name="Bangsal_Id" required="required">
                  <option disabled="disabled" selected {!! Form::select('Bangsal_Id', $bangsalOption, [isset($item->Bangsal_Id) ? $item->Bangsal_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Bangsal_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kelas_Id') ? 'has-error' : ''}}">
              <label for="Kelas_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Kelas_Id" class="form-control" name="Kelas_Id" >
                  <option disabled="disabled" selected {!! Form::select('Kelas_Id', $kelasOptions, [isset($item->Kelas_Id) ? $item->Kelas_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Kelas_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
              <div class="col-md-6 col-sm-6 offset-md-5">
                <button class="btn btn-warning" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js')}}"></script>

<script type="text/javascript">
  var pilihBangsal = {{$bangsalPilih}};
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('#filter_bangsal').val(pilihBangsal);
    $('#filter_bangsal').select2().trigger('change');
  });
</script>

<script type="text/javascript">
  $( document ).ready(function() {
    $("select[id='filter_bangsal']").change(function (e) {
      var filter_bangsal = $("[id='filter_bangsal']").val();
      window.location.href="{{asset('kamar')}}?bangsal_id="+filter_bangsal;
    });

  });
</script>
@endsection