<h5><b>Master Anggota</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" id="addXL">Tambah langsung</a>
                        <a class="dropdown-item" href="#">Import dari excel</a>
                    </div>
                </div>
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
                <input type="text" class="form-control" name="status_organisasi" id="status_organisasi">
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


<script>
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
    })

</script>