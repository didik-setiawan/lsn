<h5><b>User Settings</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <form action="<?= base_url('user/change_setting') ?>" enctype="multipart/form_data" id="editProfile" method="post"> -->
                <?= form_open_multipart('user/change_setting') ?>
                <div class="row justify-content-center">
                    <div class="col-md-4 col-lg-3 col-sm-3 col-4">
                        <img src="<?= base_url('assets/img/user/' . $user->img) ?>" alt="image user" width="100%" class="img-thumbnail">
                    </div>
                    <div class="col-12 col-md-12 col-sm-12 col-lg-10 mt-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" required class="form-control" value="<?= $user->nama ?>" id="inputEmail3" placeholder="Nama">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= $user->email ?>" name="email" class="form-control" id="inputEmail3" placeholder="Email" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" id="foto" name="foto" class="form-control" id="inputEmail3">
                            </div>
                        </div>

                        <button class="btn btn-primary" id="toSubmit" type="submit">Save</button>
                        <button class="btn btn-success" type="button" id="changePassword"><i class="fa fa-key"></i> Ubah Password</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- UPLOAD FILE KTP -->
    <div class="col-12 mt-3 mb-3">
        <div class="card">
            <div class="card-body">
                <!-- <form action="<?= base_url('user/upload_ktp') ?>" enctype="multipart/form_data" id="editProfile" method="post"> -->
                <?= form_open_multipart('user/upload_ktp') ?>
                <div class="row justify-content-center">
                    <div class="col-md-4 col-lg-3 col-sm-3 col-4">

                        <?php if($user->file_ktp == null || $user->file_ktp == ''){ ?>
                            <p>KTP belum di upload</p>
                        <?php } else { ?>
                            <img src="<?= base_url('assets/img/ktp/' . $user->file_ktp) ?>" alt="image user" width="100%" class="img-thumbnail">
                        <?php } ?>

                    </div>
                    <div class="col-12 col-md-12 col-sm-12 col-lg-10 mt-3">
                        <input type="text" value="<?= $user->email ?>" name="email" class="form-control" id="inputEmail3" placeholder="Email" hidden disabled>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">File KTP</label>
                            <div class="col-sm-9">
                                <input type="file" id="file_ktp" name="file_ktp" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="toSubmit" type="submit">Save</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- END UPLOAD FILE KTP -->
    <?php if($user->id_role == 4){ ?>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('user/edit_target_suara') ?>" id="formSuara" method="post">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Target Suara</label>
                                <div class="col-sm-9">
                                    <input type="number" value="<?= $user->target_suara ?>" name="target_suara" class="form-control" id="inputSuara" placeholder="Target Suara">
                                </div>
                        </div>
                    <button class="btn btn-primary" id="toSaveSuara" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h5><strong>Data Caleg</strong></h5>
                
                <?php if($user->dapil_id == null || $user->dapil_id == 0){ ?>
                <div class="alert alert-danger" role="alert">
                    <div class="text-center">
                        <strong>No Data Result</strong> <br>
                        <button class="btn btn-sm btn-success mt-3" id="addDataCaleg"><i class="fa fa-plus"></i> Tambah Data Caleg</button>
                    </div>
                </div>
                <?php } else { ?>
                    <?php
                        $get_dapil = $this->db->get_where('dapil', ['id_dapil' => $user->dapil_id])->row();
                        $data_dapil = $this->m->get_data_dapil($get_dapil->id_caleg, null, null, $user->dapil_id)->row();
                        $data_wilayah = $this->db->where('id_dapil', $user->dapil_id)->get('dapil_wilayah')->result();
                        
                        
                        if(!$get_dapil || !$data_dapil || !$data_wilayah){
                            echo '<div class="alert alert-warning" role="alert">
                                <strong>
                                    Data tidak valid
                                </strong>
                            </div>';
                        } else {
                            if($get_dapil->id_caleg == 1){
                                $list_wilayah = '';
                                foreach($data_wilayah as $wil){
                                    $data_prov = $this->db->where('id', $wil->id_provinsi)->get('wilayah_provinsi')->row();
                                    $data_kab = $this->db->where('id', $wil->id_kabupaten)->get('wilayah_kabupaten')->row();
                                    $list_wilayah .= '<li>'.$data_prov->nama.' / '.$data_kab->nama.'</li>';
                                }

                               echo '<table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Tingkat Caleg</th>
                                            <td>'.$data_dapil->ketegori_caleg.'</td>
                                        </tr>
                                        </tr>
                                            <th>Wilayah Dapil</th>
                                            <td>
                                                <ul>
                                                '.$list_wilayah.'
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';
                            }else if($get_dapil->id_caleg == 2){
                                $list_wilayah = '';
                                foreach($data_wilayah as $wil){
                                    $data_prov = $this->db->where('id', $wil->id_provinsi)->get('wilayah_provinsi')->row();
                                    $data_kab = $this->db->where('id', $wil->id_kabupaten)->get('wilayah_kabupaten')->row();
                                    $list_wilayah .= '<li>'.$data_prov->nama.' / '.$data_kab->nama.'</li>';
                                }

                               echo '<table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Tingkat Caleg</th>
                                            <td>'.$data_dapil->ketegori_caleg.'</td>
                                        </tr>
                                        <tr>
                                            <th>Provinsi</th>
                                            <td>'.$data_dapil->provinsi.'</td>
                                        </tr>
                                        </tr>
                                            <th>Wilayah Dapil</th>
                                            <td>
                                                <ul>
                                                '.$list_wilayah.'
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';
                            }else if($get_dapil->id_caleg == 3){
                                $list_wilayah = '';
                                foreach($data_wilayah as $wil){
                                    $data_prov = $this->db->where('id', $wil->id_provinsi)->get('wilayah_provinsi')->row();
                                    $data_kab = $this->db->where('id', $wil->id_kabupaten)->get('wilayah_kabupaten')->row();
                                    $data_kec = $this->db->where('id', $wil->id_kecamatan)->get('wilayah_kecamatan')->row();
                                    $list_wilayah .= '<li>'.$data_prov->nama.' / '.$data_kab->nama.' / '.$data_kec->nama.'</li>';
                                }

                               echo '<table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Tingkat Caleg</th>
                                            <td>'.$data_dapil->ketegori_caleg.'</td>
                                        </tr>
                                        <tr>
                                            <th>Provinsi</th>
                                            <td>'.$data_dapil->provinsi.'</td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td>'.$data_dapil->kabupaten.'</td>
                                        </tr>
                                    
                                        </tr>
                                            <th>Wilayah Dapil</th>
                                            <td>
                                                <ul>
                                                '.$list_wilayah.'
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';
                            } else {
                                echo '<div class="alert alert-warning" role="alert">
                                <strong>
                                    Data tidak valid
                                </strong>
                            </div>';
                            }
                        }

                    ?>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php } ?>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            </div>
            <form action="<?= base_url('user/change_password') ?>" id="formPass" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password lama</label>
                        <input type="password" name="old_pass" id="old_pass" class="form-control">
                        <small class="text-danger" id="err_old"></small>
                    </div>

                    <div class="form-group">
                        <label>Password baru</label>
                        <input type="password" name="new_pass" id="new_pass" class="form-control">
                        <small class="text-danger" id="err_new"></small>
                    </div>

                    <div class="form-group">
                        <label>Ulangi password baru</label>
                        <input type="password" name="re_new" id="re_new" class="form-control">
                        <small class="text-danger" id="err_re"></small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="toChange">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddCaleg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Caleg</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master/add_data_dapil_caleg') ?>" id="formSettingDapil" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label>Tingkatan Caleg</label>
            <select name="caleg" id="caleg" class="form-control" required>
                <option value="">--pilih--</option>
                <?php foreach($caleg as $c){ ?>
                    <option value="<?= $c->id_caleg ?>"><?= $c->ketegori_caleg ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Provinsi</label>
            <select name="prov" id="prov" class="form-control">
                <option value="">--pilih--</option>
                <?php foreach($prov as $p){ ?>
                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>kabupaten</label>
            <select name="kab" id="kab" class="form-control">
                <option value="">--pilih--</option>
            </select>
        </div>

        <div class="form-group">
            <label>Dapil</label>
            <select name="dapil" id="dapil" class="form-control">
                <option value="">--pilih--</option>
            </select>
        </div>

        <div id="load_list_wilayah_dapil"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toSubmitDataDapil">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('#changePassword').click(function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').html('Ubah Password');
        $('#old_pass').val('');
        $('#new_pass').val('');
        $('#re_new').val('');
        $('#err_old').html('');
        $('#err_new').html('');
        $('#err_re').html('');
    });

    $('#formPass').submit(function(e) {
        e.preventDefault();
        $('#toChange').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#toChange').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(d) {
                $('#toChange').html('Save');
                $('#toChange').removeAttr('disabled');


                if (d.type == 'validation') {
                    if (d.err_old == '') {
                        $('#err_old').html('');
                    } else {
                        $('#err_old').html(d.err_old);
                    }

                    if (d.err_new == '') {
                        $('#err_new').html('');
                    } else {
                        $('#err_new').html(d.err_new);
                    }

                    if (d.err_re == '') {
                        $('#err_re').html('');
                    } else {
                        $('#err_re').html(d.err_re);
                    }

                } else if (d.type == 'result') {
                    $('#err_old').html('');
                    $('#err_new').html('');
                    $('#err_re').html('');

                    if (d.success == false) {
                        toastr["error"](d.msg, "Error");
                    } else {
                        $('#old_pass').val('');
                        $('#new_pass').val('');
                        $('#re_new').val('');
                        $('#exampleModal').modal('hide');

                        toastr["success"](d.msg, "Success");
                    }
                }
            },
            error: function(xhr) {
                $('#toChange').html('Save');
                $('#toChange').removeAttr('disabled');

                if (xhr.status === 0) {
                    toastr["error"]("No internet access", "Error");
                } else if (xhr.status == 404) {
                    toastr["error"]("Page not found", "Error");
                } else if (xhr.status == 500) {
                    toastr["error"]("Internal server error", "Error");
                } else {
                    toastr["error"]("Unknow error", "Error");
                }
            }
        });
    });

    $('#formSuara').submit(function(e){
        e.preventDefault();
        $('#inputSuara').attr('disabled', true);
        $('#toSaveSuara').attr('disabled', true);
        let target_suara = $('#inputSuara').val();

        $.ajax({
            url: $(this).attr('action'),
            data: {target_suara: target_suara},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                if(d.success == true){
                    toastr["success"](d.msg, "Success");
                    setTimeout(() => {
                        location.reload();
                    }, 1700);
                } else {
                    toastr["error"](d.msg, "Error");
                    setTimeout(() => {
                        location.reload();
                    }, 1700);
                }
            },
            error: function(xhr) {
                $('#inputSuara').removeAttr('disabled');
                $('#toSaveSuara').removeAttr('disabled');

                if (xhr.status === 0) {
                    toastr["error"]("No internet access", "Error");
                } else if (xhr.status == 404) {
                    toastr["error"]("Page not found", "Error");
                } else if (xhr.status == 500) {
                    toastr["error"]("Internal server error", "Error");
                } else {
                    toastr["error"]("Unknow error", "Error");
                }
            }
        });
    });

    $('#addDataCaleg').click(function(){
        $('#modalAddCaleg').modal('show');
        $('#prov').attr('disabled', true);
        $('#kab').attr('disabled', true);
        $('#dapil').attr('disabled', true);

        $('#prov').removeAttr('required');
        $('#kab').removeAttr('required');
        $('#dapil').removeAttr('required');

        $('#dapil').val('');
        $('#prov').val('');
        $('#kab').val('');
        $('#caleg').val('');

        $('#load_list_wilayah_dapil').html('');
    })

    $('#caleg').change(function(){
        let val = $(this).val();

        if(val == 1){
            $('#dapil').attr('required', true);
            $('#dapil').removeAttr('disabled');

            $('#prov').val('');
            $('#kab').val('');
            $('#dapil').val('');

            $('#prov').attr('disabled', true);
            $('#kab').attr('disabled', true);
            $('#prov').removeAttr('required');
            $('#kab').removeAttr('required');

            get_data_dapil(val);

        } else if(val == 2){
            $('#dapil').attr('required', true);
            $('#dapil').removeAttr('disabled');

            $('#prov').attr('required', true);
            $('#prov').removeAttr('disabled');

            $('#prov').val('');
            $('#kab').val('');
            $('#dapil').val('');

            $('#kab').attr('disabled', true);
            $('#kab').removeAttr('required');
        } else if(val == 3){
            $('#dapil').attr('required', true);
            $('#dapil').removeAttr('disabled');

            $('#prov').attr('required', true);
            $('#prov').removeAttr('disabled');

            $('#kab').attr('required', true);
            $('#kab').removeAttr('disabled');

            $('#prov').val('');
            $('#kab').val('');
            $('#dapil').val('');
        } else {
            $('#prov').attr('disabled', true);
            $('#kab').attr('disabled', true);
            $('#dapil').attr('disabled', true);

            $('#prov').removeAttr('required');
            $('#kab').removeAttr('required');
            $('#dapil').removeAttr('required');

            $('#prov').val('');
            $('#kab').val('');
            $('#dapil').val('');
        }
    })

    $('#prov').change(function(){
        let id = $(this).val();
        let caleg = $('#caleg').val();
        if(caleg == 2){
            get_data_dapil(caleg, id);
        }


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
                $('#kab').html(html);
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
    })

    $('#kab').change(function(){
        let id = $(this).val();
        let prov = $('#prov').val();
        let caleg = $('#caleg').val();

        get_data_dapil(caleg, prov, id);

    })

    function get_data_dapil(caleg = null, prov = null, kab = null){
        $.ajax({
            url: '<?= base_url('master/get_data_dapil') ?>',
            data: {caleg: caleg, prov: prov, kab: kab},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                let html = '<option value="">--pilih--</option>';
                let i;

                for(i=0; i<d.length; i++){
                    html += '<option value='+d[i].id_dapil+'>'+d[i].nama_dapil+'</option>'
                }
                $('#dapil').html(html);
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
        })
    }

    $('#dapil').change(function(){
        let id = $(this).val();
        $.ajax({
            url: '<?= base_url('master/get_wilayah_dapil') ?>',
            data: {id: id},
            type: 'POST',
            success: function(d){
                $('#load_list_wilayah_dapil').html(d);
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
        })
    })

    $('#formSettingDapil').submit(function(e){
        e.preventDefault();
        $('#toSubmitDataDapil').attr('disabled');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType:'JSON',
            success: function(d){
                if(d.success == true){
                    $('#modalAddCaleg').modal('hide');
                    toastr["success"](d.msg, "Success");
                    setTimeout(() => {
                        location.reload();
                    }, 1700);
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
        })
    })

</script>