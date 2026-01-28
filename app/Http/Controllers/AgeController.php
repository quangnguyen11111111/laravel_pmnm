<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgeController extends Controller
{
    //
    public function showForm()
    {
        return view('age');
    }

    public function storeAge(Request $request)
    {
        // Lưu tuổi vào session
        session(['age' => $request->age]);

        return redirect()->route('home');
    }
}