<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\SubmitAccountAdmin;
use App\Models\ResetCodeNotification;
use App\Models\User;
use App\Notifications\EmailNotificationToAdmin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{

    public function index()
    {
        $allAdmin = User::paginate(10);
        return view('admin/index',compact('allAdmin'));
    }
    public function create()
    {
        return view('admin.create');
    }

    public function edit(User $user)
    {

        return view('admin/edit',compact('user'));
    }

    public function store(AdminRequest $request)
    {
        
        try{
            $AdminData = $request->validated();
            $AdminData['password'] = bcrypt('passer1234');
            $user  = User::create($AdminData);

           $succes = 'Admin cree avec succes';

           // envoyer un email  pour confirmer son compte

           // envoyer un code par mail pour verification 
            if($user)
            {
                try{
                    ResetCodeNotification::where('email',$request->email)->delete();
                    $code = rand(1000,4000); 
    
                    $data = [
                        'code' =>$code,
                        'email'=>$request->email,
                    ];
    
                    ResetCodeNotification::create($data);
                    Notification::route('mail',$request->email)->notify(new EmailNotificationToAdmin($code,$request->email));
                }catch(Exception $e){
                    dd($e);
                }
            }

        }catch(Exception $e){
            dd($e);
        } 

        return redirect()->route('admin.index')->with('succes',$succes);

    }


    public function update(AdminRequest $request)
    {
        try{
           
            $AdminData = $request->validated();
            User::updateOrCreate($AdminData);
           $succes = 'Admin modifie avec succes';
        }catch(Exception $e){
            dd($e);
        } 

        return redirect()->route('admin.index')->with('succes',$succes);
    }

    public function delete(User $user)
    {
        $succes= 'Administrateur supprime avec succes';
        $error= 'Vous ne pouvez pas supprimer votre compte';
        try{
            $userConnected = Auth::user()->id;
            if ($userConnected !=$user->id) {
                $user->delete();
                return back()->with('succes',$succes);
            }else{
                return back()->with('error',$error);
            }

        }catch(Exception $e){
            dd($e);
        } 

    }

    public function validateCompte($email)
    {
        $checkExistUser = User::where('email',$email)->first();
        if($checkExistUser)
        {
            return view('auth.validateCompte',compact('email'));
        }else{
            return redirect()->route('login');
        }
    }

    public function submitAccount(SubmitAccountAdmin $request)
    {
        try{
            $admin = User::where('email',$request->email)->first();
            if ($admin) {
                $admin->password = bcrypt($request->password);
                $admin->email_verified_at = now();
                $admin->update();
                if($admin){
                    ResetCodeNotification::where('email',$request->email)->delete();
                }

                $succes = 'Vous etes desormais un Administrateur';

            }
        }catch(Exception $e){
            dd($e);
        }

        return redirect()->route('login')->with('succes',$succes);

    }
}

