<table class="table table-bordered" id="Table">
    <thead>
        <tr class="bg-dark text-light">
            <th>#</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Status Organisasi</th>
            <th>Status Anggota</th>
            <th><i class="fa fa-cogs"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $a = 1;
        $b = 1;
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
            <td class="text-center"><img src="<?= base_url('assets/img/user/') . $d->img ?>" loading="lazy" alt="img_<?= $d->nik ?>" width="100px"></td>
            <td><?= $d->nama ?> / <?= $d->nik ?></td>
            <td><?= $d->nama_role ?></td>
            <td><?= $organisasi ?></td>
            <td>
                <?php 
                    if($d->id_role == 1){
                        $action = 'disabled';
                    } else {
                        $action = '';
                    }
                ?>
                <?php if($d->status == 1){ ?>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input status" <?= $action ?> id="customSwitch<?= $a++ ?>" checked value="<?= md5(sha1($d->id_user)) ?>" data-type="2">
                        <label class="custom-control-label" for="customSwitch<?= $b++ ?>">Aktif</label>
                    </div>
                <?php } else { ?>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input status" <?= $action ?> id="customSwitch<?= $a++ ?>" value="<?= md5(sha1($d->id_user)) ?>" data-type="1">
                        <label class="custom-control-label" for="customSwitch<?= $b++ ?>">Nonaktif</label>
                    </div>
                <?php } ?>
            </td>
            <td>

                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" <?= $action ?> type="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item detail" data-id="<?= md5(sha1($d->id_user)); ?>" href="#">Detail</a>
                        <a class="dropdown-item delete" data-id="<?= md5(sha1($d->id_user)); ?>" href="#">Hapus</a>
                        <a class="dropdown-item edit" data-id="<?= md5(sha1($d->id_user)); ?>" href="#">Edit Data</a>
                        <a class="dropdown-item edit-img" data-id="<?= md5(sha1($d->id_user)); ?>" href="#">Edit Foto</a>
                        <a class="dropdown-item edit-ktp" data-id="<?= md5(sha1($d->id_user)); ?>" href="#">Edit Ktp</a>
                        
                    </div>
                </div>

            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $('#Table').dataTable({
        "iDisplayLength": 50,
    });
</script>