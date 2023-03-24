<h5><b>Profile</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-3 col-sm-3 col-4">
                    <img src="<?= base_url('assets/img/user/' . $user->img) ?>" alt="image user" width="100%" class="img-thumbnail">
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Nama</th>
                            <td><?= $user->nama ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $user->email ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= $user->nama_role ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
