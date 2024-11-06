<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Auth\AuthController as DashboardAuthController;
use App\Http\Controllers\Dashboard\MainController as DashboardMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ClientsController;
use App\Http\Controllers\Dashboard\FreelancersController;
use App\Http\Controllers\Dashboard\CountriesController;
use App\Http\Controllers\Dashboard\ActivitiesController;
use App\Http\Controllers\Dashboard\ProjectsController;
use App\Http\Controllers\Dashboard\InvoicesController;
use App\Http\Controllers\Dashboard\QuotationsController;
use App\Http\Controllers\Dashboard\ExpensesController;
use App\Http\Controllers\Dashboard\EmailsController;

// Dashboard
Route::get('/app/login', [DashboardAuthController::class, 'loginPage'])->name('login'); // Done
Route::post('/app/login', [DashboardAuthController::class, 'loginAuth'])->name('loginAuth'); // Done
Route::get('/maintenance', [DashboardMainController::class, 'maintenance'])->name('maintenance'); // Done

// Route::middleware(['web','admin', 'localization'])->prefix(LaravelLocalization::setLocale().'/app')->name('app.')->group(function () {
Route::middleware(['web','admin'])->prefix('/app')->name('app.')->group(function () {
    Route::get('/', [DashboardMainController::class, 'index'])->name('dashboard'); // Done
    Route::get('logout', [DashboardAuthController::class, 'logout'])->name('logout'); // Done

    // Settings Area
    Route::get('settings/config', [SettingsController::class, 'config'])->name('settings.config'); // Done
    Route::post('settings/update/{type}', [SettingsController::class, 'update'])->name('settings.update'); // Done
    Route::get('settings/remove_logo/{setting}', [SettingsController::class, 'remove_logo'])->name('settings.remove_logo'); // Done

    // Roles Area
    Route::resource('roles', RolesController::class);

    // Admins Area
    Route::resource('admins', AdminsController::class);
    Route::get('admins/deleteForever/{admin}', [AdminsController::class, 'deleteForever'])->name('admins.deleteForever'); // Done
    Route::get('admins/restore/{admin}', [AdminsController::class, 'restore'])->name('admins.restore'); // Done
    Route::get('admins/is_active/{admin}', [AdminsController::class, 'is_active'])->name('admins.is_active'); // Done
    // Route::get('admins/remove_image/{admin}', [AdminsController::class, 'remove_image'])->name('admins.remove_image'); // Done
    Route::post('admins/update_dark_position', [AdminsController::class, 'update_dark_position'])->name('admins.update_dark_position'); // Done

    // Clients Area
    Route::resource('clients', ClientsController::class);
    Route::get('clients/deleteForever/{client}', [ClientsController::class, 'deleteForever'])->name('clients.deleteForever'); // Done
    Route::get('clients/restore/{client}', [ClientsController::class, 'restore'])->name('clients.restore'); // Done
    Route::get('clients/is_active/{client}', [ClientsController::class, 'is_active'])->name('clients.is_active'); // Done
    // Route::get('clients/remove_image/{client}', [ClientsController::class, 'remove_image'])->name('clients.remove_image'); // Done

    // Freelancers Area
    Route::resource('freelancers', FreelancersController::class);
    Route::get('freelancers/deleteForever/{freelancer}', [FreelancersController::class, 'deleteForever'])->name('freelancers.deleteForever'); // Done
    Route::get('freelancers/restore/{freelancer}', [FreelancersController::class, 'restore'])->name('freelancers.restore'); // Done
    Route::get('freelancers/is_active/{freelancer}', [FreelancersController::class, 'is_active'])->name('freelancers.is_active'); // Done
    // Route::get('freelancers/remove_image/{freelancer}', [FreelancersController::class, 'remove_image'])->name('freelancers.remove_image'); // Done

    // Countries Area
    Route::resource('countries', CountriesController::class);
    Route::get('countries/is_active/{country}', [CountriesController::class, 'is_active'])->name('countries.is_active'); // Done

    // Activities Area
    Route::resource('activities', ActivitiesController::class); // Done
    Route::get('activities/is_active/{activitie}', [ActivitiesController::class, 'is_active'])->name('activities.is_active'); // Done

    // Projects Area
    Route::get('projects/remove_logo/{project}', [ProjectsController::class, 'remove_logo'])->name('projects.remove_logo'); // Done
    Route::resource('projects', ProjectsController::class); // Done
    Route::get('projects/is_active/{project}', [ProjectsController::class, 'is_active'])->name('projects.is_active'); // Done

    // Invoices Area
    Route::get('invoices/update_status/{invoice}/{status}', [InvoicesController::class, 'update_status'])->name('invoices.update_status'); // Done
    Route::get('invoices/print/{invoice}', [InvoicesController::class, 'print'])->name('invoices.print'); // Done
    Route::get('invoices/send_invoice_email/{invoice}', [InvoicesController::class, 'send_invoice_email'])->name('invoices.send_invoice_email'); // Done
    Route::get('invoices/export_pdf/{invoice}', [InvoicesController::class, 'export_pdf'])->name('invoices.export_pdf'); // Done
    Route::get('invoices/remove_signature/{invoice}', [InvoicesController::class, 'remove_signature'])->name('invoices.remove_signature'); // Done
    Route::resource('invoices', InvoicesController::class); // Done

    // Quotations Area
    Route::get('quotations/print/{quotation}', [QuotationsController::class, 'print'])->name('quotations.print'); // Done
    Route::get('quotations/export_pdf/{quotation}', [QuotationsController::class, 'export_pdf'])->name('quotations.export_pdf'); // Done
    Route::get('quotations/remove_signature/{quotation}', [QuotationsController::class, 'remove_signature'])->name('quotations.remove_signature'); // Done
    Route::resource('quotations', QuotationsController::class); // Done

    // Expenses Area
    Route::get('expenses/remove_file/{quotation}', [ExpensesController::class, 'remove_file'])->name('expenses.remove_file'); // Done
    Route::resource('expenses', ExpensesController::class); // Done

    // Emails Area
    Route::get('emails', [EmailsController::class, 'index'])->name('emails.index'); // Done
    Route::get('emails/send', [EmailsController::class, 'send'])->name('emails.send'); // Done
    Route::post('emails/store', [EmailsController::class, 'store'])->name('emails.store'); // Done
    Route::delete('emails/destroy/{email}', [EmailsController::class, 'destroy'])->name('emails.destroy'); // Done

    Route::get('/403', function(){
        return view('403');
    })->name('403'); // Done
});
