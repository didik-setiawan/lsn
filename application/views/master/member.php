<h5><b>Master Anggota</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="dropdown mb-3">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" id="addXL">Tambah langsung</a>
                        <a class="dropdown-item" id="import" href="#">Import dari excel</a>
                    </div>
                </div>
                <div id="load_data"></div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalXL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title titleXL" id="exampleModalLabel">Modal title</h5>
      </div>
      <form action="" id="formAnggota" method="post">
      <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama">
                <small class="text-danger" id="err_nama"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" id="nik">
                <small class="text-danger" id="err_nik"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                <small class="text-danger" id="err_tl"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="jk" id="jk" class="form-control" required>
                    <option value="">--pilih--</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">No Telp <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" id="no_telp">
                <small class="text-danger" id="err_telp"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email">
                <small class="text-danger" id="err_email"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password">
                <small class="text-danger" id="err_pass"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Provinsi <span class="text-danger">*</span></label>
            <div class="col-sm-10 prov">
                <select name="provinsi" id="provinsi" class="form-control" required>
                    <option value="">--pilih--</option>
                    <?php foreach($provinsi as $p){ ?>
                        <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kabupaten <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="kabupaten" id="kabupaten" class="form-control" required> 
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kecamatan <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="kecamatan" id="kecamatan" class="form-control" required>
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Desa / Kelurahan <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="desa" id="desa" class="form-control" required>
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Dusun <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="dusun" id="dusun">
                <small class="text-danger" id="err_dusun"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rw <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rw" id="rw">
                <small class="text-danger" id="err_rw"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rt <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rt" id="rt">
                <small class="text-danger" id="err_rt"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status Organisasi</label>
            <div class="col-sm-10">
                <!-- <input type="text" class="form-control" name="status_organisasi" id="status_organisasi"> -->

                <select name="status_organisasi" id="status_organisasi" required class="form-control">
                    <option value="">--pilih--</option>
                    <?php foreach($cabang as $c){ ?>
                        <option value="<?= $c->id_cabang ?>"><?= $c->nama_cabang ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status Kepengurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="status_kepengurusan" id="status_kepengurusan">
                
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kelompok Pengajian</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kel_pengajian" id="kel_pengajian">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea name="alamat_lengkap" id="alamat_engkap" class="form-control" cols="30" rows="3" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role User <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-control" required>
                    <option value="">--pilih--</option>
                    <?php foreach($role as $r){ ?>
                        <option value="<?= $r->id_role ?>"><?= $r->nama_role ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="toSubmit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title titleXLE" id="exampleModalLabel">Modal title</h5>
      </div>
      <form action="" id="formAnggotaE" method="post">
      <div class="modal-body">
        <input type="hidden" name="id_member" id="id_member">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="namaE">
                <small class="text-danger" id="err_nama_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" id="nikE">
                <small class="text-danger" id="err_nik_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahirE">
                <small class="text-danger" id="err_tl_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahirE" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="jk" id="jkE" class="form-control" required>
                    <option value="">--pilih--</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">No Telp <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" id="no_telpE">
                <small class="text-danger" id="err_telp_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Provinsi <span class="text-danger">*</span></label>
            <div class="col-sm-10 prov">
                <select name="provinsi" id="provinsiE" class="form-control" required>
                    <option value="">--pilih--</option>
                    <?php foreach($provinsi as $p){ ?>
                        <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kabupaten <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="kabupaten" id="kabupatenE" class="form-control" required> 
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kecamatan <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="kecamatan" id="kecamatanE" class="form-control" required>
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Desa / Kelurahan <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="desa" id="desaE" class="form-control" required>
                    <option value="">--pilih--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Dusun <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="dusun" id="dusunE">
                <small class="text-danger" id="err_dusun_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rw <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rw" id="rwE">
                <small class="text-danger" id="err_rw_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rt <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rt" id="rtE">
                <small class="text-danger" id="err_rt_e"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status Organisasi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="status_organisasi" id="status_organisasiE">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status Kepengurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="status_kepengurusan" id="status_kepengurusanE">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kelompok Pengajian</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kel_pengajian" id="kel_pengajianE">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea name="alamat_lengkap" id="alamat_engkapE" class="form-control" cols="30" rows="3" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role User <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <select name="role" id="roleE" class="form-control" required>
                    <option value="">--pilih--</option>
                    <?php foreach($role as $r){ ?>
                        <option value="<?= $r->id_role ?>"><?= $r->nama_role ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="toSubmitE" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Detail Anggota</h5>
      </div>
      <div class="modal-body" id="load_detail_member">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKTP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <img src="" class="show-ktp" width="100%" alt="foto-ktp">
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span amodalImportria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master/import_member') ?>" id="formImport" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label>Pilih File</label>
            <input type="file" required name="file" id="file" class="form-control">
            <small class="text-danger">File yang di support: xls, xlsx</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toImport">Go</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        load_data();
    });

    $('#provinsi').change(function(){
        let id = $(this).val();

        $.ajax({
            url: '<?= base_url('master/get_kabupaten') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                let html = '<option value="">--pilih--</option>';
                let i;

                for(i=0; i<d.length; i++){
                    html += '<option value='+d[i].id+'>'+d[i].nama+'</option>'
                }
                $('#kabupaten').html(html);
            },
            error: function(xhr){
               
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });

    });

    $('#kabupaten').change(function(){
        let id = $(this).val();

        $.ajax({
            url: '<?= base_url('master/get_kecamatan') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                let html = '<option value="">--pilih--</option>';
                let i;

                for(i=0; i<d.length; i++){
                    html += '<option value='+d[i].id+'>'+d[i].nama+'</option>'
                }
                $('#kecamatan').html(html);
            },
            error: function(xhr){
              

                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });

    });
    
    $('#kecamatan').change(function(){
        let id = $(this).val();

        $.ajax({
            url: '<?= base_url('master/get_kelurahan') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                let html = '<option value="">--pilih--</option>';
                let i;

                for(i=0; i<d.length; i++){
                    html += '<option value='+d[i].id+'>'+d[i].nama+'</option>'
                }
                $('#desa').html(html);
            },
            error: function(xhr){
              

                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });

    });

    $('#addXL').click(function(){
        $('#modalXL').modal('show');
        $('.titleXL').html('Tambah Data Anggota');
        $('#formAnggota').attr('action', '<?= base_url('master/add_member'); ?>');

        $('#nama').val('');
        $('#nik').val('');
        $('#tempat_lahir').val('');
        $('#tgl_lahir').val('');
        $('#jk').val('');
        $('#no_telp').val('');
        $('#email').val('');
        $('#err_pass').val('');
        $('#provinsi').val('');
        $('#kabupaten').val('');
        $('#kecamatan').val('');
        $('#desa').val('');
        $('#dusun').val('');
        $('#rw').val('');
        $('#rt').val('');
        $('#status_organisasi').val('');
        $('#status_kepengurusan').val('');
        $('#kel_pengajian').val('');
        $('#alamat_engkap').val('');
        $('#role').val('');

        $('#err_nama').html('');
        $('#err_nik').html('');
        $('#err_tl').html('');
        $('#err_telp').html('');
        $('#err_email').html('');
        $('#err_pass').html('');
        $('#err_dusun').html('');
        $('#err_rw').html('');
        $('#err_rt').html('');

    });

    $('#formAnggota').submit(function(e){
        e.preventDefault();
        $('#toSubmit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#toSubmit').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#toSubmit').html('Save');
                $('#toSubmit').removeAttr('disabled');

                    if(d.type == 'validation'){
                        if(d.nama == ''){
                            $('#err_nama').html('');
                        } else {
                            $('#err_nama').html(d.err_nama);
                        }

                        if(d.nik == ''){
                            $('#err_nik').html('');
                        } else {
                            $('#err_nik').html(d.err_nik);
                        }

                        if(d.tl == ''){
                            $('#err_tl').html('');
                        } else {
                            $('#err_tl').html(d.err_tl);
                        }

                        if(d.tlp == ''){
                            $('#err_telp').html('');
                        } else {
                            $('#err_telp').html(d.err_tlp);
                        }

                        if(d.email == ''){
                            $('#err_email').html('');
                        } else {
                            $('#err_email').html(d.err_email);
                        }

                        if(d.pass == ''){
                            $('#err_pass').html('');
                        } else {
                            $('#err_pass').html(d.err_pass);
                        }

                        if(d.dusun == ''){
                            $('#err_dusun').html('');
                        } else {
                            $('#err_dusun').html(d.err_dusun);
                        }

                        if(d.rw == ''){
                            $('#err_rw').html('');
                        } else {
                            $('#err_rw').html(d.err_rw);
                        }

                        if(d.rt == ''){
                            $('#err_rt').html('');
                        } else {
                            $('#err_rt').html(d.err_rt);
                        }

                    } else if(d.type == 'result'){

                        $('#err_nama').html('');
                        $('#err_nik').html('');
                        $('#err_tl').html('');
                        $('#err_telp').html('');
                        $('#err_email').html('');
                        $('#err_pass').html('');
                        $('#err_dusun').html('');
                        $('#err_rw').html('');
                        $('#err_rt').html('');

                        if(d.success == false){
                            toastr["error"](d.msg, "Error");
                        } else {
                            $('#modalXL').modal('hide');
                            toastr["success"](d.msg, "Success");  
                            load_data(); 
                        }
                    }
            },
            error: function(xhr){
                $('#toSubmit').html('Save');
                $('#toSubmit').removeAttr('disabled');

                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });
    });

    $('#import').click(function(){
        $('#modalImport').modal('show');
        $('#file').val('');
    });

    $('#formImport').submit(function(e){
        e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                type: 'POST',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(d){
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
                        $('#modalImport').modal('hide');
                        load_data();
                    } else {
                        toastr["error"](d.msg, "Error");
                    }
                },
                error: function(xhr){
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
                }
            });
    });

    $(document).on('change', '.status', function(){
        let tipe = $(this).data('type');
        let id = $(this).val();

        $.ajax({
            url: '<?= base_url('master/change_status_user') ?>',
            data: {
                id: id,
                type: tipe,
            },
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                if(d.success == true){
                    toastr["success"](d.msg, "Success");
                    load_data();
                } else {
                    toastr["error"](d.msg, "Error");
                }
            },
            error: function(xhr){
               
               if(xhr.status === 0){
                   toastr["error"]("No internet access", "Error");
               } else if(xhr.status == 404){
                   toastr["error"]("Page not found", "Error");
               } else if(xhr.status == 500){
                   toastr["error"]("Internal server error", "Error");
               } else {
                   toastr["error"]("Unknow error", "Error");
               }
            }
        });

    });

    $(document).on('click', '.detail-ktp', function(){
        let ktp = $(this).attr('src');
        $('#modalKTP').modal('show');
        $('.show-ktp').attr('src', ktp);
    });

    $(document).on('click', '.detail', function(){
        $('#modalDetail').modal('show');
        let id = $(this).data('id');
        const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#load_detail_member').html(loading_animation);

        $.ajax({
            url: '<?= base_url('ajax/load_data_anggota'); ?>',
            type: 'POST',
            data: {id: id},
            success: function(d){
                $('#load_detail_member').html(d);
            },
            error: function(xhr){
               
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });
    });

    $(document).on('click', '.delete', function(){
        let id = $(this).data('id');
        let con = confirm('Apakah anda yakin untuk menghapus data ini?');
        if(con){
            $.ajax({
                url: '<?= base_url('master/delete_member') ?>',
                data: {id: id},
                type: 'POST',
                dataType: 'JSON',
                success: function(d){
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
                        load_data();
                    } else {
                        toastr["error"](d.msg, "Error");
                    }
                },
                error: function(xhr){
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
                }

            });
        }
    });

    $(document).on('click', '.edit', function(){
        let id = $(this).data('id');
        $('.titleXLE').html('Edit Data Anggota');
        $('#formAnggotaE').attr('action', '<?= base_url('master/edit_member'); ?>');

        $('#namaE').val('');
        $('#nikE').val('');
        $('#tempat_lahirE').val('');
        $('#tgl_lahirE').val('');
        $('#jkE').val('');
        $('#no_telpE').val('');
      
        $('#provinsiE').val('');
        $('#kabupatenE').val('');
        $('#kecamatanE').val('');
        $('#desaE').val('');
        $('#dusunE').val('');
        $('#rwE').val('');
        $('#rtE').val('');
        $('#status_organisasiE').val('');
        $('#status_kepengurusanE').val('');
        $('#kel_pengajianE').val('');
        $('#alamat_engkapE').val('');
        $('#roleE').val('');

        $('#err_nama_e').html('');
        $('#err_nik_e').html('');
        $('#err_tl_e').html('');
        $('#err_telp_e').html('');
        $('#err_dusun_e').html('');
        $('#err_rw_e').html('');
        $('#err_rt_e').html('');

        $.ajax({
            url: '<?= base_url('master/get_member') ?>',
            data: {id: id},
            type: 'POST',
            dataType:'JSON',
            success: function(d){
                $('#modalEdit').modal('show');
                
                $('#id_member').val(id);
                $('#namaE').val(d.nama);
                $('#nikE').val(d.nik);
                $('#tempat_lahirE').val(d.tempat_lahir);
                $('#tgl_lahirE').val(d.tanggal_lahir);
                $('#jkE').val(d.jenis_kelamin);
                $('#no_telpE').val(d.no_telp);
          
                $('#provinsiE').val(d.provinsi);
                $('#kabupaten').val('');
                $('#kecamatan').val('');
                $('#desa').val('');
                $('#dusunE').val(d.dusun);
                $('#rwE').val(d.rw);
                $('#rtE').val(d.rt);
                $('#status_organisasiE').val(d.status_organisasi);
                $('#status_kepengurusanE').val(d.status_kepengurusan);
                $('#kel_pengajianE').val(d.nama_kelompok_pengajian);
                $('#alamat_engkapE').val(d.alamat_lengkap);
                $('#roleE').val(d.id_role);

                let id_prov = d.provinsi;
                let id_kab = d.kabupaten;
                let id_kec = d.kecamatan;
                let id_desa = d.desa;
                
                $.ajax({
                    url: '<?= base_url('master/get_kabupaten') ?>',
                    data: {id: id_prov},
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(kab){
                        let html_kab = '<option value="">--pilih--</option>';
                        let i;
                        for(i=0; i<kab.length; i++){
                            if(id_kab == kab[i].id){
                                html_kab += '<option value="'+kab[i].id+'" selected>'+kab[i].nama+'</option>';
                            } else {
                                html_kab += '<option value="'+kab[i].id+'">'+kab[i].nama+'</option>';
                            }
                        }
                        $('#kabupatenE').html(html_kab);
                    }
                });
                
                $.ajax({
                    url: '<?= base_url('master/get_kecamatan') ?>',
                    data: {id: id_kab},
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(kec){
                        let html_kec = '<option value="">--pilih--</option>';
                        let i;

                        for(i=0; i<kec.length; i++){
                            if(id_kec == kec[i].id){
                                html_kec += '<option value="'+kec[i].id+'" selected>'+kec[i].nama+'</option>';
                            } else {
                                html_kec += '<option value="'+kec[i].id+'">'+kec[i].nama+'</option>';
                            }
                        }
                        $('#kecamatanE').html(html_kec);
                    }
                });

                $.ajax({
                    url: '<?= base_url('master/get_kelurahan') ?>',
                    data: {id: id_kec},
                    dataType: 'JSON',
                    type: 'POST',
                    success: function(desa){
                        let html_desa = '<option value="">--pilih--</option>';
                        let i;
                        
                        for(i=0; i<desa.length; i++){
                            if(id_desa == desa[i].id){
                                html_desa += '<option value="'+desa[i].id+'" selected>'+desa[i].nama+'</option>';
                            } else {
                                html_desa += '<option value="'+desa[i].id+'">'+desa[i].nama+'</option>';
                            }
                        }
                        $('#desaE').html(html_desa);
                    }
                });

               

                





            }, 
            error: function(xhr){
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });


    });

    function load_data(){
        const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#load_data').html(loading_animation);

        $.ajax({
            url: '<?= base_url('ajax/load_data_member'); ?>',
            type: 'POST',
            success: function(d){
                $('#load_data').html(d);
            },
            error: function(xhr){
               
                    if(xhr.status === 0){
                        toastr["error"]("No internet access", "Error");
                    } else if(xhr.status == 404){
                        toastr["error"]("Page not found", "Error");
                    } else if(xhr.status == 500){
                        toastr["error"]("Internal server error", "Error");
                    } else {
                        toastr["error"]("Unknow error", "Error");
                    }
            }
        });
    }

</script>