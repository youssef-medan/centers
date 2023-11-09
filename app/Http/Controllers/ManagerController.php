<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Manager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {

        // $managers = Manager::all();
        $managers = DB::table("managers")->select( '*' ,'managers.name as managername' , 'c.name as companyname' , 'managers.created_at as createdat')
        ->join('companies as c','managers.company_id','=','c.id')
        ->orderBy('managername');
        if ($request->has('search')) {
            $managers->where('managers.name','LIKE','%'. $request->search .'%')
            ->orWhere('c.name','LIKE','%'. $request->search .'%');
        }

     return view("managers.index",["managers"=> $managers->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       $sql = 'SELECT * from companies WHERE id NOT IN (SELECT DISTINCT m.company_id FROM managers as m);';
       $companies = DB::select($sql);

        return view("managers.create",compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "company"=> "required",
        ],['company.required' => 'company filed is required . ( note: This list only contains companies that do not have a manager)'

        ]);
        try {
            Manager::create($request->except('_token'));
            return to_route('managers.index')->with('status','New Manager Added');
        } catch (Exception $e) {
            return to_route('managers.index')->with('status', $e->getMessage());

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

       $sql = 'SELECT * from companies WHERE id NOT IN (SELECT DISTINCT m.company_id FROM managers as m );';
       $companies = DB::select($sql);
       $manager = Manager::find($id);
       $oldcompany = Company::find($manager->company_id);
        return view('managers.edit',compact('manager'),compact('companies'))->with('oldcompany',$oldcompany);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> 'required',
            'company'=> 'required',
        ]);
        try {
            Manager::find($id)->update($request->except('_token'));
            return to_route('managers.index')->with('status','Manager Updated');
        } catch (Exception $e) {
            return to_route('managers.index')->with('status',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Manager::destroy($id);
            return to_route('managers.index')->with('status','Manager Deleted');
        } catch (Exception $e) {
            return to_route('managers.index')->with('status',$e->getMessage());

        }
    }
}
