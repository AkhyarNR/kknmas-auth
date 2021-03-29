<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\TrPasien;
use App\TrRawatJalan;
use App\EmpEmployee;
use App\TrAntrianPasien;
use App\TrPasienAlergi;
use App\TrPasienAsuransi;
use App\TrPasienPenanggungJawab;
use Carbon\Carbon;
use DB;
use PDF;
use QrCode;

class PasienController extends Controller
{
    public function index()
    {
      $poli = DB::table('mstr_work_unit')
      ->where('Work_Unit_Code', 'LIKE', 'POL'.'%')
      ->get();
      // dd($poli);

      $shift_igd = DB::table('emp_shift')
      ->leftjoin('emp_shift_work_unit', 'emp_shift.Shift_Id', '=', 'emp_shift_work_unit.Shift_Id')
      ->where('emp_shift_work_unit.Work_Unit_Id', '=', '16')
      ->get();

      $lab = DB::table('mstr_jenis_pemeriksaan')
      ->where('Jenis_Pemeriksaan', 'LIKE', 'Laboratorium'.'%')
      ->get();
      // dd($lab);

      return view('pasien.Pasien')
      ->with('poli', $poli)
      ->with('shift_igd', $shift_igd)
      ->with('lab', $lab);
    }

    public function read()
    {
      $items = DB::table('tr_pasien')

      ->leftjoin('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_kelamin_Id', '=', 'tr_pasien.Jenis_kelamin_Id')
      ->leftjoin('mstr_gol_darah', 'mstr_gol_darah.Gol_Darah_Id', '=', 'tr_pasien.Gol_Darah_Id')
      ->leftjoin('mstr_status_pernikahan', 'mstr_status_pernikahan.Status_Pernikahan_Id', '=', 'tr_pasien.Status_Pernikahan_Id')
      ->leftjoin('mstr_agama', 'mstr_agama.Agama_Id', '=', 'tr_pasien.Agama_Id')
      ->leftjoin('mstr_pendidikan', 'mstr_pendidikan.Pendidikan_Id', '=', 'tr_pasien.Pendidikan_Id')
      ->leftjoin('mstr_keluarga', 'mstr_keluarga.Keluarga_Id', '=', 'tr_pasien.Keluarga_Id')
      ->leftjoin('mstr_bahasa_pasien', 'mstr_bahasa_pasien.Bahasa_Pasien_Id', '=', 'tr_pasien.Bahasa_Pasien_Id')
      ->leftjoin('mstr_disabilitas', 'mstr_disabilitas.Disabilitas_Id', '=', 'tr_pasien.Disabilitas_Id')
      ->leftjoin('mstr_ras', 'mstr_ras.Ras_Id', '=', 'tr_pasien.Ras_Id')
      ->leftjoin('mstr_provinsi', 'mstr_provinsi.Provinsi_Id', '=', 'tr_pasien.Provinsi_Id')
      ->leftjoin('mstr_kabupaten', 'mstr_kabupaten.Kabupaten_Id', '=', 'tr_pasien.Kabupaten_Id')
      ->leftjoin('mstr_kecamatan', 'mstr_kecamatan.Kecamatan_Id', '=', 'tr_pasien.Kecamatan_Id')
      ->leftjoin('mstr_kewarganegaraan', 'mstr_kewarganegaraan.Kewarganegaraan_Id', '=', 'tr_pasien.Kewarganegaraan_Id')
      ->leftjoin('mstr_status', 'mstr_status.Status_Id', '=', 'tr_pasien.Status_Id')
      ->leftjoin('tr_pasien_penanggung_jawab', 'tr_pasien.Pasien_Id', '=', 'tr_pasien_penanggung_jawab.Pasien_Id')
      ->leftjoin('mstr_kewarganegaraan AS kewarganegaraan_pj', 'kewarganegaraan_pj.Kewarganegaraan_Id', '=', 'tr_pasien_penanggung_jawab.Kewarganegaraan_Id')
      ->leftjoin('mstr_provinsi AS provinsi_pj', 'provinsi_pj.Provinsi_Id', '=', 'tr_pasien_penanggung_jawab.Provinsi_Id')
      ->leftjoin('mstr_kabupaten AS kabupaten_pj', 'kabupaten_pj.Kabupaten_Id', '=', 'tr_pasien_penanggung_jawab.Kabupaten_Id')
      ->leftjoin('mstr_kecamatan AS kecamatan_pj', 'kecamatan_pj.Kecamatan_Id', '=', 'tr_pasien_penanggung_jawab.Kecamatan_Id')
      ->select(
        'tr_pasien.Pasien_Id',
        'tr_pasien.Kode_Pasien',
        'tr_pasien.Nama',
        'tr_pasien.No_Ktp',
        'tr_pasien.Tempat_Lahir',
        'tr_pasien.Tanggal_Lahir',
        'tr_pasien.Nama_Ibu',
        'tr_pasien.Alamat',
        'tr_pasien.Pekerjaan',
        'tr_pasien.Tanggal_Daftar',
        'tr_pasien.No_HP',
        'tr_pasien.Email',
        'tr_pasien.Umur',
        'tr_pasien.Nama_Keluarga',
        'tr_pasien.Kelurahan',
        'tr_pasien.Disabilitas_Id',
        'tr_pasien.Jenis_Kelamin_Id',
        'tr_pasien.Gol_Darah_Id',
        'tr_pasien.Kewarganegaraan_Id',
        'tr_pasien.Disabilitas_Id',
        'tr_pasien.Provinsi_Id',
        'tr_pasien.Kabupaten_Id',
        'tr_pasien.Kecamatan_Id',
        'tr_pasien.Status_Pernikahan_Id',
        'tr_pasien.Agama_Id',
        'tr_pasien.Pendidikan_Id',
        'tr_pasien.Status_Id',
        'tr_pasien.Bahasa_Pasien_Id',
        'tr_pasien.Ras_Id',
        'tr_pasien.Keluarga_Id',
        'tr_pasien.Nomer_Asuransi',
        'mstr_jenis_kelamin.Jenis_Kelamin',
        'mstr_gol_darah.Gol_Darah',
        'mstr_status_pernikahan.Status_Pernikahan',
        'mstr_agama.Agama',
        'mstr_pendidikan.Pendidikan',
        'mstr_keluarga.Keluarga',
        'mstr_bahasa_pasien.Nama_Bahasa',
        'mstr_disabilitas.Jenis',
        'mstr_ras.Ras',
        'mstr_provinsi.Nama_Provinsi',
        'mstr_kabupaten.Nama_Kabupaten',
        'mstr_kecamatan.Nama_Kecamatan',
        'mstr_kewarganegaraan.Kewarganegaraan',
        'mstr_status.Status',
        'tr_pasien_penanggung_jawab.Nama_Penanggung_Jawab',
        'tr_pasien_penanggung_jawab.Alamat as alamat_Penanggung_Jawab',
        'tr_pasien_penanggung_jawab.Kelurahan as Kelurahan_Penanggung_Jawab',
        'tr_pasien_penanggung_jawab.No_Hp',
        'tr_pasien_penanggung_jawab.Provinsi_Id as Provinsi_Pj',
        'tr_pasien_penanggung_jawab.Kabupaten_Id as Kabupaten_Pj',
        'tr_pasien_penanggung_jawab.Kecamatan_Id as Kecamatan_Pj',
        'tr_pasien_penanggung_jawab.Kewarganegaraan_Id as Kewarganegaraan_Pj',
        'kewarganegaraan_pj.Kewarganegaraan as Kewarganegaraan_Penanggung_Jawab',
        'provinsi_pj.Nama_Provinsi as Provinsi_Penanggung_Jawab',
        'kabupaten_pj.Nama_Kabupaten as Kabupaten_Penanggung_Jawab',
        'kecamatan_pj.Nama_Kecamatan as Kecamatan_Penanggung_Jawab',
        'tr_pasien_penanggung_jawab.Pekerjaan as Pekerjaan_Penanggung_Jawab'
      )
      // ->GroupBy('Pasien_Id')
      ->orderBy('Kode_Pasien', 'ASC');        
      $total = DB::table('tr_pasien')->count();

      //cari
      if($_GET['cari'] != null){
        $cari = strtolower($_GET['cari']);
        $items->whereRaw('LOWER(Nama) LIKE "%'.$cari.'%"');
        $items->orwhereRaw('LOWER(No_Ktp) LIKE "%'.$cari.'%"');
      }


      if(isset($_GET['take']) || isset($_GET['skip'])){
          $items->skip($_GET['skip'])->take($_GET['take']);

      }
      $data['data'] = $items->get();
      $data['total'] = $total;

      return json_encode($data);
    }

    public function Alergipasien(Request $request)
    {

      $Alergi = DB::table('tr_pasien_alergi')->where('Pasien_Id', $request->Pasien_Id)
      ->join('mstr_alergi','tr_pasien_alergi.Alergi_Id', '=', 'mstr_alergi.Alergi_Id')
      ->select('tr_pasien_alergi.Alergi_Id', 'mstr_alergi.Alergi')
      ->get();

      $data = [];
      $i = 0;

      foreach ($Alergi as $key) {
        $data[$i]['Alergi_Id'] = $key->Alergi_Id;
        $data[$i]['Alergi'] = $key->Alergi;
        $i++; 
      }
      // dd($data);
      $data = array_values($data);

      return response()->json($data);
    }

    public function Asuransipasien(Request $request)
    {

      $Asuransi = DB::table('tr_pasien_asuransi')->where('Pasien_Id', $request->Pasien_Id)
      ->join('mstr_asuransi','tr_pasien_asuransi.Asuransi_Id', '=', 'mstr_asuransi.Asuransi_Id')
      ->select('tr_pasien_asuransi.Asuransi_Id', 'mstr_asuransi.Nama_Asuransi')
      ->get();

      $data = [];
      $i = 0;

      foreach ($Asuransi as $key) {
        $data[$i]['Asuransi_Id'] = $key->Asuransi_Id;
        $data[$i]['Nama_Asuransi'] = $key->Nama_Asuransi;
        $i++; 
      }
      // dd($data);
      $data = array_values($data);

      return response()->json($data);
    }

    private function otomatis_no(){
      $value = null;

      $biggest = DB::table('tr_pasien')
      ->select('Kode_Pasien')
      ->orderBy('Kode_Pasien','DESC')
      ->first();

      $default = '000001';

      if($biggest==null){
          $value = $default;
      }else{
          $angka = (substr($biggest->Kode_Pasien,-6))+1;
          if(strlen($angka) == 1){
              $value = "00000".$angka;
          }else if(strlen($angka) == 2){
              $value = "0000".$angka;
          }else if(strlen($angka) == 3){
              $value = "000".$angka;
          }else if(strlen($angka) == 4){
              $value = "00".$angka;
          }else if(strlen($angka) == 5){
              $value = "0".$angka;
          }else{
              $value = $angka;
          }
      }

      return $value;
    }

    public function create(Request $request)
    {
      $otomatis = $this->otomatis_no();
      $lastId = DB::table('tr_pasien')->orderBy('Pasien_Id','desc')->first();
      $data = new TrPasien();

      if(!empty($_POST['foto'])){
          $encoded_data = $_POST['foto'];
          $binary_data = base64_decode( $encoded_data );
          $namafoto = $otomatis.".jpeg";
          Storage::disk('public')->put('photos'.'/'.$namafoto, $binary_data);
      }
      $nId = $lastId->Pasien_Id + 1;

      $data->Pasien_Id = $nId;
      $data->Kode_Pasien = $otomatis;
      $data->Nama = $request->input('Nama');
      $data->Tanggal_Daftar = $request->input('Tanggal_Daftar');
      $data->No_Ktp = $request->input('No_Ktp');
      $data->Alamat = $request->input('Alamat');
      $data->Jenis_Kelamin_Id = $request->input('Jenis_Kelamin_Id');
      $data->Tempat_Lahir = $request->input('Tempat_Lahir');
      $data->Tanggal_Lahir = $request->input('Tanggal_Lahir');
      $data->Nama_Ibu = $request->input('Nama_Ibu');
      $data->Gol_Darah_Id = $request->input('Gol_Darah_Id');
      $data->Pekerjaan = $request->input('Pekerjaan');
      $data->Status_Pernikahan_Id = $request->input('Status_Pernikahan_Id');
      $data->Agama_Id = $request->input('Agama_Id');
      $data->Tanggal_Daftar = $request->input('Tanggal_Daftar');
      $data->Pendidikan_Id = $request->input('Pendidikan_Id');
      $data->No_HP = $request->input('No_HP');
      $data->Email = $request->input('Email');
      $data->Umur = $request->input('Umur');
      $data->Keluarga_Id = $request->input('Keluarga_Id');
      $data->Provinsi_Id = $request->input('Provinsi_Id');
      $data->Kabupaten_Id = $request->input('Kabupaten_Id');
      $data->Kecamatan_Id = $request->input('Kecamatan_Id');
      $data->Kelurahan = $request->input('Kelurahan');
      $data->Bahasa_Pasien_Id = $request->input('Bahasa_Pasien_Id');
      $data->Disabilitas_Id = $request->input('Disabilitas_Id');
      $data->Ras_Id = $request->input('Ras_Id');
      $data->Status_Id = $request->input('Status_Id');
      $data->Kewarganegaraan_Id = $request->input('Kewarganegaraan_Id');
      $data->Nomer_Asuransi = $request->input('Nomer_Asuransi');
      $data->save();

      $PJ = new TrPasienPenanggungJawab();
      $PJ->Pasien_Id = $nId;
      $PJ->Nama_Penanggung_Jawab = $request->input('Nama_Penanggung_Jawab');
      $PJ->Kewarganegaraan_Id = $request->input('Kewarganegaraan_Penanggung_Jawab');
      $PJ->Provinsi_Id = $request->input('Provinsi_Penanggung_Jawab');
      $PJ->Kabupaten_Id = $request->input('Kabupaten_Penanggung_Jawab');
      $PJ->Kecamatan_Id = $request->input('Kecamatan_Penanggung_Jawab');
      $PJ->Kelurahan = $request->input('Kelurahan_Penanggung_Jawab');
      $PJ->Alamat = $request->input('Alamat_Penanggung_Jawab');
      $PJ->No_Hp = $request->input('No_Hp');
      $PJ->Hubungan_Kerabat_Id = $request->input('Keluarga_Id');
      $PJ->Pekerjaan = $request->input('Pekerjaan_Penanggung_Jawab');
      $PJ->save();

      if($request->Alergi_Id != null && is_array($request->Alergi_Id)){
          foreach ($request->Alergi_Id as $Alergi_Id => $value) {
          $Aler = new TrPasienAlergi();
          $Aler->Pasien_Id = $nId;
          $Aler->Alergi_Id = $value;
          $Aler->save();
          }
      }

      if($request->Asuransi_Id != null && is_array($request->Asuransi_Id)){
          foreach ($request->Asuransi_Id as $Asuransi_Id => $value) {
          $Asur = new TrPasienAsuransi();
          $Asur->Pasien_Id = $nId;
          $Asur->Asuransi_Id = $value;
          $Asur->save();
          }
      }

      return json_encode($data);
    }

    public function update(Request $request)
    {
      $data = TrPasien::findOrFail($request->Pasien_Id);
      $otomatis = $this->otomatis_no();
      
      if(!empty($_POST['foto'])){
          $encoded_data = $_POST['foto'];
          $binary_data = base64_decode( $encoded_data );
          $namafoto = $request->Kode_Pasien.".jpeg";
          Storage::disk('public')->put('photos'.'/'.$namafoto, $binary_data);
      }

      $data->Pasien_Id = $request->Pasien_Id;
      $data->Nama = $request->input('Nama');
      $data->Tanggal_Daftar = $request->input('Tanggal_Daftar');
      $data->No_Ktp = $request->input('No_Ktp');
      $data->Alamat = $request->input('Alamat');
      $data->Jenis_Kelamin_Id = $request->input('Jenis_Kelamin_Id');
      $data->Tempat_Lahir = $request->input('Tempat_Lahir');
      $data->Tanggal_Lahir = $request->input('Tanggal_Lahir');
      $data->Nama_Ibu = $request->input('Nama_Ibu');
      $data->Gol_Darah_Id = $request->input('Gol_Darah_Id');
      $data->Pekerjaan = $request->input('Pekerjaan');
      $data->Status_Pernikahan_Id = $request->input('Status_Pernikahan_Id');
      $data->Agama_Id = $request->input('Agama_Id');
      $data->Tanggal_Daftar = $request->input('Tanggal_Daftar');
      $data->Pendidikan_Id = $request->input('Pendidikan_Id');
      $data->No_HP = $request->input('No_HP');
      $data->Email = $request->input('Email');
      $data->Umur = $request->input('Umur');
      $data->Keluarga_Id = $request->input('Keluarga_Id');
      $data->Provinsi_Id = $request->input('Provinsi_Id');
      $data->Kabupaten_Id = $request->input('Kabupaten_Id');
      $data->Kecamatan_Id = $request->input('Kecamatan_Id');
      $data->Kelurahan = $request->input('Kelurahan');
      $data->Bahasa_Pasien_Id = $request->input('Bahasa_Pasien_Id');
      $data->Disabilitas_Id = $request->input('Disabilitas_Id');
      $data->Ras_Id = $request->input('Ras_Id');
      $data->Status_Id = $request->input('Status_Id');
      $data->Kewarganegaraan_Id = $request->input('Kewarganegaraan_Id');
      $data->Nomer_Asuransi = $request->input('Nomer_Asuransi');
      $data->save();

      $PJ = new TrPasienPenanggungJawab();
      $PJ->Pasien_Id = $request->Pasien_Id;
      $PJ->Nama_Penanggung_Jawab = $request->input('Nama_Penanggung_Jawab');
      $PJ->Kewarganegaraan_Id = $request->input('Kewarganegaraan_Penanggung_Jawab');
      $PJ->Provinsi_Id = $request->input('Provinsi_Penanggung_Jawab');
      $PJ->Kabupaten_Id = $request->input('Kabupaten_Penanggung_Jawab');
      $PJ->Kecamatan_Id = $request->input('Kecamatan_Penanggung_Jawab');
      $PJ->Kelurahan = $request->input('Kelurahan_Penanggung_Jawab');
      $PJ->Alamat = $request->input('alamat_Penanggung_Jawab');
      $PJ->No_Hp = $request->input('No_Hp');
      $PJ->Hubungan_Kerabat_Id = $request->input('Keluarga_Id');
      $PJ->Pekerjaan = $request->input('Pekerjaan_Penanggung_Jawab');
      $PJ->save();

      if($request->Alergi_Id != null && is_array($request->Alergi_Id)){
          foreach ($request->Alergi_Id as $Alergi_Id => $value) {
          $Aler = new TrPasienAlergi();
          $Aler->Pasien_Id = $request->Pasien_Id;
          $Aler->Alergi_Id = $value;
          $Aler->save();
          }
      }

      if($request->Asuransi_Id != null && is_array($request->Asuransi_Id)){
          foreach ($request->Asuransi_Id as $Asuransi_Id => $value) {
          $Asur = new TrPasienAsuransi();
          $Asur->Pasien_Id = $request->Pasien_Id;
          $Asur->Asuransi_Id = $value;
          $Asur->save();
          }
      }

      return json_encode($data);
    }

    public function delete(Request $request)
    {
      $data = TrPasien::destroy($request->Pasien_Id);

      return json_encode($data);
    }



public function daftarIGD(Request $request)
    {
      $no_perawatan = $this->generatePerawatan($request->input('Work_Unit_Id'));
      $data = new TrRawatJalan();

      $res = TrRawatJalan::create([
          'Pasien_Id' => $request->input('Pasien_Id'),

          'Work_Unit_Id' => $request->input('Work_Unit_Id'),
          'Shift_Id' => $request->input('Shift_Id'),
          'Employee_Id' => $request->input('Employee_Id'),
		      'No_Perawatan' => $no_perawatan,            
		      'Waktu_Registrasi' => Carbon::now(),
          'No_Perawatan' => $no_perawatan,            
          'Waktu_Registrasi' => Carbon::now()        
      ]);

      return json_encode($res->Pasien_Rawat_Jalan_Id);
    }



    public function generatePerawatan($Work_Unit_Id){
      $value = null;

      $biggest = DB::table('tr_pasien_rawat_jalan')

      ->where('Work_Unit_Id', $Work_Unit_Id)
      ->whereDate('Waktu_Registrasi', Carbon::today()->toDateString())
      ->select('No_Perawatan')
      ->orderBy('No_Perawatan', 'DESC')
      ->first();

      $default = '0001';

      if($biggest==null){
          $value = 'IGD'.$default;
      }else{
          $angka = (substr($biggest->No_Perawatan,-4))+1;
          if(strlen($angka) == 1){
              $value = 'IGD000'.$angka;
          }else if(strlen($angka) == 2){
              $value = 'IGD00'.$angka;
          }else if(strlen($angka) == 3){
              $value = 'IGD0'.$angka;
          }else{
              $value = $angka;
          }
      }

      return $value;
    }

    public function getShift($Work_Unit_Id){
      $shift = DB::table('emp_shift_work_unit')
      ->where('Work_Unit_Id', $Work_Unit_Id)
      ->leftjoin('emp_shift', 'emp_shift.Shift_Id', '=', 'emp_shift_work_unit.Shift_Id')
      ->get();

      return json_encode($shift);
    }

    public function getDokter($Shift_Id){        
      $dokter = DB::table('emp_employee')
      ->leftjoin('emp_employee_shift', 'emp_employee_shift.Employee_Id', '=', 'emp_employee.Employee_Id')
      ->leftjoin('mstr_jenis_pegawai', 'mstr_jenis_pegawai.Jenis_Pegawai_Id', '=', 'emp_employee.Jenis_Pegawai_Id')
      ->where('emp_employee.Jenis_Pegawai_Id', '<', '4')
      ->where('Shift_Id', $Shift_Id)
      ->get();

      return json_encode($dokter);
    }

    public function getProsedurMedisBiaya($Jenis_Pemeriksaan_Id){
      $prosedur = DB::table('mstr_prosedur_medis_biaya')
      ->leftjoin('mstr_prosedur_medis', 'mstr_prosedur_medis.Prosedur_Medis_Id', '=', 'mstr_prosedur_medis_biaya.Prosedur_Medis_Id')
      ->where('Jenis_Pemeriksaan_Id', $Jenis_Pemeriksaan_Id)
      ->get();

      return json_encode($prosedur);
    }

    public function daftarPoli(Request $request){
        $pasien_id = $request->Pasien_Id;
        $shift_id = $request->Shift_Id;
        $dok_id = $request->Dokter_Id;
        $poli_id = $request->Work_Unit_Id;
        $prosedur_medis = $request->Prosedur_Medis_Biaya_Id;
        $jenis_pemeriksaan = $request->Jenis_Pemeriksaan_Id;
        $tgl_antri = Carbon::now();
        $no_urut = $this->NoUrutPoli($request->Work_Unit_Id);
        $status_periksa_id = 1;

        $res = TrAntrianPasien::create([
            'Pasien_Id' => $pasien_id,
            'Shift_Id' => $shift_id,
            'Dokter_Id' => $dok_id,
            'Work_Unit_Id' => $poli_id,
            'Prosedur_Medis_Biaya_Id' => $prosedur_medis,
            'Jenis_Pemeriksaan_Id' => $jenis_pemeriksaan,
            'No_Urut' => $no_urut,
            'Tanggal_Periksa' => $tgl_antri,
            'Status_Periksa_Id' => $status_periksa_id
        ]);

        return response()->json($res->Antrian_Pasien_Id);
    }

    public function NoUrutPoli($Work_Unit_Id)
    {
        $value = null;

        $biggest = DB::table('tr_antrian_pasien')
            ->where('Work_Unit_Id', $Work_Unit_Id)
            ->whereDate('Tanggal_Periksa', Carbon::today()->toDateString())
            ->select('No_Urut')
            ->orderBy('No_Urut', 'DESC')
            ->first();

        $default = '1';

        if ($biggest == null) {
            $value = $default;
        } else {
            $value = $biggest->No_Urut + 1;
        }

        return $value;
    }

    public function cetakAntrian(Request $req, $id)
    {
        $id = $id;

        $data = DB::table('tr_antrian_pasien')
            ->leftjoin('tr_pasien', 'tr_antrian_pasien.Pasien_Id', '=', 'tr_pasien.Pasien_Id')
            ->leftjoin('mstr_work_unit', 'tr_antrian_pasien.Work_Unit_Id', '=', 'mstr_work_unit.Work_Unit_Id')
            ->leftjoin('emp_employee', 'tr_antrian_pasien.Dokter_Id', '=', 'emp_employee.Employee_Id')
            ->orderby('Tanggal_Periksa', 'desc')
            ->where('Antrian_Pasien_Id', $id)
            ->first();

        $no_antrian = DB::table('tr_antrian_pasien')
            ->select('No_Urut')
            ->where('Work_Unit_Id', '=', $data->Work_Unit_Id)
            ->where('Status_Periksa_Id', '=', '1')
            ->whereDate('Tanggal_Periksa', Carbon::today()->toDateString())
            ->count();
        // dd($no_antrian);
        return view('poliklinik/antrian/cetak')->with('data', $data)->with('total_antrian', $no_antrian)->with('id', $id);
    }

    public function printList()
    {
        $getpasien = DB::table('tr_pasien')
            ->join('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_Kelamin_Id', '=', 'tr_pasien.Jenis_Kelamin_Id')
            ->select('tr_pasien.*', 'mstr_jenis_kelamin.Jenis_Kelamin')->get();

        $pdf = PDF::loadView('pasien/cetak_listpasien', ['data' => $getpasien])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function printKartu($idPasien)
    {
        $getpasien = DB::table('tr_pasien')->where('Pasien_Id', $idPasien)
            ->leftjoin('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_Kelamin_Id', '=', 'tr_pasien.Jenis_Kelamin_Id')
            ->select('tr_pasien.*', 'mstr_jenis_kelamin.Jenis_Kelamin')->first();
        // dd($getpasien);
        $pdf = PDF::loadView('pasien/cetak_kartupasien', ['data' => $getpasien])->setPaper([0, 0, 340, 208], 'portrait');

        return $pdf->stream();
    }

    public function printLabelRM($idPasien)
    {
        $getpasien = DB::table('tr_pasien')->where('Pasien_Id', $idPasien)
            ->join('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_Kelamin_Id', '=', 'tr_pasien.Jenis_Kelamin_Id')
            ->select('tr_pasien.*', 'mstr_jenis_kelamin.Jenis_Kelamin')->first();

        $pdf = PDF::loadView('pasien/cetak_labelRM', ['data' => $getpasien])->setPaper([0, 0, 340, 208], 'portrait');

        return $pdf->stream();
    }

    public function printIdentitasPasien($idPasien)
    {
        $getpasien = DB::table('tr_pasien')->where('Pasien_Id', $idPasien)
            ->join('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_Kelamin_Id', '=', 'tr_pasien.Jenis_Kelamin_Id')
            ->join('mstr_keluarga', 'mstr_keluarga.Keluarga_Id', '=', 'tr_pasien.Keluarga_Id')
            ->join('mstr_agama', 'mstr_agama.Agama_Id', '=', 'tr_pasien.Agama_Id')
            ->join('mstr_status_pernikahan', 'mstr_status_pernikahan.Status_Pernikahan_Id', '=', 'tr_pasien.Status_Pernikahan_Id')
            ->join('mstr_pendidikan', 'mstr_pendidikan.Pendidikan_Id', '=', 'tr_pasien.Pendidikan_Id')
            ->select('tr_pasien.*', 'mstr_jenis_kelamin.Jenis_Kelamin', 'mstr_keluarga.Keluarga', 'mstr_agama.agama', 'mstr_status_pernikahan.Status_Pernikahan', 'mstr_pendidikan.pendidikan')->first();

        $pdf = PDF::loadView('pasien/cetak_identitaspasien', ['data' => $getpasien])->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function printKartuIndeks($idPasien)
    {
        $getpasien = DB::table('tr_pasien')->where('Pasien_Id', $idPasien)
            ->join('mstr_jenis_kelamin', 'mstr_jenis_kelamin.Jenis_Kelamin_Id', '=', 'tr_pasien.Jenis_Kelamin_Id')
            ->join('mstr_keluarga', 'mstr_keluarga.Keluarga_Id', '=', 'tr_pasien.Keluarga_Id')
            ->join('mstr_agama', 'mstr_agama.Agama_Id', '=', 'tr_pasien.Agama_Id')
            ->join('mstr_status_pernikahan', 'mstr_status_pernikahan.Status_Pernikahan_Id', '=', 'tr_pasien.Status_Pernikahan_Id')
            ->join('mstr_pendidikan', 'mstr_pendidikan.Pendidikan_Id', '=', 'tr_pasien.Pendidikan_Id')
            ->join('mstr_gol_darah', 'mstr_gol_darah.Gol_Darah_Id', '=', 'tr_pasien.Gol_Darah_Id')
            ->select('tr_pasien.*', 'mstr_jenis_kelamin.Jenis_Kelamin', 'mstr_keluarga.Keluarga', 'mstr_agama.agama', 'mstr_status_pernikahan.Status_Pernikahan', 'mstr_pendidikan.pendidikan', 'mstr_gol_darah.Gol_Darah')->first();

        $pdf = PDF::loadView('pasien/cetak_kartuindeks', ['data' => $getpasien])->setPaper('LEGAL', 'landscape');

        return $pdf->stream();
    }
}
