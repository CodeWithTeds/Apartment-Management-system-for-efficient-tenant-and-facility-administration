<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Models\Inquiry;
use App\Models\Unit;
use App\Services\UnitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    protected $unitService;

    /**
     * Create a new controller instance.
     *
     * @param UnitService $unitService
     */
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        if ($filter === 'all') {
            $units = $this->unitService->getAllUnits();
        } else {
            $units = $this->unitService->getUnitsByAvailability($filter);
        }
        
        $stats = $this->unitService->getDashboardStats();
        
        return view('admin.units.index', compact('units', 'stats', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $unit = $this->unitService->createUnit($request->validated());
        
        return redirect()->route('admin.units.index')
            ->with('success', 'Unit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        // Check if the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        // Check if the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $tenants = Inquiry::with('user')->where('status', 'accepted')->get();
        
        return view('admin.units.edit', compact('unit', 'tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        // Check if the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $this->unitService->updateUnit($unit, $request->validated());
        
        return redirect()->route('admin.units.index')
            ->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        // Check if the unit belongs to the authenticated admin
        if ($unit->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $this->unitService->deleteUnit($unit);
        
        return redirect()->route('admin.units.index')
            ->with('success', 'Unit deleted successfully.');
    }
}