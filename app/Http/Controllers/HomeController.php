<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = Event::leftJoin('reports', 'events.id_material', '=', 'reports.id_material')
                ->select('events.*', 'reports.keterangan')
                ->get();
        return view('konten.dashboard', compact('data'));
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();
        
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
