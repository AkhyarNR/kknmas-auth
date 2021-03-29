<section>
<script>
    function hitungUmur(Tanggal_Lahir){

        var date1 = new Date(Tanggal_Lahir);
        var date2 = new Date(Date.now());
    
        var miliday = 24 * 60 * 60 * 1000;
    
        var tglPertama = Date.parse(date1);
        var tglKedua = Date.parse(date2);
        var selisih = (tglKedua - tglPertama) / miliday;
        var tahun = Math.floor(selisih / 365);
        var sisaHari = (selisih % 365);
        var bulan = Math.floor(sisaHari / 30);
        var hari = Math.floor(sisaHari % 30);
    
        console.log(tahun + " tahun "+bulan+" bulan "+hari+" hari");
        return (tahun + " tahun "+bulan+" bulan "+hari+" hari");
    }

</script>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Pasien <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" disabled class="form-control" name="Nama" value="{{ isset($val->Nama) ? $val->Nama : '' }}">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. RM <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" disabled class="form-control" name="Kode_Pasien" value="{{ isset($val->Kode_Pasien) ? $val->Kode_Pasien : '' }}">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Lab <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input type="text" disabled class="form-control" name="No_Perawatan" value="{{ isset($val->No_Perawatan) ? $val->No_Perawatan : '' }}">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Umur <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" disabled disabled class="form-control" id="Umur" name="Umur" value="">
                <script type="text/javascript">
                    $('#Umur').val(hitungUmur('{{$val->Tanggal_Lahir}}'));
                </script>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Istri <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="Nama_Istri">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Kelamin <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" disabled class="form-control" name="Jenis_Kelamin" value="{{ isset($val->Jenis_Kelamin) ? $val->Jenis_Kelamin : '' }}">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal / Jam <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" disabled class="form-control" name="Waktu_Pemeriksaan" value="{{Carbon\Carbon::now()->format('d-m-Y H:i:s')}}">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Dokter Pengirim <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="Dokter_Pengirim">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Dokter Yang Bertanggung Jawab <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="Dokter">
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Petugas <span class="required">:</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="Perawat">
        </div>
    </div>

<script>
    $(document).ready(function(){

        $('input[name="Dokter_Pengirim"]').kendoDropDownList({
            optionLabel: "-Pilih Dokter-",
                dataTextField: "Full_Name",
                dataValueField: "Employee_Id",
                dataSource:{
                    transport:{
                        read:{
                            type: "GET",
                            url: "{{route('dropdown.getDokterLab')}}",
                            dataType: "json"
                        }
                    }
                }
        });

        $('input[name="Dokter"]').kendoDropDownList({
            optionLabel: "-Pilih Dokter-",
                dataTextField: "Full_Name",
                dataValueField: "Employee_Id",
                dataSource:{
                    transport:{
                        read:{
                            type: "GET",
                            url: "{{route('dropdown.getDokterLab')}}",
                            dataType: "json"
                        }
                    }
                }
        });

        $('input[name="Perawat"]').kendoDropDownList({
            optionLabel: "-Pilih Petugas-",
                dataTextField: "Full_Name",
                dataValueField: "Employee_Id",
                dataSource:{
                    transport:{
                        read:{
                            type: "GET",
                            url: "{{route('dropdown.getPerawatLab')}}",
                            dataType: "json"
                        }
                    }
                }
        });

    });
</script>
</section>