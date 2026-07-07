<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>Download PDF - University CGPA Calculator</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- html2pdf.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
            0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
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

        /* Download Button */
        .download-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
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

        .btn-download {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        .btn-download:active { transform: translateY(0); }

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

        .btn-calculate {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        /* PDF Preview Container */
        .pdf-preview-wrapper {
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

        .preview-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .preview-label::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #14b8a6;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* PDF Content (printable) */
        .pdf-content {
            background: white;
            color: #1e293b;
            padding: 40px;
            font-family: 'Inter', sans-serif;
            border-radius: 12px;
        }

        .pdf-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #14b8a6;
        }

        .pdf-header h1 {
            color: #0f766e;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .pdf-header p {
            color: #64748b;
            font-size: 14px;
        }

        .pdf-cgpa-display {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.1), rgba(16, 185, 129, 0.1));
            border: 2px solid rgba(20, 184, 166, 0.2);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-bottom: 24px;
        }

        .pdf-cgpa-value {
            font-size: 48px;
            font-weight: 800;
            color: #14b8a6;
            line-height: 1;
        }

        .pdf-class-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 12px;
            background: rgba(20, 184, 166, 0.1);
            color: #0f766e;
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .pdf-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .pdf-stat-item {
            text-align: center;
            padding: 16px;
            background: rgba(241, 245, 249, 0.8);
            border-radius: 8px;
            border: 1px solid rgba(20, 184, 166, 0.1);
        }

        .pdf-stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #0f766e;
        }

        .pdf-stat-label {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .pdf-grades-table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
            background: white;
        }

        .pdf-grades-table thead {
            background: rgba(20, 184, 166, 0.1);
        }

        .pdf-grades-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #0f766e;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #14b8a6;
        }

        .pdf-grades-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
        }

        .pdf-grades-table tbody tr:nth-child(even) {
            background: rgba(241, 245, 249, 0.5);
        }

        .pdf-grade-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .pdf-grade-A { background: rgba(34, 197, 94, 0.2); color: #16a34a; border: 1px solid rgba(34, 197, 94, 0.3); }
        .pdf-grade-B { background: rgba(59, 130, 246, 0.2); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.3); }
        .pdf-grade-C { background: rgba(251, 191, 36, 0.2); color: #ca8a04; border: 1px solid rgba(251, 191, 36, 0.3); }
        .pdf-grade-D { background: rgba(251, 146, 60, 0.2); color: #ea580c; border: 1px solid rgba(251, 146, 60, 0.3); }
        .pdf-grade-E { background: rgba(239, 68, 68, 0.2); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.3); }
        .pdf-grade-F { background: rgba(239, 68, 68, 0.3); color: #b91c1c; border: 1px solid rgba(239, 68, 68, 0.4); }

        .pdf-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 12px;
            color: #64748b;
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

        /* Notification */
        .notification {
            position: fixed;
            top: 80px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 2000;
            display: flex;
            align-items: center;
            gap: 8px;
            transform: translateX(400px);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .notification.show { transform: translateX(0); }
        .notification.success { background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.3); color: #4ade80; }
        .notification.error { background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; }
        .notification.info { background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.3); color: #60a5fa; }

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
            .pdf-preview-wrapper { padding: 20px; border-radius: 16px; }
            .pdf-content { padding: 24px; }
            .pdf-cgpa-value { font-size: 36px; }
            .pdf-stats-grid { grid-template-columns: 1fr; }
            .pdf-grades-table th, .pdf-grades-table td { padding: 8px 10px; font-size: 12px; }
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body>
    <div class="bg-particles" id="particles"></div>

    <!-- Notification -->
    <div class="notification" id="notification"></div>

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
        <section class="page-header">
            <h1>📄 Download PDF Report</h1>
            <p>Preview your CGPA report below and download it as a PDF file.</p>
        </section>

        <!-- Download Buttons -->
        <div class="download-bar">
            <button class="btn btn-download" onclick="downloadPDF()">
                <span>📥</span> Download PDF
            </button>
            <a href="/grades" class="btn btn-calculate">
                <span>📋</span> View Grades
            </a>
            <a href="/analytics" class="btn btn-calculate">
                <span>📊</span> View Analytics
            </a>
            <a href="/" class="btn btn-secondary">
                <span>←</span> Back
            </a>
        </div>

        <!-- PDF Preview -->
        <div class="pdf-preview-wrapper">
            <div class="preview-label">PDF Preview</div>
            <div id="pdfContent" class="pdf-content">
                <div class="pdf-header">
                    <h1>📊 CGPA Calculator Report</h1>
                    <p>Generated on {{ date('F j, Y') }}</p>
                </div>

                <div class="pdf-cgpa-display">
                    <div style="font-size: 14px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Your Cumulative GPA</div>
                    <div class="pdf-cgpa-value">{{ number_format($cgpa, 2) }}</div>
                    <div class="pdf-class-badge">{{ $class }}</div>

                    <div class="pdf-stats-grid">
                        <div class="pdf-stat-item">
                            <div class="pdf-stat-value">{{ $totalUnits }}</div>
                            <div class="pdf-stat-label">Total Units</div>
                        </div>
                        <div class="pdf-stat-item">
                            <div class="pdf-stat-value">{{ number_format($totalPoints, 1) }}</div>
                            <div class="pdf-stat-label">Total Points</div>
                        </div>
                        <div class="pdf-stat-item">
                            <div class="pdf-stat-value">{{ $courseCount }}</div>
                            <div class="pdf-stat-label">Courses</div>
                        </div>
                    </div>
                </div>

                <h3 style="color: #0f766e; margin-bottom: 16px; font-size: 18px;">📋 Course Details</h3>
                <table class="pdf-grades-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $gradePoints = ['A' => 5, 'B' => 4, 'C' => 3, 'D' => 2, 'E' => 1, 'F' => 0];
                            $rowNum = 0;
                        @endphp
                        @for ($i = 0; $i < count($units); $i++)
                            @php
                                $unitValue = floatval($units[$i]);
                                $gradeValue = $grades[$i] ?? 'F';
                                $points = $gradePoints[$gradeValue] ?? 0;
                                $coursePoints = $unitValue * $points;
                            @endphp
                            @if ($unitValue > 0)
                                @php $rowNum++; @endphp
                                <tr>
                                    <td>{{ $rowNum }}</td>
                                    <td>{{ $courses[$i] ?? 'Course ' . ($i + 1) }}</td>
                                    <td>{{ $unitValue }}</td>
                                    <td><span class="pdf-grade-badge pdf-grade-{{ $gradeValue }}">{{ $gradeValue }}</span></td>
                                    <td>{{ number_format($coursePoints, 1) }}</td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>

                <div class="pdf-footer">
                    <p>© {{ date('Y') }} University CGPA Calculator. Built with care for students.</p>
                    <p>Generated by <strong>Akingbehin Abideen (WETech)</strong></p>
                    <p style="margin-top: 8px;">📞 WhatsApp: <strong>08073866899</strong></p>
                </div>
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

        function showNotification(message, type = 'info') {
            const notification = document.getElementById('notification');
            notification.className = 'notification ' + type;
            notification.textContent = message;
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 3000);
        }

        function downloadPDF() {
            if (typeof html2pdf === 'undefined') {
                showNotification('PDF library not loaded. Please refresh the page.', 'error');
                return;
            }

            const content = document.getElementById('pdfContent');

            const opt = {
                margin: [10, 10, 10, 10],
                filename: 'CGPA_Report_{{ date("Y-m-d") }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            showNotification('Generating PDF...', 'info');

            html2pdf().set(opt).from(content).save().then(() => {
                showNotification('PDF downloaded successfully!', 'success');
            }).catch((error) => {
                console.error('PDF generation error:', error);
                showNotification('Error generating PDF. Please try again.', 'error');
            });
        }

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>
