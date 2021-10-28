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
    public function getClinicInfo() 
    {
        $clinicIdx = $this->session->get('clinic_idx');
        $clinicModel = new \App\Models\clinicModel();
        $clinicName = $clinicModel -> select('clinic_name')
                                    -> where('clinic_idx',$clinicIdx)
                                    -> get() -> getResultArray();
        return $this->response->setJSON($clinicName[0]['clinic_name']);
    }
    public function getReservationInfo()
    {
        $today = date("Y-m-d");
        $clinicIdx = $this->session->get('clinic_idx');
        $clinicModel = new \App\Models\clinicModel();
        //총 예약자 수
        $totalReservationCnt = $clinicModel -> join('reservation r','r.clinic_idx = c.clinic_idx')
                                            -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx')
                                            -> where('c.clinic_idx',$clinicIdx)
                                            -> get() -> getNumRows();
        //오늘 예약자 수
        $todayReservationCnt = $clinicModel -> join('reservation r','r.clinic_idx = c.clinic_idx')
                                            -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx')
                                            -> where('c.clinic_idx',$clinicIdx)
                                            -> where('reservation_date',$today)
                                            -> get() -> getNumRows();
        //현재 대기 시간
        $currentWatingTime = $clinicModel -> select('wating_time AS time')
                                            -> join('wating_time w','c.clinic_idx = w.clinic_idx')
                                            -> where('c.clinic_idx',$clinicIdx)
                                            -> orderby('w.created_dt DESC')
                                            -> limit(1)
                                            -> get() -> getResultArray();
        $currentWatingTime = explode('.',$currentWatingTime[0]['time']);
        //평균 대기 시간
        $avgWatingTime = $clinicModel -> select('SEC_TO_TIME(AVG(TIME_TO_SEC(wating_time))) as avg')
                                    -> join('wating_time w','c.clinic_idx = w.clinic_idx')
                                    -> where('c.clinic_idx',$clinicIdx)
                                    -> get() -> getResultArray();
        $avgWatingTime = explode('.',$avgWatingTime[0]['avg']);               
        //대기중인 예약자
        $watingBookerCnt = $clinicModel -> join('reservation r','c.clinic_idx = r.clinic_idx','left')
                                     -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                     -> where('r.reservation_date',$today)
                                     -> where('c.clinic_idx',$clinicIdx)
                                     -> where('ar.inoculation','n')
                                     -> get() -> getNumRows(); 
        //코로나 확진자

        $data = [
            'clinicIdx' => $clinicIdx,
            'totalReservationCnt' => $totalReservationCnt,
            'todayReservationCnt' => $todayReservationCnt,
            'currentWatingTime' => $currentWatingTime[0],
            'avgWatingTime' => $avgWatingTime[0],
            'watingBookerCnt' => $watingBookerCnt
        ];

        return $this->response->setJSON($data);
    }
    public function reservationChartInfo()
    {
        $clinicIdx = $this->session->get('clinic_idx');
        $clinicModel = new \App\Models\clinicModel();
        $reservationChart = $clinicModel -> select('count(*) as cnt,r.reservation_date')
                                         -> join('reservation r','c.clinic_idx = r.clinic_idx','left')
                                         -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                         -> where('ar.inoculation','y')
                                         -> where('c.clinic_idx',$clinicIdx)
                                         -> groupby('r.reservation_date')
                                         -> orderby('r.reservation_date DESC')
                                         -> limit(7)
                                         -> get() -> getResultArray();
        
        return $this->response->setJSON($reservationChart); 
    }
}