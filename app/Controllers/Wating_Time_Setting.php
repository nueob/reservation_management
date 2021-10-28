<?php

namespace App\Controllers;

class Wating_Time_Setting extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('html/wating_time_setting');
        echo view('footer');
    }
}