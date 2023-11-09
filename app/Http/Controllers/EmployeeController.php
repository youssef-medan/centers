<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;
use Termwind\Components\Dd;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        // $sql ='select * , b.name as name , u.name as uname , employees.id as id from employees join users u on employees.user_id = u.id join branches b on employees.branch_id = b.id order by uname';
        // $employees = Employee::query()->join('users as u', 'employees.user_id', '=', 'u.id')->join('branches as b', 'employees.branch_id', '=', 'b.id')
        //     ->select('*', 'b.name as bname', 'u.name as uname', 'employees.id as id')->orderBy('uname')->get();
        $employees = DB::table('employees')->select( '*' , 'b.name as bname' , 'u.name as uname' , 'employees.id as id')
        ->leftJoin('users as u', 'employees.user_id', '=', 'u.id')
        ->leftJoin('branches as b', 'employees.branch_id', '=', 'b.id')
        ->orderby('uname');

        if ($request->has("search")) {
            $employees->where("u.name","like","%". $request->search ."%")
            ->orWhere("b.name","like","%". $request->search ."%");
        }

        return view('employees.index',["employees" => $employees->paginate(20) ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       $sql = 'SELECT * from users WHERE id NOT IN (SELECT DISTINCT e.user_id FROM employees as e);';
        $users = DB::select($sql);
        $branches = Branch::query()->get();

        return view('employees.create', compact('users'),compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title'=> 'required',
            'salary'=> 'required',
            'hire_date'=> 'required',
            'user_id'=> 'required',
            'branch_id'=> 'required'
        ]);

        try {
            Employee::create($request->except('_token'));
            return to_route('employees.index')->with('status' ,'new employee adeed');
        } catch (Exception $e) {
            return to_route('employees.index')->with('status' ,$e->getMessage());

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
        $employee = Employee::findorfail($id);
        $empname = Employee::query()->join('users as u','employees.user_id', '=', 'u.id')->where('employees.id','=', $id)->first();
        $branches = Branch::query()->get();
        return view('employees.edit',compact('employee') ,compact('branches'))->with('empname', $empname);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'job_title'=> 'required',
            'salary'=> 'required',
            'hire_date'=> 'required',
            'branch_id'=> 'required'
        ]);

        try {
            Employee::find($id)->update($request->except('_token'));
            return to_route('employees.index')->with('status' ,'employee updated');
        } catch (Exception $e) {
            return to_route('employees.index')->with('status' ,$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
         Employee::destroy($id);
         return to_route('employees.index')->with('status','employee deleted');
        } catch (Exception $e) {
            return to_route('employees.index')->with('status',$e->getMessage());
        }
    }
}
