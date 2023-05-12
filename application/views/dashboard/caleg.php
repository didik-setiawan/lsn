<style>
  .box
  {
      position: relative;
      margin: 50px;
  }
  .box .text
  {
      position: absolute;
      top: 50%;
      left: 52%;
      transform: translate(-50%,-50%);
      text-align: center;
      color: #404040;
  }
  .box .text h2
  {
      font-size: 38px;
      font-weight: 400;
      letter-spacing: 1px;
  }
  .box .text small
  {
      font-size: 18px;
      display: block;
  }
  .circle
  {
      width: 100%;
      height: 100px;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .circle .points
  {
      width: 3px;
      height: 10px;
      background: #0007;
      position: absolute;
      border-radius: 3px;
      transform: rotate(calc(var(--i)*var(--rot))) translateY(-100px);
      
  }
  .points.marked
  {
      animation: glow 0.04s linear forwards;
      animation-delay: calc(var(--i)*0.05s);
  }
  @keyframes glow
  {
      0%
      {
          background: #0007;
          box-shadow: none;
      }
      100%
      {
          background: var(--bgColor);
          box-shadow: 0 0 10px var(--bgColor);
      }
  }
</style>
<div class="container-fluid">
    <h3 class="mb-4">Selamat datang <?= $user->nama ?></h3>
    <div class="row justify-content-center">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Target Suara</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $user->target_suara ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-users fa-2x text-primary"></i> -->
                      <i class="fas fa-dot-circle fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Dukungan</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $dukungan ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Relawan</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $relawan ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-tag fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6><b>Progres Pemenangan: <?= $persentase ?>%</b></h6>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $persentase; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persentase ?>%"></div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-12 col-lg-8 mt-3">
          <div class="card">
            <div class="card-header bg-danger text-white">
              Statistik Suara
            </div>
            <div class="card-body">
              <div width="100%">
                <canvas id="loadData"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4 mt-3">
          <div class="card">
            <div class="card-header bg-info text-white">
              Persentase Target Suara
            </div>
            <div class="card-body">
              <div class="box">
                <div class="circle" data-dots="70" data-percent="<?= $persentase ?>" style="--bgColor: #ff0070"></div>
                  <div class="text">
                      <h2><?= round($persentase, 2) ?>%</h2>
                  </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>


<script>
  let canvas = $('#loadData');
  const data = {
    labels: ['Target Suara', 'Pendukung', 'Relawan'],
    datasets: [{
      label: 'Jumlah',
      data: [
        <?= $user->target_suara ?>,
        <?= $dukungan ?>,
        <?= $relawan ?>
      ],
      backgroundColor: [
        '#a1c8ff',
        '#75ff8c',
        '#fa70e5'
      ],
      borderColor: [
        '#0f4780',
        '#077d17',
        '#a10a8a'
      ],
      borderWidth: 1,
    }]
  }

  new Chart(canvas, {
    type: 'bar',
    data: data,
  });


</script>
<script>
  const circles = document.querySelectorAll('.circle');
  circles.forEach(elem => {
      var dots = elem.getAttribute('data-dots')
      var marked = elem.getAttribute('data-percent');
      var percent = Math.floor(dots * marked / 100);
      var rotate = 360 / dots;
      var points = "";
      for (let i = 0; i < dots; i++) {
          points += `<div class="points" style="--i: ${i}; --rot: ${rotate}deg"></div>`;
      }
      elem.innerHTML = points;
      const pointsMarked = elem.querySelectorAll('.points');
      for (let i = 0; i < percent; i++) {
          pointsMarked[i].classList.add('marked')
      }
  })
</script>