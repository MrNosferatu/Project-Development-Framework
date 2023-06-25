<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function index()
    {
        // $vacancy = DB::select('select * from vacancy');
 
        $vacancy = Vacancy::take(1)
        ->get();
        return view('home', ['vacancy' => $vacancy]);
    }
    public function store(Request $request)
    {
        $formInput = new Vacancy;
        $formInput->title = $request->input('title');
        $formInput->description = $request->input('description');
        $formInput->qualification = $request->input('qualification');
        $formInput->location = $request->input('location');
        $formInput->type = $request->input('type');
        $formInput->salary = $request->input('salary');
        $formInput->save();

        return redirect('/')->with('success', 'Form input saved successfully.');
    }
    public function update($id, Request $request)
    {
        $formInput = new Vacancy;
        $formInput = Vacancy::find($id);
        $formInput->title = $request->input('title');
        $formInput->description = $request->input('description');
        $formInput->qualification = $request->input('qualification');
        $formInput->location = $request->input('location');
        $formInput->type = $request->input('type');
        $formInput->salary = $request->input('salary');
        $formInput->update();

        return redirect('/')->with('success', 'Form input saved successfully.');
    }
    public function view($id)
    {
        $vacancy = Vacancy::where('id', $id)
        ->orderBy('name')
        ->take(1)
        ->get();
 
        return view('Vacancy/view', ['vacancy' => $vacancy]);
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
        return redirect('/');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');

        if ($type == 'any'){
            $vacancy = Vacancy::where('title', 'LIKE', "%$query%")
            ->get();
        }else{
            $vacancy = Vacancy::where('title', 'LIKE', "%$query%")
            ->where('type', $type)
            ->get();
        };
        return response()->json($vacancy);

    }
    
}
