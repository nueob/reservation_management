<?php

namespace App\Controllers;

class Sample extends BaseController
{   
    public function index()
    {
        echo view('header');
        echo view('html/reservation_management');
        echo view('footer');
    }

    public function tables()
    {
        echo view('sample/tables');
    }
    public function form()
    {
        echo view('sample/form-wizard');
    }
    public function grid()
    {
        echo view('sample/grid');
    }
    public function gallery()
    {
        echo view('sample/pages-gallery');
    }
    public function invoice()
    {
        echo view('sample/pages-invoice');
    }
    public function button()
    {
        echo view('sample/pages-buttons');
    }
}