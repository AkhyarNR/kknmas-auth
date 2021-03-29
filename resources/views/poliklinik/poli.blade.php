@extends('layouts.master')

@section('content')

<!-- Data Poliklinik -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h3>KELOLA DATA POLIKLINIK</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm"><i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data</a>
                      
                      @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                      </div>
                      @endif

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Unit</th>
                            <th>Nama Unit</th>
                            <th>Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $no=1; ?>
                        @foreach($poli as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->Kode_Poliklinik }}</td>
                            <td>{{ $item->Nama_Poliklinik }}</td>
                            @if($item->Is_Buka == '1')
                            <td>Buka</td>
                            @else
                            <td>Tutup</td>
                            @endif
                            <td style="text-align:center" width="200px">
                                <a href="#" data-toggle="modal" data-target="#updateModal{{$item->Poliklinik_Id}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form method="POST" action="{{ url('/poliklinik' . '/' . $item->Poliklinik_Id) }}" accept-charset="UTF-8" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i></button> 
                                </form>
                            </td>
                          </tr>
                          <?php $no++ ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Poliklinik</h5>
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

          <form method="POST" action="{{ url('/poliklinik') }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Kode_Poliklinik') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kode_Poliklinik">Kode Unit <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Kode_Poliklinik" name="Kode_Poliklinik"  class="form-control" required="required">
                {!! $errors->first('Kode_Poliklinik', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Nama_Poliklinik') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Poliklinik">Nama Unit <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="Nama_Poliklinik" name="Nama_Poliklinik"  class="form-control" required="required">
                {!! $errors->first('Nama_Poliklinik', '<p class="help-block">:message</p>') !!}
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
@foreach($poli as $item)
<div class="modal fade" id="updateModal{{$item->Poliklinik_Id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Poliklinik</h5>
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

          <form method="POST" action="{{ url('/poliklinik/'.$item->Poliklinik_Id) }}" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="item form-group {{ $errors->has('Kode_Poliklinik') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Kode_Poliklinik">Kode Unit <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="Kode_Poliklinik" name="Kode_Poliklinik" class="form-control" value="{{ isset($item->Kode_Poliklinik) ? $item->Kode_Poliklinik : '' }}">
                {!! $errors->first('Kode_Poliklinik', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Nama_Poliklinik') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Nama_Poliklinik">Nama Unit <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <input type="text" id="Nama_Poliklinik" name="Nama_Poliklinik"  class="form-control" value="{{ isset($item->Nama_Poliklinik) ? $item->Nama_Poliklinik : '' }}" required="required">
                {!! $errors->first('Nama_Poliklinik', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Is_Buka') ? 'has-error' : ''}}">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Is_Buka">Status <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" name="Is_Buka" id="Is_Buka" type="text">
                  <option disabled>-- Pilih Salah Satu --</option>
                  <option value="1" {{($item->Is_Buka=='1' ? 'selected' : '' )}}>Buka</option>
                  <option value="0" {{($item->Is_Buka=='0' ? 'selected' : '' )}}>Tutup</option>
                </select>
                {!! $errors->first('Is_Buka', '<p class="help-block">:message</p>') !!}
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
@endsection