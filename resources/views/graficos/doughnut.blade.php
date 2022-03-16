

<div class="container grafico">
  <div class="row">
    <div class="col-8">
       <div class="doughnut">
         <canvas id="myChart" ></canvas> 
       </div>
    </div>
    <div class="col">
       <div class="card mb-3 border-1" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-12">
                  <h5 class="card-title">Retenida</h5>
                  <span class="retenida" valor="{{ $totales['retenida'] }}">{{ $totales['retenida'] }} KG</span>
              </div>
            </div>
        </div>
        <div class="card mb-3 border-2" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-12">
                  <h5 class="card-title">Incidental</h5>
                   <span class="incidental" valor="{{ $totales['incidental'] }}">{{ $totales['incidental'] }} KG</span>
              </div>
            </div>
        </div>
        <div class="card mb-3 border-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-12">
                  <h5 class="card-title">Descarte</h5>
                   <span class="descarte" valor="{{ $totales['descarte'] }}">{{ $totales['descarte'] }} KG</span>
              </div>
            </div>
        </div>
    </div>
  
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="js/doughnut.js"></script>