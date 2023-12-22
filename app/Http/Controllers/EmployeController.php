<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeRequest;
use App\Models\Departement;
use App\Models\Employe;
use Exception;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function create()
    {
        $departements = Departement::all();

        return view('employes.create',compact('departements'));
    }    


    public function index()
    {
        $employes= Employe::with('departement')->paginate(5);
        return view('employes.index', compact('employes'));
    }


    public function edit(Employe $employe)
    {
        $departements = Departement::all();
        return view('employes.edit',compact('employe','departements'));
    }

    public function store(EmployeRequest $request)
    {
        try{
            $employeData = $request->validated();
            Employe::create($employeData);
           $succes = 'Employe cree avec succes';
        }catch(Exception $e){
            dd($e);
        }

        return redirect()->route('employe.index')->with('succes',$succes);
    }

    public function update(EmployeRequest $request,Employe $employe)
    {
        try{
            $updateData  = $request->validated();
            Employe::updateOrCreate(['id'=>$employe->id],$updateData);
            $succes = 'Employe modifier avec succes';
        }catch(Exception $e){
            dd($e);
        }
        
        return redirect()->route('employe.index')->with('succes',$succes);
    }

    public function delete(Employe $employe)
    {
        try{
            $employe->delete();
            $succes = 'Employe supprimer';
        }catch(Exception $e){
            dd($e);
        }

        return back()->with('succes',$succes);
    }
}
