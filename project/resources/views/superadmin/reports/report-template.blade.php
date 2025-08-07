<!DOCTYPE html>
<html>
<head>
    <title>{{ $report->report_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: white;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .report-table th {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        
        .report-table td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            font-size: 12px;
        }
        
        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        
        @media print {
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $report->report_name }}</h1>
    </div>
    
    <table class="report-table">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Report Type</td>
                <td>{{ ucwords(str_replace('_', ' ', $report->report_type)) }}</td>
            </tr>
            <tr>
                <td>Date Range</td>
                <td>{{ ucwords(str_replace('_', ' ', $report->date_range)) }}</td>
            </tr>
            @if($report->start_date)
            <tr>
                <td>Start Date</td>
                <td>{{ $report->start_date->format('Y-m-d') }}</td>
            </tr>
            @endif
            @if($report->end_date)
            <tr>
                <td>End Date</td>
                <td>{{ $report->end_date->format('Y-m-d') }}</td>
            </tr>
            @endif
            <tr>
                <td>Format</td>
                <td>{{ strtoupper($report->format) }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ ucfirst($report->status) }}</td>
            </tr>
            @if($report->description)
            <tr>
                <td>Description</td>
                <td>{{ $report->description }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    
    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }} | HYSLOP Property Management System
    </div>
</body>
</html>
