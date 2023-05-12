
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
      <form action="<?= base_url('welcome/add_kegiatan') ?>" method="post">
      <div class="modal-body">

      <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tgl" id="tgl" class="form-control">
      </div>

      <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="ket" id="ket" class="form-control">
      </div>

      <div class="form-group">
        <label>Tempat</label>
        <textarea name="loc" id="loc" cols="30" rows="5" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label>Jumlah Peserta</label>
        <input type="number" name="jml" id="jml" class="form-control">
      </div>

       <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" id="foto" multiple="multiple" accept="image/*">
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('#addData').click(function(){
        $('#modalAdd').modal('show');
    });

    
</script>

