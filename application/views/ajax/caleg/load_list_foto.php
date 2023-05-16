<div class="row">
<?php foreach($data as $d){ ?>
    <div class="col-6" >
        <div class="border m-2">
            <img src="<?= base_url('assets/img/kegiatan/').$d->file ?>" alt="foto" class="w-100 detailimage">
            <?php if($user->id_role == 2){ ?>
            <div class="text-center">
                <button class="badge badge-danger delete-Photo" data-id="<?= md5(sha1($d->id_foto)) ?>"><i class="fa fa-times"></i></button>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>