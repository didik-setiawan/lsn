<?php if($id == 1){ ?>
    <table class="table table-bordered listTable">
        <thead>
            <tr class="bg-secondary text-light">
                <th>#</th>
                <th>Nama Dapil</th>
                <th>Tingkatan Caleg</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($data as $d){ ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $d->nama_dapil ?></td>
                <td><?= $d->ketegori_caleg ?></td>
                <td>
                    
                    <button class="btn btn-sm btn-danger deleteDapil" data-id="<?= md5(sha1($d->id_dapil)) ?>"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-sm btn-primary showWilayah" data-id="<?= $d->id_dapil ?>"><i class="fa fa-eye"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else if($id == 2){ ?>
    <table class="table table-bordered listTable">
        <thead>
            <tr class="bg-secondary text-light">
                <th>#</th>
                <th>Nama Dapil</th>
                <th>Tingkatan Caleg</th>
                <th>Provinsi</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($data as $d){ ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $d->nama_dapil ?></td>
                <td><?= $d->ketegori_caleg ?></td>
                <td><?= $d->provinsi ?></td>
                <td>
                   
                    <button class="btn btn-sm btn-danger deleteDapil" data-id="<?= md5(sha1($d->id_dapil)) ?>"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-sm btn-primary showWilayah" data-id="<?= $d->id_dapil ?>"><i class="fa fa-eye"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else if($id == 3){ ?>
    <table class="table table-bordered listTable">
        <thead>
            <tr class="bg-secondary text-light">
                <th>#</th>
                <th>Nama Dapil</th>
                <th>Tingkatan Caleg</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($data as $d){ ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $d->nama_dapil ?></td>
                <td><?= $d->ketegori_caleg ?></td>
                <td><?= $d->provinsi ?></td>
                <td><?= $d->kabupaten ?></td>
                <td>
                 
                    <button class="btn btn-sm btn-danger deleteDapil" data-id="<?= md5(sha1($d->id_dapil)) ?>"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-sm btn-primary showWilayah" data-id="<?= $d->id_dapil ?>"><i class="fa fa-eye"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<script>
    $('.listTable').dataTable();
</script>