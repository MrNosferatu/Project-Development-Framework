<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company')->except('index', 'view', 'search', 'apply', 'user_lamaran');
    }
    public function index()
    {
        $vacancy = Vacancy::paginate(20);
        return view('Vacancy/index', ['vacancies' => $vacancy]);
    }
    public function create()
    {
        return view('Vacancy/input');
    }
    public function store(Request $request)
    {
        $formInput = new Vacancy();
        $formInput->title = $request->input('title');
        $formInput->company_id = session('company_id');
        $formInput->description = $request->input('description');
        $formInput->qualification = $request->input('qualification');
        $formInput->location = $request->input('location');
        $formInput->type = $request->input('type');
        $formInput->salary = $request->input('salary');
        $formInput->save();

        return redirect('/companies/vacancy')->with('success', 'Lowongan berhasil diposting.');
    }
    public function update($id, Request $request)
    {
        $formInput = new Vacancy();
        $formInput = Vacancy::find($id);
        $formInput->title = $request->input('title');
        $formInput->description = $request->input('description');
        $formInput->qualification = $request->input('qualification');
        $formInput->location = $request->input('location');
        $formInput->type = $request->input('type');
        $formInput->salary = $request->input('salary');
        $formInput->update();

        return redirect('/companies/vacancy')->with('success', 'Lowongan berhasil diupdate.');
    }
    public function view($id)
    {
        $vacancy = Vacancy::where('id', $id)
            ->orderBy('name')
            ->first();

        $company = Company::where('id', $vacancy->company_id)->first();

        return view('Vacancy/view', ['vacancy' => $vacancy, 'company' => $company]);
    }
    public function edit($id)
    {
        $vacancy = Vacancy::where('id', $id)
            ->orderBy('name')
            ->get();

        return view('Vacancy/edit', ['vacancy' => $vacancy]);
    }
    public function delete($id)
    {
        Vacancy::where('id', '=', $id)->delete();
        return redirect('/companies/vacancy')->with('success', 'Lowongan berhasil dihapus.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');

        if ($type == 'any') {
            $vacancy = Vacancy::where('title', 'LIKE', "%$query%")->get();
        } else {
            $vacancy = Vacancy::where('title', 'LIKE', "%$query%")
                ->where('type', $type)
                ->get();
        }
        return response()->json($vacancy);
    }
    public function apply($id)
    {
        $user_id = session('user')->id;

        $lamaran = new lamaran();
        $lamaran->user_id = $user_id;
        $lamaran->vacancy_id = $id;
        $lamaran->status = 'diproses';
        $lamaran->save();
        echo "<script>console.log('Vacancy ID: " . $id . "');</script>"; // Log the ID to the browser console

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim.');
    }
    public function companies_vacancy()
    {
        $company_id = session('company_id');
        $vacancy = Vacancy::where('company_id', $company_id)->paginate(20);
        return view('companies/vacancy', ['vacancies' => $vacancy]);
    }
    public function companies_vacancy_view($id)
    {
        $vacancy = Vacancy::where('id', $id)
            ->orderBy('name')
            ->first();

        $applications = DB::table('lamaran')
            ->join('users', 'lamaran.user_id', '=', 'users.id')
            ->join('vacancy', 'lamaran.vacancy_id', '=', 'vacancy.id')
            ->where('vacancy.id', $id)
            ->select('lamaran.*', 'users.name', 'users.email', 'users.cv')
            ->get();

        return view('companies/Vacancy_view', ['vacancy' => $vacancy, 'applications' => $applications]);
    }
    public function updateApplication(Request $request, $id)
{
    $application = Lamaran::findOrFail($id);
    $application->status = $request->input('status');
    $application->keterangan = $request->input('keterangan');
    $application->save();

    return response()->json(['success' => true]);
}
public function user_lamaran(){
    $user_id = session('user')->id;
    $lamaran = DB::table('lamaran')
    ->join('vacancy', 'lamaran.vacancy_id', '=', 'vacancy.id')
    ->join('companies', 'vacancy.company_id', '=', 'companies.id') // Join with the companies table
    ->where('lamaran.user_id', $user_id)
    ->select('lamaran.*', 'vacancy.title', 'vacancy.location', 'vacancy.type', 'vacancy.description', 'vacancy.salary', 'companies.nama_badan_usaha')
    ->get();
    return view('user/lamaran', ['lamaran' => $lamaran]);
}
public function downloadCV($filename)
{
    $path = public_path('cv/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    return response()->download($path, $filename, $headers);
}
}
