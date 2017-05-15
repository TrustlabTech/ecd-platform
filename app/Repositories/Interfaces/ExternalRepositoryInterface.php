<?php

namespace App\Repositories\Interfaces;

interface ExternalRepositoryInterface
{
    public function findWebUser($id);

    public function allWebUsers();

    public function createWebUser(array $webUser);

    public function updateWebUser(array $user, $id);

    public function deleteWebUser($id);

    public function emptyModel();

    public function findApiUser($id);

    public function allApiUsers();

    public function createApiUser(array $webUser);

    public function updateApiUser(array $user, $id);

    public function deleteApiUser($id);

    public function generateNewToken($id);
}
