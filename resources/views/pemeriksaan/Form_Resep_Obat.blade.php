<section>

    <label class="col-md-3 col-sm-3  control-label">Pilih Obat
          <br>
          <small class="text-navy">Kode Obat| Nama Obat</small>
      </label>
      <div class="item form-group">
          <select class="form-control" name="Obat_Id_Resep" id="Obat_Id_Resep" placeholder="Select Obat..." style="width: 50%">
            </select>
      </div>
  
      <label class="col-md-3 col-sm-3  control-label">Dosis Resep Obat
          <br>
      </label>
      <div class="item form-group">
          <input class="form-control" name="Dosis_Resep" id="Dosis_Resep">
      </div>
  
      <label class="col-md-3 col-sm-3  control-label">Jumlah Obat
          <br>
      </label>
      <div class="item form-group">
          <input type="number" class="form-control" name="Jumlah_Obat_Resep" id="Jumlah_Obat_Resep">
      </div>

      <label class="col-md-3 col-sm-3  control-label">Aturan Pakai
        <br>
    </label>
    <div class="item form-group">
        <input class="form-control" name="Aturan_Pakai" id="Aturan_Pakai">
    </div>
  
      <div class="form-group">
          <button type="button" id="addItem" class="btn btn-primary">
              Tambah <span class="glyphicon glyphicon-plus" style="color:white" aria-hidden="true"></span>
          </button>
      </div> 
      {{-- <input type="hidden" id="url" name="url" value="{{asset('set_biaya_registrasi/create_post')}}"> --}}
              
      <div id="ObatDetailsResep" class="table-responsive">
  
  </section>