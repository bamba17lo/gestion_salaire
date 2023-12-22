<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartementRequest;
use App\Models\Departement;
use Exception;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function create()
    {
        return view('departements.create');
    }    


    public function index()
    {
        $departements= Departement::paginate(5);
        return view('departements.index', compact('departements'));
    }


    public function edit(Departement $departement)
    {
        return view('departements.edit',compact('departement'));
    }




    // Interaction avec la BD
    public function store (DepartementRequest $request)
    {
        // Creation d'un nouveau departement
        try{

            $departementData = $request->validated();
            Departement::create($departementData);
            $success = 'Le Departement '.request('name').' a ete ajoute avec succes';

        }catch(Exception $e){
            dd($e);
        }
        
        return redirect()->route('departement.index')->with('succes',$success);

    }


    public function update(DepartementRequest $request, Departement $departement)
    {
        try{

            $departementData = $request->validated();
            Departement::updateOrCreate([
                'id'=> $departement->id],
                $departementData
            );

            $success = 'Le Departement a ete modifier avec succes';

        }catch(Exception $e){
            dd($e);
        }
        return redirect()->route('departement.index')->with('succes',$success );
    }

    public function delete(Departement $departement)
    {
        try{
            $departement->delete();
            $success= 'Departement supprime avec succes';
        }catch(Exception $e){
            dd($e);
        }
        return redirect()->route('departement.index')->with('succes',$success );
    }
}
