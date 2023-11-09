<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /* function __construct()
    {
        $this->middleware('age');
    } */
    public function index()
    {

        $companies = Company::latest()->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            // 'owner' => 'nullable|in:male,female|regex:'
            // 'owner' => 'required|numeric|max:10'
            // 'owner' => 'nullable|numeric|max:10'
            // 'owner' => 'unique:users,email'
        ]);

        try {
            // dd($request->only("_token"));
            // dd($request->except("_token"));
            // dd($request->name);
            // dd($request->all());
            Company::create($request->except("_token"));
            // session()->put('status', 'New Company Added');
            // session()->forget('status');
            // session()->flash('status', 'New Company Added');
            return to_route('companies.index')->with('status', 'New Company Added');
            // return redirect()->route('companies.index');
            // return redirect()->to('/companies');
            // return redirect()->back();
            // return back();
        } catch (Exception $e) {
            return to_route('companies.index')->with('status', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            Company::destroy($id);
            return to_route('companies.index')->with('status', 'Company Deleted');
        } catch (Exception $e) {
            return to_route('companies.index')->with('status', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'owner' => 'nullable|string|max:60'
        ]);
        try {
            $company = Company::find($id);
            $company->name = $request->name;
            $company->owner = $request->owner;
            $company->save();
            return to_route('companies.index')->with('status', 'Company ' . $company->name . ' Updated');
        } catch (Exception $e) {
            return to_route('companies.index')->with('status', $e->getMessage());
        }
    }
}
