<style>
  .detailimage {
    cursor: pointer;
  }
</style>
<h5><b>Kegiatan</b></h5>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-sm btn-success" id="addData"><i class="fa fa-plus"></i> Tambah</button>

                <div id="load_data_kegiatan" class="mt-3"></div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kegiatan Baru</h5>
      </div>
      <form action="<?= base_url('welcome/add_kegiatan') ?>" enctype="multipart/form-data" method="post" id="formAddKegiatan">
      <div class="modal-body">

      <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tgl" id="tgl" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="ket" id="ket" class="form-control">
        <small class="text-danger" id="err_ket"></small>
      </div>

      <div class="form-group">
        <label>Tempat</label>
        <textarea name="loc" id="loc" cols="30" rows="5" class="form-control"></textarea>
        <small class="text-danger" id="err_loc"></small>
      </div>

      <div class="form-group">
        <label>Jumlah Peserta</label>
        <input type="number" name="jml" id="jml" class="form-control">
        <small class="text-danger" id="err_jml"></small>
      </div>

       <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto[]" id="foto" multiple="multiple" accept="image/*" required>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toAdd">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAllFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Foto Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadListPhoto">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="toAddNewPhoto"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loadFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
      <div class="modal-body" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img src="" id="showImageSelected" alt="foto" class="w-100">
      </div>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewPhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Foto Baru</h5>
      </div>
      <form action="<?= base_url('welcome/add_new_photo_kegiatan'); ?>" method="post" id="add_new_photo" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="kegiatan" id="kegiatan_id">
        <div class="form-group">
          <label>Pilih Foto</label>
          <input type="file" name="foto[]" id="foto_add" class="form-control" required multiple="multiple" accept="image/*">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="toSaveNewPhoto">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>

    $(document).ready(function(){
      load_data_kegiatan();
    });

    $('#addData').click(function(){
        $('#modalAdd').modal('show');
        $('#tgl').val('');
        $('#ket').val('');
        $('#loc').val('');
        $('#jml').val('');
        $('#foto').val('');

        $('#err_ket').html('');
        $('#err_jml').html('');
        $('#err_loc').html('');
    });

    $('#formAddKegiatan').submit(function(e){
      e.preventDefault();
      $('#toAdd').attr('disabled', true);

      $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: 'POST',
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function(d){
          $('#toAdd').removeAttr('disabled');
          if(d.type == 'validation'){
            if(d.err_ket == ''){
              $('#err_ket').html('');
            } else {
              $('#err_ket').html(d.err_ket);
            }

            if(d.err_loc == ''){
              $('#err_loc').html('');
            } else {
              $('#err_loc').html(d.err_loc);
            }

            if(d.err_jml == ''){
              $('#err_jml').html('');
            } else {
              $('#err_jml').html(d.err_jml);
            }
          } else if(d.type == 'result'){
            $('#modalAdd').modal('hide');
            if(d.status == true){
              toastr["success"](d.msg, "Success");
            } else {
              toastr["error"](d.msg, "Error");
            }
          }
        },
        error: function(xhr){
          $('#toAdd').removeAttr('disabled');
          $('#modalAdd').modal('hide');
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

    $(document).on('click', '.view_photo', function(){
      let id = $(this).data('id');
      let kegiatan = $(this).data('kegiatan');

      const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

      $('#loadListPhoto').html(loading_animation);
      $('#modalAllFoto').modal('show');
      $('#toAddNewPhoto').data('id', kegiatan);

      $.ajax({
        url: '<?= base_url('ajax/load_list_foto_kegiatan'); ?>',
        data: {id: id},
        type: 'POST',
        success: function(d){
          $('#loadListPhoto').html(d);
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

    $(document).on('click', '.detailimage', function(){
      let link = $(this).attr('src');
      $('#showImageSelected').attr('src', link);
      $('#loadFoto').modal('show');
    });

    $(document).on('click', '.delete-Photo', function(){
      let id = $(this).data('id');
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Untuk menghapus foto ini",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?= base_url('welcome/delete_photo_kegiatan') ?>',
            data: {id: id},
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
              $('#modalAllFoto').modal('hide');
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
          });
        }
      })
    });

    $('#toAddNewPhoto').click(function(){
      $('#modalAllFoto').modal('hide');
      let id = $(this).data('id');
      $('#kegiatan_id').val(id);
      $('#addNewPhoto').modal('show');
      $('#foto_add').val('');
    });

    $('#add_new_photo').submit(function(e){
      e.preventDefault();
      $('#toSaveNewPhoto').attr('disabled', true);

      $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: 'POST',
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function(d){
          $('#toSaveNewPhoto').removeAttr('disabled');
          $('#addNewPhoto').modal('hide');

          if(d.status == true){
            toastr["success"](d.msg, "Success");
          } else {
            toastr["error"](d.msg, "Error");
          }

        },
        error: function(xhr){
          $('#toSaveNewPhoto').removeAttr('disabled');
          $('#addNewPhoto').modal('hide');
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

    function load_data_kegiatan(){
      const loading_animation = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
        $('#load_data_kegiatan').html(loading_animation);

        $.ajax({
            url: '<?= base_url('ajax/load_data_kegiatan'); ?>',
            type: 'POST',
            success: function(d){
                $('#load_data_kegiatan').html(d);
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

