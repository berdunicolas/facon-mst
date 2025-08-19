<?php

namespace App\Http\Api\User\Controller; 

use Illuminate\Http\JsonResponse;

use App\Models\User;

use App\Http\Api\ApiController;
use App\Http\Api\ApiResource;
use App\Http\Api\User\Requests\UserQueryRequest;
use App\Http\Api\User\Requests\UserStoreRequest;
use App\Http\Api\User\Requests\UserUpdateRequest;
use App\Http\Api\User\Resources\UserResource;

class UserApiController extends ApiController
{
    protected string $resource;
    protected string $successfullStoreTask;
    protected string $successfullUpdateTask;
    protected string $failedStoreTask;
    protected string $failedUpdateTask;
    protected string $failedDeleteTask;

    public function __construct()
    {
        $this->resource = UserResource::class;
        $this->successfullStoreTask = __('User created successfully');
        $this->successfullUpdateTask = __('User updated successfully');
        $this->failedStoreTask = __('Error creating user');
        $this->failedUpdateTask = __('Error updating user');
        $this->failedDeleteTask = __('Error deleting user');
    }

    public function index(UserQueryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->datatableDraw(User::class, $validated, ['id', 'name', 'email']);
    }

    public function show(User $user): JsonResponse
    {
        return $this->getTask(function () {});
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->storeTask(function () use ($validatedData) {
            return User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => '',
            ]);
        });
    }

    public function update(User $user, UserUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->updateTask(function () use ($validatedData, $user) {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->save();
            return $user;
        });
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->deleteTask(function () use ($user) {
            $user->delete();
        });
    }
}
