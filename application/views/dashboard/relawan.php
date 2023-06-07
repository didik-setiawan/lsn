<h3 class="mb-4">Selamat datang <?= $user->nama ?></h3>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card" style="border: 1px solid #fbff2b">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pendukung Baru Bulan Ini</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 count"><?= $pendukung_bulan ?></div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card" style="border: 1px solid #2b84ff">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pendukung</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 count"><?= $pendukung_total ?></div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="card" style="border: 1px solid #d90b53">
            <div class="card-header text-white" style="background: #d90b53">
                <b>Statistik Bulan Ini</b>
            </div>
            <div class="card-body">
                <canvas id="load_statistik_bulan" style="width: 100%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        get_data();
    });
    
    let chart = $('#load_statistik_bulan');

    function get_data(){
        $.ajax({
            url: '<?= base_url('ajax/get_data_bulan_pendukung_relawan') ?>',
            type: 'POST',
            dataType: 'JSON',
            success: function(d){
                let date = d.map(element => element.tanggal);
                let jml = d.map(element => element.jml);
                
                load_statistik(date, jml);
            }
        });
    }


    function load_statistik(date, jml){
        const data = {
        labels: date,
        datasets: [{
            label: 'Jumlah',
            data: jml,
            backgroundColor: '#8bff87',
            borderColor: '#3fff38',
            borderWidth: 1,
            barThickness: 10,
        }]
        }

        new Chart(chart, {
        type: 'bar',
        data: data,
        });
    }
</script>
