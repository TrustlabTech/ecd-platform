<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use App\Repositories\Implementations\EloquentExternalRepository;

class ExternalTest extends TestCase
{
    use DatabaseTransactions;

    protected $externalRepository;

    public function setUp()
    {
        parent::setUp();
        $this->externalRepository = new EloquentExternalRepository();
    }

    /** @test */
    public function external_may_find_and_create_web_user()
    {
        $webUser = $this->createWebUser();

        $this->assertNotNull($webUser);
    }

    /** @test */
    public function external_may_return_all_web_users()
    {
        $createWebUserOne = [
            'email' => 'lolcat1@lolcat.com',
            'password' => 'lolcat1',
        ];

        $createWebUserTwo = [
            'email' => 'lolcat2@lolcat.com',
            'password' => 'lolcat2',
        ];

        $this->externalRepository->createWebUser($createWebUserOne);
        $this->externalRepository->createWebUser($createWebUserTwo);

        $webUsers = $this->externalRepository->allWebUsers();

        $this->assertCount(2, $webUsers);
    }

    /** @test */
    public function external_may_update_web_user()
    {
        $webUser = $this->createWebUser();

        $updateWebUser = [
            'email' => 'hello@world.com'
        ];

        $this->externalRepository->updateWebUser($updateWebUser, $webUser->id);

        $role = Role::where('name', 'external_user')->first();
        $webUserUpdated = User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();

        $this->assertEquals('hello@world.com', $webUserUpdated->email);
    }

    /** @test */
    public function external_may_delete_web_user()
    {
        $webUser = $this->createWebUser();

        $this->externalRepository->deleteWebUser($webUser->id);

        $role = Role::where('name', 'external_user')->first();
        $webUser = User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();

        $this->assertNull($webUser);
    }

    /** @test */
    public function external_may_return_empty_model()
    {
        $emptyWebUser = $this->externalRepository->emptyModel();

        $this->assertFalse($emptyWebUser->exists());
    }

    /** @test */
    public function external_may_find_and_create_api_user()
    {
        $apiUser = $this->createApiUser();

        $this->assertNotNull($apiUser);
    }

    /** @test */
    public function external_may_return_all_api_users()
    {
        $createApiUserOne = [
            'email' => 'lolcat1@lolcat.com',
            'password' => 'lolcat1',
        ];

        $createApiUserTwo = [
            'email' => 'lolcat2@lolcat.com',
            'password' => 'lolcat2',
        ];

        $this->externalRepository->createApiUser($createApiUserOne);
        $this->externalRepository->createApiUser($createApiUserTwo);

        $apiUsers = $this->externalRepository->allApiUsers();

        $this->assertCount(2, $apiUsers);
    }

    /** @test */
    public function external_may_update_api_user()
    {
        $apiUser = $this->createApiUser();

        $updateApiUser = [
            'email' => 'hello@world.com'
        ];

        $this->externalRepository->updateApiUser($updateApiUser, $apiUser->id);

        $role = Role::where('name', 'external_api')->first();
        $apiUserUpdated = User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();

        $this->assertEquals('hello@world.com', $apiUserUpdated->email);
    }

    /** @test */
    public function external_may_delete_api_user()
    {
        $apiUser = $this->createApiUser();

        $this->externalRepository->deleteApiUser($apiUser->id);

        $role = Role::where('name', 'external_api')->first();
        $apiUser = User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();

        $this->assertNull($apiUser);
    }

    /** @test */
    public function external_may_generate_new_token_for_api_user()
    {
        $apiUser = $this->createApiUser();
        $this->externalRepository->generateNewToken($apiUser->id);
        $user = User::find($apiUser->id);

        $this->assertTrue($apiUser->username !== $user->username);
    }

    protected function createWebUser()
    {
        $createWebUser = [
            'email' => 'lolcat1@lolcat.com',
            'password' => 'lolcat1',
        ];

        $this->externalRepository->createWebUser($createWebUser);

        $role = Role::where('name', 'external_user')->first();

        return User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();
    }

    protected function createApiUser()
    {
        $createApiUser = [
            'email' => 'lolcat1@lolcat.com',
            'password' => 'lolcat1',
        ];

        $this->externalRepository->createApiUser($createApiUser);

        $role = Role::where('name', 'external_api')->first();

        return User::whereHas('role', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->first();
    }
}
