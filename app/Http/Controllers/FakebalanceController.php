<?php

namespace App\Http\Controllers;

class FakebalanceController extends Controller
{
    public function table()
    {
        return view('parent.fakebalance-table');
    }
}
