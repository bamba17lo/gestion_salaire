<?php

namespace App\Http\Controllers;

use App\Models\{
    Configuration,
    User, Departement, Employe
};
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Departement::all()->count();
        $totalEmployes = Employe::all()->count();
        $totalAdministrateurs = User::all()->count();
        $defaultPayment = Configuration::where('type','PAYMENT_DATE')->first();

        $notification ="";

        $currentDate = Carbon::now()->day;
        $datePaymentInt = intval($defaultPayment->value);

        if ($currentDate <= $datePaymentInt) {
            $notification = 'Le paiement doit avoir lieu le '.$datePaymentInt.' de ce mois';
        }else{
            $nextMonth = Carbon::now()->addMonth();
            $nextMonthName = $nextMonth->format('F');
            $notification = 'Le paiement doit avoir lieu le '.$datePaymentInt.' du mois de  '.$nextMonthName;

        }
        
        return view('dashboard',compact('totalDepartements','totalEmployes','totalAdministrateurs','notification'));
    }
}
