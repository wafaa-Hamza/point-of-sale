<?php

namespace App\Http\Controllers\Api\V1\User;

use Throwable;
use App\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\User\AuthInterface;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    use helpers;
    private  $authInterface;

    public function __construct(AuthInterface $authInterface)
    {

        $this->authInterface = $authInterface;
    }

    public function Register(Request $request)
    {


        $register = $this->authInterface->Register($request);

        if ($register->first()) {
            return $this->apiResponse(new GeneralCollection($register, AuthResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);

        }
    }

    public function Login(Request $request)
    {
        $login = $this->authInterface->Login($request);
       // return $this->apiResponse(new GeneralCollection($login, AuthResource::class));
        return $this->apiResponse(new AuthResource($login));

           // return $login;
        }










        //         if (is_numeric($request->phonenumber)) {
        //             if (!Auth::attempt($request->only(['phonenumber', 'password']))) {
        //                 return response()->json([
        //                     'status' => false,
        //                     'message' => 'Phone number & Password does not match with our record.',
        //                 ], 401);
        //             }
        //             $user = User::where('phonenumber', $request->phonenumber)->first();
        //         } else {

        //             if (!Auth::attempt($request->only(['email', 'password']))) {
        //                 return response()->json([
        //                     'status' => false,
        //                     'message' => 'Email & Password does not match with our record.',
        //                 ], 401);
        //             }
        //             $user = User::where('email', $request->email)->first();
        //         }
        //         // $tenant = tenant::find(1);
        //         // $tenant->notify(new LoginNotification()); 

        //         auth()->login($user);
        //         



        //         // $userPermissions = Permission::
        //         //     //selectRaw("'*', DB::raw('explode('-', name) as my_values')")
        //         //     whereHas('users', function ($q) use ($user) {
        //         //         $q->where('model_id', $user->id);
        //         //     })
        //         //     ->get();
        //         // foreach ($userPermissions as $permission) {
        //         //     $permissionExploded = explode('-', $permission->name);
        //         //     $permissionArr['action'] = $permissionExploded[0];
        //         //     $permissionArr['subject'] = $permissionExploded[1];
        //         //     // dd($permissionArr);
        //         //     array_push($allPermission, $permissionArr);
        //         // }

        //         return response()->json([
        //             'status' => true,
        //             'message' => 'User Logged In Successfully',
        //             'token' => $user->createToken("API TOKEN")->plainTextToken,
        //             //'userAbilities' => $userPermissions,
        //             // 'userAbilities' => $allPermission,
        //             'user' =>  $user,


        //         ], 200);
        //     } catch (\Throwable $th) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => $th->getMessage(),
        //         ], 500);
        //     }
        // }

        //     public function Logout(Request $request)
        //     {
        //         //  return $request;
        //         $user = $request->user();
        //         $accessToken = $user->currentAccessToken();
        //         $accessToken->delete();
        //         return response()->json([
        //             'message' => 'User Logged out Successfully',

        //         ]);
        //     }
    }
//}
