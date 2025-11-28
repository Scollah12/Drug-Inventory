<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DrugRequestController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AnomalyReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\ChatbotController;



Route::get('/', function () {
    return redirect('/login'); 
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::resource('drugrequests', DrugRequestController::class);




Route::get('/pharmacist-dashboard', [PharmacistController::class, 'dashboard'])->name('pharmacist.dashboard');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login.custom');



Route::get('/password/reset', function () {
    return 'Password Reset Page';
})->name('password.request');

Route::get('/guest-access', function () {
    return 'Guest Dashboard';
})->name('guest.access');

Route::post('/register', [RegisterController::class, 'register'])->name('register.custom');





Route::get('/add_user', [UserController::class, 'showForm'])->name('add_user.form');
Route::post('/add_user', [UserController::class, 'storeUser'])->name('add_user.store');
Route::get('/add-user', [AdminController::class, 'showAddUserForm'])->name('admin.adduser');
Route::post('/add-user', [AdminController::class, 'storeUser'])->name('admin.storeuser');
Route::post('/add-user', [AddUserController::class, 'store'])->name('add_user.store');



Route::get('/userdashboard', [UserDashboardController::class, 'index'])->name('userdashboard');
Route::post('/drugrequest', [UserDashboardController::class, 'storeRequest'])->name('request.drug');



Route::get('/admin/send-notification', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/admin/send-notification', [NotificationController::class, 'store'])->name('notifications.store');




Route::get('/user-dashboard', [NotificationController::class, 'userNotifications'])->middleware('auth');


Route::get('/my-notifications', [NotificationController::class, 'show'])->name('notifications.show');


Route::get('/inventory-dashboard', [InventoryController::class, 'index'])->name('inventory.dashboard');


Route::get('/add-medicine', [InventoryController::class, 'create'])->name('medicine.create');
Route::post('/add-medicine', [InventoryController::class, 'store'])->name('medicine.store');


Route::match(['get', 'post'], '/view-medicine', [InventoryController::class, 'viewMedicine'])->name('view.medicine');




Route::match(['get', 'post'], '/view-medicine', [InventoryController::class, 'viewMedicine'])->name('view.medicine');



Route::match(['get', 'post'], '/update_medicine', [InventoryController::class, 'indexx'])->name('medicine.update');
Route::post('/medicine/update', [InventoryController::class, 'update'])->name('medicine.doUpdate');




Route::get('/expiring-medicines', [InventoryController::class, 'showExpiryForm'])->name('medicines.expiry');
Route::post('/expiring-medicines', [InventoryController::class, 'filterExpiry'])->name('medicines.expiry.filter');


Route::match(['get', 'post'], '/delete-medicine', [InventoryController::class, 'showDeleteMedicinePage'])->name('delete_medicine');
Route::post('/delete-medicine-action', [InventoryController::class, 'deleteMedicine'])->name('delete_medicine_action');




Route::get('/anomaly-report', [AnomalyReportController::class, 'index'])->name('anomaly.report');

Route::get('/clear-log', [InventoryController::class, 'clearLog'])->name('clear.log');



Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

Route::get('/pending-orders/{sup_id?}', [OrderController::class, 'pendingOrders'])->name('pending.orders');



Route::post('/supplier/edit', [SupplierController::class, 'editForm'])->name('supplier.edit');


Route::post('/supplier/update', [SupplierController::class, 'update'])->name('supplier.update');





    Route::get('/drugrequests', [DrugRequestController::class, 'index'])->name('drugrequests.index');
    Route::get('/drugrequests/create', [DrugRequestController::class, 'create'])->name('drugrequests.create');
    Route::post('/drugrequests', [DrugRequestController::class, 'store'])->name('drugrequests.store');

 Route::patch('/pharmacist/requests/{id}/status', [DrugRequestController::class, 'updateStatus'])->name('pharmacist.requests.updateStatus');



Route::get('/completed-purchases', [PurchaseController::class, 'index'])->name('purchases.index');


Route::get('/purchase-report', [PurchaseReportController::class, 'index'])->name('purchase.report');




Route::match(['get', 'post'], '/druginventorymodule/chatbot', [ChatbotController::class, 'handleMessage'])->name('chatbot.handle');








