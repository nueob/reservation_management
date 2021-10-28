<?php

namespace App\Controllers;
use Config\Services; 

class Home extends BaseController
{
    protected $session;


    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();


    }

    public function index()
    {
        // 로그인 페이지
        echo view('html/login');
        // echo view('sample/pages-buttons');
    }
    public function loginProc()
    {
        $id = $this->request->getVar('id');
        $password = $this->request->getVar('password');

        $adminModel = new \App\Models\adminModel();
        $loginResult = $adminModel -> where('admin_id',$id)
                                    -> where('admin_password',$password)
                                    -> get() -> getNumRows();
        if($loginResult > 0) {
            $adminIdx = $adminModel -> select('admin_idx')
                                      -> where('admin_id',$id)
                                      -> where('admin_password',$password)
                                      -> get() -> getResultArray();
            $sessionData = [
                'admin_idx'  => $adminIdx[0]['admin_idx'],
                'logged_in' => true
            ];
            $this->session->set($sessionData);

            $data = [
                'sessionData' => $sessionData,
                'code' => 100,
                'msg' => '로그인 성공'
            ];
        } else {
            $data = [
                'code' => 200,
                'msg' => '로그인 실패'
            ];
        }
        return $this->response->setJSON($data);

    }
    // 세션 체크
    // public function sessionCheck() 
    // {
    //     $result = $this->session->get('admin_idx');
    //     return $this->response->setJSON($result);
    // }
}
