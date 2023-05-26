<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableController;

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductCategoryController;

use App\Http\Controllers\Transaction\PurchasingController;

use App\Http\Controllers\Delivery\ExpeditionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('tables/simple', [TableController::class, 'simple'])->name('tables-simple');
Route::get('tables/datatable', [TableController::class, 'datatable'])->name('tables-datatable');

Route::get('product/master', [ProductController::class, 'index'])->name('product-index');
Route::post('product/master', [ProductController::class, 'store'])->name('product-add');
Route::post('product/master/update', [ProductController::class, 'update'])->name('product-update');
Route::post('product/master/destroy', [ProductController::class, 'destroy'])->name('product-destroy');
Route::get('product/categories', [ProductCategoryController::class, 'index'])->name('product-category');
Route::post('product/categories', [ProductCategoryController::class, 'store'])->name('product-category-add');
Route::post('product/categories/update', [ProductCategoryController::class, 'update'])->name('product-category-update');
Route::post('product/categories/destroy', [ProductCategoryController::class, 'destroy'])->name('product-category-destroy');

Route::get('transaction/purchasing', [PurchasingController::class, 'index'])->name('transaction-purchasing');
Route::get('transaction/purchasing/create', [PurchasingController::class, 'create'])->name('transaction-purchasing-create');
Route::post('transaction/purchasing/create', [PurchasingController::class, 'store'])->name('transaction-purchasing-store');
Route::get('transaction/purchasing/{id}/edit', [PurchasingController::class, 'edit'])->name('transaction-purchasing-edit');
Route::post('transaction/purchasing/update', [PurchasingController::class, 'update'])->name('transaction-purchasing-update');
Route::post('transaction/purchasing/delete', [PurchasingController::class, 'destroy'])->name('transaction-purchasing-destroy');

// Route::get('delivery/expedition/import', [ExpeditionController::class, 'import'])->name('delivery-expedition-import');
