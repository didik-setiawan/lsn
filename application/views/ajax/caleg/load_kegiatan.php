<?php if($user->id_role == 2){ ?>
<table class="table table-bordered" id="tableKegiatan">
    <thead>
        <tr class="bg-dark text-light">
            <th>#</th>
            <th>Tanggal</th>
            <th>Foto Kegiatan</th>
            <th>Keterangan</th>
            <th>Lokasi</th>
            <th>Jumlah Peserta</th>
            <th><i class="fa fa-cogs"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($kegiatan as $k){ 
        $tgl = date_create($k->tgl);   
        
        $foto = $this->db->get_where('kegiatan_foto', ['kegiatan' => $k->foto_kegiatan])->row();
        
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= date_format($tgl, 'd F Y'); ?></td>
                <?php if($foto){ ?>
                    <td class="text-center"><img src="<?= base_url('assets/img/kegiatan/') . $foto->file ?>" alt="foto_kegiatan" width="100px"></td>
                <?php } else { ?>
                    <td class="text-center text-danger">Belum ada foto di upload</td>
                <?php } ?>
                <td><?= $k->keterangan ?></td>
                <td><?= $k->tempat ?></td>
                <td><?= $k->jml_peserta ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cogs"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item view_photo" type="button" data-id="<?= md5(sha1($k->foto_kegiatan)) ?>"  data-kegiatan="<?= $k->foto_kegiatan ?>">Lihat Foto</button>
                            <button class="dropdown-item edit_data" type="button" data-id="<?= md5(sha1($k->id_kegiatan)) ?>">Edit</button>
                            <button class="dropdown-item delete_data" type="button" data-id="<?= md5(sha1($k->id_kegiatan)) ?>">Hapus</button>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $('#tableKegiatan').dataTable({
        "iDisplayLength": 50,
    });
</script>
<?php } else if($user->id_role == 4){ ?>
    <table class="table table-bordered tableForCaleg">
    <thead>
        <tr class="bg-dark text-light">
            <th>#</th>
            <th>Tanggal</th>
            <th>Foto Kegiatan</th>
            <th>Keterangan</th>
            <th>Lokasi</th>
            <th>Jumlah Peserta</th>
            <th>Nama Relawan</th>
            <th><i class="fa fa-cogs"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($kegiatan as $k){ 
        $tgl = date_create($k->tgl);    
        $foto = $this->db->get_where('kegiatan_foto', ['kegiatan' => $k->foto_kegiatan])->row();
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= date_format($tgl, 'd F Y'); ?></td>

                <?php if($foto){ ?>
                    <td class="text-center"><img src="<?= base_url('assets/img/kegiatan/') . $foto->file ?>" alt="foto_kegiatan" width="100px"></td>
                <?php } else { ?>
                    <td class="text-center text-danger">Belum ada foto di upload</td>
                <?php } ?>
                <td><?= $k->keterangan ?></td>
                <td><?= $k->tempat ?></td>
                <td><?= $k->jml_peserta ?></td>
                <td><?= $k->nama ?></td>
                <td>
                    <button class="btn btn-sm btn-dark view_photo" data-id="<?= md5(sha1($k->foto_kegiatan)) ?>"><i class="fa fa-images"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $('.tableForCaleg').dataTable({
        "iDisplayLength": 50,
    });
</script>
<?php } ?>