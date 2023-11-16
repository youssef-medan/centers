<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::query()->select('*' ,'branches.name as branch_name','companies.name as company_name')
        ->join('companies','company_id','=','companies.id')->orderBy('branch_name')->paginate(20);
        return BranchResource::collection($branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'mobile' => 'required',
                'location' => 'required',
                'company_id' => 'required|numeric|exists:companies,id'
            ]);
            $branch = Branch::create($request->except('_token'));
            return response()->json([
                'status' => 'succsess',
               
            ]);
        } catch (Exception $e) {
            response()->json([
                'status' => 'failed',
                'masage' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
