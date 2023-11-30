<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

// Category Routes
Route::get('/all/category', [CategoryController::class, 'index'])->name('AllCat');

Route::post('/category/add', [CategoryController::class, 'Create'])->name('category.add');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->name('category.update');
Route::post('/category/remove/{id}', [CategoryController::class, "Remove"])->name('category.remove');
Route::post('/category/restore/{id}', [CategoryController::class, "Restore"])->name('category.restore');
Route::post('/category/delete/{id}', [CategoryController::class, 'Delete'])->name('category.delete');

//Brand Controller
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name("brand");

Route::post('/brand/add', [BrandController::class, 'Create'])->name("brand.add");