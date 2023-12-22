<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Employe;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use PDF;

class PaymentController extends Controller
{
    public function index(){
        $defaultPayment = Configuration::where('type','PAYMENT_DATE')->first();

        $datePaymentInt = intval($defaultPayment->value);
        $today = date('d');
        $isPayment = false;
        if($today == $datePaymentInt){
            $isPayment = true;
        }
        $payments = Payment::latest()->orderBy('id')->paginate(10);
        return view('payment.index',compact('payments','isPayment'));
    }

    public function initPayment(){
        $month = [
            'JANUARY'=>'JANVIER',
            'FEBRUARY'=>'FEVRIER',
            'MARCH'=>'MARS',
            'APRIL'=>'AVRIL',
            'MAY'=>'MAI',
            'JUNE'=>'JUIN',
            'JULY'=>'JUILLET',
            'AUGUST'=>'AOUT',
            'SEPTEMBER'=>'SEPTEMBRE',
            'OCTOBER'=>'OCTOBRE',
            'NOVEMBER'=>'NOVEMBRE',
            'DECEMBER'=>'DECEMBRE',
        ];
        Carbon::setLocale('fr');
        // mois en cour en francais
        $currentMonthInFrench = strtoupper(Carbon::now()->translatedFormat('F'));
        // annee en cour 
        $currentYears = Carbon::now()->format('Y');

        // paiement de tout les employe dans le mois en cour 

        // recupere la liste des employe qui non pas ete payer pour le mois en cour
        $employes = Employe::whereDoesntHave('payments',function($query) use($currentMonthInFrench,$currentYears){
            $query->where('mois',$currentMonthInFrench)
            ->where('annee',$currentYears);
        })->get();

        if($employes->count()===0){
            return back()->with('error','Tous les employes ont ete paye pour ce mois '.$currentMonthInFrench);
        };

        // boucler puis verifie si employe a ete paye
        foreach ($employes as $value) {
            $aEtePayer = $value->payments()->where('mois',$currentMonthInFrench)
            ->where('annee',$currentYears)->exists();

            if (!$aEtePayer) {
                $salaire = $value->montant_journalier *31;
                $paiement = new Payment();
                
                $paiement->references= strtoupper(Str::random(10));
                $paiement->employes_id  = $value->id;
                $paiement->montant = $salaire;  
                $paiement->launch_date = now();
                $paiement->done_date = now();
                $paiement->launch_date = now();
                $paiement->status = 'SUCCESS';
                $paiement->mois= $currentMonthInFrench;
                $paiement->annee= $currentYears;
                $paiement->save();
            }
        }

        return back()->with('succes','Paiement des employes effectuer pour le mois de '.$currentMonthInFrench);
    }

    /// Generer PDF
    public function download(Payment $payment)
    {
        try {
            $fullPaymentInfo= Payment::with('employe')->find($payment->id);
// generer PDF
            // return view('payment.facture',compact('fullPaymentInfo'));
            $pdf = PDF::loadView('payment.facture',compact('fullPaymentInfo'));
            return $pdf->download('facture_'.$fullPaymentInfo->employe->nom.'.pdf');
        } catch (Exception $e) {
            throw new Exception('Une erreur est survenue lors du telechargement du fichier');
        }
    }
}
