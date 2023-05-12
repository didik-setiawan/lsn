<table class="table table-bordered" id="data_anggota">
    <thead>
        <tr class="bg-dark text-light">
            <th>#</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Role</th>
            <th><i class="fa fa-cogs"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        foreach($data as $d){ ?>
        <tr>
            <td><?= $i++ ?></td>
            <td class="text-center"><img src="<?= base_url('assets/img/user/') . $d->img ?>" loading="lazy" alt="img_<?= $d->nik ?>" width="100px"></td>
            <td><?= $d->nama ?> / <?= $d->nik ?></td>
            <td><?= $d->nama_role ?></td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
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
    $('#data_anggota').dataTable({
        "iDisplayLength": 50,
    });
</script>