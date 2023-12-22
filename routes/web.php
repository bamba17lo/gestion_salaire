<?php

use App\Http\Controllers\{
    AdminController,
    AuthController, AppController,
    EmployeController, DepartementController, 
    ConfigurationController,
    PaymentController,
};
use Illuminate\Support\Facades\Route;

// ------------------- AuthController
Route::get('/',[AuthController::class, 'login'])->name('login');
Route::post('/',[AuthController::class, 'postLogin'])->name('post.login');

//Route securisee
Route::middleware('auth')->group(function(){
    Route::get('dashboard',[AppController::class, 'index'])->name('dashboard');


    Route::prefix('employes')->group(function (){
        Route::get('/',[EmployeController::class, 'index'])->name('employe.index');
        Route::get('/edit/{employe}',[EmployeController::class, 'edit'])->name('employe.edit');
        Route::get('/create',[EmployeController::class, 'create'])->name('employe.create');
        Route::get('delete/{employe}',[EmployeController::class, 'delete'])->name('employe.delete');

        Route::put('/update/{employe}',[EmployeController::class, 'update'])->name('employe.update');

        Route::post('/store',[EmployeController::class,'store'])->name('employe.store');
    });


    Route::prefix('departements')->group(function (){
        Route::get('/',[DepartementController::class, 'index'])->name('departement.index');
        Route::get('/edit/{departement}',[DepartementController::class, 'edit'])->name('departement.edit');
        // Suppression avec la premiere methode voir index de departement
        Route::get('/delete/{departement}',[DepartementController::class, 'delete'])->name('departement.delete');
        Route::get('/create',[DepartementController::class, 'create'])->name('departement.create');

        Route::put('/update/{departement}',[DepartementController::class, 'update'])->name('departement.update');

        // Suppression avec la deuxieme methode voir index de departement
        // Route::delete('/delete/{departement}',[DepartementController::class, 'delete'])->name('departement.delete');

        Route::post('/create',[DepartementController::class, 'store'])->name('departement.store');
    });

    //--------CONFIGURATION

    Route::prefix('configuration')->group(function (){
        Route::get('/',[ConfigurationController::class, 'index'])->name('conf.index');
        Route::get('create',[ConfigurationController::class, 'create'])->name('conf.create');
        Route::get('/delete/{config}',[ConfigurationController::class, 'delete'])->name('conf.delete');



        Route::post('create',[ConfigurationController::class, 'store'])->name('conf.store');

    });


    Route::prefix('admin')->group(function(){
        Route::get('/',[AdminController::class , 'index'])->name('admin.index');
        Route::get('/delete/{user}',[AdminController::class , 'delete'])->name('admin.delete');
        Route::get('/edit/{user}',[AdminController::class , 'edit'])->name('admin.edit');
        Route::get('/create',[AdminController::class , 'create'])->name('admin.create');


        Route::put('/update/{admin}',[AdminController::class , 'update'])->name('admin.update');


        Route::post('/store',[AdminController::class , 'store'])->name('admin.store');

    });

    Route::prefix('payment')->group(function(){
        Route::get('/',[PaymentController::class , 'index'])->name('payment.index');
        Route::get('/make',[PaymentController::class, 'initPayment'])->name('payment.make');
        Route::get('/download/{payment}',[PaymentController::class,'download'])->name('payment.download');

    });


    Route::get('/validate-account/{email}',[AdminController::class, 'validateCompte'])->name('admin.validate');
    Route::post('/validate-account/{email}',[AdminController::class, 'submitAccount'])->name('admin.submit');
});