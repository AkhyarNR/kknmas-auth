@extends('layouts.master')

@section('content')
<style type="text/css">
  tr.hide-table-padding td {
  padding: 0;
}

.expand-button {
  position: relative;
}

.accordion-toggle .expand-button:after
{
  position: absolute;
  left:.75rem;
  top: 50%;
  transform: translate(0, -50%);
  content: '-';
}
.accordion-toggle.collapsed .expand-button:after
{
  content: '+';
}
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h4>Data Rawat Inap</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <a href="{{ url('/pasien/pasieninap_tbh') }}" class="btn btn-primary btn-sm"><i class="fa fa-wpforms" aria-hidden="true"></i> Masuk</a>
                      <a href="#" class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Cetak Data</a>
                  
                      @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                      </div>
                      @endif

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Nomer RM</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>Penanggung Jawab</th>
                            <th colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $i = 0;
                           ?>
                          @foreach($pasieninap as $item)
                          <tr class="accordion-toggle collapsed" id="accordion1{{$i}}" data-toggle="collapse" data-parent="#accordion1{{$i}}" href="#collapseOne{{$i}}">
                            <td class="expand-button"></td>
                            <td>{{ $item->Kode_Pasien }}</td>
                            <td>{{ $item->Nama }}</td>
                            <td>{{ $item->Alamat}}</td>
                            <td>{{ $item->Nama_Penanggung_Jawab}}</td>
                            <td>
                              <a href="{{ url('/pasienrawat_inap/' . $item->Pasien_Rawat_Inap_Id . '/edit') }}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>
                                <a href="{{ url('/pasienrawat_inap/' . $item->Pasien_Rawat_Inap_Id . '/pulang') }}" class="btn btn-success btn-sm"><i class="fa fa-edit" aria-hidden="true"> Pulang</i></a>
                                <a href="{{ url('/pasienrawat_inap/' . $item->Pasien_Rawat_Inap_Id . '/pindah') }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"> Pindah</i></a>
                                <form method="POST" action="{{ url('/pasienrawat_inap' . '/' . $item->Pasien_Rawat_Inap_Id) }}" accept-charset="UTF-8" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"> Hapus</i></button> 
                                </form>
                            </td>
                          </tr>
                          <tr class="hide-table-padding">
                            <td></td>
                            <td colspan="5">
                            <div id="collapseOne{{$i}}" class="collapse in p-3">
                              <div class="row">
                               <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" href="#DetailRawatInap{{$i}}" role="tab" data-toggle="tab">Detail Rawat Inap</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#RiwayatKamarPasien{{$i}}" role="tab" data-toggle="tab">Riwayat Kamar Pasien</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#RiwayatKunjungan{{$i}}" role="tab" data-toggle="tab">Riwayat Kunjungan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#RiwayatTindakan{{$i}}" role="tab" data-toggle="tab">Riwayat Tindakan</a>
                                </li>
                              </ul>
                              </div>
                              <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="DetailRawatInap{{$i}}">
                                   <div class="col-md-14">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="private-separator mb-2"></div>
                                            <ul class="employee-datalist">
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Nama Pasien</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Nama }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Nama Kamar</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Nama_Kamar }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>No Bed</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Kode_Bed }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Penanggung Jawab</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Nama_Penanggung_Jawab}}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Tarif Kamar</strong></label>
                                                    <p class="col-md-2 private-content"> : @currency($item->Tarif_Kamar)
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Diagnosa Awal</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Diagnosa_Awal }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Diagnosa Akhir</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Diagnosa_Akhir }}
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                         <div class="col-md-5">
                                            <div class="private-separator mb-2"></div>
                                            <ul class="employee-datalist">
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong> Tanggal Masuk</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ date('j F Y', strtotime($item->Tanggal_Masuk)) }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Jam Masuk</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ date('H:i:s', strtotime($item->Tanggal_Masuk)) }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Tanggal Keluar</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Tanggal_Keluar !== null ? date('j F Y', strtotime($item->Tanggal_Keluar)) : null }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Jam Keluar</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ date('H:i:s', strtotime($item->Tanggal_Keluar)) }}
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Lama</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item->Lama }} Hari
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Total Biaya</strong></label>
                                                    <p class="col-md-2 private-content"> : @currency($item->Total_Biaya)
                                                    </p>
                                                </li>
                                                <li class="row">
                                                    <label class="d-block col-md-3"><strong>Status Pulang</strong></label>
                                                    <p class="col-md-2 private-content"> : {{ $item-> Status_Pulang }}
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="RiwayatKamarPasien{{$i}}">
                                  <div>
                                    <a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
                                  </div>
                                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>Nama Pasien</th>
                                        <th>Nama Kamar</th>
                                        <th>No bed</th>
                                        <th>Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> {{ $item->Nama }}</td>
                                        <td> {{ $item->Nama_Kamar }}</td>
                                        <td> {{ $item->Kode_Bed }}</td>
                                        <td style="text-align:center" width="200px">
                                            <a href="{{ url('/pasienkamar_inap/' . $item->Pasien_Rawat_Inap_Id . '/edit') }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>
                                            <form method="POST" action="{{ url('/pasienrawat_inap' . '/' . $item->Pasien_Rawat_Inap_Id) }}" accept-charset="UTF-8" style="display:inline">
                                              {{ method_field('DELETE') }}
                                              {{ csrf_field() }}
                                              <button type="submit" class="btn btn-secondary btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"> Hapus</i></button> 
                                            </form>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="RiwayatKunjungan{{$i}}">
                                  <div>
                                    <a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
                                  </div>
                                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>Nama Pasien</th>
                                        <th>Petugas</th>
                                        <th>Catatan</th>
                                        <th>Waktu Kunjungan</th>
                                        <th>Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> {{ $item->Nama }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:center" width="200px">
                                            <a href="{{ url('/pasienrawat_inap/' . $item->Pasien_Rawat_Inap_Id . '/edit') }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>
                                            <form method="POST" action="{{ url('/pasienrawat_inap' . '/' . $item->Pasien_Rawat_Inap_Id) }}" accept-charset="UTF-8" style="display:inline">
                                              {{ method_field('DELETE') }}
                                              {{ csrf_field() }}
                                              <button type="submit" class="btn btn-secondary btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"> Hapus</i></button> 
                                            </form>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="RiwayatTindakan{{$i}}">
                                  <div>
                                    <a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
                                  </div>
                                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>Nama Pasien</th>
                                        <th>Petugas</th>
                                        <th>Waktu Tindakan</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> {{ $item->Nama }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:center" width="200px">
                                            <a href="{{ url('/pasienrawat_inap/' . $item->Pasien_Rawat_Inap_Id . '/edit') }}" class="btn btn-secondary btn-sm" title="Edit"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a>
                                            <form method="POST" action="{{ url('/pasienrawat_inap' . '/' . $item->Pasien_Rawat_Inap_Id) }}" accept-charset="UTF-8" style="display:inline">
                                              {{ method_field('DELETE') }}
                                              {{ csrf_field() }}
                                              <button type="submit" class="btn btn-secondary btn-sm" title="Hapus" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"> Hapus</i></button> 
                                            </form>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </td>
                            <td style="visibility: hidden;"></td>
                            <td style="visibility: hidden;"></td>
                            <td style="visibility: hidden;"></td>
                            <td style="visibility: hidden;"></td>
                            </div>
                          </tr>
                          <?php 
                            $i++
                          ?>
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
@endsection