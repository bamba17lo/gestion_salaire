<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuration;
use Exception;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $allConfigurations = Configuration::latest()->paginate(5);
        return view('config/index',compact('allConfigurations'));
    }

    public function create()
    {
        return view('config.create');

    }

    public function store(ConfigurationRequest $request)
    {
        try{
            $dataConfig  = $request->validated();
            Configuration::create($dataConfig);
            $succes = 'Configuration ajouter';
        }catch(Exception $e){
            dd($e);
            throw new Exception('Erreur lors de l\'enregistrement');
        }

        return redirect()->route('conf.index')->with('succes',$succes);
    }

    public function delete(Configuration $config)
    {
        try{
            $config->delete();
            $succes = 'Cette configuration a ette supprime';
        }catch(Exception $e){
            dd($e);
            throw new Exception('Erreur lors de la suppression');
        }

        return redirect()->route('conf.index')->with('succes',$succes);

    }
}
