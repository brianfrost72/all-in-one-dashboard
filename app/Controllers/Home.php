<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }
    public function appData()
    {
        return view('app-data');
    }
    public function appList()
    {
        return view('app-list');
    }
    public function drafts()
    {
        return view('drafts');
    }
    public function returnedApp()
    {
        return view('returned-app');
    }
}
