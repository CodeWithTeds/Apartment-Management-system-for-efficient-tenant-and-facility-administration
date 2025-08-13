<?php

namespace App\Http\Controllers\SuperAdmin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('assignable')->latest()->get();
        return view('superadmin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = SuperAdmin::all();
        $users = User::all();
        $assignees = $admins->map(function ($admin) {
            $admin->assignable_type = SuperAdmin::class;
            return $admin;
        })->concat($users->map(function ($user) {
            $user->assignable_type = User::class;
            return $user;
        }));
        return view('superadmin.reports.create', compact('assignees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'report_type' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'format' => 'required|string|max:255',
            'assignable' => 'required|string',
        ]);

        [$assignable_type, $assignable_id] = explode('-', $request->assignable);

        $report = Report::create([
            'report_name' => $request->report_name,
            'report_type' => $request->report_type,
            'date_range' => $request->date_range,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'format' => $request->format,
            'assignable_id' => $assignable_id,
            'assignable_type' => $assignable_type,
            'status' => 'pending',
            'channel' => Report::CHANNEL_SUPERADMIN_TO_ADMIN,
        ]);

        $this->generateReport($report);

        return redirect()->route('superadmin.reports.index')->with('success', 'Report generation started.');
    }

    public function generate(Report $report)
    {
        $this->generateReport($report);
        return redirect()->route('superadmin.reports.index')->with('success', 'Report regenerated successfully.');
    }

    private function generateReport(Report $report)
    {
        $format = $report->format;
        $filename = 'report-' . $report->id . '.' . $format;
        $path = public_path('reports/' . $filename);
        $url = asset('reports/' . $filename);

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('superadmin.reports.report-template', compact('report'));
            $pdf->save($path);
        } else {
            $content = $this->generateCsvContent($report);
            file_put_contents($path, $content);
        }

        $report->update([
            'status' => 'completed',
            'file_path' => $url,
            'completed_at' => now(),
        ]);
    }

    private function generateCsvContent(Report $report)
    {
        $data = [
            ['Report Name', $report->report_name],
            ['Report Type', $report->report_type],
            ['Date Range', $report->date_range],
            ['Start Date', $report->start_date ? $report->start_date->format('Y-m-d') : 'N/A'],
            ['End Date', $report->end_date ? $report->end_date->format('Y-m-d') : 'N/A'],
            ['Description', $report->description],
        ];

        $handle = fopen('php://temp', 'r+');
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $csv;
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('superadmin.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        $admins = SuperAdmin::all();
        $users = User::all();
        $assignees = $admins->map(function ($admin) {
            $admin->assignable_type = SuperAdmin::class;
            return $admin;
        })->concat($users->map(function ($user) {
            $user->assignable_type = User::class;
            return $user;
        }));
        return view('superadmin.reports.edit', compact('report', 'assignees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'report_type' => 'required|string|max:255',
            'date_range' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'format' => 'required|string|max:255',
            'assignable' => 'required|string',
        ]);

        [$assignable_type, $assignable_id] = explode('-', $request->assignable);

        $report->update([
            'report_name' => $request->report_name,
            'report_type' => $request->report_type,
            'date_range' => $request->date_range,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'format' => $request->format,
            'assignable_id' => $assignable_id,
            'assignable_type' => $assignable_type,
        ]);

        return redirect()->route('superadmin.reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('superadmin.reports.index')->with('success', 'Report deleted successfully.');
    }
}
