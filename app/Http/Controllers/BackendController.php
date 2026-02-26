<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Sale;
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
            'national_id' => 'required|string|unique:employees,national_id',
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'province.required' => 'لطفا ولایت را وارد کنید',
            'email.required' => 'لطفا ایمیل کارمند را وارد کنید',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already taken',
            'national_id.required' => 'لطفا شماره تذکره را وارد کنید',
            'national_id.unique' => 'این شماره تذکره قبلا ثبت شده',
        ]);

        Employee::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'province' => $request->province,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
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
            'national_id' => "required|string|unique:employees,national_id,{$emp_id}",
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'province.required' => 'لطفا ولایت را وارد کنید',
            'email.required' => 'لطفا ایمیل کارمند را وارد کنید',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already taken',
            'national_id.required' => 'لطفا شماره تذکره را وارد کنید', 
            'national_id.unique' => 'این شماره تذکره قبلا ثبت شده', 
        ]);

        Employee::find($emp_id)->update([
            'name' => $request->name,
            'lname' => $request->lname,
            'province' => $request->province,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
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

    // --------------  Products -----------------

    public function AllProducts(){
        $product = Product::orderBy('id','desc')->get();
        return view('backend.pages.products.index', compact('product'));
    }

    public function AddProducts(){
        $categories = Category::all();
        return view('backend.pages.products.add', compact('categories'));
    }

    public function StoreProducts(Request $request) {

        // تبدیل اعداد فارسی به انگلیسی
        $quantity = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
            ['0','1','2','3','4','5','6','7','8','9'],
            $request->quantity
        );

        $price = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
            ['0','1','2','3','4','5','6','7','8','9'],
            $request->price
        );

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/products'), $filename);
            $imagePath = 'upload/products/'.$filename;
        } else {
            $imagePath = null;
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'quantity' => $quantity,
            'code' => $request->code,
            'price' => $price,
            'note' => $request->note,
            'image' => $imagePath,
        ]);

        $notification = array(
            'message' => 'محصول اضافه شد',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }

    public function EditProducts($id){
        $categories = Category::all();
        $product = Product::find($id);
        return view('backend.pages.products.edit', compact('product','categories'));
    }
    
    public function UpdateProducts(Request $request, $id) {
        $product = Product::findOrFail($id);

        // تبدیل اعداد فارسی به انگلیسی
        $quantity = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
            ['0','1','2','3','4','5','6','7','8','9'],
            $request->quantity
        );

        $price = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
            ['0','1','2','3','4','5','6','7','8','9'],
            $request->price
        );

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/products'), $filename);
            $imagePath = 'upload/products/'.$filename;
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'quantity' => $quantity,
            'code' => $request->code,
            'price' => $price,
            'note' => $request->note,
            'image' => $imagePath,
        ]);

        $notification = [
            'message' => 'محصول با موفقیت بروزرسانی شد',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.products')->with($notification);
    }

    public function DeleteProducts($id) {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        $notification = [
            'message' => 'محصول با موفقیت حذف شد',
            'alert-type' => 'error' 
        ];

        return redirect()->back()->with($notification);
    }

    // --------------  Sales -----------------

    public function AllSales(){
        $sale = Sale::orderBy('id','desc')->get();
        return view('backend.pages.sales.index', compact('sale'));
    }

    public function AddSales(){
        $employee = Employee::all();
        $category = Category::all();
        $product = Product::all();
        return view('backend.pages.sales.add', compact('employee','category', 'product'));
    }
    
    public function GetProducts($category_id){
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products);
    }

    public function StoreSales(Request $request){
        // تبدیل اعداد فارسی به انگلیسی قبل از validate
        $request->merge([
            'quantity' => str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->quantity),
            'sale_price' => str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->sale_price),
            'charges' => isset($request->charges) ? str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->charges) : 0,
        ]);

        $request->validate([
            'category_id' => 'required',
            'product_id' => 'required',
            'employee_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'sale_price' => 'required|numeric',
            'province' => 'required',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        // تبدیل به عدد برای محاسبه‌ها
        $quantity = (int) $request->quantity;
        $sale_price = (float) $request->sale_price;
        $charges = (float) $request->charges;

        $product = Product::findOrFail($request->product_id);

        if($request->status == 'completed'){

            if($product->quantity < $quantity){
                return back()->withErrors('موجودی کافی نیست');
            }

            $buy_price = $product->price;
            $total = ($sale_price * $quantity) - $charges;
            $profit = ($sale_price - $buy_price) * $quantity - $charges;

            $product->quantity -= $quantity;
            $product->save();

        }else{

            $buy_price = $product->price;
            $charges = 0;
            $total = 0;
            $profit = 0;
        }

        Sale::create([
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'employee_id' => $request->employee_id,
            'quantity' => $quantity,
            'buy_price' => $buy_price,
            'sale_price' => $sale_price,
            'charges' => $charges,
            'province' => $request->province,
            'status' => $request->status,
            'date' => $request->date,
            'profit' => $profit,
            'total' => $total,
        ]);

        $notification = array(
            'message' => 'فروش موفقانه اضافه شد',
            'alert-type' => 'success'
        );

        return redirect()->route('all.sales')->with($notification);
    }

    public function EditSales($id){
        $sale = Sale::findOrFail($id);
        $category = Category::all();
        $product = Product::all();
        $employee = Employee::all();
        return view('backend.pages.sales.edit', compact('sale','category','product','employee'));
    }

    public function UpdateSales(Request $request, $id){
        $request->validate([
            'category_id' => 'required',
            'product_id' => 'required',
            'employee_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'sale_price' => 'required|numeric',
            'province' => 'required',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $sale = Sale::findOrFail($id);
        $product = Product::findOrFail($request->product_id);

        $oldStatus = $sale->status;
        $newStatus = $request->status;

        $oldQty = $sale->quantity;
        $newQty = $request->quantity;
        $difference = $newQty - $oldQty;

        if($newStatus == 'completed'){

            if($oldStatus != 'completed'){
                if($product->quantity < $newQty){
                    return back()->withErrors('موجودی کافی نیست');
                }
                $product->quantity -= $newQty;
            }

            if($oldStatus == 'completed'){
                if($product->quantity < $difference){
                    return back()->withErrors('موجودی کافی نیست');
                }
                $product->quantity -= $difference;
            }

            $charges = $request->charges ?? 0;
            $total = ($request->sale_price * $request->quantity) - $charges;
            $profit = ($request->sale_price - $product->price) * $request->quantity - $charges;

        }else{

            if($oldStatus == 'completed'){
                $product->quantity += $oldQty;
            }

            $charges = 0;
            $total = 0;
            $profit = 0;
        }

        $product->save();

        $sale->update([
            'category_id' => $request->category_id,
            'product_id' => $request->product_id,
            'employee_id' => $request->employee_id,
            'quantity' => $request->quantity,
            'buy_price' => $product->price,
            'sale_price' => $request->sale_price,
            'charges' => $charges,
            'province' => $request->province,
            'status' => $request->status,
            'date' => $request->date,
            'profit' => $profit,
            'total' => $total,
        ]);

        $notification = array(
            'message' => 'فروش موفقانه ویرایش شد',
            'alert-type' => 'success'
        );

        return redirect()->route('all.sales')->with($notification);
    }

    public function DeleteSales($id){
        $sale = Sale::findOrFail($id);
        $product = Product::findOrFail($sale->product_id);

        if($sale->status == 'completed'){
            $product->quantity += $sale->quantity;
            $product->save();
        }

        $sale->delete();

        $notification = array(
            'message' => 'فروش حذف شد',
            'alert-type' => 'error'
        );

        return redirect()->route('all.sales')->with($notification);
    }

    public function DetailsSales($id){
        $sale = Sale::with(['product', 'employee', 'category'])->findOrFail($id);
        return view('backend.pages.sales.sales_details', compact('sale'));
    }


    // --------------  Expenses -----------------
    public function AllExpenses(){
        $expenses = Expense::get();
        return view('backend.pages.expenses.index', compact('expenses'));
    }

    public function AddExpenses(){
        $employee = Employee::all();
        return view('backend.pages.expenses.add', compact('employee'));
    }

    public function StoreExpenses(Request $request){
        $request->validate([
            'type' => 'required|in:employee,shop',
            'employee_id' => 'nullable|exists:employees,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $employee_id = $request->type === 'employee' ? $request->employee_id : null;

        Expense::create([
            'type' => $request->type,
            'employee_id' => $employee_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('all.expenses')->with('success', 'مصرف با موفقیت ثبت شد');
    }

    public function EditExpenses($id){
        $expense = Expense::find($id);
        $employee = Employee::all();
        return view('backend.pages.expenses.edit', compact('expense', 'employee'));
    }

    public function UpdateExpenses(Request $request, $id){
        $request->validate([
            'type' => 'required|in:employee,shop',
            'employee_id' => 'nullable|exists:employees,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $expense = Expense::findOrFail($id);

        $employee_id = $request->type === 'employee' ? $request->employee_id : null;

        $expense->update([
            'type' => $request->type,
            'employee_id' => $employee_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('all.expenses')->with('success', 'مصرف با موفقیت بروزرسانی شد');
    }

    public function DeleteExpenses($id){
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->back()->with('success', 'مصرف با موفقیت حذف شد.');
    }

}
