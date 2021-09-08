<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use DB;

class SalaryController extends Controller
{
    public function index()
    {
        $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

        return response()->json($salary);
    }


    public function paid(Request $request, $id)
    {
        $data = $request->validate([
            'salary_month' => 'required'
        ]);

        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month',$request->salary_month)->where('salary_year', date('Y'))->first();

        if ($check) {
            return response()->json(['salary already paid']);
        }

        $data = array();
        $data['employee_id'] = $id;
        $data['salary'] = $request->salary;
        $data['salary_date'] = date('d-m-Y');
        $data['salary_month'] = $request->salary_month;
        $data['salary_year'] = date('Y');

        Salary::create($data);
    }

    public function view($month)
    {
        $salaries = Salary::where('salary_month', $month)->with('employees')->get();

        return response()->json($salaries);
    }

    public function edit(Request $request, $id)
    {
        $salary = DB::table('salaries')
                ->join('employees', 'salaries.employee_id', 'employees.id')
                ->select('employees.name','employees.email','salaries.*')
                ->where('salaries.id', $id)
                ->first();

        return response()->json($salary);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'salary' => 'required',
            'salary_month' => 'required',
        ]);

        $salary = Salary::where('id', $id)->update($data);
    }


}
