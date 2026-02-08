<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function AllEmployee(){
        $employee = Employee::get();
        return view('backend.pages.employee.index', compact('employee'));
    }

    public function AddEmployee() {
         return view('backend.pages.employee.add');
    }

    public function StoreEmployee(Request $request){
            Employee::create([
                'name' => $request->name,
                'lname' => $request->lname,
                'province' => $request->province,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

             $notification = array(
            'message' => 'کاربر اضافه شد',
            'alert-type' => 'success'
        );
            return redirect()->route('all.employee')->with($notification);
    }

    public function EditEmployee($id){
        $employee = Employee::find($id);
        return view('backend.pages.employee.edit', compact('employee'));
    }

    public function UpdateEmployee(Request $request){
         $emp_id = $request->id;
        $employee = Employee::find($emp_id);

            Employee::find($emp_id)->update([
                'name' => $request->name,
                'lname' => $request->lname,
                'province' => $request->province,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $notification = array(
            'message' => 'کارمند ویرایش شد',
            'alert-type' => 'success'
        );
           
            return redirect()->route('all.employee')->with($notification);
    }

     public function DeleteEmployee($id) {
        Employee::find($id)->delete();

        $notification = array(
            'message' => 'کارمند حذف شد',
            'alert-type' => 'error'
        );
            return redirect()->back()->with($notification);
    }

}
