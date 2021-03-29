@extends('layouts.master')

@section('content')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

<div class="right_col" role="main"><div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h3>INPUT DATA PASIEN KAMAR</h3>
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

          <form method="POST" action="{{ url('/pasienkamar_inap') }}" id="demo-form2" name="demo-form2" data-parsley-validate class="form-horizontal form-label-left" accept-charset="UTF-8">
            {{ csrf_field() }}
            
            <div class="item form-group {{ $errors->has('Pasien_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Nomer RM </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="pasien" class="form-control js-example-basic-single" name="Pasien_Id">
                  <option selected value="0">-- Pilih Nomer RM --</option>
                  @foreach($pasien as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
                </select>
                {!! $errors->first('Pasien_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kamar_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kamar</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Nama_Kamar" class="form-control" type="text" name="Nama_Kamar" readonly>
                <input id="Kamar_Id" class="form-control" type="hidden" name="Kamar_Id" readonly>
                {!! $errors->first('Kamar_Id', '<p class="help-block">:message</p>') !!}
              </div>
              <a href="#" data-toggle="modal" data-target="#exampleModal" class=" btn btn-light btn-sm" title="Link"><i class="fa fa-link" aria-hidden="true"></i></a>
            </div>
            <div class="item form-group {{ $errors->has('bangsal') ? 'has-error' : ''}}">
              <label for="Bangsal" class="col-form-label col-md-3 col-sm-3 label-align">Bangsal </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Bangsal" class="form-control" type="text" name="Bangsal" readonly>
                {!! $errors->first('Bangsal', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('bed_Id') ? 'has-error' : ''}}">
              <label for="Bed_Id" class="col-form-label col-md-3 col-sm-3 label-align">No Bed </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Kode_Bed" class="form-control" type="text" name="Kode_Bed" readonly>
                <input id="Bed_Id" class="form-control" type="hidden" name="Bed_Id" readonly>
                {!! $errors->first('Bed_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Kelas_Id') ? 'has-error' : ''}}">
              <label for="Kelas_Id" class="col-form-label col-md-3 col-sm-3 label-align">Kelas </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Kelas" class="form-control" type="text" name="Kelas" readonly>
                <input id="Kelas_Id" class="form-control" type="hidden" name="Kelas_Id" readonly>
                {!! $errors->first('Kelas_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tarif') ? 'has-error' : ''}}">
              <label for="Tarif" class="col-form-label col-md-3 col-sm-3 label-align">Tarif </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tarif_Dasar" class="form-control" type="text" name="Tarif_Dasar" readonly>
                <input id="Tarif" class="form-control" type="hidden" name="Tarif" readonly>
                {!! $errors->first('Tarif', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
              <label for="Status" class="col-form-label col-md-3 col-sm-3 label-align">Status </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Status" class="form-control" type="text" name="Status" readonly>
                <input id="Status_Booking_Id" class="form-control" type="hidden" name="Status_Booking_Id" readonly>
                {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Pasien_Penanggung_Jawab_Id') ? 'has-error' : ''}}">
              <label for="Pasien_Penanggung_Jawab_Id" class="col-form-label col-md-3 col-sm-3 label-align">Penanggung Jawab </label>
              <div class="col-md-6 col-sm-6 ">
                <select id="Pasien_Penanggung_Jawab" class="form-control js-example-basic-single" name="Pasien_Penanggung_Jawab_Id">
                  <option selected value="0">-- Pilih Penanggung Jawab --</option>
                  @foreach($Penanggung_jawab as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
                </select>
                {!! $errors->first('Pasien_Id', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Diagnosa_Awal') ? 'has-error' : ''}}">
              <label for="Diagnosa_Awal" class="col-form-label col-md-3 col-sm-3 label-align">Diagnosa Awal 
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Diagnosa_Awal" class="form-control" type="text" name="Diagnosa_Awal">
                {!! $errors->first('Diagnosa_Awal', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Tanggal_Masuk') ? 'has-error' : ''}}">
              <label for="Tanggal_Masuk" class="col-form-label col-md-3 col-sm-3 label-align">Tgl Masuk 
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input id="Tanggal_Masuk" class="date-picker form-control" type="date" name="Tanggal_Masuk">
                {!! $errors->first('Tanggal_Masuk', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="item form-group {{ $errors->has('Jam_Masuk') ? 'has-error' : ''}}">
              <label for="Jam_Masuk" class="col-form-label col-md-3 col-sm-3 label-align">Jam Masuk</label>
                  <div class='input-group date col-md-6 col-sm-6' id='myDatepicker3'>
                    <input id="Jam_Masuk" name="Jam_Masuk" type='text' class="form-control" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Data Nomer Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="border: 0; width:100%">
            <thead>
              <tr>
                <th>Nama Bangsal</th>
                <th>Nama Kamar</th>
                <th>Nomer Bed</th>
                <th>Kelas</th>
                <th>Tarif Kamar</th>
                <th>Status Kamar</th>
                <th style="visibility: hidden;">tarif</th>
                <th style="visibility: hidden;">id kamar</th>
                <th style="visibility: hidden;">id bed</th>
                <th style="visibility: hidden;">id kelas</th>
                <th style="visibility: hidden;">id status</th>
              </tr>
            </thead>
            @foreach($bed as $item)
            <tbody>
              <tr>
                <td>{{ $item->Nama_Bangsal}}</td>
                <td>{{ $item->Nama_Kamar}}</td>
                <td>{{ $item->Kode_Bed}}</td>
                <td>{{ $item->Kelas}}</td>
                <td> @currency($item->Tarif_Dasar)</td>
                <td>{{ $item->Status_Booking}}</td>
                <td style="visibility: hidden;">{{ $item->Tarif_Dasar}}</td>
                <td style="visibility: hidden;">{{ $item->Kamar_Id}}</td>
                <td style="visibility: hidden;">{{ $item->Bed_Id}}</td>
                <td style="visibility: hidden;">{{ $item->Kelas_Id}}</td>
                <td style="visibility: hidden;">{{ $item->Status_Booking_Id}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="{{ asset('assets/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<script>
        $( document ).ready(function() {
    
          $("#datatable").on('click', 'tr', function() {
              //get row contents into an array
              var rowData = $(this).children("td").map(function() {
                             return $(this).text();
              }).get();
              $("#Bangsal").val(rowData[0]);
              $("#Nama_Kamar").val(rowData[1]);
              $("#Kode_Bed").val(rowData[2]);
              $("#Kelas").val(rowData[3]);
              $("#Tarif_Dasar").val(rowData[4]);
              $("#Status").val(rowData[5]);
              $("#Tarif").val(rowData[6]);
              $("#Kamar_Id").val(rowData[7]);
              $("#Bed_Id").val(rowData[8]);
              $("#Kelas_Id").val(rowData[9]);
              $("#Status_Booking_Id").val(rowData[10]);       

          $('#exampleModal').modal('hide');
          });   

        });

</script>

<script  type="text/javascript">
   $(function () {
                $('#myDatepicker').datetimepicker();
            });
    
    $('#myDatepicker3').datetimepicker({
        format: 'HH:mm:ss'
    });
</script>

@endsection