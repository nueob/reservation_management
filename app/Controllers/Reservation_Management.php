<?php

namespace App\Controllers;

class Reservation_Management extends BaseController
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
        echo view('html/reservation_management');
        echo view('footer');
    }
    public function getReservationInfo()
    {
        $log = new \App\Models\LogModel();

        $clinicIdx = $this->session->get('clinic_idx');
        $page = $this->request->getVar('page');
        $size = $this->request->getVar('size');

        if($page == 1) {
            $limit = 0;
        } else {
            $limit = ($page-1)*$size;
        }

        $clinicModel = new \App\Models\clinicModel();
        $reservationInfoCnt = $clinicModel -> select('r.reservation_idx,user_name,user_mp,reservation_date,reservation_time,
                                                    (CASE 
                                                        WHEN ISNULL(allow_idx) THEN "N"
                                                        ELSE "Y"
                                                    END) as allow')
                                            -> join('reservation r','c.clinic_idx = r.clinic_idx','left')
                                            -> join('user_info u','r.user_idx = u.user_idx','left')
                                            -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                            -> where('c.clinic_idx',$clinicIdx)
                                            -> get() -> getNumRows();

        $reservationInfo = $clinicModel -> select('r.reservation_idx,user_name,user_mp,reservation_date,reservation_time,
                                                    (CASE 
                                                        WHEN ISNULL(allow_idx) THEN "N"
                                                        ELSE "Y"
                                                    END) as allow')
                                         -> join('reservation r','c.clinic_idx = r.clinic_idx','left')
                                         -> join('user_info u','r.user_idx = u.user_idx','left')
                                         -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                         -> where('c.clinic_idx',$clinicIdx)
                                         -> orderby('reservation_date DESC')
                                         -> orderby('reservation_time DESC')
                                         -> limit(10,$limit)
                                         -> get() -> getResultArray();

        $log->save(['controller' => 'Reservation_Management', 'function' => 'getReservationInfo', 'message' => $clinicModel->getLastQuery()]);

        $data = [
            'reservationInfoCnt' => $reservationInfoCnt,
            'reservationInfo' => $reservationInfo,
            'page' => $page
        ];

        return $this->response->setJSON($data); 
    }
    /*
        예약 상세 정보 보기 
    */
    public function detailReservationInfo()
    {
        $idx = $_GET['idx'];
        $data['idx'] = $idx;

        echo view('header');
        echo view('html/reservation_detail_info',$data);
        echo view('footer');
    }
    public function getDetailReservationInfo()
    {
        $idx = $this->request->getVar('idx');
        $reservationModel = new \App\Models\ReservationModel();

        $reservationInfo = $reservationModel -> select('r.*,u.*,ar.*,
                                                    (CASE 
                                                        WHEN ISNULL(allow_idx) THEN "N"
                                                        ELSE "Y"
                                                    END) as allow')
                                             -> join('user_info u','u.user_idx = r.user_idx')
                                             -> join('allow_reservation ar','r.reservation_idx = ar.reservation_idx','left')
                                             -> where('r.reservation_idx',$idx)
                                             -> get() -> getResultArray();
        
        return $this->response->setJSON($reservationInfo[0]);
    }
    public function allowReservationRequest()
    {
        $reservationIdx = $this->request->getVar('idx');

        $allowModel = new \App\Models\allowReservationModel();
        $allowModel->insert(['reservation_idx'=>$reservationIdx,'inoculation'=>'N']);

        return $this->response->setJSON($reservationIdx);
    }
}