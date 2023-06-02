<h5><b>Statistik</b></h5>

<p class="text-center"><b>Total Dukungan</b></p>
<h5 class="text-center count" style="margin-top: -15px"><b><?= number_format($jml_pendukung) ?></b></h5>

<small class="text-primary">Demography Gender</small>
<div class="row">

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <span style="font-size: 40px;" class="text-primary">
                        <i class="fas fa-male"></i>
                    </span>
                </div>

                <div class="float-right">
                    <span style="font-size: 20px;" class="text-primary count"><b><?= number_format($jml_l) ?></b></span> <br>
                    <small><?= round($persentase_l, 2) ?>%</small>
                </div>

            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <span style="font-size: 20px;" class="text-danger count"><b><?= number_format($jml_p) ?></b></span> <br>
                    <small><?= round($persentase_p, 2) ?>%</small>
                </div>

                <div class="float-right">
                    <span style="font-size: 40px;" class="text-danger">
                        <i class="fas fa-female"></i>
                    </span>
                </div>

            </div>  
        </div>
    </div>

    <div class="col-sm-12 col-md-6 mt-3">

        <div class="card">
            <div class="card-header bg-success text-white">
                <b>Pendukung Baru Bulan Ini</b>
            </div>
            <div class="card-body">
                <div class="float-left">
                    <span style="font-size: 50px">
                        <i class="fas fa-users text-success"></i>
                    </span>
                </div>
                <div class="float-right">
                    <span class="float-right count">60</span> <br>
                    <span>Pendukung baru</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 mt-3">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <b>Relawan Baru Bulan Ini</b>
            </div>
            <div class="card-body">
                <div class="float-left">
                    <span style="font-size: 50px">
                        <i class="fas fa-users text-primary"></i>
                    </span>
                </div>
                <div class="float-right">
                    <span class="float-right count">60</span> <br>
                    <span>Relawan baru</span>
                </div>
            </div>
        </div>
    </div>

</div>