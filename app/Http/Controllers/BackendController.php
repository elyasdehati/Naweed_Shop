<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'province.required' => 'لطفا ولایت را وارد کنید',
            'email.required' => 'لطفا ایمیل کارمند را وارد کنید',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already taken',
        ]);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'email' => "required|email|unique:employees,email,{$emp_id}",
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'province.required' => 'لطفا ولایت را وارد کنید',
            'email.required' => 'لطفا ایمیل کارمند را وارد کنید',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already taken',
        ]);

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

    // --------------  Category -----------------
    public function AllCategory(){
        $category = Category::get();
        return view('backend.pages.category.index', compact('category'));
    }

    public function AddCategory(){
        return view('backend.pages.category.add');
    }

    public function StoreCategory(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'لطفا نام دسته بندی را وارد کنید',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

             $notification = array(
            'message' => 'دسته بندی محصول اضافه شد',
            'alert-type' => 'success'
        );
            return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id){
        $category = Category::find($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;
        // $category = Category::find($cat_id);

        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'لطفا نام دسته بندی را وارد کنید',
        ]);

            Category::find($cat_id)->update([
                'name' => $request->name,
            ]);

            $notification = array(
            'message' => 'دسته بندی ویرایش شد',
            'alert-type' => 'success'
        );
           
        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id){
        Category::find($id)->delete();

        $notification = array(
            'message' => 'دسته بندی حذف شد',
            'alert-type' => 'error'
        );
            return redirect()->back()->with($notification);
    }

}
