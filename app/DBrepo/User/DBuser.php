<?php

namespace App\DBrepo\User;

use Exception;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\RepoInterface\User\UserInterface;

class DBuser implements UserInterface
{
    private $userModel;
    public function __construct(User $userModel)
    {

        $this->userModel = $userModel;
    }
    public function index()
    {
        $user = $this->userModel::get();
        return $user;
    }

    public function show($id)
    {
        $userShow = $this->userModel::where('id', $id)->get();
        return $userShow;
    }

    public function store($request)
    {
        $user = $this->userModel::create([

            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'language' => $request->language,
        ]);
        if($request->has('pos'))
        {
            $userData = $this->userModel->where('id',$user->id)->first();
            $userData->pos()->sync($request->pos);
        }
        // $userRoles = Role::where('id', $request->role)->with('permissions')->first();

        // $user->syncPermissions([$userRoles->permissions]);

        return $user;
    }

    public function update($request, $id)
    {
        try {
            $userdata = $this->userModel::where('id', $id)->first();
            $userUpdate = $this->userModel::where('id', $id)->update([

                'firstname'   => (!empty($request->firstname)) ? $request->firstname : $userdata->firstname,
                'lastname'    => (!empty($request->lastname)) ? $request->lastname : $userdata->lastname,
                'phonenumber' => (!empty($request->phonenumber)) ? $request->firsphonenumbertname : $userdata->phonenumber,
                'email'       => (!empty($request->email)) ? $request->email : $userdata->email,
                'role'        => (!empty($request->role)) ? $request->role : $userdata->role,
                'language'    => (!empty($request->language)) ? $request->language : $userdata->language,

            ]);

            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }


        // $userRoles = Role::where('id', $request->role)->with('permissions')->first();

        // $userUpdate->syncPermissions([$userRoles->permissions]);

    }
    public function destroy($id)
    {
        $userTrashed = $this->userModel::where('id', $id)->delete();
        return $userTrashed;
    }
}
