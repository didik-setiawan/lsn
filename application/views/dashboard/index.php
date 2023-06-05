

<div class="container-fluid">
<h3 class="mb-4">Selamat datang <?= $user->nama ?></h3>
  <div class="row">

    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
      <div class="card mt-3" style="border: 1px solid #bf6728">
        <div class="card-header text-white" style="background: #bf6728">
          <b>Statistik User Per Role</b>
        </div>
        <div class="card-body w-100">
          <canvas class="w-100" id="load_by_role"></canvas>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
      <div class="card mt-3" style="border: 1px solid #bf6728">
        <div class="card-header text-white" style="background: #bf6728">
            <b>Jumlah User Per Role</b>
        </div>
        <div class="card-body">
          <div class="list p-2 mb-2" style="border: 1px solid #c7c7c7">
            <b>Total Semua User</b>
            <div class="float-right">
              <span class="badge badge-success count"><?= $total_user ?></span>
            </div>
          </div>

          <?php foreach($role as $r){ 
            $total_per_role = $this->m->get_total_user_role($r->id_role);    
          ?>
            <div class="list p-2 mb-2" style="border: 1px solid #c7c7c7">
              <b>Total <?= $r->nama_role ?></b>
              <div class="float-right">
                <span class="badge badge-success count"><?= $total_per_role ?></span>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
      <div class="card mt-3" style="border: 1px solid #5810c4">
        <div class="card-header text-white" style="background:#5810c4">
          <b>Statistik User Per Kelompok</b>
        </div>
        <div class="card-body w-100">
          <canvas class="w-100" id="load_by_group"></canvas>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
      <div class="card mt-3" style="border: 1px solid #5810c4">
        <div class="card-header text-white" style="background: #5810c4">
            <b>Jumlah User Per Kelompok</b>
        </div>
        <div class="card-body">
          <?php foreach($cabang as $c){ ?>
            <div class="list p-2 mb-2" style="border: 1px solid #c7c7c7">
              <b><?= $c['nama'] ?></b>
              <div class="float-right">
                <span class="badge badge-danger count"><?= $c['jml'] ?></span>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card mt-3" style="border: 1px solid #c40e20">
        <div class="card-header text-white" style="background: #c40e20">
          <b>Penambahan User Baru Periode: Bulan <?= date('F') .' '. date('Y') ?></b>
        </div>
        <div class="card-body w-100">
            <canvas id="load_by_month"></canvas>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  let by_role = $('#load_by_role');
  let by_group = $('#load_by_group');
  let by_month = $('#load_by_month');

  $(document).ready(function(){
    get_data();
  })

  function get_data(){
    $.ajax({
      url: '<?= base_url('ajax/get_data_chart_dashboard_admin') ?>',
      type: 'POST',
      dataType: 'JSON',
      success: function(d){
        let role = d.map(element => element.role);
        let jumlah_role = d.map(element => element.jumlah);
        load_statistik_by_role(role, jumlah_role);
      }
    });

    $.ajax({
      url: '<?= base_url('ajax/get_data_user_by_group') ?>',
      type: 'POST',
      dataType: 'JSON',
      success: function(d){
        let group = d.map(element => element.nama);
        let jml = d.map(element => element.jml);
        load_statistik_by_group(group, jml);
      }
    })

    $.ajax({
      url: '<?= base_url('ajax/get_data_user_per_month') ?>',
      type: 'POST',
      dataType: 'JSON',
      success: function(d){
        let date = d.map(element => element.tanggal);
        let jml = d.map(element => element.jml);
        
        load_statistik_by_month(date, jml);
      }
    });

  }


  function load_statistik_by_role(role, jml){
    const data = {
      labels: role,
      datasets: [{
        label: 'Jumlah',
        data: jml,
        backgroundColor: '#a1ffee',
        borderColor: '#32ad97',
        borderWidth: 1,
        barThickness: 20,
        indexAxis: 'y',
      }]
    }

    new Chart(by_role, {
      type: 'bar',
      data: data,
    });
  }

  function load_statistik_by_group(group,jml){
    const data = {
      labels: group,
      datasets: [{
        label: 'Jumlah',
        data: jml,
        backgroundColor: '#fcff69',
        borderColor: '#fcff38',
        borderWidth: 1,
        barThickness: 20,
        indexAxis: 'y',
      }]
    }

    new Chart(by_group, {
      type: 'bar',
      data: data,
    });
  }

  function load_statistik_by_month(date, jml){
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

    new Chart(by_month, {
      type: 'bar',
      data: data,
    });
  }

</script>