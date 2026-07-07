<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>Your Grades - University CGPA Calculator</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #134e4a 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background particles */
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(20, 184, 166, 0.3);
            border-radius: 50%;
            animation: float 15s infinite;
            box-shadow: 0 0 6px rgba(20, 184, 166, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(100vh) rotate(0deg) opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }

        /* Header */
        .header {
            position: relative;
            z-index: 10;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(20, 184, 166, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;
            gap: 12px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .logo:hover { transform: scale(1.02); }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #14b8a6, #10b981);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #14b8a6, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-nav {
            display: flex;
            gap: 20px;
        }

        .header-nav a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
            position: relative;
        }

        .header-nav a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #14b8a6, #10b981);
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .header-nav a:hover {
            color: #14b8a6;
            background: rgba(20, 184, 166, 0.1);
        }

        .header-nav a:hover::before { width: 80%; }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .hamburger:hover { background: rgba(20, 184, 166, 0.1); }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
            background: #14b8a6;
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
            background: #14b8a6;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-header h1 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #f8fafc, #94a3b8, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }

        .page-header p {
            font-size: 1rem;
            color: #94a3b8;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Content Card */
        .content-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e2e8f0;
            margin-bottom: 20px;
        }

        .card-title-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.2), rgba(16, 185, 129, 0.2));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        /* CGPA Summary Bar */
        .cgpa-summary-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.1), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .cgpa-summary-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #14b8a6, #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .cgpa-summary-label {
            font-size: 0.8rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .cgpa-summary-class {
            font-size: 0.9rem;
            font-weight: 600;
            color: #14b8a6;
        }

        /* Grades Table */
        .grades-table-container {
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            padding: 4px;
            border: 1px solid rgba(20, 184, 166, 0.1);
            overflow-x: auto;
        }

        .grades-table {
            width: 100%;
            border-collapse: collapse;
        }

        .grades-table thead {
            background: rgba(20, 184, 166, 0.1);
        }

        .grades-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid rgba(20, 184, 166, 0.2);
            white-space: nowrap;
        }

        .grades-table td {
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #e2e8f0;
            border-bottom: 1px solid rgba(20, 184, 166, 0.1);
        }

        .grades-table tbody tr:hover {
            background: rgba(20, 184, 166, 0.05);
        }

        .grades-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Grade Badges */
        .grade-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .grade-A { background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .grade-B { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .grade-C { background: rgba(251, 191, 36, 0.2); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }
        .grade-D { background: rgba(251, 146, 60, 0.2); color: #fb923c; border: 1px solid rgba(251, 146, 60, 0.3); }
        .grade-E { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .grade-F { background: rgba(239, 68, 68, 0.3); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.4); }

        .grade-status-pass {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .grade-status-fail {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Summary Grid */
        .grades-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 16px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(20, 184, 166, 0.1);
        }

        .summary-item {
            text-align: center;
            padding: 16px 12px;
            background: rgba(15, 23, 42, 0.3);
            border-radius: 12px;
            transition: all 0.3s;
        }

        .summary-item:hover {
            background: rgba(15, 23, 42, 0.5);
            transform: translateY(-2px);
        }

        .summary-label {
            font-size: 0.7rem;
            color: #64748b;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #14b8a6;
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
            flex: 1;
            min-width: 150px;
        }

        .btn-calculate {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        .btn-secondary {
            background: rgba(20, 184, 166, 0.1);
            color: #2dd4bf;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(20, 184, 166, 0.2);
            border-color: rgba(20, 184, 166, 0.3);
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 32px 24px 24px;
            color: #64748b;
            font-size: 0.85rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .footer-links a:hover {
            color: #14b8a6;
            background: rgba(20, 184, 166, 0.1);
        }

        .footer-copyright { font-size: 0.75rem; margin-bottom: 8px; }
        .footer-credit { font-size: 0.7rem; color: #475569; }
        .footer-credit a { color: #14b8a6; text-decoration: none; }
        .footer-credit a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 768px) {
            .header { padding: 12px 16px; flex-wrap: wrap; }
            .logo { flex: 1; min-width: 200px; }
            .logo-text { font-size: 1.1rem; }
            .header-nav {
                position: fixed;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(15, 23, 42, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                gap: 16px;
                padding: 24px 20px;
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border-bottom: 2px solid rgba(20, 184, 166, 0.2);
                z-index: 1000;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            }
            .header-nav.active { transform: translateY(0); opacity: 1; visibility: visible; }
            .header-nav a { font-size: 1rem; padding: 12px 16px; background: rgba(20, 184, 166, 0.05); }
            .hamburger { display: flex; }
            .main-content { padding: 20px 16px; max-width: 100%; }
            .page-header h1 { font-size: 1.8rem; }
            .content-card { padding: 20px; border-radius: 16px; }
            .cgpa-summary-value { font-size: 2rem; }
            .grades-summary { grid-template-columns: repeat(2, 1fr); }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="bg-particles" id="particles"></div>

    <!-- Header -->
    <header class="header">
        <div class="logo" onclick="window.location.href='/'">
            <div class="logo-icon">📊</div>
            <span class="logo-text">CGPA Calculator</span>
        </div>
        <nav class="header-nav" id="headerNav">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/help">Help</a>
        </nav>
        <div class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <section class="page-header">
            <h1>📋 Your Grades Summary</h1>
            <p>A detailed breakdown of your course grades, credit units, and performance.</p>
        </section>

        <!-- CGPA Summary Bar -->
        <div class="cgpa-summary-bar">
            <div>
                <div class="cgpa-summary-label">Your CGPA</div>
                <div class="cgpa-summary-value">{{ number_format($cgpa, 2) }}</div>
            </div>
            <div>
                <div class="cgpa-summary-label">Classification</div>
                <div class="cgpa-summary-class">{{ $class }}</div>
            </div>
        </div>

        <!-- Grades Table -->
        <div class="content-card">
            <div class="card-title">
                <div class="card-title-icon">📝</div>
                Course Breakdown
            </div>
            <div class="grades-table-container">
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Points</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $gradePoints = ['A' => 5, 'B' => 4, 'C' => 3, 'D' => 2, 'E' => 1, 'F' => 0];
                            $passingCourses = 0;
                            $failingCourses = 0;
                        @endphp
                        @for ($i = 0; $i < count($units); $i++)
                            @php
                                $unitValue = floatval($units[$i]);
                                $gradeValue = $grades[$i];
                                $points = $gradePoints[$gradeValue] ?? 0;
                                $coursePoints = $unitValue * $points;
                                $isPassing = $gradeValue !== 'F' && $gradeValue !== 'E';
                                if ($isPassing) { $passingCourses++; } else { $failingCourses++; }
                            @endphp
                            @if ($unitValue > 0)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $courses[$i] ?? 'Course ' . ($i + 1) }}</td>
                                    <td>{{ $unitValue }}</td>
                                    <td><span class="grade-badge grade-{{ $gradeValue }}">{{ $gradeValue }}</span></td>
                                    <td>{{ number_format($coursePoints, 1) }}</td>
                                    <td>
                                        @if ($isPassing)
                                            <span class="grade-status-pass">✓ Pass</span>
                                        @else
                                            <span class="grade-status-fail">✗ Fail</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Summary Stats -->
            <div class="grades-summary">
                <div class="summary-item">
                    <div class="summary-label">Total Courses</div>
                    <div class="summary-value">{{ $courseCount }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Units</div>
                    <div class="summary-value">{{ $totalUnits }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Points</div>
                    <div class="summary-value">{{ number_format($totalPoints, 1) }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Passed</div>
                    <div class="summary-value" style="color: #4ade80;">{{ $passingCourses }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Failed</div>
                    <div class="summary-value" style="color: {{ $failingCourses > 0 ? '#ef4444' : '#4ade80' }};">{{ $failingCourses }}</div>
                </div>
                @php
                    $passingRate = $courseCount > 0 ? ($passingCourses / $courseCount) * 100 : 0;
                @endphp
                <div class="summary-item">
                    <div class="summary-label">Passing Rate</div>
                    <div class="summary-value" style="color: {{ $passingRate >= 70 ? '#4ade80' : ($passingRate >= 50 ? '#fbbf24' : '#ef4444') }};">{{ number_format($passingRate, 1) }}%</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="/analytics" class="btn btn-calculate">
                    <span>📊</span> View Analytics
                </a>
                <a href="/pdf" class="btn btn-calculate">
                    <span>📄</span> Download PDF
                </a>
                <a href="/" class="btn btn-secondary">
                    <span>←</span> Back to Calculator
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/help">Help</a>
        </div>
        <div class="footer-copyright">
            © {{ date('Y') }} University CGPA Calculator. Built with care for students.
        </div>
        <div class="footer-credit">
            Built by <a href="#" target="_blank">Akingbehin Abideen (WETech)</a>
        </div>
    </footer>

    <script>
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (10 + Math.random() * 10) + 's';
                container.appendChild(particle);
            }
        }

        function toggleMobileMenu() {
            const hamburger = document.getElementById('hamburger');
            const nav = document.getElementById('headerNav');
            hamburger.classList.toggle('active');
            nav.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>
