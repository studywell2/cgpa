<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - University CGPA Calculator</title>

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
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
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
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            animation: float 15s infinite;
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
            z-index: 1;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
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
            transition: color 0.3s;
        }

        .header-nav a:hover,
        .header-nav a.active {
            color: #6366f1;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #f8fafc, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            font-size: 1rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Content Cards */
        .content-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 24px;
            padding: 28px;
            margin-bottom: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .content-card h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-card h2 .icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .content-card p {
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 14px;
            font-size: 0.925rem;
        }

        .content-card p:last-child {
            margin-bottom: 0;
        }

        /* Steps */
        .steps-container {
            margin-top: 14px;
        }

        .step-item {
            display: flex;
            gap: 14px;
            padding: 18px;
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            margin-bottom: 10px;
            border: 1px solid rgba(99, 102, 241, 0.05);
            transition: all 0.3s;
        }

        .step-item:hover {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .step-number {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .step-content h3 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .step-content p {
            font-size: 0.825rem;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }

        /* FAQ */
        .faq-item {
            background: rgba(51, 65, 85, 0.3);
            border: 1px solid rgba(99, 102, 241, 0.05);
            border-radius: 12px;
            margin-bottom: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .faq-item:hover {
            border-color: rgba(99, 102, 241, 0.2);
        }

        .faq-question {
            padding: 18px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .faq-question:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        .faq-icon {
            font-size: 1.25rem;
            transition: transform 0.3s;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-answer-content {
            padding: 0 18px 18px;
            font-size: 0.825rem;
            color: #64748b;
            line-height: 1.6;
        }

        /* Tips Box */
        .tips-box {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 20px;
            margin-top: 14px;
        }

        .tips-box h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tips-box ul {
            list-style: none;
            padding: 0;
        }

        .tips-box li {
            padding: 6px 0;
            padding-left: 24px;
            position: relative;
            color: #94a3b8;
            font-size: 0.825rem;
        }

        .tips-box li::before {
            content: "💡";
            position: absolute;
            left: 0;
        }

        /* Example Table */
        .example-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
            font-size: 0.85rem;
        }

        .example-table th,
        .example-table td {
            padding: 10px 14px;
            text-align: left;
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }

        .example-table th {
            background: rgba(99, 102, 241, 0.1);
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #818cf8;
        }

        .example-table td {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .example-table tr:last-child td {
            border-bottom: none;
        }

        .calculation-result {
            background: rgba(99, 102, 241, 0.1);
            border-radius: 8px;
            padding: 14px;
            margin-top: 14px;
            text-align: center;
        }

        .calculation-result .formula {
            font-size: 0.825rem;
            color: #818cf8;
            margin-bottom: 6px;
        }

        .calculation-result .result {
            font-size: 1.35rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 32px 24px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 20px;
        }

        .cta-section h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .cta-section p {
            color: #94a3b8;
            margin-bottom: 20px;
            font-size: 0.925rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
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
        }

        .footer-links a:hover {
            color: #6366f1;
        }

        .footer-copyright {
            font-size: 0.75rem;
            margin-bottom: 8px;
        }

        .footer-credit {
            font-size: 0.7rem;
            color: #475569;
        }

        .footer-credit a {
            color: #6366f1;
            text-decoration: none;
        }

        .footer-credit a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 14px 16px;
            }

            .logo-text {
                font-size: 1rem;
            }

            .header-nav {
                gap: 12px;
                font-size: 0.8rem;
            }

            .main-content {
                padding: 24px 14px;
            }

            .page-header h1 {
                font-size: 1.6rem;
            }

            .page-header p {
                font-size: 0.9rem;
            }

            .content-card {
                padding: 20px;
                border-radius: 16px;
            }

            .content-card h2 {
                font-size: 1.15rem;
            }

            .example-table {
                font-size: 0.75rem;
            }

            .example-table th,
            .example-table td {
                padding: 8px 10px;
            }

            .cta-section {
                padding: 24px 18px;
            }

            .cta-section h2 {
                font-size: 1.15rem;
            }
        }

        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                gap: 12px;
                text-align: center;
                padding: 12px 14px;
            }

            .header-nav {
                width: 100%;
                justify-content: center;
                gap: 10px;
            }

            .page-header h1 {
                font-size: 1.4rem;
            }

            .page-header p {
                font-size: 0.85rem;
            }

            .content-card {
                padding: 16px;
            }

            .content-card h2 {
                font-size: 1.05rem;
            }

            .step-item {
                flex-direction: column;
                gap: 10px;
                padding: 14px;
            }

            .step-number {
                align-self: flex-start;
            }

            .example-table {
                display: block;
                overflow-x: auto;
                font-size: 0.7rem;
            }

            .example-table th,
            .example-table td {
                padding: 6px 8px;
                white-space: nowrap;
            }

            .footer-links {
                gap: 10px;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="bg-particles" id="particles"></div>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <div class="logo-icon">📊</div>
            <span class="logo-text">CGPA Calculator</span>
        </div>
        <nav class="header-nav">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/help" class="active">Help</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <section class="page-header">
            <h1>Help & FAQ</h1>
            <p>Everything you need to know about using the CGPA Calculator effectively.</p>
        </section>

        <!-- How to Use -->
        <div class="content-card">
            <h2>
                <span class="icon">📖</span>
                How to Use the Calculator
            </h2>
            <div class="steps-container">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Enter Course Details</h3>
                        <p>For each course, enter the course name (optional), credit units (1-6), and select your expected or actual grade from the dropdown menu.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Add More Courses</h3>
                        <p>Click the "+ Add Course" button to add additional courses. You can add as many courses as you need for your semester.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Calculate CGPA</h3>
                        <p>Once all courses are entered, click the "Calculate CGPA" button to see your results instantly.</p>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>View Results</h3>
                        <p>Your CGPA will be displayed along with your degree classification, total units, total points, and number of courses.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calculation Example -->
        <div class="content-card">
            <h2>
                <span class="icon">🧮</span>
                Calculation Example
            </h2>
            <p>Here's how the CGPA calculation works with a sample set of courses:</p>
            <table class="example-table">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Credit Units</th>
                        <th>Grade</th>
                        <th>Grade Points</th>
                        <th>Total Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MATH 101</td>
                        <td>3</td>
                        <td>A</td>
                        <td>5.0</td>
                        <td>15.0</td>
                    </tr>
                    <tr>
                        <td>ENG 101</td>
                        <td>2</td>
                        <td>B</td>
                        <td>4.0</td>
                        <td>8.0</td>
                    </tr>
                    <tr>
                        <td>PHY 101</td>
                        <td>4</td>
                        <td>A</td>
                        <td>5.0</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>CS 101</td>
                        <td>3</td>
                        <td>C</td>
                        <td>3.0</td>
                        <td>9.0</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>12</strong></td>
                        <td>-</td>
                        <td>-</td>
                        <td><strong>52.0</strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="calculation-result">
                <div class="formula">CGPA = Total Points ÷ Total Units = 52.0 ÷ 12</div>
                <div class="result">CGPA = 4.33</div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="content-card">
            <h2>
                <span class="icon">❓</span>
                Frequently Asked Questions
            </h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What is CGPA and how is it different from GPA?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        CGPA (Cumulative Grade Point Average) is the average of all your grade points across all semesters, while GPA (Grade Point Average) typically refers to a single semester's performance. CGPA gives you a complete picture of your academic performance throughout your entire study program.
                    </div>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>How accurate is this calculator?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Our calculator uses the standard 5-point grading scale and provides accurate results based on the information you enter. However, always verify with your institution's official grading policy, as some universities may have slight variations in their calculation methods.
                    </div>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Can I use this for any university?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        This calculator uses the common 5-point grading scale (A=5, B=4, C=3, D=2, E=1, F=0) which is used by many universities. If your institution uses a different scale (like 4.0 or 10.0), the results may not be accurate for your system.
                    </div>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What if my course has no credit units?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        All courses should have credit units (typically 1-6). If a course has no credit units, it usually doesn't count toward your CGPA. You can leave such courses out of the calculation.
                    </div>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Can I save my calculations?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Currently, calculations are not saved between sessions. If you need to keep a record, we recommend taking a screenshot of your results or noting them down manually.
                    </div>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>How do I calculate CGPA for multiple semesters?</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        To calculate your cumulative CGPA across multiple semesters, enter all courses from all semesters at once. The calculator will compute the overall CGPA based on the total points and total units from all courses entered.
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="content-card">
            <h2>
                <span class="icon">💡</span>
                Tips for Accurate Results
            </h2>
            <div class="tips-box">
                <ul>
                    <li>Double-check your credit units before calculating</li>
                    <li>Use the official grades from your transcript or result slip</li>
                    <li>Include all courses that count toward your degree</li>
                    <li>Remember that failed courses (F) still count as 0 points</li>
                    <li>Some courses may be excluded from CGPA calculation - check your handbook</li>
                    <li>Carry over courses from previous semesters should be included</li>
                </ul>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            <h2>Still have questions?</h2>
            <p>Try the calculator now or reach out to us for more assistance.</p>
            <a href="/" class="btn">
                <span>🧮</span> Try Calculator
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/help">Help</a>
            <a href="#">Privacy Policy</a>
        </div>
        <div class="footer-copyright">
            © {{ date('Y') }} University CGPA Calculator. Built with care for students.
        </div>
        <div class="footer-credit">
            Built by <a href="#" target="_blank">Akingbehin Abideen (WETech)</a>
        </div>
    </footer>

    <script>
        // Create background particles
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

        // Toggle FAQ items
        function toggleFaq(element) {
            const faqItem = element.closest('.faq-item');
            const isActive = faqItem.classList.contains('active');

            // Close all other FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            // Toggle current item
            if (!isActive) {
                faqItem.classList.add('active');
            }
        }

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>