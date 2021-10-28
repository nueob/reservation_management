<style>
.pagination ul {
	list-style:none;
	float:left;
	display:inline;
}
.pagination ul li {
	float:left;
}
.pagination ul li a {
	float:left;
	padding:4px;
	margin-right:3px;
	width:15px;
	color:#000;
	font:bold 12px tahoma;
	border:1px solid #eee;
	text-align:center;
	text-decoration:none;
}
.pagination ul li a:hover, .pagination ul li a:focus {
	color:#fff;
	border:1px solid #f40;
	background-color:#f40;
}
</style>
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Tables</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard/index">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Reservation_Management
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>이름</th>
                            <th>핸드폰 번호</th>
                            <th>예약 날짜</th>
                            <th>예약 시간</th>
                            <th>승인 여부</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="reser in reservation" @click="goToDetailReservation(reser.reservation_idx)">
                            <td>{{reser.user_name}}</td>
                            <td>{{reser.user_mp}}</td>
                            <td>{{reser.reservation_date}}</td>
                            <td>{{reser.reservation_time}}</td>
                            <td>{{reser.allow}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- </div> -->
                <!-- </div> -->
              </div>
            </div>
          </div>
          <div class="pagination">
            <ul>
              <li><a v-if="page > 1" @click="pageSetting('prev')"><</a></li>
              <li v-for="page in pages"><a @click="pageSetting(page)">{{page}}</a></li>
              <li><a v-if="page < paginationSize" @click="pageSetting('after')">></a></li>  
            </ul>
          </div>
        </div>
        <footer class="footer text-center">
          All Rights Reserved by Matrix-admin. Designed and Developed by
          <a href="https://www.wrappixel.com">WrapPixel</a>.
        </footer>
      </div>
    </div>
<script>
  var management = new Vue({
    el:'.page-wrapper',
    data : {
      reservation:[],
      reservationCnt:0,
      checkReservation:[],
      allCheckReservation : false,
      pages:[],
      page:1,
      paginationSize:0,
    },
    created() {
      this.getReservationInfo();
    },
    methods :{
      getReservationInfo : async function() {
        var frm = new FormData();
        frm.append('page',this.page);
        frm.append('size',10);
        axios.post('/reservation_management/getReservationInfo',frm)
          .then(response=>{
            this.reservation = response.data.reservationInfo;
            this.reservationCnt = response.data.reservationInfoCnt;
            console.log(response.data);
          })
      },
      pageSetting : function(action) {
        if(action =='prev') {
          this.page -= 1;
        } else if(action == 'after') {
          this.page += 1;
        } else {
          this.page = action;
        }
        this.getReservationInfo();
      },
      goToDetailReservation : function(idx) {
        location.href = '/reservation_management/detailReservationInfo?idx='+idx;
      }
    },
    watch :{
      reservation : function() {
        this.pages = [];
        this.paginationSize = parseInt(this.reservationCnt/10)+1;
        var size = 0;
        if(this.paginationSize > 5) {
          size = 5;
        } else {
          size = parseInt(this.reservationCnt/10)+1;
        }
        for(var i=this.page ; i<=size ; i++) {
          this.pages.push(i);
        }
      },
    }
  })
</script>