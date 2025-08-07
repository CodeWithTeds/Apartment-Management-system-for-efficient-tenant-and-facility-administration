<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin-top: 20px; }
        .details { width: 100%; border-collapse: collapse; }
        .details th, .details td { border: 1px solid #ddd; padding: 8px; }
        .details th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $report->report_name }}</h1>
        </div>
        <div class="content">
            <table class="details">
                <tr>
                    <th>Report Type</th>
                    <td>{{ $report->report_type }}</td>
                </tr>
                <tr>
                    <th>Date Range</th>
                    <td>{{ $report->date_range }}</td>
                </tr>
                @if($report->start_date)
                <tr>
                    <th>Start Date</th>
                    <td>{{ $report->start_date->format('Y-m-d') }}</td>
                </tr>
                @endif
                @if($report->end_date)
                <tr>
                    <th>End Date</th>
                    <td>{{ $report->end_date->format('Y-m-d') }}</td>
                </tr>
                @endif
                <tr>
                    <th>Description</th>
                    <td>{{ $report->description }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
