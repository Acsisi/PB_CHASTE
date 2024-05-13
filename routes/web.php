<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Guest;

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TenantController;

Route::get('/', [HomeController::class, 'getLanding']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'show'])->name('login')->middleware([Guest::class]);
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware([Guest::class]);
Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');

// Route::post('/food-midtrans', [MidtransController::class, 'foodMidtrans'])->name('food-midtrans');
// Route::get('/food-midtrans/success', [MidtransController::class, 'food_payment_success']);
// Route::get('/food-midtrans/failed', [MidtransController::class, 'food_payment_fail']);

// Route::get('/cart', [CartController::class, 'cartView']);
// Route::get('/add-cart/{id}', [CartController::class, 'addFood']);
// Route::get('/minus-cart/{id}', [CartController::class, 'minusFood']);
// Route::get('/remove-cart/{id}', [CartController::class, 'deleteFood']);
// Route::get('/payCart', [CartController::class, 'paymentCart']);

// Route::get('/food', [FoodController::class, 'getFood']);
// Route::get('/pay-food/{id}', [FoodController::class, 'foodPayment']);


Route::get('/kos/AC', [KosController::class, 'getKamarAC']);
Route::get('/kos/Non-AC', [KosController::class, 'getKamarNonAC']);
Route::get('/kos-detail/{id}', [KosController::class, 'getKamarDetail']);
Route::get('/kos-invoice', function () {
    return view('kos-invoice');
});


Route::middleware('authen:user')->group(function () {
	Route::get('/user', [PageController::class, 'dashboard'])->name('user');

	Route::get('/user/history/kamar', [PageController::class, 'user_history'])->name('search-history');
	Route::get('/user/history/kamar/{id}', [PageController::class, 'user_history_detail']);
	Route::get('/user/history/galon/{id}', [PageController::class, 'user_history_detail_galon']);
	// Route::get('/user/history/food', [PageController::class, 'user_history_food'])->name('search-history-food');
	// Route::get('/user/history/food/{id}', [PageController::class, 'user_history_detail_food']);

	Route::post('/payment', [MidtransController::class, 'payment'])->name('payment');
	Route::post('/payment/success', [MidtransController::class, 'payment_success'])->name('payment-success');
	Route::post('/paymentsewa/success', [MidtransController::class, 'payment_sewa_success'])->name('payment-sewa-success');
	Route::post('/paymentgalon/success', [MidtransController::class, 'payment_galon_success'])->name('payment-galon-success');
	Route::get('/payment/success', [MidtransController::class, 'payment_success_get']);
	Route::get('/paymentgalon/success', [MidtransController::class, 'payment_galon_success_get']);
	Route::get('/payment/failed', [MidtransController::class, 'payment_fail']);
	// Route::post('/payment-notif', [MidtransController::class, 'payment_notif'])->name('payment-notif');
});


Route::middleware('authen:tenant')->group(function () {
	// Route::get('/hlmnTenant', [HomeController::class, 'showtenant'])->name('showtenant');
	// // Route::get('/reportTenant', [HomeController::class, 'showReportTenant'])->name('showReportTenant');
	// Route::get('/ordersTenant', [HomeController::class, 'showOrders'])->name('showOrders');
	// Route::post('/orders/filter', [HomeController::class, 'filter'])->name('orders.filter');
	// Route::post('/orders/terima/{id}', [HomeController::class, 'terimaOrder'])->name('orders.terima');
	// Route::post('/orders/tolak/{id}', [HomeController::class, 'tolakOrder'])->name('orders.tolak');
	// Route::get('/pengeluaran', [HomeController::class, 'showPengeluaran'])->name('pengeluaran.show');
	// Route::post('/pengeluaran/store', [HomeController::class, 'storePengeluaran'])->name('pengeluaran.store');
	// Route::get('/report/tenant', [HomeController::class, 'showReportTenant'])->name('showReportTenant');
	// Route::post('/edit-pengeluaran/{id}', [HomeController::class, 'editPengeluaran'])->name('pengeluaran.edit');
	// Route::post('/update-pengeluaran/{id}', [HomeController::class, 'updatePengeluaran'])->name('pengeluaran.update');
	// Route::delete('/delete-pengeluaran/{id}', [HomeController::class, 'deletePengeluaran'])->name('pengeluaran.delete');
	// Route::post('/insertmenu', [MenuController::class, 'insertmenu'])->name('insertmenu');
	// Route::get('/edit-menu/{id}', [MenuController::class, 'showEditMenu'])->name('edit.menu');
	// Route::post('/update-status-menu/{id}', [MenuController::class, 'updateStatusMenu'])->name('updateStatus.menu');
	// Route::post('/update-menu/{id}', [MenuController::class, 'updateMenu'])->name('update.menu');
	// Route::post('/update-status-menu/{id}', [MenuController::class, 'updateStatusMenu'])->name('updateStatus.menu');
	// Route::get('/profileTenant', [PageController::class, 'profileTenant'])->name('profileTenant');
	// Route::post('/update', [PageController::class, 'update'])->name('profile.update');
});


Route::middleware('authen:admin')->group(function () {
	Route::get('/admin', function () {return redirect('/dashboard');});
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout']);
	Route::post('addTenant', [TenantController::class, 'addTenant'])->name('add-tenant');
	Route::post('editTenant', [TenantController::class, 'changeTenant'])->name('edit-tenant');
	Route::get('/tenant/edit/{id}', [TenantController::class, 'editTenant'])->name('editTenant');
	Route::get('/tenant/delete/{id}', [TenantController::class, 'deleteTenant']);

	Route::post('addKos', [KosController::class, 'addKos'])->name('add-kos');
	Route::post('editKos', [KosController::class, 'changeKos'])->name('edit-kos');
	Route::get('/kos/edit/{id}', [KosController::class, 'editKos'])->name('editKos');
	Route::get('/kos/delete/{id}', [KosController::class, 'deleteKos']);
	Route::get('/user-management/edit/{id}', [UserProfileController::class, 'editRole']);
	Route::get('/user-management/delete/{id}', [UserProfileController::class, 'deleteUser']);
	Route::get('/user-management/update/{id}', [UserProfileController::class, 'updateUser']);

	Route::post('editRole', [UserProfileController::class, 'changeRole'])->name('edit-role');

	Route::post('addExpenses', [ReportController::class, 'addExpense'])->name('add-expense');
	Route::post('addIncome', [ReportController::class, 'addIncome'])->name('add-income');

	Route::post('editExpense', [ReportController::class, 'editExpense'])->name('editExpense');
	Route::get('/pengeluaranOwner/edit/{id}', [ReportController::class, 'changeExpense'])->name('edit-expense');
	Route::get('/pengeluaranOwner/delete/{id}', [ReportController::class, 'deleteExpense']);

});


Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
