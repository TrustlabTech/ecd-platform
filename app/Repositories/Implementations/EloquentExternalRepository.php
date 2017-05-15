<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\ExternalRepositoryInterface;
use App\Models\User;
use App\Models\Role;
use JWTAuth;
use JWTFactory;

class EloquentExternalRepository implements ExternalRepositoryInterface
{
    public function findWebUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->isExternalUser()) {
            return $user;
        }

        return false;
    }

    public function allWebUsers()
    {
        $role = Role::where('name', 'external_user')->first();

        return $role->users;
    }

    public function createWebUser(array $webUser)
    {
        $user = new User();
        $user->email = $webUser['email'];
        $user->password = bcrypt($webUser['password']);

        if ($user->save()) {
            $user->load('role');
            $role = Role::where('name', 'external_user')->first();
            $user->role()->attach($role);

            return true;
        }

        return false;
    }

    public function updateWebUser(array $user, $id)
    {
        $webUser = $this->findWebUser($id);

        if ($webUser !== null) {
            $webUser->email = $user['email'];

            if (isset($user['password'])) {
                $webUser->password = bcrypt($user['password']);
            }

            return $webUser->save();
        }

        return false;
    }

    public function deleteWebUser($id)
    {
        $webUser = $this->findWebUser($id);

        if ($webUser !== null) {
            $role = Role::where('name', 'external_user')->first();
            $webUser->role()->detach($role);

            return $webUser->delete();
        }

        return false;
    }

    public function emptyModel()
    {
        return new User();
    }

    public function findApiUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->isExternalApiUser()) {
            return $user;
        }

        return false;
    }

    public function allApiUsers()
    {
        $role = Role::where('name', 'external_api')->first();

        return $role->users;
    }

    public function createApiUser(array $webUser)
    {
        $user = new User();
        $user->email = $webUser['email'];
        $user->password = bcrypt($webUser['password']);

        if ($user->save()) {
            $user->load('role');
            $role = Role::where('name', 'external_api')->first();
            $user->role()->attach($role);

            // Generate token for username
            $time = time();
            $claims = ['email' => $webUser['email'], 'time' => $time];
            $payload = JWTFactory::make($claims);
            $token = JWTAuth::encode($payload);
            $user->username = $token;
            $user->save();

            return true;
        }

        return false;
    }

    public function updateApiUser(array $user, $id)
    {
        $apiUser = $this->findApiUser($id);

        if ($apiUser !== null) {
            $apiUser->email = $user['email'];

            if (isset($user['password'])) {
                $apiUser->password = bcrypt($user['password']);
            }

            return $apiUser->save();
        }

        return false;
    }

    public function deleteApiUser($id)
    {
        $apiUser = $this->findApiUser($id);

        if ($apiUser !== null) {
            $role = Role::where('name', 'external_api')->first();
            $apiUser->role()->detach($role);

            return $apiUser->delete();
        }

        return false;
    }

    public function generateNewToken($id)
    {
        $apiUser = $this->findApiUser($id);

        if ($apiUser !== null) {
            $apiUser->username = JWTAuth::fromUser($apiUser);
            $apiUser->save();

            return true;
        }

        return false;
    }
}
