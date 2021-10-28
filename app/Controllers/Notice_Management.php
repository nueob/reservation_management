<?php

namespace App\Controllers;

class Notice_Management extends BaseController
{
    protected $session;


    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $db = \Config\Database::connect();
    }
    
    public function index()
    {
        echo view('header');
        echo view('html/notice_management');
        echo view('footer');
    }

    public function getNoticeInfo()
    {
        $log = new \App\Models\LogModel();

        $adminIdx = $this->session->get('admin_idx');
        $page = $this->request->getVar('page');
        $size = $this->request->getVar('size');

        if($page == 1) {
            $limit = 0;
        } else {
            $limit = ($page-1)*$size;
        }

        $noticeModel = new \App\Models\NoticeModel();
        $noticeInfoCnt = $noticeModel  -> where('admin_idx',$adminIdx)
                                     -> get() -> getNumRows();

        $noticeInfo = $noticeModel  -> where('admin_idx',$adminIdx)
                                         -> orderby('created_dt DESC')
                                         -> limit(10,$limit)
                                         -> get() -> getResultArray();

        $log->save(['controller' => 'Notice_Management', 'function' => 'getNoticeInfo', 'message' => $noticeModel->getLastQuery()]);

        $data = [
            'noticeInfoCnt' => $noticeInfoCnt,
            'noticeInfo' => $noticeInfo,
            'page' => $page
        ];

        return $this->response->setJSON($data); 
    }
    public function setNotice()
    {
        $idx = $_GET['idx'];

        if(empty($idx)) {
            $idx = 0;
        }
        
        echo view('header');
        echo view('html/notice_management',$idx);
        echo view('footer');
    }
}