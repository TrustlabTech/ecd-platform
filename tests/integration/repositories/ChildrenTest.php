<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Child;
use App\Repositories\Implementations\EloquentChildRepository;

class ChildrenTest extends TestCase
{
    use DatabaseTransactions;

    protected $childRepository;

    public function setUp()
    {
        parent::setUp();
        $this->childRepository = new EloquentChildRepository(new Child());
    }

    /** @test */
    public function children_can_be_found()
    {
        $newChildren = $this->getChildren();

        $children = $this->childRepository->find($newChildren->id);

        $this->assertEquals($newChildren->id, $children->id);
    }

    /** @test */
    public function all_children_can_be_retrieved()
    {
        $newChildren = $this->getChildren(10);

        $children = $this->childRepository->all();

        $this->assertCount(10, $children);
    }

    /** @test */
    public function children_may_be_paginated()
    {
        $newChildren = $this->getChildren(20);

        $children = $this->childRepository->paginate(5);

        $this->assertCount(5, $children);
    }

    /** @test */
    public function children_may_be_created()
    {
        $this->childRepository->create(factory(App\Models\Child::class)->make()->toArray());

        $newChildren = Child::first();

        $this->assertNotNull($newChildren);
    }

    /** @test */
    public function children_may_be_updated()
    {
        $newChildren = $this->getChildren();

        $updateChildren = [
            'given_name' => 'HelloWorldName'
        ];

        $this->childRepository->update($updateChildren, $newChildren->id);

        $updatedChildren = $this->childRepository->find($newChildren->id);

        $this->assertEquals('HelloWorldName', $updatedChildren->given_name);
    }

    /** @test */
    public function children_may_be_deleted()
    {
        $newChildren = $this->getChildren();

        $this->childRepository->delete($newChildren->id);

        $this->assertCount(0, Child::all());
    }

    /** @test */
    public function children_may_be_retrieved_by_class_name()
    {
        $centreOneClasses = factory(App\Models\CentreClass::class)->create();
        $centreTwoClasses = factory(App\Models\CentreClass::class)->create();

        $childrenOneClass = factory(App\Models\Child::class, 5)->create(['centre_class_id' => $centreOneClasses->id]);
        $childrenTwoClass = factory(App\Models\Child::class, 5)->create(['centre_class_id' => $centreTwoClasses->id]);

        $childrenResults = $this->childRepository->byClass($centreOneClasses->id, 'asc');

        $this->assertCount(5, $childrenResults);
        $this->assertEquals($centreOneClasses->id, $childrenResults[0]->centre_class_id);
    }

    /** @test */
    public function children_may_be_searchable_by_given_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->given_name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searchable_by_family_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->family_name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searchable_by_id_number()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->family_name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searchable_by_class_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->centreClass->name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searchable_by_centre_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->centreClass->centre->name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searched_by_family_name_and_given_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->family_name . ' ' . $newChildren[5]->given_name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_be_searched_by_given_name_and_family_name()
    {
        $newChildren = $this->getChildren(20);

        $childrenResults = $this->childRepository
                                ->search($newChildren[5]->given_name . ' ' . $newChildren[5]->family_name);

        $this->assertGreaterThanOrEqual(1, $childrenResults->count());
    }

    /** @test */
    public function children_may_return_empty_model()
    {
        $emptyChildren = $this->childRepository->emptyModel();

        $this->assertFalse($emptyChildren->exists());
    }

    // SQLite does not support the CONCAT method that
    // $this->childRepository->forList() use
    // /** @test */
    // public function children_may_be_retrieved_for_dropdown_list_format()
    // {
    //     $newChildren = $this->getChildren(20);
    //
    //     $childrenResults = $this->childRepository->forList();
    //
    //     $this->assertEquals($newChildren[0]->given_name, $childrenResults[0]->name);
    // }

    /** @test */
    public function children_may_return_results_for_external()
    {
        $newChildren = $this->getChildren(10);

        $childrenResults = $this->childRepository->externalAll();

        $this->assertCount(10, $childrenResults);
    }

    protected function getChildren($num = 1)
    {
        return factory(App\Models\Child::class, $num)->create();
    }
}
