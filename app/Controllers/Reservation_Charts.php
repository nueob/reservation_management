<?php

namespace App\Controllers;

class Reservation_Charts extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('html/reservation_charts');
        echo view('footer');
    }
}