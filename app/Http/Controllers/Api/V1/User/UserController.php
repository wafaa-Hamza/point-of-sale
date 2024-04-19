<?php

namespace  App\Http\Controllers\Api\V1\User;

use App\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\User\UserInterface;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use helpers;
    private  $userInterface;
    public function __construct(UserInterface $userInterface)

    {

        $this->userInterface = $userInterface;
    }

    public function index()
    {
        $userData = $this->userInterface->index();

        if ($userData->first()) {

            return $this->apiResponse(new GeneralCollection($userData, UserResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $userStore = $this->userInterface->store($request);


        return $this->apiResponse(new UserResource($userStore), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userShow = $this->userInterface->show($id);
        if ($userShow) {
            return $this->apiResponse(new GeneralCollection($userShow, UserResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {

        $userUpdate = $this->userInterface->update($request, $id);

        if ($userUpdate) {

            return $this->apiResponse(['data' => new UserResource($userUpdate)]);
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userTrashed = $this->userInterface->destroy($id);

        if ($userTrashed) {
            return $this->apiResponse(new GeneralCollection($userTrashed, UserResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
