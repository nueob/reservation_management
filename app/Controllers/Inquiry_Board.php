<?php

namespace App\Controllers;

class Inquiry_Board extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('html/inquiry_board');
        echo view('footer');

    }
}