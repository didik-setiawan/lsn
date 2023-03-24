<h5><b>User Settings</b></h5>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <form action="<?= base_url('user/change_setting') ?>" enctype="multipart/form_data" id="editProfile" method="post"> -->
                <?= form_open_multipart('user/change_setting') ?>
                <div class="row justify-content-center">
                    <div class="col-md-4 col-lg-3 col-sm-3 col-4">
                        <img src="<?= base_url('assets/img/user/' . $user->img) ?>" alt="image user" width="100%" class="img-thumbnail">
                    </div>
                    <div class="col-12 col-md-12 col-sm-12 col-lg-10 mt-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" required class="form-control" value="<?= $user->nama ?>" id="inputEmail3" placeholder="Nama">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= $user->email ?>" name="email" class="form-control" id="inputEmail3" placeholder="Email" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto" class="form-control" id="inputEmail3">
                            </div>
                        </div>

                        <button class="btn btn-primary" id="toSubmit" type="submit">Save</button>
                        
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
