@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

<!-- Data Bed/Kasur -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>KELOLA DATA BED/KASUR</h3>
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
                        <option value="{{ $key }}" {{($bangsalPilih == $value ? 'selected' : '' )}} >{{ $value }}</option>
                        @endforeach
                      </select>
                      <select class="btn btn-sm btn-info js-example-basic-single" id="filter_kamar" name="filter_kamar">
                        <option value="0">-- Semua Kamar --</option>
                        @foreach($kamarOptions as $key => $value)
                        <option value="{{ $key }}" {{($kamarPilih == $value ? 'selected' : '' )}} >{{ $value }}</option>
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
                            <th>No Bed</th>
                            <th>Kode Kamar</th>
                            <th>Nama Kamar</th>
                            <th>Nama Bangsal</th>
                            <th>Kelas</th>
                            <th>Tarif Kamar</th>
                            <th>Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($bed as $item)
                        <tr>
                            <td>{{ $item->Kode_Bed }}</td>
                            <td>{{ $item->Kode_Kamar }}</td>
                            <td>{{ $item->Nama_Kamar }}</td>
                            <td>{{ $item->Nama_Bangsal }}</td>
                            <td>{{ $item->Kelas }}</td>
                            <td style="text-align:right;">@currency($item->Tarif_Dasar)</td>
                            <td>{{ $item->Status_Booking }}</td>
                            <td style="text-align:center;" width="200px">
                                <a href="#" data-toggle="modal" data-target="#updateModal{{$item->Bed_Id}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form method="POST" action="{{ url('/bed' . '/' . $item->Bed_Id) }}" accept-charset="UTF-8" style="display:inline">
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Bed</h5>
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

          <form method="POST" action="{{ url('/bed') }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Kode_Bed') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kode_Bed">No Bed <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kode_Bed" name="Kode_Bed"  class="form-control" required="required" value="BD-">
                {!! $errors->first('Kode_Bed', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kamar_Id') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kamar_Id">Kode Kamar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kode_Kamar" name="Kode_Kamar" class="form-control" readonly>
                <input type="hidden" id="Kamar_Id" name="Kamar_Id" class="form-control">
                {!! $errors->first('Kamar_Id', '<p class="help-block">:message</p>') !!}
              </div>
              <a href="#" data-toggle="modal" data-target="#kamartableModal" class=" btn btn-light btn-sm" title="Data Kamar"><i class="fa fa-link" aria-hidden="true"></i></a>
            </div>
            <div class="item form-group {{ $errors->has('Nama_Kamar') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Kamar">Nama Kamar <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Nama_Kamar" name="Nama_Kamar"  class="form-control" required="required" readonly>
                {!! $errors->first('Nama_Kamar', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Nama_Bangsal') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Bangsal">Nama Bangsal <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Nama_Bangsal" name="Nama_Bangsal"  class="form-control" required="required" readonly>
                {!! $errors->first('Nama_Bangsal', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kelas') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kelas">Kelas <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kelas" name="Kelas"  class="form-control" required="required" readonly>
                {!! $errors->first('Kelas', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tarif_Dasar') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Tarif_Dasar">Tarif <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Tarif_Dasar" name="Tarif_Dasar"  class="form-control" required="required" readonly>
                {!! $errors->first('Tarif_Dasar', '<p class="help-block">:message</p>') !!}
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

<!-- Kamar Table Modal -->
<div class="modal fade" id="kamartableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Data Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Kamar</th>
                <th>Nama Kamar</th>
                <th>Nama Bangsal</th>
                <th>Kelas</th>
                <th>Tarif Kamar</th>
                <th style="text-align:center;">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach($datakamar as $item)
              <tr>
                <td>{{ $item->Kamar_Id}}</td>
                <td>{{ $item->Kode_Kamar}}</td>
                <td>{{ $item->Nama_Kamar}}</td>
                <td>{{ $item->Nama_Bangsal}}</td>
                <td>{{ $item->Kelas}}</td>
                <td style="text-align:right;">@currency($item->Tarif_Dasar)</td>
                <td style="text-align:center;"><a href="#" class="btn btn-primary btn-sm" title="Pilih"><i class="fa fa-check" aria-hidden="true"></i></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Update Modal -->
@foreach($bed as $item)
<div class="modal fade" id="updateModal{{$item->Bed_Id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Bed</h5>
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

          <form method="POST" action="{{ url('/bed/'.$item->Bed_Id) }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kode_Bed">No Bed <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kode_Bed" name="Kode_Bed" class="form-control" value="{{ isset($item->Kode_Bed) ? $item->Kode_Bed : '' }}">
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kamar_Id') ? 'has-error' : ''}}">
              <label for="Kamar_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kode Kamar <span class="">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Kamar_Id" class="form-control js-example-basic-single" type="text" name="Kamar_Id" required="required">
                  <option disabled="disabled" selected {!! Form::select('Kamar_Id', $kamarOptions, [isset($item->Kamar_Id) ? $item->Kamar_Id : ''], ['class' => 'form-control']); !!}</option>
                </select>
                {!! $errors->first('Kamar_Id', '<p class="help-block">:message</p>') !!}
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
  var pilihKamar = {{$kamarPilih}};
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('#filter_bangsal').val([pilihBangsal, pilihKamar]);
    $('#filter_bangsal').select2().trigger('change');
  });
</script>

<script type="text/javascript">
  $( document ).ready(function() {
    $("select[name='filter_bangsal']").change(function (e) {
      var filter_bangsal = $("[name='filter_bangsal']").val();
      window.location.href="{{asset('bed')}}?bangsal_id="+filter_bangsal;
    });

    $("select[name='filter_kamar']").change(function (e) {
      var filter_kamar = $("[name='filter_kamar']").val();
      window.location.href="{{asset('bed')}}?kamar_id="+filter_kamar;
    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#datatable").on('click', 'tr', function() {

      var rowData = $(this).children("td").map(function() {
        return $(this).text();
      }).get();
      $("#Kode_Kamar").val(rowData[1]);
      $("#Nama_Kamar").val(rowData[2]);
      $("#Nama_Bangsal").val(rowData[3]);
      $("#Kelas").val(rowData[4]);
      $("#Tarif_Dasar").val(rowData[5]);
      $("#Kamar_Id").val(rowData[0]);

      $('#kamartableModal').modal('hide');
    });

  });
</script>
@endsection