<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - University CGPA Calculator</title>

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

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        .feature-item {
            background: rgba(51, 65, 85, 0.3);
            border: 1px solid rgba(99, 102, 241, 0.05);
            border-radius: 12px;
            padding: 18px;
            transition: all 0.3s;
        }

        .feature-item:hover {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateY(-2px);
        }

        .feature-item h3 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-item p {
            font-size: 0.825rem;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }

        /* Team Section */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-top: 14px;
        }

        .team-member {
            text-align: center;
            padding: 20px;
            background: rgba(51, 65, 85, 0.3);
            border-radius: 16px;
            border: 1px solid rgba(99, 102, 241, 0.05);
            transition: all 0.3s;
        }

        .team-member:hover {
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateY(-4px);
        }

        .team-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin: 0 auto 14px;
        }

        .team-member h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .team-member p {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0;
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

            .features-grid,
            .team-grid {
                grid-template-columns: 1fr;
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

            .feature-item {
                padding: 14px;
            }

            .team-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
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
            <a href="/about" class="active">About</a>
            <a href="/help">Help</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <section class="page-header">
            <h1>About CGPA Calculator</h1>
            <p>Learn more about our tool and how it helps students track their academic performance.</p>
        </section>

        <!-- What is CGPA -->
        <div class="content-card">
            <h2>
                <span class="icon">🎓</span>
                What is CGPA?
            </h2>
            <p>CGPA stands for <strong>Cumulative Grade Point Average</strong>. It is a numerical representation of a student's overall academic performance across all semesters of study. CGPA is calculated by averaging the grade points earned in all courses, weighted by their credit units.</p>
            <p>Unlike GPA (Grade Point Average), which typically refers to a single semester, CGPA provides a comprehensive view of your entire academic journey. It's an important metric used by universities to determine academic standing, honors, and eligibility for various programs.</p>
        </div>

        <!-- Features -->
        <div class="content-card">
            <h2>
                <span class="icon">✨</span>
                Key Features
            </h2>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>📝 Easy Input</h3>
                    <p>Simply enter your course names, credit units, and grades to get instant results.</p>
                </div>
                <div class="feature-item">
                    <h3>🧮 Accurate Calculation</h3>
                    <p>Our calculator uses the standard 5-point grading scale for precise CGPA computation.</p>
                </div>
                <div class="feature-item">
                    <h3>🏆 Class Classification</h3>
                    <p>Automatically determines your degree classification based on your CGPA.</p>
                </div>
                <div class="feature-item">
                    <h3>📱 Responsive Design</h3>
                    <p>Works seamlessly on desktop, tablet, and mobile devices.</p>
                </div>
                <div class="feature-item">
                    <h3>➕ Flexible Courses</h3>
                    <p>Add or remove courses as needed to match your semester load.</p>
                </div>
                <div class="feature-item">
                    <h3>🔄 Quick Reset</h3>
                    <p>Clear all entries and start fresh with a single click.</p>
                </div>
            </div>
        </div>

        <!-- Grading System -->
        <div class="content-card">
            <h2>
                <span class="icon">📋</span>
                Grading System
            </h2>
            <p>Our calculator uses the standard 5-point grading scale commonly used in universities:</p>
            <div class="features-grid" style="grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));">
                <div class="feature-item">
                    <h3><span style="color: #4ade80;">A</span></h3>
                    <p>5.0 Points (70-100%)</p>
                </div>
                <div class="feature-item">
                    <h3><span style="color: #60a5fa;">B</span></h3>
                    <p>4.0 Points (60-69%)</p>
                </div>
                <div class="feature-item">
                    <h3><span style="color: #fbbf24;">C</span></h3>
                    <p>3.0 Points (50-59%)</p>
                </div>
                <div class="feature-item">
                    <h3><span style="color: #fb923c;">D</span></h3>
                    <p>2.0 Points (45-49%)</p>
                </div>
                <div class="feature-item">
                    <h3><span style="color: #f87171;">E</span></h3>
                    <p>1.0 Point (40-44%)</p>
                </div>
                <div class="feature-item">
                    <h3><span style="color: #ef4444;">F</span></h3>
                    <p>0.0 Points (Below 40%)</p>
                </div>
            </div>
        </div>

        <!-- Classification -->
        <div class="content-card">
            <h2>
                <span class="icon">🎯</span>
                Degree Classification
            </h2>
            <p>Based on your CGPA, you'll receive one of the following classifications:</p>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>🏆 First Class</h3>
                    <p>CGPA: 4.50 - 5.00</p>
                </div>
                <div class="feature-item">
                    <h3>🥈 Second Class Upper</h3>
                    <p>CGPA: 3.50 - 4.49</p>
                </div>
                <div class="feature-item">
                    <h3>🥉 Second Class Lower</h3>
                    <p>CGPA: 2.50 - 3.49</p>
                </div>
                <div class="feature-item">
                    <h3>Third Class</h3>
                    <p>CGPA: 1.50 - 2.49</p>
                </div>
                <div class="feature-item">
                    <h3>Pass</h3>
                    <p>CGPA: 1.00 - 1.49</p>
                </div>
                <div class="feature-item">
                    <h3>Fail</h3>
                    <p>CGPA: Below 1.00</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            <h2>Ready to Calculate Your CGPA?</h2>
            <p>Start using our calculator now and track your academic performance.</p>
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

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>