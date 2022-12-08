<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('superAdmin')) {
            $user = User::with('roles')->get();
            return view('superAdmin.index', compact('user'));
        } elseif (Auth::user()->hasRole('admin')) {
            return view('admin.index');
        } elseif (Auth::user()->hasRole('user')) {
            return view('dashboard');
        }
    }
}
