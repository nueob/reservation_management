    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Form Wizard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard/index">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                      Reservation_Management
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Reservation_Management_Detail
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
          <div class="card">
            <div class="card-body wizard-content">
              <h4 class="card-title">예약 정보 확인</h4>
              <h6 class="card-subtitle"></h6>
              <form id="example-form" action="#" class="mt-5" style="width:100%">
                <div>
                  <h3>예약 정보</h3>
                  <section>
                    <div class="reserSection1" style="vertical-align: middle;padding-top:10px;padding-bottom:30px;">
                        <div style="float:left;width:33%;padding-right: 10px;">
                            <label for="userName">예약자 성함</label>
                            <input
                            id="userName"
                            name="userName"
                            type="text"
                            class="required form-control" v-model='reserInfo.user_name' disabled
                            />
                        </div>
                        <div style="float:left;width:33%;padding-right: 10px;">
                            <label for="confirm">예약 승인 여부</label>
                            <input
                            id="confirm"
                            name="confirm"
                            type="text"
                            class="required form-control" v-model='reserInfo.allow' disabled
                            />
                        </div>
                        <!-- <div style="float:left;width:33%;padding-right: 10px;">
                            <label for="confirm">검사 결과</label>
                            <input
                            id="confirm"
                            name="confirm"
                            type="text"
                            class="required form-control" v-model='reserInfo.inoculation' disabled
                            />
                        </div> -->
                    </div>
                    <div class='reserSection2' style="vertical-align: middle;padding-top:50px;padding-bottom:50px;">
                        <div style="float:left;width:50%;padding-right: 10px;">
                            <label for="password">예약 날짜</label>
                            <input
                            id="password"
                            name="password"
                            type="text"
                            class="required form-control" v-model='reserInfo.reservation_date' disabled
                            />
                        </div>
                        <div style="float:left;width:50%;padding-right: 10px;">
                            <label for="confirm">예약 시간</label>
                            <input
                            id="confirm"
                            name="confirm"
                            type="text"
                            class="required form-control" v-model='reserInfo.reservation_time' disabled
                            />
                        </div>
                    </div>
                  </section>
                </div>
                <div>
                  <h3 style='padding-top:40px'>예약자 정보</h3>
                  <section>
                    <div class="reserSection1" style="vertical-align: middle;padding-top:10px;padding-bottom:30px;">
                        <div style="float:left;width:50%;padding-right: 10px;">
                            <label for="name">아이디</label>
                            <input
                            id="name"
                            name="name"
                            type="text"
                            class="required form-control" v-model='reserInfo.user_id' disabled
                            />
                        </div>
                        <div style="float:left;width:50%;padding-right: 10px;">
                            <label for="surname">핸드폰 번호</label>
                            <input
                            id="surname"
                            name="surname"
                            type="text"
                            class="required form-control" v-model='reserInfo.user_mp' disabled
                            />
                        </div>
                    </div>
                    <div class='reserSection2' style="vertical-align: middle;padding-top:10px;padding-bottom:30px;">
                        <div style="float:left;width:50%;padding-bottom: 30px;padding-right: 10px;">
                            <label for="email">성별</label>
                            <input
                            id="email"
                            name="email"
                            type="text"
                            class="required email form-control" v-model='reserInfo.user_sex' disabled
                            />
                        </div>
                        <div style="float:left;width:50%;padding-bottom: 30px;padding-right: 10px;">
                            <label for="address">생년월일</label>
                            <input
                            id="address"
                            name="address"
                            type="text"
                            class="form-control" v-model='reserInfo.user_birth' disabled
                            />
                        </div>
                    </div>
                 </section>
                  <!-- <h3>문진표</h3>
                  <section>
                    <ul>
                      <li>* 문진표 들어갈 자리 *</li>
                    </ul>
                  </section> -->
                  <!-- <h3>Finish</h3>
                  <section>
                    <input
                      id="acceptTerms"
                      name="acceptTerms"
                      type="checkbox"
                      class="required"
                    />
                    <label for="acceptTerms"
                      >I agree with the Terms and Conditions.</label
                    >
                  </section> -->
                </div>
              </form>
            </div>
          </div>
          <button v-if="reserInfo.allow == 'N'" type="button" class="btn btn-danger text-white" style='width:20%;position:relative;left:80%' @click="reservationRequest">
            예약 완료
          </button>
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
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
<script>
    var detail_info = new Vue({
        el:'.page-wrapper',
        data :{
            idx : '<?= $idx ?>',
            reserInfo:[],
        },
        created() {
            this.getDetailReservationInfo();
        },
        methods :{
            getDetailReservationInfo : async function() {
                var frm = new FormData();
                frm.append('idx',this.idx);
                axios.post('/reservation_management/getDetailReservationInfo',frm)
                    .then(response=>{
                        this.reserInfo = response.data;
                        console.log(response.data);
                    })
            },
            reservationRequest : async function() {
                var frm = new FormData();
                frm.append('idx',this.idx);
                axios.post('/reservation_management/allowReservationRequest',frm)
                    .then(response=>{
                        alert('예약이 완료 되었습니다.');
                        location.href='/reservation_management/index';
                        console.log(response.data);
                    })
            }
        }
    })
</script>