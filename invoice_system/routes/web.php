<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Client;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\RoleMiddleware;






Route::get('/', function () {
    return view('welcome');
});
// Route for admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // Create this view
})->middleware(['auth', RoleMiddleware::class . ':admin']);

Route::get('/dashboard', function () {
    // Fetch the company for the authenticated user
    $company = Company::where('user_id', Auth::id())->first();

    // If no company found, handle it as needed
    if (!$company) {
        return redirect()->route('some.route')->with('error', 'No company found.');
    }

    // Fetch clients related to the company
    $clients = Client::where('company_id', $company->id)->get();

    // Fetch the latest 6 invoices based on the company ID
    $invoices = \App\Models\Invoice::with('client')
        ->where('company_id', $company->id)
        ->latest()
        ->take(6)
        ->get();

    return view('dashboard', [
        'company' => $company,
        'clients' => $clients,
        'invoices' => $invoices, // Pass invoices to the dashboard view
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//company routes
Route::middleware(['auth'])->group(function () {
    Route::get('/register-company', [CompanyController::class, 'create'])->name('register.company');
    Route::post('/register-company', [CompanyController::class, 'store'])->name('company.store');
    
});
// web.php or api.php
Route::get('/company/details', [CompanyController::class, 'getCompanyDetails']);



//invoices

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/choose-template/{invoiceId}', [InvoiceController::class, 'chooseTemplate'])->name('invoices.chooseTemplate');
Route::post('/invoices/generate-pdf/{invoiceId}', [InvoiceController::class, 'generatePDF'])->name('invoices.generatePDF');
Route::post('/invoices/{id}/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');

Route::get('/invoices', function () {
    // Fetch the company for the authenticated user
    $company = Company::where('user_id', Auth::id())->first();

    // If no company found, handle it as needed
    if (!$company) {
        return redirect()->route('some.route')->with('error', 'No company found.');
    }

    // Fetch clients related to the company
    $clients = Client::where('company_id', $company->id)->get();

    // Fetch the latest 6 invoices based on the company ID
    $invoices = \App\Models\Invoice::with('client')
        ->where('company_id', $company->id)
        ->latest()
        ->take(6)
        ->get();

    // Fetch the total number of invoices for the company
    $totalInvoices = \App\Models\Invoice::where('company_id', $company->id)->count();

    // Fetch the number of paid invoices
    $paidInvoices = \App\Models\Invoice::where('company_id', $company->id)
        ->where('status', 'paid')
        ->count();

    // Fetch the number of unpaid invoices (assuming 'unpaid' means 'pending')
    $unpaidInvoices = \App\Models\Invoice::where('company_id', $company->id)
        ->where('status', 'unpaid')
        ->count();

    return view('invoices', [
        'company' => $company,
        'clients' => $clients,
        'invoices' => $invoices, // Pass invoices to the dashboard view
        'totalInvoices' => $totalInvoices, // Pass total invoices count
        'paidInvoices' => $paidInvoices,   // Pass paid invoices count
        'unpaidInvoices' => $unpaidInvoices // Pass unpaid invoices count
    ]);
})->middleware(['auth', 'verified'])->name('invoices');



//payment gateway
Route::post('/payfast/payment', [PaymentController::class, 'processPayment'])->name('payfast.payment');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/payment/notify', [PaymentController::class, 'paymentNotify'])->name('payment.notify');



//admin authentication
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\AdminAuth\LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth:admin')->name('dashboard');
});



require __DIR__.'/auth.php';
