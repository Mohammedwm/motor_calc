<?php

use App\Http\Livewire\AddPaymentComponent;
use App\Http\Livewire\ConstantComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\MeterReadComponent;
use App\Http\Livewire\BeneficiaryComponent;
use App\Http\Livewire\EmployeeComponent;
use App\Http\Livewire\PaymentComponent;
use App\Models\employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now crneate something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('home');
Route::get('/MeterRead', MeterReadComponent::class)->name('MeterRead');
Route::get('/Payment', PaymentComponent::class)->name('Payment');
Route::get('/AddPayment', AddPaymentComponent::class)->name('AddPayment');

Route::get('/beneficiaries', BeneficiaryComponent::class)->name('Beneficiaries');
Route::get('/Constants', ConstantComponent::class)->name('Constants');
Route::get('/Employee', EmployeeComponent::class)->name('Employee');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
