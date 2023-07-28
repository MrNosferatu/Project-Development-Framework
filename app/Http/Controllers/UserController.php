<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\Company;
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
        $users = UserModel::all();
        return view('user/login', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/register');
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
                'tanggal_lahir' => 'required|date',
                'user_type' => 'required|string|in:user,perusahaan',
            ],
            [
                'name.required' => 'Kolom nama harus diisi.',
                'name.min' => 'Nama minimal 3 karakter.',
                'email.required' => 'Kolom nama harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Kolom password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'user_type.required' => 'Kolom user type harus diisi.',
                'user_type.in' => 'User type tidak valid.',
            ],
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new UserModel;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_telp = $request->no_telp;
            $user->pendidikan = $request->pendidikan;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->user_type = $request->user_type;
            $user->password = bcrypt($request->password);
            // Save the CV
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $filename = time() . '.' . $cv->getClientOriginalExtension();
                $upload_success = $cv->move(public_path('cv'), $filename);
                if ($upload_success) {
                    $user->cv = $filename;
                } else {
                    $error = $cv->getError();
                    return redirect()
                        ->back()
                        ->withErrors(['image' => $error])
                        ->withInput();
                }
            }
            $user->save();
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        return view('user/show', compact('userModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        return view('user/edit', compact('userModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|unique:users,email,' . $userModel->id,
                'no_telp' => 'required|string|max:13',
                'pendidikan' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'user_type' => 'required|string|in:user,perusahaan',
            ],
            [
                'name.required' => 'Kolom nama harus diisi.',
                'name.min' => 'Nama minimal 3 karakter.',
                'email.required' => 'Kolom nama harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'user_type.required' => 'Kolom user type harus diisi.',
                'user_type.in' => 'User type tidak valid.',
            ],
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $userModel->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'pendidikan' => $request->pendidikan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'user_type' => $request->user_type,
            ]);
        }
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        $userModel->delete();
        return redirect('/home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->put('user', Auth::user());
            $request->session()->put('logged_in', true);
    
            if (Auth::user()->user_type == 'perusahaan') {
                $company = Company::where('user_id', Auth::user()->id)->first();
                if ($company) {
                    $request->session()->put('company_id', $company->id);
                }
            }
    
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
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->forget('logged_in');
        Auth::logout();
        return redirect('/');
    }
    public function profile()
    {
        $user = UserModel::where('id', session('user')->id)->first();
        return view('user/profile', ['user'=>$user]);
    }
    public function profile_edit()
    {
        $user = UserModel::where('id', session('user')->id)->first();
        return view('user/edit', ['user'=>$user]);
    }
    // profile update controller function
    public function profile_update(Request $request)
    {
        $formInput = new UserModel();
        $formInput = UserModel::where('id', session('user')->id)->first();
        $formInput->name = $request->input('name');
        $formInput->email = $request->input('email');
        $formInput->no_telp = $request->input('no_telp');
        $formInput->pendidikan = $request->input('pendidikan');
        $formInput->tanggal_lahir = $request->input('tanggal_lahir');
        $formInput->update();
        return redirect('/profile');
    }
}
