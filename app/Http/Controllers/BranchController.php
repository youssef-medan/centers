<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branches = Branch::query();
        if ($request->has('search')) {
            $branches->where('name', 'like', '%' . $request->search . '%');
            $branches->orWhereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        return view('branches.index', ["branches" => $branches->orderBy('created_at', 'desc')->paginate(20)]);
        // return view('branches.index', ["branches" => $branches->orderBy('created_at', 'desc')->simplePaginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('branches.create')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'location' => 'required',
            'company_id' => 'required|numeric|exists:companies,id'
        ]);

        try {
            Branch::create($request->except('_token'));
            return to_route('branches.index')->with('status', 'New Branch Added');
        } catch (Exception $e) {
            return to_route('branches.index')->with('status', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::findOrFail($id);
        $companies = Company::orderBy('name')->get();
        return view('branches.edit', compact('branch'), compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'location' => 'required',
            'company_id' => 'required|numeric|exists:companies,id'
        ]);

        try {
            Branch::find($id)->update($request->except('_token'));
            return to_route('branches.index')->with('status', 'Branch Updated');
        } catch (Exception $e) {
            return to_route('branches.index')->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Branch::destroy($id);
            return to_route('branches.index')->with('status', 'Branch Deleted');
        } catch (Exception $e) {
            return to_route('branches.index')->with('status', $e->getMessage());
        }
    }
}
