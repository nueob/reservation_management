      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Charts</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Reservation_Chart
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <canvas id="reservationChartData" style="display: block;box-sizing: border-box;height: 400px;width: 100%;padding-right: 20px;padding-left: 20px;"></canvas>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
          All Rights Reserved by Matrix-admin. Designed and Developed by
          <a href="https://www.wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var chart = new Vue({
    el:'.page-wrapper',
    data:{
      reservationChartData:[]
    },
    created() {
      this.reservationChartInfo();
    },
    methods : {
      reservationChartInfo : async function() {
        axios.post('/dashboard/reservationChartInfo')
          .then(response=>{
            console.log(response.data);
            this.reservationChartData = response.data;
            this.chartJSsetting();
          })
      },
      chartJSsetting: function() {
        var labels = new Array();
				var reservation = new Array();

        this.reservationChartData.forEach(ele=>{
          labels.push(ele.reservation_date);
          reservation.push(ele.cnt);
        })
				const data = {
					labels: labels,
					datasets: [{
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(255, 99, 132)',
						data: reservation,
					}],
				};
				const config = {
					type: 'line',
					data,
					options: {
            responsive: false,
						plugins: {
							legend: {
								display: false,
							},
						}
					}
				};
				this.reservationChart = new Chart(
					document.getElementById('reservationChartData'),
					config,
				)
      },
    }
  })
</script>