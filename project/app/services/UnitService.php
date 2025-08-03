<?php

namespace App\Services;

use App\Models\Unit;
use App\Repositories\UnitRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UnitService
{
    protected $unitRepository;

    /**
     * Create a new service instance.
     *
     * @param UnitRepository $unitRepository
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Get all units for the authenticated admin.
     *
     * @return Collection
     */
    public function getAllUnits(): Collection
    {
        return $this->unitRepository->getAllForAdmin(Auth::id());
    }

    /**
     * Get a unit by ID.
     *
     * @param int $id
     * @return Unit|null
     */
    public function getUnitById(int $id): ?Unit
    {
        $unit = $this->unitRepository->findById($id);

        // Check if the unit belongs to the authenticated admin
        if ($unit && $unit->admin_id !== Auth::id()) {
            return null;
        }

        return $unit;
    }

    /**
     * Create a new unit.
     *
     * @param array $data
     * @return Unit
     */
    public function createUnit(array $data): Unit
    {
        // Ensure the unit is assigned to the authenticated admin
        $data['admin_id'] = Auth::id();

        return $this->unitRepository->create($data);
    }

    /**
     * Update a unit.
     *
     * @param Unit $unit
     * @param array $data
     * @return bool
     */
    public function updateUnit(Unit $unit, array $data): bool
    {
        // Ensure the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            return false;
        }

        return $this->unitRepository->update($unit, $data);
    }

    /**
     * Delete a unit.
     *
     * @param Unit $unit
     * @return bool
     */
    public function deleteUnit(Unit $unit): bool
    {
        // Ensure the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            return false;
        }

        return $this->unitRepository->delete($unit);
    }

    /**
     * Get units by availability status.
     *
     * @param string $status
     * @return Collection
     */
    public function getUnitsByAvailability(string $status): Collection
    {
        return $this->unitRepository->getByAvailability($status, Auth::id());
    }

    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        $adminId = Auth::id();
        
        return [
            'total' => $this->unitRepository->getAllForAdmin($adminId)->count(),
            'available' => $this->unitRepository->countByAvailability('Available', $adminId),
            'occupied' => $this->unitRepository->countByAvailability('Occupied', $adminId),
            'maintenance' => $this->unitRepository->countByAvailability('Maintenance', $adminId),
        ];
    }
}