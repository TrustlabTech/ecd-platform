<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\CentreClass;
use App\Models\Centre;
use App\Repositories\Implementations\EloquentCentreClassRepository;

class CentreClassTest extends TestCase
{
    use DatabaseTransactions;

    protected $centreClassRepository;

    public function setUp()
    {
        parent::setUp();
        $this->centreClassRepository = new EloquentCentreClassRepository(new CentreClass());
    }

    /** @test */
    public function classes_can_be_found()
    {
        $newCentreClass = $this->getCentreClasses();

        $centreClass = $this->centreClassRepository->find($newCentreClass->id);

        $this->assertEquals($newCentreClass->id, $centreClass->id);
    }

    /** @test */
    public function all_classes_can_be_retrieved()
    {
        $newCentreClasses = $this->getCentreClasses(10);

        $centreClasses = $this->centreClassRepository->all();

        $this->assertCount(10, $centreClasses);
    }

    /** @test */
    public function classes_may_be_paginated()
    {
        $newCentreClasses = $this->getCentreClasses(20);

        $centreClasses = $this->centreClassRepository->paginate(5);

        $this->assertCount(5, $centreClasses);
    }

    /** @test */
    public function classes_may_be_created()
    {
        $this->centreClassRepository->create(factory(App\Models\CentreClass::class)->make()->toArray());

        $newClass = CentreClass::first();

        $this->assertNotNull($newClass);
    }

    /** @test */
    public function classes_may_be_updated()
    {
        $newCentreClass = $this->getCentreClasses();

        $updateCentreClass = [
            'name' => 'HelloWorldClass'
        ];

        $this->centreClassRepository->update($updateCentreClass, $newCentreClass->id);

        $updatedCentreClass = $this->centreClassRepository->find($newCentreClass->id);

        $this->assertEquals('HelloWorldClass', $updatedCentreClass->name);
    }

    /** @test */
    public function classes_may_be_deleted()
    {
        $newCentreClass = $this->getCentreClasses();

        $this->centreClassRepository->delete($newCentreClass->id);

        $this->assertCount(0, CentreClass::all());
    }

    /** @test */
    public function classes_may_be_retrieved_via_centre_id()
    {
        $centreOne = factory(App\Models\Centre::class)->create();
        $centreTwo = factory(App\Models\Centre::class)->create();

        $centreOneClasses = factory(App\Models\CentreClass::class, 5)->create(['centre_id' => $centreOne->id]);
        $centreTwoClasses = factory(App\Models\CentreClass::class, 5)->create(['centre_id' => $centreTwo->id]);

        $centreClassResults = $this->centreClassRepository->byCentre($centreTwo->id);

        $this->assertCount(5, $centreClassResults);
        $this->assertEquals($centreTwo->id, $centreClassResults[0]->centre_id);
    }

    // SQLite does not support the CONCAT method that
    // $this->centreClassRepository->allWithCentreName() use

    // /** @test */
    // public function classes_may_be_retrieved_with_centre_name()
    // {
    //     $centre = factory(App\Models\Centre::class)->create();
    //     $centreClasses = factory(App\Models\CentreClass::class, 5)->create(['centre_id' => $centre->id]);
    //
    //     $centreClassResults = $this->centreClassRepository->allWithCentreName();
    //
    //     $this->assertEquals($centre->name, $centreClassResults[0]->name);
    //
    // }

    /** @test */
    public function classes_may_be_searched_by_name()
    {
        $newCentreClasses = $this->getCentreClasses(20);

        $centreClassResults = $this->centreClassRepository
                                    ->search($newCentreClasses[5]->name);

        $this->assertGreaterThanOrEqual(1, $centreClassResults->count());
    }

    /** @test */
    public function classes_may_be_searched_by_centre_name()
    {
        $newCentreClasses = $this->getCentreClasses(20);

        $centreClassResults = $this->centreClassRepository
                                    ->search($newCentreClasses[5]->centre->name);

        $this->assertGreaterThanOrEqual(1, $centreClassResults->count());
    }

    /** @test */
    public function classes_may_return_empty_model()
    {
        $emptyCentreClass = $this->centreClassRepository->emptyModel();

        $this->assertFalse($emptyCentreClass->exists());
    }

    /** @test */
    public function classes_may_return_results_for_external()
    {
        $newCentreClasses = $this->getCentreClasses(10);

        $centreClassResults = $this->centreClassRepository->externalAll();

        $this->assertCount(10, $centreClassResults);
    }

    protected function getCentreClasses($num = 1)
    {
        return factory(App\Models\CentreClass::class, $num)->create();
    }
}
