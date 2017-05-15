<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Implementations\EloquentAdminRepository;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    protected $adminRepository;

    public function setUp()
    {
        parent::setUp();
        $this->adminRepository = new EloquentAdminRepository(new Admin());
    }

    /** @test */
    public function admins_can_be_found()
    {
        $newAdmins = $this->getAdmin();

        $admins = $this->adminRepository->find($newAdmins->id);

        $this->assertEquals($newAdmins->id, $admins->id);
    }

    /** @test */
    public function all_admins_can_be_retrieved()
    {
        $newAdmins = $this->getAdmin(10);

        $admins = $this->adminRepository->all();

        $this->assertCount(10, $admins);
    }

    /** @test */
    public function admins_may_be_paginated()
    {
        $newAdmins = $this->getAdmin(20);

        $admins = $this->adminRepository->paginate(5);

        $this->assertCount(5, $admins);
    }

    /** @test */
    public function admins_may_be_created()
    {
        $createAdmin = [
            'email' => 'lolcat@lolcat.com',
            'password' => 'lolcat',
            'first_name' => 'Lolcat',
            'last_name' => 'Lolcat'
        ];

        $this->adminRepository->create($createAdmin);

        $newAdmin = Admin::first();

        $this->assertNotNull($newAdmin);
    }

    /** @test */
    public function admins_may_be_updated()
    {
        $newAdmin = $this->getAdmin();

        $updateAdmin = [
            'first_name' => 'HelloWorldName',
            'last_name' => 'HelloWorldLastName',
            'email' => 'lolcat@lolcat.com'
        ];

        $this->adminRepository->update($updateAdmin, $newAdmin->id);

        $updatedAdmin = $this->adminRepository->find($newAdmin->id);

        $this->assertEquals('HelloWorldName', $updatedAdmin->first_name);
    }

    /** @test */
    public function admin_may_be_deleted()
    {
        $newAdmin = $this->getAdmin();

        $this->adminRepository->delete($newAdmin->id);

        $this->assertCount(0, Admin::all());
    }

    /** @test */
    public function admin_and_user_record_needs_to_be_deleted()
    {
        $newAdmin = $this->getAdmin();

        $this->adminRepository->delete($newAdmin->id);

        $user = User::find($newAdmin->user_id);

        $this->assertEquals(null, $user);
    }

    /** @test */
    public function admin_may_return_empty_model()
    {
        $emptyAdmin = $this->adminRepository->emptyModel();

        $this->assertFalse($emptyAdmin->exists());
    }

    protected function getAdmin($num = 1)
    {
        return factory(App\Models\Admin::class, $num)->create();
    }
}
