<?php

namespace App\Repositories\Interfaces;

interface ChildAttendanceRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $childAttendance);

    public function update(array $childAttendance, $id);

    public function delete($id);

    public function byClass($staff_id);

    public function byBatch($data);

    public function attendanceToday();

    public function attendanceThisWeek();

    public function emptyModel();

    public function externalAll();

    public function history($centreId, $year, $month);

    public function getAttendanceForMaps();
}
