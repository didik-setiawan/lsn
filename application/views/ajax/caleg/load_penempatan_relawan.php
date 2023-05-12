<?php if(empty($data)){ ?>
    <p class="text-center text-danger"><i>No data result</i></p>
<?php } else { ?>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-dark text-light">
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>No TPS</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $d){ ?>
                <tr>
                    <td><?= $d->prov ?></td>
                    <td><?= $d->kab ?></td>
                    <td><?= $d->kec ?></td>
                    <td><?= $d->desa ?></td>
                    <td><?= $d->no_tps ?></td>
                    <td>
                        <button class="btn btn-sm btn-danger delete-penempatan" data-id="<?= md5(sha1($d->id_penempatan)) ?>"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-sm btn-success edit-penempatan" data-id="<?= md5(sha1($d->id_penempatan)) ?>"><i class="fa fa-edit"></i></button>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>