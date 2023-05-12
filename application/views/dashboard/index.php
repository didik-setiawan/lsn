<!-- <h1 class="count">100000</h1> -->

<div class="container-fluid">
    <h3 class="mb-4">Selamat datang <?= $user->nama ?></h3>
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Semua User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_user ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php foreach($role as $r){ 
            $total_per_role = $this->m->get_total_user_role($r->id_role);    
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total <?= $r->nama_role ?></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_per_role ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
