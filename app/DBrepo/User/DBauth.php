<?php

namespace App\DBrepo\User;

use App\helpers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepoInterface\User\AuthInterface;
use App\RepoInterface\General\PosInterface;

class DBauth implements AuthInterface
{
    use helpers;
    private $userModel;
    private $posInterface;

    public function __construct(User $userModel,PosInterface $posInterface)
    {

        $this->userModel = $userModel;
        $this->posInterface = $posInterface;
    }

    public function Register($request)
    {

        $register = $this->userModel::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phonenumber' => $request->phonenumber,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $userRoles = Role::where('id', $request->role)->with('permissions')->first();
        // $userRole = Role::where('id', $request->role)->with('permissions')->first();
        // $userRole =  $register->syncPermissions($userRole->permissions);
        return $register;
    }


    public function Login($request)
    {
        // $login = $this->userModel::make(
        //     $request->all()
        // );
        if (is_numeric($request->phonenumber)) {

            if (!Auth::attempt($request->only(['phonenumber', 'password']))) {

                return $this->apiResponse(['message' => 'Phone number & Password does not match with our record']);
            } else {
                return $this->apiResponse(['message' => 'Phone number & Password  match with our record']);
            }

            $user = User::where('phonenumber', $request->phonenumber)->first();
        } else {


            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->apiResponse(['message' => 'Email & Password does not match with our record']);
            }
            $user = User::where('email', $request->email)->first();
            auth()->login($user);

            activity()
                    ->causedBy($user)
                   ->withProperties(['attributes' => $user])
                   ->log('User Successfully Logged In');
           

           $user = User::where('id',auth()->user()->id)->with('pos')->first();
           $user->syncPermissions('permission1');
           $permissions = $user->permissions;
     $token = $user->createToken('authToken')->plainTextToken;
     $this->posInterface->sowitchPos($request);
     $data = $user->get()->map(function($user)use($token,$permissions){
        $user->token = $token;
        $user->apilites = $permissions;
        return $user;
     });
     return $data->first();
        }


    }

    public function Logout($request)
    {
        $logout = $this->userModel::make($request->user());

        return $logout;
    }

}


