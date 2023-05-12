
<h5><b>Kegiatan</b></h5>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-sm btn-success" id="addData"><i class="fa fa-plus"></i> Tambah</button>
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

<script>
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

    
</script>

