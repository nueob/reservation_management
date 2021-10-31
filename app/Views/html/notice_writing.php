<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">{{formMode}}</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    {{itemFormMode}}
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
              <h4 class="card-title">{{formMode}}</h4>
              <h6 class="card-subtitle"></h6>
              <form id="example-form" action="#" class="mt-5">
                <div>
                  <!-- <h3>Account</h3> -->
                  <section>
                    <label for="userName">제목 *</label>
                    <input
                      id="userName"
                      name="userName"
                      type="text"
                      class="required form-control"
                    />
                    <label for="password">내용 *</label>
                    <!-- <input
                      id="password"
                      name="password"
                      type="text"
                      class="required form-control"
                    /> -->
                    <textarea id="notice_contents" name="notice_contents"></textarea>
                  </section>
                </div>
              </form>
            </div>
          </div>
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
<script type="text/javascript" src="/dist/js/smarteditor2-master/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js"></script>
<script type="text/javascript">
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "notice_contents",  //textarea ID
        sSkinURI: "/dist/js/smarteditor2-master/smarteditor2-master/workspace/static/SmartEditor2Skin.html",  //skin경로
        fCreator: "createSEditor2",
    })
</script>
<script>
    var notice_writing = new Vue({
        el:'.page-wrapper',
        data : {
            formMode : '공지사항 추가',
            itemFormMode : 'Notice_writing'
        },
        created() {

        },
        methods : {

        },

    })
</script>