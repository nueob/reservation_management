<?php

namespace App\Controllers;

class Dashboard extends BaseController
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
        echo view('html/dashboard');
        echo view('footer');
    }
    public function getadminInfo() 
    {
        $adminIdx = $this->session->get('admin_idx');
        $adminModel = new \App\Models\adminModel();
        $adminName = $adminModel -> select('admin_name')
                                    -> where('admin_idx',$adminIdx)
                                    -> get() -> getResultArray();
        return $this->response->setJSON($adminName[0]['admin_name']);
    }
    public function getReservationInfo()
    {
        $today = date("Y-m-d");
        $adminIdx = $this->session->get('admin_idx');
        $adminModel = new \App\Models\adminModel();
        //총 예약자 수
        $totalReservationCnt = $adminModel -> join('reservation r','r.admin_idx = a.admin_idx')
                                            -> where('a.admin_idx',$adminIdx)
                                            -> get() -> getNumRows();

        //오늘 예약자 수
        $todayReservationCnt = $adminModel -> join('reservation r','r.admin_idx = a.admin_idx')
                                            -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx')
                                            -> where('a.admin_idx',$adminIdx)
                                            -> where('reservation_date',$today)
                                            -> get() -> getNumRows();

        // //현재 대기 시간
        // $currentWatingTime = $adminModel -> select('wating_time AS time')
        //                                     -> join('wating_time w','a.admin_idx = w.admin_idx')
        //                                     -> where('a.admin_idx',$adminIdx)
        //                                     -> orderby('w.created_dt DESC')
        //                                     -> limit(1)
        //                                     -> get() -> getResultArray();
        // $currentWatingTime = explode('.',$currentWatingTime[0]['time']);

        // //평균 대기 시간
        // $avgWatingTime = $adminModel -> select('SEC_TO_TIME(AVG(TIME_TO_SEC(wating_time))) as avg')
        //                             -> join('wating_time w','a.admin_idx = w.admin_idx')
        //                             -> where('a.admin_idx',$adminIdx)
        //                             -> get() -> getResultArray();
        // $avgWatingTime = explode('.',$avgWatingTime[0]['avg']);     

        //대기중인 예약자
        $watingBookerCnt = $adminModel -> join('reservation r','a.admin_idx = r.admin_idx','left')
                                     -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                     -> where('r.reservation_date',$today)
                                     -> where('a.admin_idx',$adminIdx)
                                     -> where('ar.visitation','n')
                                     -> get() -> getNumRows(); 
        //코로나 확진자

        $data = [
            'adminIdx' => $adminIdx,
            'totalReservationCnt' => $totalReservationCnt,
            'todayReservationCnt' => $todayReservationCnt,
            // 'currentWatingTime' => $currentWatingTime[0],
            // 'avgWatingTime' => $avgWatingTime[0],
            'watingBookerCnt' => $watingBookerCnt
        ];

        return $this->response->setJSON($data);
    }
    public function reservationChartInfo()
    {
        $adminIdx = $this->session->get('admin_idx');
        $adminModel = new \App\Models\adminModel();
        $reservationChart = $adminModel -> select('count(*) as cnt,r.reservation_date')
                                         -> join('reservation r','a.admin_idx = r.admin_idx','left')
                                         -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                         -> where('ar.visitation','y')
                                         -> where('a.admin_idx',$adminIdx)
                                         -> groupby('r.reservation_date')
                                         -> orderby('r.reservation_date DESC')
                                         -> limit(7)
                                         -> get() -> getResultArray();
        
        return $this->response->setJSON($reservationChart); 
    }
}