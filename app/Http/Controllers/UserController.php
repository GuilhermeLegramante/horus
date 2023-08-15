<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function table()
    {
        return view('parent.user-table');
    }

    public function form($id = null)
    {
        return view('parent.user-form', ['id' => $id]);
    }
}
