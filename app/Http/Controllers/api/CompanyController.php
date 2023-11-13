<?php

namespace App\Http\Controllers\api;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function companysearch(request $request){
    //     $companies = Company::query();
    //    if($request->has('search')) $companies->where("name","LIKE","%".$request->search."%");
    //    $result = $companies->get;
    //     return $result;

    //  }

    public function search(Request $request)
    {
        // echo "test";
        try {
            $companies = Company::query();
            if ($request->name) $companies->where('namew', 'like', '%' . $request->name . '%');
            $result = $companies->get();
            return $result;
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }
    public function index()
    {
        $company = Company::all();
        return $company;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'owner' => 'required|string|max:10'
        ]);
        try {
            Company::create($request->all());
            return response()->json([
                'status' => 'done',
            ]) ;
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massage' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
           $company = Company::find($id);
            return response()->json([
                'status'=> 'done',
                'name'=> $company->name,
                'owner'=> $company->owner,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massage' => $e->getMessage()
            ],500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'owner' => 'nullable|string|max:60'
        ]);

        try {
         company::find($id)->update($request->all());
           $company = company::find($id);
            return response()->json([
                'status'=> 'updated',
                'name'=> $company->name,
                'owner'=> $company->owner,

            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massage' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            company::destroy($id);
            return response()->json([
                'status' => 'deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'massage' => $e->getMessage()
            ],500);
        }
    }
    }

