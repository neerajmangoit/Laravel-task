<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;

class SuperAdminFunctionalityController extends Controller
{
    public function show(Request $request) {
        $data = User::all();
        return view('superAdmin.table', ['users'=>$data]);
    }

    public function addUser(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(123456789),
        ]);

        $user->attachRole($request->role_id);

        return redirect('dashboard');
    }

    public function mailSender() {
    }

    public function deleteUser($id) {
        $data = User::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function editUser($id) {
        $data = User::with('roles')->find($id);
        return view('updateUser', compact('data'));
    }

    public function updateUser(Request $request){
        $user = User::with('roles')->find($request->id);

        dd($user['roles'][0]['name']);

        // $user->detachRole($admin);

        return redirect('dashboard');
    }
}
