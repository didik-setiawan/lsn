<div class="table-responsive mt-3">
    <table class="table table-bordered" id="load_data_pendukung">
        <thead>
            <tr class="bg-dark text-light">
                <th>#</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status Organisasi</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i  =1;
            foreach($data as $d){ 
                $get_organisasi = $this->db->where('id_cabang', $d->status_organisasi)->get('cabang')->row();
                if(isset($get_organisasi)){
                    $organisasi = $get_organisasi->nama_cabang;
                } else {
                    $organisasi = '<i>Unknow</i>';
                }    
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><img src="<?= base_url('assets/img/user/') . $d->img ?>" loading="lazy" alt="img_<?= $d->nik ?>" width="100px"></td>
                <td><?= $d->nama ?> / <?= $d->nik ?></td>
                <td><?= $d->nama_role ?></td>
                <td><?= $organisasi ?></td>
                <td>
                    <button class="btn btn-sm btn-success detail-pendukung" data-id="<?= md5(sha1($d->id_user)); ?>"><i class="fa fa-search"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $('#load_data_pendukung').dataTable({
        "iDisplayLength": 50,
    });
</script>