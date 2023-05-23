<h5><b>Master Dapil</b></h5>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <button class="btn btn-sm btn-success mb-3" id="toAdd"><i class="fa fa-plus"></i> Tambah</button>
                <div id="load_data">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>#</th>
                                <th>Caleg</th>
                                <th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach($caleg as $cl){ ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $cl->ketegori_caleg; ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm show_next" data-id="<?= $cl->id_caleg ?>"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Dapil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master/add_dapil') ?>" method="post" id="formAdd">
      <div class="modal-body">

        <div class="form-group">
            <label>Nama Dapil</label>
            <input type="text" name="dapil" id="dapil_add" class="form-control" required>
            <small class="text-danger" id="err_dapil"></small>
        </div>

        <div class="form-group">
            <label>Tingkatan Caleg</label>
            <select name="caleg" id="caleg_add" class="form-control" required>
                <option value="">--pilih--</option>
                <?php foreach($caleg as $c){ ?>
                    <option value="<?= $c->id_caleg ?>"><?= $c->ketegori_caleg ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Wilayah Provinsi</label>
            <select name="prov" id="wil_prov" class="form-control" disabled>
                <option value="">--pilih--</option>
                <?php foreach($provinsi as $p){ ?>
                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Wilayah Kabupaten</label>
            <select name="kab" id="wil_kab" class="form-control" disabled>
                <option value="">--pilih--</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toSubmit">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalShowDapil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Data Dapil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showListDapil">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalListWIlayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="exampleModalLabel">Wilayah Dapil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showListWilayah">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary addWilayah"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddWilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Wilayah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <form action="<?= base_url('master/add_list_wilayah') ?>" id="formAddCard" method="post">
                <input type="hidden" name="id_dapil" id="dapil_add_list">
                <div class="form-group">
                    <label>Provinsi</label>
                    <select name="prov" id="prov_add_wilayah" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kab" id="kab_add_wilayah" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="kec" id="kec_add_wilayah" class="form-control">
                        <option value="">--pilih--</option>
                    </select>
                </div>
                
                <button class="btn btn-sm btn-danger" type="reset"><i class="fa fa-redo"></i> Reset</button>
                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-plus"></i> Tambah</button>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        <b>List Wilayah</b>
                    </div>
                    <div class="card-body" id="showList">

                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="toAddWilayah">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#toAdd').click(function(){
        $('#modalAdd').modal('show');
        $('#dapil_add').val('');
        $('#err_dapil').html('');
        $('#caleg_add').val('');
        $('#wil_prov').removeAttr('required');
        $('#wil_kab').removeAttr('required');

        $('#wil_prov').attr('disabled', true);
        $('#wil_kab').attr('disabled', true);
        $('#wil_prov').val('');
        $('#wil_kab').val('');
    })

    $('#wil_prov').change(function(){
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
                $('#wil_kab').html(html);
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

    $('#caleg_add').change(function(){
        let id = $(this).val();
        if(id == 1){
            $('#wil_prov').attr('disabled', true);
            $('#wil_kab').attr('disabled', true);
            $('#wil_prov').val('');
            $('#wil_kab').val('');
            $('#wil_prov').removeAttr('required');
            $('#wil_kab').removeAttr('required');
        } else if(id == 2){
            $('#wil_prov').removeAttr('disabled');
            $('#wil_kab').attr('disabled', true);
            $('#wil_prov').val('');
            $('#wil_kab').val('');
            $('#wil_prov').attr('required', true);
            $('#wil_kab').removeAttr('required');
        } else if(id == 3){
            $('#wil_prov').removeAttr('disabled');
            $('#wil_kab').removeAttr('disabled');
            $('#wil_prov').val('');
            $('#wil_kab').val('');
            $('#wil_prov').attr('required', true);
            $('#wil_kab').attr('required', true);
        } else {
            $('#wil_prov').attr('disabled', true);
            $('#wil_kab').attr('disabled', true);
            $('#wil_prov').val('');
            $('#wil_kab').val('');
            $('#wil_prov').removeAttr('required');
            $('#wil_kab').removeAttr('required');
        }
    })

    $('#formAdd').submit(function(e){
        e.preventDefault();
        let spinner = ' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        $('#toSubmit').html(spinner);
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
                    if(d.err_dapil == ''){
                        $('#err_dapil').html('');
                    } else {
                        $('#err_dapil').html(d.err_dapil);
                    }
                } else if(d.type == 'result'){
                    $('#err_dapil').html('');
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
                        $('#modalAdd').modal('hide');
                    } else {
                        toastr["error"](d.msg, "Error");
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
        })
    })

    $(document).on('click', '.show_next', function(){
        let spinner = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#showListDapil').html(spinner);
        $('#modalShowDapil').modal('show');

        let id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('ajax/load_list_dapil') ?>',
            data: {id: id},
            type: 'POST',
            success: function(d){
                $('#showListDapil').html(d);
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

    $(document).on('click', '.showWilayah', function(){
        let id = $(this).data('id');
        $('#modalListWIlayah').modal('show');
        $('.addWilayah').data('id', id);

        $('#prov_add_wilayah').attr('readonly', true);
        $('#kab_add_wilayah').attr('readonly', true);
        $('#kec_add_wilayah').attr('readonly', true);

        load_wilayah_dapil(id);
    })

    $('.addWilayah').click(function(){
        let id = $(this).data('id');
        $('#dapil_add_list').val(id);

        $('#modalListWIlayah').modal('hide');
        $('#modalAddWilayah').modal('show');

        $('#prov_add_wilayah').removeAttr('required', true);
        $('#kab_add_wilayah').removeAttr('required', true);
        $('#kec_add_wilayah').removeAttr('required', true);

        $('#prov_add_wilayah').val('');
        $('#kab_add_wilayah').val('');
        $('#kec_add_wilayah').val('');

        load_list_wilayah();

        $.ajax({
            url: '<?= base_url('ajax/check_data_dapil') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                
                if(d.id_caleg == 1){
                    $('#prov_add_wilayah').removeAttr('readonly');
                    $('#kab_add_wilayah').removeAttr('readonly');
                    $('#prov_add_wilayah').attr('required', true);
                    $('#kab_add_wilayah').attr('required', true);

                    let data_prov = d.data_prov;
                    let html = '<option value="">--pilih--</option>';
                    let i;

                    for(i=0; i<data_prov.length; i++){
                        html += '<option value='+data_prov[i].id+'>'+data_prov[i].nama+'</option>'
                    }
                    $('#prov_add_wilayah').html(html);

                } else if(d.id_caleg == 2){
                    $('#kab_add_wilayah').removeAttr('readonly');
                    $('#kab_add_wilayah').attr('required', true);

                    let data_kab = d.data_kab;
                    let html = '<option value="">--pilih--</option>';
                    let i;

                    let html_prov = '<option value='+d.id_provinsi+' selected>'+d.provinsi+'</option>';

                    for(i=0; i<data_kab.length; i++){
                        html += '<option value='+data_kab[i].id+'>'+data_kab[i].nama+'</option>'
                    }
                    $('#kab_add_wilayah').html(html);
                    $('#prov_add_wilayah').html(html_prov);

                } else if(d.id_caleg == 3){
                    $('#kec_add_wilayah').removeAttr('readonly');
                    $('#kec_add_wilayah').attr('required', true);

                    let data_kec = d.data_kec;
                    let html = '<option value="">--pilih--</option>';
                    let i;

                    let html_prov = '<option value='+d.id_provinsi+' selected>'+d.provinsi+'</option>';
                    let html_kab = '<option value='+d.id_kabupaten+' selected>'+d.kabupaten+'</option>';

                    for(i=0; i<data_kec.length; i++){
                        html += '<option value='+data_kec[i].id+'>'+data_kec[i].nama+'</option>'
                    }
                    $('#kec_add_wilayah').html(html);
                    $('#prov_add_wilayah').html(html_prov);
                    $('#kab_add_wilayah').html(html_kab);
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

    $('#prov_add_wilayah').change(function(){
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
                $('#kab_add_wilayah').html(html);
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

    $('#formAddCard').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function(d){
                load_list_wilayah();
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

    $(document).on('click', '.delete_list_cart', function(){
        let id = $(this).data('id');
        $.ajax({
            url: '<?= base_url('master/delete_list_cart') ?>',
            data:{id: id},
            type: 'POST',
            success: function(d){
                load_list_wilayah();
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

    $('#toAddWilayah').click(function(){
        $('#toAddWilayah').attr('disabled', true);
        $.ajax({
            url: '<?= base_url('master/add_wilayah_dapil') ?>',
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                $('#toAddWilayah').removeAttr('disabled');
                $('#modalAddWilayah').modal('hide');
                if(d.success == true){
                   toastr["success"](d.msg, "Success");
                } else {
                   toastr["error"](d.msg, "Error");
                }
            },
            error: function(xhr){
                $('#toAddWilayah').removeAttr('disabled');
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

    $(document).on('click', '.delete_list_wilayah', function(){
        let id = $(this).data('id');
        let id_dapil = $(this).data('dapil');
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Untuk menghapus data ini",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('master/delete_wilayah_dapil') ?>',
                data: {id: id},
                type: 'POST',
                dataType: 'JSON',
                success: function(d){
                    load_wilayah_dapil(id_dapil);
                    if(d.success == true){
                        toastr["success"](d.msg, "Success");
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
        }
        })
    })

    function load_list_wilayah(){
        $.ajax({
            url: '<?= base_url('master/load_list_wilayah_cart') ?>',
            type: 'POST',
            success: function(d){
                $('#showList').html(d);
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

    function load_wilayah_dapil(id_dapil = null){
        let spinner = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#showListWilayah').html(spinner);

        $.ajax({
            url: '<?= base_url('ajax/load_wilayah_dapil') ?>',
            data: {id: id_dapil},
            type: 'POST',
            success: function(d){
                $('#showListWilayah').html(d);
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

</script>