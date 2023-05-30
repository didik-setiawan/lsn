<h5><b>Master Anggota</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <div class="dropdown mb-3">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" id="addXL">Tambah langsung</a>
                        <a class="dropdown-item" id="import" href="#">Import dari excel</a>
                    </div>
                    <button id="export" class="btn btn-sm btn-secondary">Export Data</button>
                    <button class="btn btn-sm btn-primary" id="filterData"><i class="fa fa-filter"></i> Filter Data</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="TableAllMember">
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
                
                <div id="pagination_link">
                    <?= $this->pagination->create_links(); ?>
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
      <form action="<?= site_url('master/edit_member') ?>" id="formAnggotaE" method="post">
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
               
                <select name="status_organisasi" id="status_organisasiE" required class="form-control">
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
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
  <div class="modal-dialog modal-lg modal-dialog-centered">
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
        <a href="<?= base_url('master/download_template') ?>" class="btn btn-success"><i class="fa fa-download"></i> Download template excel</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toImport">Go</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Edit Foto Anggota</h5>
      </div>
      <form action="<?= base_url('master/edit_foto_member') ?>" id="formEditFoto" method="post">
      <div class="modal-body">
        <div id="load_image"></div>
        <div class="form-group mt-3">
            <label>Upload Foto Baru</label>
            <input type="hidden" name="id_member" id="id_member_edit_img">
            <input type="file" class="form-control" name="file_upload" id="file_edit_foto" required>
            <small class="text-danger">File yg di bolehkan: png, jpg, jpeg</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="SubmitImage" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editKtp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Edit Foto KTP</h5>
      </div>
      <form action="<?= base_url('master/edit_member_ktp'); ?>" id="formKTP" method="post">
      <div class="modal-body">
        <div id="load_img_ktp"></div>
        <div class="form-group mt-3">
            <label>Pilih File</label>
            <input type="hidden" name="id_member" id="member_id_ktp">
            <input type="file" name="img_ktp" id="img_ktp" class="form-control" required>
            <small class="text-danger">File yg di izinkan: png, jpg, jpeg</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="submitImgKTP" class="btn btn-primary">Go</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="getFilterData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control" name="provinsi" id="filter_provinsi">
                        <option value="">--pilih--</option>
                        <?php foreach($provinsi as $p){ ?>
                            <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kabupaten" id="filter_kabupaten" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="kecamatan" id="filter_kecamatan" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Desa</label>
                    <select name="desa" id="filter_desa" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Status Organisasi</label>
                    <select name="organisasi" id="filter_organisasi" class="form-control">
                        <option value="">--pilih--</option>
                         <?php foreach($cabang as $c){ ?>
                            <option value="<?= $c->id_cabang ?>"><?= $c->nama_cabang ?></option>
                         <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="goFilter" class="btn btn-primary">Go</button>
      </div>
     
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
      </div>
      <form action="<?= base_url('master/export_data'); ?>" method="post">
      <div class="modal-body">
        <p class="text-center"><strong>Silahkan pilih data yang akan di tampilkan</strong></p>
        <div class="row">
            <input type="hidden" name="provinsi" id="export_provinsi">
            <input type="hidden" name="kabupaten" id="export_kabupaten">
            <input type="hidden" name="kecamatan" id="export_kecamatan">
            <input type="hidden" name="desa" id="export_desa">
            <input type="hidden" name="organisasi" id="export_organisasi">


            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="nik" id="customCheck2">
                <label class="custom-control-label" for="customCheck2">NIK</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="nama" id="customCheck3">
                <label class="custom-control-label" for="customCheck3">Nama</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="email" id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Email</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="telp" id="customCheck5">
                <label class="custom-control-label" for="customCheck5">No telp</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="role" id="customCheck6">
                <label class="custom-control-label" for="customCheck6">Role</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="tmp_lahir" id="customCheck7">
                <label class="custom-control-label" for="customCheck7">Tempat Lahir</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="tgl_lahir" id="customCheck8">
                <label class="custom-control-label" for="customCheck8">Tanggal Lahir</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="jk" id="customCheck9">
                <label class="custom-control-label" for="customCheck9">Jenis Kelamin</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="alamat" id="customCheck10">
                <label class="custom-control-label" for="customCheck10">Alamat Lengkap</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="prov" id="customCheck11">
                <label class="custom-control-label" for="customCheck11">Provinsi</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="kab" id="customCheck12">
                <label class="custom-control-label" for="customCheck12">Kabupaten</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="kec" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">Kecamatan</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="des" id="customCheck14">
                <label class="custom-control-label" for="customCheck14">Desa</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="dusun" id="customCheck15">
                <label class="custom-control-label"for="customCheck15">Dusun</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="rw" id="customCheck16">
                <label class="custom-control-label" for="customCheck16">Rw</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="rt" id="customCheck17">
                <label class="custom-control-label" for="customCheck17">Rt</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="stat_org" id="customCheck18">
                <label class="custom-control-label" for="customCheck18">Status Organisasi</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="stat_kep" id="customCheck19">
                <label class="custom-control-label" for="customCheck19">Status Kepengurusan</label>
            </div>
            <div class="custom-control custom-checkbox col-md-6">
                <input type="checkbox" class="custom-control-input" name="pengajian" id="customCheck20">
                <label class="custom-control-label"  for="customCheck20">Nama Kelompok Pengajian</label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="toExport" class="btn btn-primary">Go</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        load_all_member();
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
                            setTimeout(() => {
                                load_all_member();
                            }, 2000);
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
                        setTimeout(() => { 
                            load_all_member();
                        }, 2000);
                    } else {
                        toastr["error"](d.msg, "Error");
                        $('#modalImport').modal('hide');
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

                    setTimeout(() => {
                        load_all_member();
                    }, 2000);
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
                        setTimeout(() => {
                            load_all_member();
                        }, 2000);
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

    $('#provinsiE').change(function(){
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
                $('#kabupatenE').html(html);
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

    $('#kabupatenE').change(function(){
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
                $('#kecamatanE').html(html);
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
    
    $('#kecamatanE').change(function(){
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
                $('#desaE').html(html);
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

                        $('#modalEdit').modal('hide');
                        if(d.success == false){
                            toastr["error"](d.msg, "Error");
                        } else {
                            toastr["success"](d.msg, "Success");  
                            setTimeout(() => {
                                load_all_member();
                            }, 2000);
                        }
                    }
            },
            error: function(xhr){
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

    $(document).on('click', '.edit-img',function(){
        let id = $(this).data('id');
        $('#id_member_edit_img').val(id);
        $('#img_ktp').val('');

        $.ajax({
            url: '<?= base_url('master/get_img_member') ?>',
            data: {id: id},
            type: 'POST',
            success: function(d){
                $('#load_image').html(d);
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
        $('#editImage').modal('show');
    });

    $('#formEditFoto').submit(function(e){
        e.preventDefault();
        $('#SubmitImage').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#SubmitImage').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(d){
                $('#SubmitImage').html('Save');
                $('#SubmitImage').removeAttr('disabled');

                if(d.success == false){
                    toastr["error"](d.msg, "Error");
                    $('#editImage').modal('hide');
                } else {
                    $('#editImage').modal('hide');
                    toastr["success"](d.msg, "Success");
                    setTimeout(() => {
                        load_all_member(); 
                    }, 2000);  
                }

            },
            error: function(xhr){
                $('#SubmitImage').html('Save');
                $('#SubmitImage').removeAttr('disabled');

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

    // function load_data(){
    //     const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
    //     $('#load_data').html(loading_animation);

    //     let prov = $('#filter_provinsi').val();
    //     let kab = $('#filter_kabupaten').val();
    //     let kec = $('#filter_kecamatan').val();
    //     let desa = $('#filter_desa').val();
    //     let org = $('#filter_organisasi').val();

    //     $.ajax({
    //         url: '<?= base_url('ajax/load_data_member'); ?>',
    //         type: 'POST',
    //         data: {
    //             provinsi: prov,
    //             kabupaten: kab,
    //             kecamatan: kec,
    //             desa: desa,
    //             organisasi: org
    //         },
    //         success: function(d){
    //             $('#load_data').html(d);
    //         },
    //         error: function(xhr){
               
    //                 if(xhr.status === 0){
    //                     toastr["error"]("No internet access", "Error");
    //                 } else if(xhr.status == 404){
    //                     toastr["error"]("Page not found", "Error");
    //                 } else if(xhr.status == 500){
    //                     toastr["error"]("Internal server error", "Error");
    //                 } else {
    //                     toastr["error"]("Unknow error", "Error");
    //                 }
    //         }
    //     });
    // }

    $(document).on('click', '.edit-ktp', function(){
        let id = $(this).data('id');
        $('#member_id_ktp').val(id);
        $.ajax({
            url: '<?= base_url('master/get_member_ktp') ?>',
            data: {id: id},
            type: 'POST',
            success: function(d){
                $('#load_img_ktp').html(d);
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

        $('#editKtp').modal('show');
    });

    $('#formKTP').submit(function(e){
        e.preventDefault();
        $('#submitImgKTP').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#submitImgKTP').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(d){
                $('#submitImgKTP').html('Go');
                $('#submitImgKTP').removeAttr('disabled');

                if(d.success == false){
                    toastr["error"](d.msg, "Error");
                } else {
                    $('#editKtp').modal('hide');
                    toastr["success"](d.msg, "Success");  
                    load_data(); 
                }

            },
            error: function(xhr){
                $('#submitImgKTP').html('Go');
                $('#submitImgKTP').removeAttr('disabled');
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

    $('#filterData').click(function(){
        $('#getFilterData').modal('show');
        $('#goFilter').removeAttr('disabled');
    });

    $('#filter_provinsi').change(function(){
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
                $('#filter_kabupaten').html(html);
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

    $('#filter_kabupaten').change(function(){
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
                $('#filter_kecamatan').html(html);
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
    
    $('#filter_kecamatan').change(function(){
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
                $('#filter_desa').html(html);
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

    

    $('#export').click(function(){
        $('#modalExport').modal('show');
        $('#toExport').removeAttr('disabled');
        $('#toExport').html('Go');
    });

    $('#filter_provinsi').change(function(){
        let value = $(this).val();
        $('#export_provinsi').val(value);
        $('#export_kabupaten').val('');
        $('#export_kecamatan').val('');
        $('#export_desa').val('');

        $('#filter_kabupaten').val('');
        $('#filter_kecamatan').val('');
        $('#filter_desa').val('');
    });

    $('#filter_kabupaten').change(function(){
        let value = $(this).val();
        $('#export_kabupaten').val(value);
        $('#export_kecamatan').val('');
        $('#export_desa').val('');

        $('#filter_kecamatan').val('');
        $('#filter_desa').val('');
    });

    $('#filter_kecamatan').change(function(){
        let value = $(this).val();
        $('#export_kecamatan').val(value);
        $('#export_desa').val('');
        $('#filter_desa').val('');
    });

    $('#filter_desa').change(function(){
        let value = $(this).val();
        $('#export_desa').val(value);
    });

    $('#filter_organisasi').change(function(){
        let value = $(this).val();
        $('#export_organisasi').val(value);
    });

    $('#goFilter').click(function(){
        $('#goFilter').attr('disabled', true);
        reload_data_member();
        $('#getFilterData').modal('hide');
    });
    
    function reload_data_member(){
        let prov = $('#filter_provinsi').val();
        let kab = $('#filter_kabupaten').val();
        let kec = $('#filter_kecamatan').val();
        let desa = $('#filter_desa').val();
        let org = $('#filter_organisasi').val();
        $('#TableAllMember').DataTable().destroy();
        load_all_member(prov, kab, kec, desa, org);
    }

    function load_all_member(prov = null, kab  =null, kec = null, desa = null, org = null){
        let datatable = $('#TableAllMember').dataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('ajax/load_all_data_member')?>",
                "type": "POST",
                "data": {
                    "prov" : prov,
                    "kab" : kab,
                    "kec" : kec,
                    "desa": desa,
                    "org": org
                }
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

</script>