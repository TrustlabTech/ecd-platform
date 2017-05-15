<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;

class EloquentAdminRepository extends AbstractEloquentRepository implements AdminRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function create(array $admin)
    {
        $user = new User();
        $user->email = $admin['email'];
        $user->password = bcrypt($admin['password']);

        if ($user->save()) {
            $user->load('role');
            $role = Role::where('name', 'admin')->first();
            $user->role()->attach($role);

            $adminUser = new Admin();
            $adminUser->first_name = $admin['first_name'];
            $adminUser->last_name = $admin['last_name'];
            $adminUser->user_id = $user->id;

            if ($adminUser->save()) {
                return true;
            } else {
                $user->role()->detach($role);
                $user->delete();

                return false;
            }
        }
    }

    public function update(array $admin, $id)
    {
        $adminUser = Admin::findOrfail($id);
        $adminUser->first_name = $admin['first_name'];
        $adminUser->last_name = $admin['last_name'];
        $adminUser->user->email = $admin['email'];
        $adminUser->user->save();

        return $adminUser->save();
    }

    public function delete($id)
    {
        $admin = Admin::findOrfail($id);
        $role = Role::where('name', 'admin')->first();
        $admin->user->role()->detach($role);

        if ($admin->user->delete()) {
            return $admin->delete();
        } else {
            $admin->user->role()->attach($role);
        }

        return false;
    }

    public function emptyModel()
    {
        $user = new User();
        $admin = new Admin();
        $admin->user = $user;

        return $admin;
    }
}
