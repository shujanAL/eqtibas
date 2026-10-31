<?php
use App\Http\Controllers\Auth\LoginController; use App\Http\Controllers\Auth\RegisterController; use App\Http\Controllers\QuoteController; use Illuminate\Support\Facades\Route;
Route::get('/up', fn () => response()->json(['status' => 'ok']));
Route::get('/',[QuoteController::class,'index'])->name('quotes.index');
Route::middleware('guest')->group(function(){Route::get('/register',[RegisterController::class,'create'])->name('register');Route::post('/register',[RegisterController::class,'store']);Route::get('/login',[LoginController::class,'create'])->name('login');Route::post('/login',[LoginController::class,'store']);});
Route::middleware('auth')->group(function(){Route::post('/logout',[LoginController::class,'destroy'])->name('logout');Route::post('/quotes',[QuoteController::class,'store'])->name('quotes.store');Route::get('/quotes/{quote}/edit',[QuoteController::class,'edit'])->name('quotes.edit');Route::put('/quotes/{quote}',[QuoteController::class,'update'])->name('quotes.update');Route::delete('/quotes/{quote}',[QuoteController::class,'destroy'])->name('quotes.destroy');});
