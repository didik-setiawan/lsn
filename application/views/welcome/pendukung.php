<h5><b>Pendukung</b></h5>

<?php if($user->id_role == 4){ ?>

    <!-- jika Caleg -->
    
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
            <nav> 
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pendukung</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Relawan</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                   
                    <button class="btn btn-sm btn-success mt-3" id="add_pendukung" data-by="caleg"><i class="fa fa-plus"></i> Tambah</button>

                    <div id="load_pendukung" class="table-responsive mt-3">
                        <table class="table table-bordered loadPendukung w-100">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Domisili</th>
                                    <th>Status Organisasi</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div id="load_data_relawan" class="table-responsive mt-3">
                        <table class="table table-bordered loadRelawan w-100">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Domisili</th>
                                    <th>Status Organisasi</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<?php } else if($user->id_role == 2) { ?>
    <!-- jika relawan -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php 
                        $check_penempatan_relawan = $this->m->check_penempatan_relawan();

                        if($check_penempatan_relawan > 0){
                            $action = '';
                        } else {
                            $action = 'disabled';
                        }
                    ?>
                    <button <?= $action ?> class="btn btn-sm btn-success" id="add_pendukung" data-by="relawan"><i class="fa fa-plus"></i> Tambah</button>

                    <div id="load_data_if_relawan" class="mt-3 table-responsive">
                        <table class="table table-bordered loadPendukungRelawan w-100">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Domisili</th>
                                    <th>Status Organisasi</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<div class="modal fade" id="modalPendukung" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label class="col-sm-2 col-form-label">NIK</label>
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
            <label class="col-sm-2 col-form-label">No Telp</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" id="no_telp">
                <small class="text-danger" id="err_telp"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email">
                <small class="text-danger" id="err_email"></small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
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

                <select name="status_organisasi" id="status_organisasi" class="form-control">
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="toSubmit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Detail Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="load_detail_pendukung"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm float-left" data-dismiss="modal">Close</button>
        <?php if($user->id_role == 4){ ?>
        <a href="" class="btn btn-sm btn-success for_relawan" id="for_relawan" >Jadikan Relawan</a>
        <?php } ?>
        <a href="" class="btn btn-sm btn-danger delete"  id="delete" >Hapus</a>
        <a href="" class="btn btn-sm btn-primary edit" id="edit">Edit</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title titleXLE" id="exampleModalLabel">Edit Data Pendukung</h5>
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
               
                <select name="status_organisasi" id="status_organisasiE" class="form-control">
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
<div class="modal fade" id="modalPenempatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="exampleModalLabel">Penempatan Relawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive" id="load_penempatan_relawan">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-id="" data-type="add" id="penempatan"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalActionPenempatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title titlePenempatan" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="formPenempatan" method="post">
      <div class="modal-body">
        <input type="hidden" name="id_relawan" id="relawan_id">
        <div class="form-group">
            <label>Provinsi</label>
            <select name="provinsi" id="prov_penempatan" required class="form-control">
                <option value="">Pilih</option>
                <?php foreach($provinsi as $p){ ?>
                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Kabupaten</label>
            <select name="kabupaten" id="kab_penempatan" required class="form-control">
                <option value="">pilih</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kecamatan</label>
            <select name="kecamatan" id="kec_penempatan" required class="form-control">
                <option value="">pilih</option>
            </select>
        </div>

        <div class="form-group">
            <label>Desa</label>
            <select name="desa" id="desa_penempatan" required class="form-control">
                <option value="">pilih</option>
            </select>
        </div>

        <div class="form-group">
            <label>No TPS</label>
            <input type="text" name="tps" id="tps" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" id="savePenempatan">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        load_pendukung();
        load_relawan();
        load_pendukung_if_relawan();
    });

    $('#add_pendukung').click(function(){

        let by = $(this).data('by');
        if(by == 'caleg'){
            $('#formAnggota').attr('action', '<?= base_url('welcome/add_pendukung'); ?>');
        } else if(by == 'relawan'){
            $('#formAnggota').attr('action', '<?= base_url('welcome/add_pendukung_by_relawan'); ?>');
        }

        $('#modalPendukung').modal('show');
        $('.titleXL').html('Tambah Data Pendukung');

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

                load_pendukung();
                load_pendukung_if_relawan();

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
                            $('#modalPendukung').modal('hide');
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
    });

    $(document).on('click', '.detail-pendukung', function(){
        let id = $(this).data('id');
        const spinner = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

        $('#modalDetail').modal('show');
        $('#load_detail_pendukung').html(spinner);

        $('#for_relawan').attr('disabled', true);
        $('#delete').attr('disabled', true);
        $('#edit').attr('disabled', true);

        $.ajax({
            url: '<?= base_url('ajax/load_data_anggota'); ?>',
            type: 'POST',
            data: {id: id},
            success: function(d){
                $('#load_detail_pendukung').html(d);
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

        $.ajax({
            url: '<?= base_url('ajax/get_data_member') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#for_relawan').removeAttr('disabled');
                $('#delete').removeAttr('disabled');
                $('#edit').removeAttr('disabled'); 

                $('#for_relawan').attr('href', '<?= base_url('welcome/change_role_member/') ?>' + d.id_user);
                $('#delete').attr('href', '<?= base_url('welcome/hapus_member/') ?>' + d.id_user);
                $('#edit').attr('href', d.id_user);

                if(d.role != 3){
                    $('#for_relawan').addClass('d-none');
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

    $('.for_relawan').click(function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Mengubah role member ini ke relawan?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: href,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(d){
                        $('#modalDetail').modal('hide');

                        if(d.success == true){
                            toastr["success"](d.msg, "Success");
                            load_pendukung();
                            load_relawan();
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
        
    });

    $('.delete').click(function(e){
        e.preventDefault();
        let href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Untuk menghapus member ini?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                url: href,
                type: 'POST',
                dataType: 'JSON',
                success: function(d){
                    $('#modalDetail').modal('hide');
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
                        load_pendukung();
                        load_relawan();
                        load_pendukung_if_relawan();
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
        })
    });

    $('.edit').click(function(e){
        e.preventDefault();
        let href = $(this).attr('href');

        $('#modalEdit').modal('show');

        $('#formAnggotaE').attr('action', '<?= base_url('welcome/edit_pendukung'); ?>');

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
            data: {id: href},
            type: 'POST',
            dataType:'JSON',
            success: function(d){
                $('#modalEdit').modal('show');
                
                $('#id_member').val(href);
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

    $('#formAnggotaE').submit(function(e){
        e.preventDefault();
        $('#toSubmitE').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#toSubmitE').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#toSubmitE').html('Save');
                $('#toSubmitE').removeAttr('disabled');

                    if(d.type == 'validation'){
                        if(d.nama == ''){
                            $('#err_nama_e').html('');
                        } else {
                            $('#err_nama_e').html(d.err_nama);
                        }

                        if(d.nik == ''){
                            $('#err_nik_e').html('');
                        } else {
                            $('#err_nik_e').html(d.err_nik);
                        }

                        if(d.tl == ''){
                            $('#err_tl_e').html('');
                        } else {
                            $('#err_tl_e').html(d.err_tl);
                        }

                        if(d.tlp == ''){
                            $('#err_telp_e').html('');
                        } else {
                            $('#err_telp_e').html(d.err_tlp);
                        }

                        if(d.dusun == ''){
                            $('#err_dusun_e').html('');
                        } else {
                            $('#err_dusun_e').html(d.err_dusun);
                        }

                        if(d.rw == ''){
                            $('#err_rw_e').html('');
                        } else {
                            $('#err_rw_e').html(d.err_rw);
                        }

                        if(d.rt == ''){
                            $('#err_rt_e').html('');
                        } else {
                            $('#err_rt_e').html(d.err_rt);
                        }

                    } else if(d.type == 'result'){

                        $('#err_nama_e').html('');
                        $('#err_nik_e').html('');
                        $('#err_tl_e').html('');
                        $('#err_telp_e').html('');
                        $('#err_dusun_e').html('');
                        $('#err_rw_e').html('');
                        $('#err_rt_e').html('');

                        if(d.success == false){
                            toastr["error"](d.msg, "Error");
                        } else {
                            $('#modalEdit').modal('hide');
                            $('#modalDetail').modal('hide');
                            toastr["success"](d.msg, "Success");  
                            load_pendukung();
                            load_relawan();
                            load_pendukung_if_relawan();
                        }
                    }
            },
            error: function(xhr){
                load_pendukung_if_relawan();
                $('#toSubmitE').html('Save');
                $('#toSubmitE').removeAttr('disabled');

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

    $(document).on('click', '.tempat_relawan', function(){
        $('#modalPenempatan').modal('show');
        const spinner = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#load_penempatan_relawan').html(spinner);
        let id = $(this).data('id');
        $('#penempatan').data('id', id);
        $('#penempatan').attr('disabled', true);


        $.ajax({
            url: '<?= base_url('ajax/load_data_penempatan_relawan') ?>',
            data: {id: id},
            type: 'POST',
            success: function(d){
                $('#load_penempatan_relawan').html(d);
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

        $.ajax({
            url:'<?= base_url('welcome/check_status_penempatan_relawan') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#penempatan').data('id', d.id);
                $('#penempatan').removeAttr('disabled');
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

    $(document).on('click' ,'#penempatan', function(){
        let id = $(this).data('id');
        let type = $(this).data('type');

        if(type == 'add'){
            $('.titlePenempatan').html('Tambah Penempatan');
            $('#formPenempatan').attr('action', '<?= base_url('welcome/add_penempatan_relawan') ?>');
            $('#relawan_id').val(id);

        } 
        $('#modalActionPenempatan').modal('show');

        $('#prov_penempatan').val('');
        $('#kab_penempatan').val('');
        $('#kec_penempatan').val('');
        $('#desa_penempatan').val('');
        $('#tps').val('');
    });

    $(document).on('click', '.edit-penempatan', function(){
        let id = $(this).data('id');

        $('#prov_penempatan').val('');
        $('#kab_penempatan').val('');
        $('#kec_penempatan').val('');
        $('#desa_penempatan').val('');
        $('#tps').val('');

        $('#modalActionPenempatan').modal('show');
        $('.titlePenempatan').html('Edit Penempatan');
        $('#formPenempatan').attr('action', '<?= base_url('welcome/edit_penempatan_relawan') ?>');
        $('#relawan_id').val(id);

        $.ajax({
            url: '<?= base_url('welcome/get_penempatan_relawan_row') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#prov_penempatan').val(d.id_provinsi);
                $('#tps').val(d.tps);

                let id_prov = d.id_provinsi;
                let id_kab = d.id_kabupaten;
                let id_kec = d.id_kecamatan;
                let id_desa = d.id_desa;

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
                        $('#kab_penempatan').html(html_kab);
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
                        $('#kec_penempatan').html(html_kec);
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
                        $('#desa_penempatan').html(html_desa);
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

    $('#prov_penempatan').change(function(){
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
                $('#kab_penempatan').html(html);
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

    $('#kab_penempatan').change(function(){
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
                $('#kec_penempatan').html(html);
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
    
    $('#kec_penempatan').change(function(){
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
                $('#desa_penempatan').html(html);
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

    $('#formPenempatan').submit(function(e){
        e.preventDefault();
        $('#savePenempatan').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#savePenempatan').removeAttr('disabled');
                $('#modalActionPenempatan').modal('hide');
                $('#modalPenempatan').modal('hide');
                load_relawan();

                if(d.success == true){
                  toastr["success"](d.msg, "Success");
                } else {
                  toastr["error"](d.msg, "Error");
                }
            },
            error: function(xhr){
                $('#savePenempatan').removeAttr('disabled');
    
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

    $(document).on('click', '.delete-penempatan', function(){
        let id = $(this).data('id');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Untuk menghapus data ini?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                url: '<?= base_url('welcome/delete_penempatan_relawan') ?>',
                data: {id: id},
                type: 'POST',
                dataType: 'JSON',
                success: function(d){
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
                        $('#modalPenempatan').modal('hide');
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
        })

    });

    function load_pendukung(){
        $('.loadPendukung').DataTable().destroy();
        let datatable = $('.loadPendukung').dataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('ajax/get_data_pendukung')?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            "iDisplayLength": 50,
            "ordering": false,
        });
    }

    function load_relawan(){
        $('.loadRelawan').DataTable().destroy();
        let datatable = $('.loadRelawan').dataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('ajax/load_data_relawan')?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            "iDisplayLength": 50,
            "ordering": false,
        });
    }

    function load_pendukung_if_relawan(){

        $('.loadPendukungRelawan').DataTable().destroy();
        let datatable = $('.loadPendukungRelawan').dataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('ajax/get_data_pendukung_relawan')?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            "iDisplayLength": 50,
            "ordering": false,
        });

        // const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

        // $('#load_data_if_relawan').html(loading_animation);

        // $.ajax({
        //     url: '<?= base_url('ajax/get_data_pendukung_relawan') ?>',
        //     type: 'POST',
        //     success: function(d){
        //         $('#load_data_if_relawan').html(d);
        //     },
        //     error: function(xhr){
        //       if(xhr.status === 0){
        //           toastr["error"]("No internet access", "Error");
        //       } else if(xhr.status == 404){
        //           toastr["error"]("Page not found", "Error");
        //       } else if(xhr.status == 500){
        //           toastr["error"]("Internal server error", "Error");
        //       } else {
        //           toastr["error"]("Unknow error", "Error");
        //       }
        //     }
        // });
    }


</script>