<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  Employee
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/employee', 'AllEmployee')->name('all.employee');
        Route::get('add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('store.employee');
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    //  Category
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/category', 'AllCategory')->name('all.category');
        Route::get('add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    //  Products
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/products', 'AllProducts')->name('all.products');
        Route::get('add/products', 'AddProducts')->name('add.products');
        Route::post('/store/products', 'StoreProducts')->name('store.products');
        Route::get('/edit/products/{id}', 'EditProducts')->name('edit.products');
        Route::post('/update/products/{id}','UpdateProducts')->name('update.products');
        Route::get('/delete/products/{id}', 'DeleteProducts')->name('delete.products');
    });

    //  Sales
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/sales', 'AllSales')->name('all.sales');
        Route::get('add/sales', 'AddSales')->name('add.sales');
        Route::post('/store/sales', 'StoreSales')->name('store.sales');
        Route::get('/edit/sales/{id}', 'EditSales')->name('edit.sales');
        Route::post('/update/sales/{id}','UpdateSales')->name('update.sales');
        Route::get('/delete/sales/{id}', 'DeleteSales')->name('delete.sales');
        Route::get('/details/sales/{id}', 'DetailsSales')->name('details.sales');
    });
    Route::get('/get-products/{category_id}', [BackendController::class, 'GetProducts']);
});

require __DIR__.'/auth.php';
