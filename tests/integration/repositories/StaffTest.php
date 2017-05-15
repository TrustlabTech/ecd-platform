<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Staff;
use App\Models\User;
use App\Repositories\Implementations\EloquentStaffRepository;

class StaffTest extends TestCase
{
    use DatabaseTransactions;

    protected $staffRepository;

    public function setUp()
    {
        parent::setUp();
        $this->staffRepository = new EloquentStaffRepository(new Staff());
    }

    /** @test */
    public function staff_can_be_found()
    {
        $newStaff = $this->getStaff();

        $staff = $this->staffRepository->find($newStaff->id);

        $this->assertEquals($newStaff->id, $staff->id);
    }

    /** @test */
    public function all_staff_may_be_retrieved()
    {
        $newStaff = $this->getStaff(10);

        $staff = $this->staffRepository->all();

        $this->assertCount(10, $staff);
    }

    /** @test */
    public function staff_may_be_paginated()
    {
        $newStaff = $this->getStaff(20);

        $staff = $this->staffRepository->paginate(5);

        $this->assertCount(5, $staff);
    }

    /** @test */
    public function staff_may_be_created()
    {
        $this->staffRepository->create(factory(App\Models\Staff::class, 'user_staff')->make()->toArray());

        $newStaff = Staff::first();

        $this->assertNotNull($newStaff);
    }

    /** @test */
    public function staff_may_be_updated()
    {
        $newStaff = $this->getStaff();

        $updateStaff = [
            'given_name' => 'HelloWorldName'
        ];

        $this->staffRepository->update($updateStaff, $newStaff->id);

        $updatedStaff = $this->staffRepository->find($newStaff->id);

        $this->assertEquals('HelloWorldName', $updatedStaff->given_name);
    }

    /** @test */
    public function staff_may_be_deleted()
    {
        $newStaff = $this->getStaff();

        $this->staffRepository->delete($newStaff->id);

        $this->assertCount(0, Staff::all());
    }

    /** @test */
    public function staff_and_user_record_needs_to_be_deleted()
    {
        $newStaff = $this->getStaff();

        $this->staffRepository->delete($newStaff->id);

        $user = User::find($newStaff->user_id);

        $this->assertEquals(null, $user);
    }

    /** @test */
    public function staff_should_be_searchable_by_given_name()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->given_name);

        $this->assertGreaterThanOrEqual(1, $staffResults->count());
    }

    /** @test */
    public function staff_should_be_searchable_by_family_name()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->family_name);

        $this->assertGreaterThanOrEqual(1, $staffResults->count());
    }

    /** @test */
    public function staff_should_be_searchable_by_za_id_number()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->za_id_number);

        $this->assertCount(1, $staffResults);
    }

    /** @test */
    public function staff_should_be_searchable_by_cell_number()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->user->username);

        $this->assertGreaterThanOrEqual(1, $staffResults->count());
    }

    /** @test */
    public function staff_should_be_searchable_by_combination_with_family_name_and_given_name()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->family_name . ' ' . $newStaff[4]->given_name);

        $this->assertGreaterThanOrEqual(1, $staffResults->count());
    }

    /** @test */
    public function staff_should_be_searchable_by_combination_with_given_name_and_family_name()
    {
        $newStaff = $this->getStaff(10);

        $staffResults = $this->staffRepository->search($newStaff[4]->given_name . ' ' . $newStaff[4]->family_name);

        $this->assertGreaterThanOrEqual(1, $staffResults->count());
    }

    /** @test */
    public function staff_may_return_empty_model()
    {
        $emptyStaff = $this->staffRepository->emptyModel();

        $this->assertFalse($emptyStaff->exists());
    }

    /** @test */
    public function staff_may_return_results_for_external()
    {
        $newStaff = $this->getStaff(10);

        $externalStaff = $this->staffRepository->externalAll();

        $this->assertEquals(10, count($externalStaff));
    }

    protected function getStaff($num = 1)
    {
        return factory(App\Models\Staff::class, $num)->create();
    }
}
