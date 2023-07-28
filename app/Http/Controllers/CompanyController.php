<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('user/company/index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/company/register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'no_telp' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
                'npwp' => 'required|string|max:20',
                'nama_badan_usaha' => 'required|string|max:255',
                'nama_pemilik' => 'required|string|max:255',
            ],
            [
                'name.required' => 'The name field is required.',
                'name.max' => 'The name may not be greater than :max characters.',
                'no_telp.required' => 'The phone number field is required.',
                'no_telp.max' => 'The phone number may not be greater than :max characters.',
                'alamat.required' => 'The address field is required.',
                'alamat.max' => 'The address may not be greater than :max characters.',
                'npwp.required' => 'The NPWP field is required.',
                'npwp.max' => 'The NPWP may not be greater than :max characters.',
                'nama_badan_usaha.required' => 'The business field is required.',
                'nama_badan_usaha.max' => 'The business may not be greater than :max characters.',
                'nama_pemilik.required' => 'The owner name field is required.',
                'nama_pemilik.max' => 'The owner name may not be greater than :max characters.',
            ],
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $company = new Company();
        $company->user_id = session('user')->id;
        $company->name = $request->input('name');
        $company->no_telp = $request->input('no_telp');
        $company->alamat = $request->input('alamat');
        $company->npwp = $request->input('npwp');
        $company->nama_badan_usaha = $request->input('nama_badan_usaha');
        $company->nama_pemilik = $request->input('nama_pemilik');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('images'), $filename);
            if ($upload_success) {
                $company->image = $filename;
            } else {
                $error = $image->getError();
                return redirect()
                    ->back()
                    ->withErrors(['image' => $error])
                    ->withInput();
            }
        }
        $company->save();
        session()->put('company_id', $company->id);

        return redirect('/')->with('success', 'Company registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $existingCompany = Company::where('user_id', session('user')->id)->first();
    
        if ($existingCompany) {
            return redirect()->to('/companies/'. $existingCompany->id.'/edit');
        } else {
            return redirect()->to('/companies/create');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('user/company/edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=400,height=400',
            'nama_badan_usaha' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'npwp' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $company->name = $request->input('name');
        $company->nama_badan_usaha = $request->input('nama_badan_usaha');
        $company->no_telp = $request->input('no_telp');
        $company->alamat = $request->input('alamat');
        $company->npwp = $request->input('npwp');
        $company->nama_pemilik = $request->input('nama_pemilik');
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $company->image = $imageName;
        }
    
        $company->save();
    
        session()->flash('success', 'Company updated successfully.');
        session()->put('company_id', $company->id);
    
        return redirect('/')->with('success', 'Company registered successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('/companies')->with('success', 'Company deleted successfully.');
    }
}
