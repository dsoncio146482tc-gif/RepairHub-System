<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - RepairHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }
        .main-container {
            max-width: 920px;
            margin: 28px auto;
            background: #fff;
            min-height: calc(100vh - 56px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            padding-bottom: 36px;
            overflow: hidden;
        }
        .header {
            padding: 30px 34px 0 34px;
        }
        .header h1 {
            font-size: 30px;
            font-weight: 700;
            margin: 0;
        }
        .header .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin: 8px 0 28px 0;
        }
        .welcome {
            background: #b71c1c;
            color: #fff;
            border-radius: 14px;
            padding: 24px;
            margin: 0 34px 28px 34px;
        }
        .welcome h2 {
            margin: 0 0 8px 0;
            font-size: 22px;
        }
        .welcome p {
            margin: 0 0 18px 0;
            font-size: 15px;
            line-height: 1.5;
        }
        .welcome .actions {
            display: flex;
            gap: 10px;
        }
        .welcome .actions button, .welcome .actions a {
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .welcome .actions .report-btn {
            background: #ffe066;
            color: #222;
            font-weight: bold;
        }
        .welcome .actions .view-btn {
            background: #fff;
            color: #b71c1c;
            border: 1px solid #fff;
        }
        .stats {
            display: flex;
            gap: 14px;
            margin: 0 34px 30px 34px;
        }
        .stat-card {
            flex: 1;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 12px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        }
        .stat-card .label {
            font-size: 15px;
            color: #6b7280;
            margin-top: 6px;
        }
        .stat-card .count {
            font-size: 32px;
            font-weight: bold;
            line-height: 1;
        }
        .stat-card .pending { color: #b71c1c; }
        .stat-card .ongoing { color: #f9a825; }
        .stat-card .resolved { color: #388e3c; }
        .issues-section {
            margin: 0 34px;
        }
        .issues-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .issues-header h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }
        .issues-header a {
            font-size: 14px;
            color: #b71c1c;
            text-decoration: none;
            font-weight: 500;
        }
        .issue-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .issue-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }
        .issue-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eee;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .issue-info {
            flex: 1;
        }
        .issue-title {
            font-size: 16px;
            margin: 0;
            font-weight: 600;
        }
        .issue-status {
            font-size: 16px;
            margin-left: 0;
            font-weight: bold;
            white-space: nowrap;
        }
        .issue-status.resolved { color: #388e3c; }
        .issue-status.ongoing { color: #f9a825; }
        .issue-status.pending { color: #b71c1c; }
        .issue-desc {
            font-size: 15px;
            color: #666;
        }
        .issue-date {
            font-size: 15px;
            color: #888;
            margin-left: 0;
            white-space: nowrap;
        }
        .issues-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .issues-table th,
        .issues-table td {
            text-align: left;
            padding: 14px 12px 14px 0;
            vertical-align: top;
        }
        .issues-table th {
            font-size: 18px;
            color: #111827;
            font-weight: 700;
        }
        .issues-table thead tr {
            border-bottom: 1px solid #eee;
        }
        .issues-table tbody tr {
            border-bottom: 1px solid #eee;
        }
        .issues-table tbody tr:hover {
            background: #f9fafb;
        }
        .issues-table tbody tr:last-child {
            border-bottom: none;
        }
        .issues-table th:nth-child(1),
        .issues-table td:nth-child(1) {
            width: 22%;
            white-space: nowrap;
        }
        .issues-table th:nth-child(2),
        .issues-table td:nth-child(2) {
            width: 43%;
        }
        .issues-table th:nth-child(3),
        .issues-table td:nth-child(3) {
            width: 17%;
            white-space: nowrap;
        }
        .issues-table th:nth-child(4),
        .issues-table td:nth-child(4) {
            width: 18%;
            white-space: nowrap;
        }
        .issues-table td:last-child,
        .issues-table th:last-child {
            padding-right: 0;
        }
        @media (max-width: 768px) {
            .main-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
                box-shadow: none;
            }
            .header, .welcome, .stats, .issues-section {
                margin-left: 20px;
                margin-right: 20px;
                padding-left: 0;
                padding-right: 0;
            }
            .header {
                padding-top: 24px;
            }
            .stats {
                flex-wrap: wrap;
            }
            .stat-card {
                min-width: 130px;
            }
            .issues-header h3 {
                font-size: 24px;
            }
            .issues-header a {
                font-size: 16px;
            }
            .issues-table th {
                font-size: 16px;
            }
            .issue-title,
            .issue-desc,
            .issue-status,
            .issue-date {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <h1>Home</h1>
            <div class="subtitle">Facility Issue Reporting System</div>
        </div>
        <div class="welcome">
            <h2>Welcome to RepairHub</h2>
            <p>A system for reporting and tracking campus facility issues.</p>
            <div class="actions">
                <button class="report-btn">Report an Issue</button>
                <a href="#" class="view-btn">View Reports</a>
            </div>
        </div>
        <div class="stats">
            <div class="stat-card">
                <div class="count">3</div>
                <div class="label">Total Reports</div>
            </div>
            <div class="stat-card">
                <div class="count pending">1</div>
                <div class="label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="count ongoing">1</div>
                <div class="label">Ongoing</div>
            </div>
            <div class="stat-card">
                <div class="count resolved">1</div>
                <div class="label">Resolved</div>
            </div>
        </div>
        <div class="issues-section">
            <div class="issues-header">
                <h3>Issues</h3>
                <a href="#">View all</a>
            </div>
            <table class="issues-table">
                <thead>
                    <tr>
                        <th>Object</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="issue-title">Chair</span></td>
                        <td><span class="issue-desc">Room 301, Engineering Building</span></td>
                        <td><span class="issue-status resolved">Resolved</span></td>
                        <td><span class="issue-date">April 10, 2026</span></td>
                    </tr>
                    <tr>
                        <td><span class="issue-title">Light</span></td>
                        <td><span class="issue-desc">Hallway 2F, IT Building</span></td>
                        <td><span class="issue-status ongoing">Ongoing</span></td>
                        <td><span class="issue-date">February 3, 2026</span></td>
                    </tr>
                    <tr>
                        <td><span class="issue-title">Window</span></td>
                        <td><span class="issue-desc">DPT 213, New Building</span></td>
                        <td><span class="issue-status pending">Pending</span></td>
                        <td><span class="issue-date">March 2, 2026</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>