<?php

namespace App\Repositories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

class UnitRepository
{
    /**
     * Get all units for the authenticated admin.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllForAdmin(int $adminId): Collection
    {
        return Unit::with('inquiry.user')->where('admin_id', $adminId)
            ->orderBy('unit_number')
            ->get();
    }

    /**
     * Get a unit by ID.
     *
     * @param int $id
     * @return Unit|null
     */
    public function findById(int $id): ?Unit
    {
        return Unit::find($id);
    }

    /**
     * Create a new unit.
     *
     * @param array $data
     * @return Unit
     */
    public function create(array $data): Unit
    {
        return Unit::create($data);
    }

    /**
     * Update a unit.
     *
     * @param Unit $unit
     * @param array $data
     * @return bool
     */
    public function update(Unit $unit, array $data): bool
    {
        return $unit->update($data);
    }

    /**
     * Delete a unit.
     *
     * @param Unit $unit
     * @return bool
     */
    public function delete(Unit $unit): bool
    {
        return $unit->delete();
    }

    /**
     * Get units by availability status.
     *
     * @param string $status
     * @param int $adminId
     * @return Collection
     */
    public function getByAvailability(string $status, int $adminId): Collection
    {
        return Unit::with('inquiry.user')->where('admin_id', $adminId)
            ->where('availability', $status)
            ->orderBy('unit_number')
            ->get();
    }

    /**
     * Count units by availability status.
     *
     * @param string $status
     * @param int $adminId
     * @return int
     */
    public function countByAvailability(string $status, int $adminId): int
    {
        return Unit::where('admin_id', $adminId)
            ->where('availability', $status)
            ->count();
    }
}