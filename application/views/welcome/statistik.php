<h5><b>Statistik</b></h5>
<div class="row">
    <?php if($user->dapil_id != null || $user->dapil_id != 0){ ?>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card" style="border: 1px solid #232946">
            <div class="card-body">

                <div class="text-center mb-3">
                    <h5><b>Total Pendukung</b></h5>
                    <span class="count" style="font-size: 25px;"><?= $total_pendukung ?></span>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5 p-2 mr-2" style="border: 1px solid #306bab; border-radius: 3px">
                        <span style="font-size: 30px; color: #306bab"><i class="fas fa-male"></i></span>
                        <div class="float-right">
                            <span class="count" style="font-size: 30px; color: #306bab"><b><?= $pendukung_l ?></b></span>
                        </div>
                    </div>

                    <div class="col-5 p-2 ml-2" style="border: 1px solid #cf1b9f; border-radius: 3px">
                        <span class="count" style="font-size: 30px; color: #cf1b9f"><b><?= $pendukung_p ?></b></span>
                        <div class="float-right">
                            <span style="font-size: 30px; color: #cf1b9f"><i class="fas fa-female"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card" style="border: 1px solid #232946">
            <div class="card-body">

                <div class="text-center mb-3">
                    <h5><b>Total Relawan</b></h5>
                    <span class="count" style="font-size: 25px;"><?= $total_relawan ?></span>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5 p-2 mr-2" style="border: 1px solid #306bab; border-radius: 3px">
                        <span style="font-size: 30px; color: #306bab"><i class="fas fa-male"></i></span>
                        <div class="float-right">
                            <span class="count" style="font-size: 30px; color: #306bab"><b><?= $relawan_l ?></b></span>
                        </div>
                    </div>

                    <div class="col-5 p-2 ml-2" style="border: 1px solid #cf1b9f; border-radius: 3px">
                        <span class="count" style="font-size: 30px; color: #cf1b9f"><b><?= $relawan_p ?></b></span>
                        <div class="float-right">
                            <span style="font-size: 30px; color: #cf1b9f"><i class="fas fa-female"></i></span>
                        </div>
                    </div>
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
                    <span class="float-right count"><?= $pendukung_bulan ?></span> <br>
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
                    <span class="float-right count"><?= $relawan_bulan ?></span> <br>
                    <span>Relawan baru</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-8 mt-3">
        <div class="card" style="border: 1px solid #570b99">
            <div class="card-header text-white" style="background: #570b99">
                Statistik Pendukung
            </div>
            <div class="card-body">
                <canvas id="load_statistik_pendukung"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-3">
        <div class="card" style="border: 1px solid #ab3a02">
            <div class="card-header text-white" style="background: #ab3a02">
                Persebaran Pendukung
            </div>
            <div class="card-body">
                <?php foreach($data as $d){ ?>
                <div class="list p-2 mb-2" style="border: 1px solid #bfbfbf">
                    <span><?= $d['wilayah'] ?></span>
                    <div class="float-right">
                    <span class="badge badge-pill badge-primary"><?= $d['pendukung'] ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-8 mt-3">
        <div class="card" style="border: 1px solid #63b023">
            <div class="card-header text-white" style="background: #63b023">
                Statistik Relawan
            </div>
            <div class="card-body">
                <canvas id="load_statistik_relawan"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-3">
        <div class="card" style="border: 1px solid #b02349">
            <div class="card-header text-white" style="background: #b02349">
                Persebaran Relawan
            </div>
            <div class="card-body">
                <?php foreach($data as $d){ ?>
                <div class="list p-2 mb-2" style="border: 1px solid #bfbfbf">
                    <span><?= $d['wilayah'] ?></span>
                    <div class="float-right">
                    <span class="badge badge-pill badge-primary"><?= $d['relawan'] ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php } else { ?>
        <div class="card bg-danger text-light w-100">
            <div class="card-body text-center">
                <i style="font-size: 50px" class="fas fa-exclamation-triangle"></i>
                <p class="mt-3">Tidak ada data statistik yang dapat di munculkan</p>
            </div>
        </div>
    <?php } ?>

</div>

<script>
    $(document).ready(function(){
        get_data_statistik();
    })

    let statistik_pendukung = $('#load_statistik_pendukung');
    let statistik_relawan = $('#load_statistik_relawan');

    function get_data_statistik(){
        $.ajax({
            url: '<?= base_url('ajax/get_data_statistik') ?>',
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                //statistik pendukung
                let newWilayah = d.map(element => element.wilayah);
                let newPendukung = d.map(element => element.pendukung);
                let newRelawan = d.map(element => element.relawan);
                
                load_statistik_pendukung(newWilayah, newPendukung);
                load_statistik_relawan(newWilayah, newRelawan);
            }
        })
    }

    function load_statistik_pendukung(wilayah, pendukung){
        const data = {
            labels: wilayah,
            datasets: [{
                label: 'Pendukung',
                data: pendukung,
                backgroundColor: '#ffeda6',
                borderColor: '#fcd73f',
                borderWidth: 1,
                barThickness: 20,
            }]
        }
        new Chart(statistik_pendukung, {
            type: 'bar',
            data: data,
        });
    }

    function load_statistik_relawan(wilayah, relawan){
        const data = {
            labels: wilayah,
            datasets: [{
                label: 'Relawan',
                data: relawan,
                backgroundColor: '#a1ffee',
                borderColor: '#32ad97',
                borderWidth: 1,
                barThickness: 20,
            }]
        }
        new Chart(statistik_relawan, {
            type: 'bar',
            data: data,
        });
    }
</script>