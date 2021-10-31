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
              <h4 class="page-title">공지사항</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard/index">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Notice_Management
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
                <div id="notice_button" style="padding-bottom:15px;">
                    <button type="button" class="btn btn-info" style="position:relative;left:90%;padding-left:10px" @click="goToAddNotice">추가</button>
                    <button type="button" class="btn btn-light" style="position:relative;left:90%;padding-right:10px">삭제</button>
                </div>
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <template v-if="noticeInfoCnt > 0">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">
                                            <label class="customcheckbox mb-3" style="margin-left:15px;">
                                                <input type="checkbox" id="mainCheckbox" v-model="checkAllNotice"/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th>제목</th>
                                        <th>작성 날짜</th>
                                        <th>게재 여부</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="notice in noticeInfo">
                                        <th>
                                            <label class="customcheckbox" style="margin-left:15px;">
                                                <input type="checkbox" class="listCheckbox" :id="notice.idx" :value="notice.idx" v-model="checkNotice"/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <td  @click="goToDetailNotice(notice.idx)">{{notice.subject}}</td>
                                        <td  @click="goToDetailNotice(notice.idx)">{{notice.created_dt}}</td>
                                        <td  @click="goToDetailNotice(notice.idx)">{{notice.publication}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                        <template v-else>
                            <td>등록된 공지사항이 없습니다.</td>
                        </template>
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
        checkAllNotice:[],
        checkNotice:[],
        noticeInfo:[],
        noticeInfoCnt:0,
        pages:[],
        page:1,
        paginationSize:0,
    },
    created() {
        console.log('hi');
        this.getNoticeInfo();
    },
    methods :{
      getNoticeInfo : async function() {
        var frm = new FormData();
        frm.append('page',this.page);
        frm.append('size',10);
        axios.post('/notice_management/getNoticeInfo',frm)
          .then(response=>{
            this.noticeInfo = response.data.noticeInfo;
            this.noticeInfoCnt = response.data.noticeInfoCnt;
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
        this.getNoticeInfo();
      },
      goToDetailNotice : function(idx) {
        location.href = '/notice_management/setNotice?idx='+idx;
      },
      goToAddNotice : function() {
        location.href = '/notice_management/setNotice';
      }
    },
    watch :{
        noticeInfo : function() {
            this.pages = [];
            this.paginationSize = parseInt(this.noticeInfoCnt/10)+1;
            var size = 0;
            if(this.paginationSize > 5) {
                size = 5;
            } else {
                size = parseInt(this.noticeInfoCnt/10)+1;
            }
            for(var i=this.page ; i<=size ; i++) {
                this.pages.push(i);
            }
        },
        checkAllNotice : function() {
            if(this.checkAllNotice) {
                this.noticeInfo.forEach(el=>{
                    this.checkNotice.push(el.idx);
                })
            } else {
                this.checkNotice = [];
            }
        },
        checkNotice : function() {
            if(this.checkNotice.length == 10) {
                this.checkAllNotice = true;
            }
            console.log(this.checkNotice);
        }
    }
  })
</script>