<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\ChildAttendance;
use App\Repositories\Implementations\EloquentChildAttendanceRepository;
use Carbon\Carbon;

class ChildAttenanceTest extends TestCase
{
    use DatabaseTransactions;

    protected $childAttendanceRepository;

    public function setUp()
    {
        parent::setUp();
        $this->childAttendanceRepository = new EloquentChildAttendanceRepository(new ChildAttendance());
    }

    /** @test */
    public function attendance_may_be_found()
    {
        $newAttendances = $this->getAttendances();

        $attendance = $this->childAttendanceRepository->find($newAttendances->id);

        $this->assertEquals($newAttendances->id, $attendance->id);
    }

    /** @test */
    public function all_attendances_may_be_retrieved()
    {
        $newAttendances = $this->getAttendances(10);

        $attendance = $this->childAttendanceRepository->all();

        $this->assertCount(10, $attendance);
    }

    /** @test */
    public function attendances_may_be_paginated()
    {
        $newAttendances = $this->getAttendances(20);

        $attendances = $this->childAttendanceRepository->paginate(5);

        $this->assertCount(5, $attendances);
    }

    /** @test */
    public function attendances_may_be_created()
    {
        $this->childAttendanceRepository->create(factory(App\Models\ChildAttendance::class)->make()->toArray());

        $newAttendances = ChildAttendance::first();

        $this->assertNotNull($newAttendances);
    }

    /** @test */
    public function attendances_may_be_updated()
    {
        $newAttendances = $this->getAttendances();

        $attendedValue = $newAttendances->attended;

        $updateAttendance = [
            'attended' => !$newAttendances->attended
        ];

        $this->childAttendanceRepository->update($updateAttendance, $newAttendances->id);

        $updatedChildren = $this->childAttendanceRepository->find($newAttendances->id);

        $this->assertNotEquals($attendedValue, $updatedChildren->attended);
    }

    /** @test */
    public function attendances_may_be_deleted()
    {
        $newAttendances = $this->getAttendances();

        $this->childAttendanceRepository->delete($newAttendances->id);

        $this->assertCount(0, ChildAttendance::all());
    }

    /** @test */
    public function attendance_done_can_be_retrieved_by_class()
    {
        $centre = factory(App\Models\Centre::class)->create();

        $centreOneClasses = factory(App\Models\CentreClass::class)->create(['centre_id' => $centre->id]);
        $centreTwoClasses = factory(App\Models\CentreClass::class)->create(['centre_id' => $centre->id]);

        $staffOne = factory(App\Models\Staff::class)->create(['centre_id' => $centre->id]);
        $staffTwo = factory(App\Models\Staff::class)->create(['centre_id' => $centre->id]);

        $childrenClassOne = factory(App\Models\Child::class, 15)->create(['centre_class_id' => $centreOneClasses->id]);
        $childrenClassTwo = factory(App\Models\Child::class, 15)->create(['centre_class_id' => $centreTwoClasses->id]);

        foreach ($childrenClassOne as $child) {
            factory(App\Models\ChildAttendance::class)->create(['children_id' => $child->id]);
        }

        foreach ($childrenClassTwo as $child) {
            factory(App\Models\ChildAttendance::class)->create(['children_id' => $child->id]);
        }

        $attendanceResults = $this->childAttendanceRepository->byClass($staffOne->id);

        $this->assertCount(2, $attendanceResults);
        $this->assertTrue($attendanceResults[0]->attended);
    }

    /** @test */
    public function attendance_not_done_can_be_retrieved_by_class()
    {
        $centre = factory(App\Models\Centre::class)->create();

        $centreOneClasses = factory(App\Models\CentreClass::class)->create(['centre_id' => $centre->id]);
        $centreTwoClasses = factory(App\Models\CentreClass::class)->create(['centre_id' => $centre->id]);

        $staffOne = factory(App\Models\Staff::class)->create(['centre_id' => $centre->id]);
        $staffTwo = factory(App\Models\Staff::class)->create(['centre_id' => $centre->id]);

        $childrenClassOne = factory(App\Models\Child::class, 15)->create(['centre_class_id' => $centreOneClasses->id]);
        $childrenClassTwo = factory(App\Models\Child::class, 15)->create(['centre_class_id' => $centreTwoClasses->id]);

        $attendanceResults = $this->childAttendanceRepository->byClass($staffOne->id);

        $this->assertCount(2, $attendanceResults);
        $this->assertFalse($attendanceResults[0]->attended);
    }

    /** @test */
    public function attendance_can_be_done_by_batch()
    {
        $centre = factory(App\Models\Centre::class)->create();

        $centreClasses = factory(App\Models\CentreClass::class)->create(['centre_id' => $centre->id]);

        $staff = factory(App\Models\Staff::class)->create(['centre_id' => $centre->id]);

        $children = factory(App\Models\Child::class, 15)->create(['centre_class_id' => $centreClasses->id]);

        $batch = [];

        foreach ($children as $child) {
            $batch['children'][] = [
                'attended' => true,
                'children_id' => $child->id,
                'latitude' => 0,
                'longitude' => 0
            ];
        }

        $attendanceResults = $this->childAttendanceRepository->byBatch($batch);

        $this->assertTrue($attendanceResults);
    }

    /** @test */
    public function attendance_may_return_results_for_today()
    {
        factory(App\Models\ChildAttendance::class, 6)
                ->create(['created_at' => Carbon::now()->toDateString(), 'attended' => true]);
        factory(App\Models\ChildAttendance::class, 4)
                ->create(['created_at' => Carbon::now()->toDateString(), 'attended' => false]);
        factory(App\Models\ChildAttendance::class, 10)
                ->create(['created_at' => Carbon::yesterday()->toDateString(), 'attended' => true]);

        $attendanceResults = $this->childAttendanceRepository->attendanceToday();

        $this->assertEquals(60, $attendanceResults);
    }

//    /** @test */
//    public function attendance_may_return_results_for_this_week()
//    {
//        factory(App\Models\ChildAttendance::class, 6)
//                ->create(['created_at' => Carbon::yesterday()->toDateString(), 'attended' => true]);
//        factory(App\Models\ChildAttendance::class, 4)
//                ->create(['created_at' => Carbon::yesterday()->toDateString(), 'attended' => false]);
//        factory(App\Models\ChildAttendance::class, 10)
//                ->create(['created_at' => Carbon::today()->subWeek(), 'attended' => true]);
//
//        $attendanceResults = $this->childAttendanceRepository->attendanceThisWeek();
//
//        $this->assertEquals(60, $attendanceResults);
//    }

    /** @test */
    public function attendance_may_return_results_for_external()
    {
        $newAttendance = $this->getAttendances(10);

        $attendanceResults = $this->childAttendanceRepository->externalAll();

        $this->assertCount(10, $attendanceResults);
    }

    /** @test */
    public function attendance_may_return_empty_model()
    {
        $emptyAttendance = $this->childAttendanceRepository->emptyModel();

        $this->assertFalse($emptyAttendance->exists());
    }

    protected function getAttendances($num = 1)
    {
        return factory(App\Models\ChildAttendance::class, $num)->create();
    }
}
