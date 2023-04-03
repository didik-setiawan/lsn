<?php
    $get_organisasi = $this->db->where('id_cabang', $data->status_organisasi)->get('cabang')->row();
    $get_prov = $this->db->where('id', $data->provinsi)->get('wilayah_provinsi')->row();
    $get_kab = $this->db->where('id', $data->kabupaten)->get('wilayah_kabupaten')->row();
    $get_kec = $this->db->where('id', $data->kecamatan)->get('wilayah_kecamatan')->row();
    $get_desa = $this->db->where('id', $data->desa)->get('wilayah_desa')->row();

    if(isset($get_organisasi)){
        $organisasi = $get_organisasi->nama_cabang;
    } else {
        $organisasi = '<i class="text-danger">Unknow</i>';
    }

    if(isset($get_prov)){
        $prov = $get_prov->nama;
    } else {
        $prov = '<i class="text-danger">Unknow</i>';
    }

    if(isset($get_kab)){
        $kab = $get_kab->nama;
    } else {
        $kab = '<i class="text-danger">Unknow</i>';
    }

    if(isset($get_kec)){
        $kec = $get_kec->nama;
    } else {
        $kec = '<i class="text-danger">Unknow</i>';
    }

    if(isset($get_desa)){
        $desa = $get_desa->nama;
    } else {
        $desa = '<i class="text-danger">Unknow</i>';
    }

?>
<style>
    .detail-ktp {
      cursor: pointer;
    }
</style>

<div class="text-center">
    <img src="<?= base_url('assets/img/user/') . $data->img ?>" alt="img-user" width="150px" class="img-thumbnail rounded-circle shadow-sm">
</div>

<table class="table table-bordered mt-3 table-hover">
    <tr>
        <th>NIK</th>
        <td><?= $data->nik ?></td>
    </tr>
    <tr>
        <th>Nama Lengkap</th>
        <td><?= $data->nama ?></td>
    </tr>
    <tr>
        <th>Tempat, Tanggal Lahir</th>
        <td><?= $data->tempat_lahir ?>, <?php $date = date_create($data->tanggal_lahir); echo date_format($date, 'd F Y') ?></td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td><?= $data->jenis_kelamin ?></td>
    </tr>
    <tr>
        <th>Provinsi</th>
        <td><?= $prov ?></td>
    </tr>
    <tr>
        <th>Kabupaten</th>
        <td><?= $kab ?></td>
    </tr>
    <tr>
        <th>Kecamatan</th>
        <td><?= $kec ?></td>
    </tr>
    <tr>
        <th>Kelurahan / Desa</th>
        <td><?= $desa ?></td>
    </tr>
    <tr>
        <th>Dusun</th>
        <td><?= $data->dusun ?></td>
    </tr>
    <tr>
        <th>Rw / Rt</th>
        <td><?= $data->rw ?> / <?= $data->rt ?></td>
    </tr>
    <tr>
        <th>Alamat Lengkap</th>
        <td><?= $data->alamat_lengkap ?></td>
    </tr>
    <tr>
        <th>Status Organisasi</th>
        <td><?= $organisasi ?></td>
    </tr>
    <tr>
        <th>Status Kepengurusan</th>
        <td><?= $data->status_kepengurusan ?></td>
    </tr>
    <tr>
        <th>Nama Kelompok Pengajian</th>
        <td><?= $data->nama_kelompok_pengajian ?></td>
    </tr>
    <tr>
        <th>Role User</th>
        <td><?= $data->nama_role ?></td>
    </tr>
    <tr>
        <th>Foto KTP</th>
        <td>
            <?php if($data->file_ktp == null){ ?>   
                <i>KTP belum di upload</i>
            <?php } else { ?>
                <img src="<?= base_url('assets/img/ktp/') . $data->file_ktp ?>" class="detail-ktp" alt="file_ktp" width="100px">
            <?php } ?>
        </td>
    </tr>
    
</table>