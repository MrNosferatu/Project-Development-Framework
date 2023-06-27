<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'no_telp' => 'required|string|max:13',
                'pendidikan' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
            ],
            [
                'name.required' => 'Kolom nama harus diisi.',
                'name.min' => 'Nama minimal 3 karakter.',
                'email.required' => 'Kolom nama harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Kolom password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
            ],
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = UserModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'pendidikan' => $request->pendidikan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);
        }
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        //
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session(['logged_in' => true]);
            return redirect()->intended('/');
        }

        if (UserModel::where('email', $request->email)->exists()) {
            return redirect()
                ->back()
                ->withErrors([
                    'password' => 'Password salah.',
                ])
                ->withInput($request->except('password'));
        } else {
            return redirect()
                ->back()
                ->withErrors([
                    'email' => 'Email tidak ditemukan.',
                ])
                ->withInput($request->except('password'));
        }
    }
}
