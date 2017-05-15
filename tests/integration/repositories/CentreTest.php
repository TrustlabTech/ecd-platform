<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Centre;
use App\Repositories\Implementations\EloquentCentreRepository;

class CentreTest extends TestCase
{
    use DatabaseTransactions;

    protected $centreRepository;

    public function setUp()
    {
        parent::setUp();
        $this->centreRepository = new EloquentCentreRepository(new Centre());
    }

    /** @test */
    public function centres_can_be_found()
    {
        $newCentres = $this->getCentres();

        $centre = $this->centreRepository->find($newCentres->id);

        $this->assertEquals($newCentres->id, $centre->id);
    }

    /** @test */
    public function all_centres_may_be_retrieved()
    {
        $newCentres = $this->getCentres(10);

        $centres = $this->centreRepository->all();

        $this->assertCount(10, $centres);
    }

    /** @test */
    public function centres_may_be_paginated()
    {
        $newCentres = $this->getCentres(20);

        $centres = $this->centreRepository->paginate(5);

        $this->assertCount(5, $centres);
    }

    /** @test */
    public function centres_may_be_created()
    {
        $newCentre = factory(App\Models\Centre::class)->make()->toArray();

        $this->centreRepository->create($newCentre);

        $centre = Centre::first();

        $this->assertNotNull($centre);
    }

    /** @test */
    public function centre_may_be_updated()
    {
        $newCentres = $this->getCentres();

        $updateCentre = [
            'name' => 'Hello World Centre'
        ];

        $this->centreRepository->update($updateCentre, $newCentres->id);

        $updatedCentre = $this->centreRepository->find($newCentres->id);

        $this->assertEquals('Hello World Centre', $updatedCentre->name);
    }

    /** @test */
    public function centre_may_be_deleted()
    {
        $newCentres = $this->getCentres();

        $this->centreRepository->delete($newCentres->id);

        $this->assertCount(0, Centre::all());
    }

    /** @test */
    public function centres_may_be_filtered_by_name_and_id()
    {
        $newCentres = $this->getCentres(10);

        $filteredCentres = $this->centreRepository->allFiltered()->toArray();

        $this->assertEquals([
                    'id' => $newCentres[0]->id,
                    'name' => $newCentres[0]->name
                ], $filteredCentres[0]);
    }

    /** @test */
    public function centres_may_be_searched_by_name()
    {
        $newCentres = $this->getCentres(10);

        $centreResults = $this->centreRepository->search($newCentres[3]->name);

        $this->assertGreaterThanOrEqual(1, $centreResults->count());
    }

    /** @test */
    public function centres_may_be_searched_by_c_code()
    {
        $newCentres = $this->getCentres(10);

        $centreResults = $this->centreRepository->search($newCentres[3]->c_code);

        $this->assertGreaterThanOrEqual(1, $centreResults->count());
    }

    /** @test */
    public function centres_may_return_empty_model()
    {
        $emptyCentre = $this->centreRepository->emptyModel();

        $this->assertFalse($emptyCentre->exists());
    }

    /** @test */
    public function centres_may_return_results_for_external()
    {
        $newCentres = $this->getCentres(10);

        $externalCentres = $this->centreRepository->externalAll();

        $this->assertEquals(10, count($newCentres));
    }

    protected function getCentres($num = 1)
    {
        return $newCentres = factory(App\Models\Centre::class, $num)->create();
    }
}
