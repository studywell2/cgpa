<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>University CGPA Calculator</title>

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
            animation: float 15s infinite ease-in-out;
            box-shadow: 0 0 6px rgba(20, 184, 166, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(100vh) rotate(0deg) scale(0); opacity: 0; }
            10% { opacity: 1; transform: translateY(90vh) rotate(90deg) scale(1); }
            90% { opacity: 1; transform: translateY(10vh) rotate(630deg) scale(1); }
            100% { transform: translateY(-100vh) rotate(720deg) scale(0); opacity: 0; }
        }

        /* Gradient orbs */
        .gradient-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 0;
            animation: pulse 8s infinite ease-in-out;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: #14b8a6;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: #10b981;
            bottom: -50px;
            left: -50px;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: #059669;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -2s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.15; }
            50% { transform: scale(1.1); opacity: 0.25; }
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

        /* Theme Toggle */
        .theme-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
            margin-right: 20px;
        }

        .theme-btn {
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #14b8a6;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .theme-btn:hover {
            background: rgba(20, 184, 166, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        }

        .theme-btn.active {
            background: rgba(20, 184, 166, 0.3);
            border-color: rgba(20, 184, 166, 0.4);
        }

        /* Theme Picker */
        .theme-picker {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .theme-picker-btn {
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #14b8a6;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .theme-picker-btn:hover {
            background: rgba(20, 184, 166, 0.2);
            transform: translateY(-2px);
        }

        .theme-picker-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 12px;
            padding: 8px;
            min-width: 180px;
            display: none;
            z-index: 1000;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        body.light-mode .theme-picker-dropdown {
            background: rgba(255, 255, 255, 0.95);
        }

        .theme-picker-dropdown.show {
            display: block;
            animation: fadeInDown 0.2s ease-out;
        }

        .theme-option {
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .theme-option:hover {
            background: rgba(20, 184, 166, 0.1);
        }

        .theme-option:active {
            background: rgba(20, 184, 166, 0.15);
            transform: scale(0.98);
        }

        .theme-option.active {
            background: rgba(20, 184, 166, 0.2);
            border: 1px solid rgba(20, 184, 166, 0.3);
        }

        .theme-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .theme-name {
            font-size: 0.85rem;
            font-weight: 500;
            color: #e2e8f0;
        }

        body.light-mode .theme-name {
            color: #1e293b;
        }

        /* Light Mode */
        body.light-mode {
            background: linear-gradient(135deg, #f0f9ff 0%, #ecfdf5 50%, #f0f9ff 100%);
            color: #1e293b;
        }

        body.light-mode .header {
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(20, 184, 166, 0.2);
        }

        body.light-mode .hamburger span {
            background: #1e293b;
        }

        body.light-mode .logo-text {
            background: linear-gradient(135deg, #0f766e, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body.light-mode .header-nav a {
            color: #64748b;
        }

        body.light-mode .header-nav a:hover {
            color: #0f766e;
            background: rgba(20, 184, 166, 0.1);
        }

        body.light-mode .calculator-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(20, 184, 166, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1),
                        0 0 0 1px rgba(20, 184, 166, 0.05);
        }

        body.light-mode .card-title {
            color: #1e293b;
        }

        body.light-mode .table-header {
            color: #64748b;
        }

        body.light-mode .course-number {
            color: #0f766e;
            background: rgba(20, 184, 166, 0.1);
        }

        body.light-mode .course-row {
            background: rgba(241, 245, 249, 0.5);
            border: 1px solid rgba(20, 184, 166, 0.1);
        }

        body.light-mode .course-row:hover {
            background: rgba(241, 245, 249, 0.8);
            border-color: rgba(20, 184, 166, 0.3);
        }

        body.light-mode .course-input {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #1e293b;
        }

        body.light-mode .grade-select {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #1e293b;
        }

        body.light-mode .hero h1 {
            background: linear-gradient(135deg, #1e293b, #64748b, #0f766e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body.light-mode .hero p {
            color: #64748b;
        }

        body.light-mode .results-card {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.05), rgba(16, 185, 129, 0.05));
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        body.light-mode .cgpa-label {
            color: #64748b;
        }

        body.light-mode .stat-value {
            color: #1e293b;
        }

        body.light-mode .stat-label {
            color: #94a3b8;
        }

        body.light-mode .stat-item {
            background: rgba(255, 255, 255, 0.5);
        }

        body.light-mode .stat-item:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        body.light-mode .grading-info {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        body.light-mode .grading-info h3 {
            color: #1e293b;
        }

        body.light-mode .grading-item {
            background: rgba(241, 245, 249, 0.5);
        }

        body.light-mode .grading-item:hover {
            background: rgba(241, 245, 249, 0.8);
        }

        body.light-mode .footer {
            color: #64748b;
        }

        body.light-mode .footer-links a {
            color: #64748b;
        }

        body.light-mode .footer-links a:hover {
            color: #0f766e;
            background: rgba(20, 184, 166, 0.1);
        }

        body.light-mode .footer-credit {
            color: #94a3b8;
        }

        body.light-mode .footer-credit a {
            color: #0f766e;
        }

        body.light-mode .social-icon {
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #64748b;
        }

        body.light-mode .social-icon:hover {
            background: rgba(20, 184, 166, 0.2);
            border-color: rgba(20, 184, 166, 0.4);
            color: #0f766e;
        }

        body.light-mode .social-icon:active {
            transform: translateY(-2px) scale(1.05);
        }

        /* Real-time CGPA Preview */
        .cgpa-preview {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.1), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            display: none;
            animation: fadeIn 0.3s ease-out;
        }

        body.light-mode .cgpa-preview {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.05), rgba(16, 185, 129, 0.05));
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .cgpa-preview.show {
            display: block;
        }

        .cgpa-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .cgpa-preview-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cgpa-preview-title::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #14b8a6;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .cgpa-preview-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #14b8a6, #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .cgpa-preview-meta {
            display: flex;
            gap: 20px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(20, 184, 166, 0.1);
            font-size: 0.8rem;
            color: #64748b;
        }

        .cgpa-preview-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Improved Animations */
        .calculator-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .calculator-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5),
                        0 0 0 1px rgba(20, 184, 166, 0.1);
        }

        body.light-mode .calculator-card:hover {
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15),
                        0 0 0 1px rgba(20, 184, 166, 0.15);
        }

        /* Success Animation */
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .cgpa-value.animate {
            animation: successPulse 0.6s ease-out;
        }

        /* Input Focus Effects */
        .course-row:focus-within {
            border-color: rgba(20, 184, 166, 0.4);
            background: rgba(51, 65, 85, 0.6);
            transform: translateX(4px);
        }

        body.light-mode .course-row:focus-within {
            background: rgba(241, 245, 249, 0.8);
        }

        /* Card hover improvements */
        .calculator-card:hover {
            border-color: rgba(100, 116, 139, 0.2);
        }

        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .course-row:active {
                background: rgba(51, 65, 85, 0.6);
                border-color: rgba(20, 184, 166, 0.3);
            }

            .btn:active {
                transform: scale(0.98);
            }

            .social-icon:active {
                transform: scale(0.95);
            }

            .theme-btn:active,
            .theme-picker-btn:active {
                transform: scale(0.95);
            }
        }

        /* Improved input focus */
        .course-input:focus, .grade-select:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1), 0 0 20px rgba(20, 184, 166, 0.1);
            transform: translateY(-2px) scale(1.02);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .hamburger:hover {
            background: rgba(20, 184, 166, 0.1);
        }

        body.light-mode .hamburger:hover {
            background: rgba(20, 184, 166, 0.15);
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 2px;
        }

        body.light-mode .hamburger span {
            background: #1e293b;
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

        /* Improved hamburger touch target */
        .hamburger {
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .logo:hover {
            transform: scale(1.02);
        }

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
            transition: all 0.3s;
        }

        .logo:hover .logo-icon {
            box-shadow: 0 6px 20px rgba(20, 184, 166, 0.5);
            transform: translateY(-2px);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #14b8a6, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
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

        .header-nav a:hover::before {
            width: 80%;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #f8fafc, #94a3b8, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            letter-spacing: -1px;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .hero p {
            font-size: 1rem;
            color: #94a3b8;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Calculator Card */
        .calculator-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                        0 0 0 1px rgba(20, 184, 166, 0.05);
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e2e8f0;
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

        .semester-badge {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.3);
            transition: all 0.3s;
        }

        .semester-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.4);
        }

        /* Courses List */
        .courses-container {
            margin-bottom: 24px;
        }

        .course-row {
            display: grid;
            grid-template-columns: 36px 1fr 120px 100px 36px;
            gap: 10px;
            align-items: center;
            padding: 14px;
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            margin-bottom: 8px;
            border: 1px solid rgba(20, 184, 166, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .course-row:hover {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(20, 184, 166, 0.2);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .course-number {
            font-size: 0.7rem;
            font-weight: 600;
            color: #14b8a6;
            text-align: center;
            padding: 4px 8px;
            background: rgba(20, 184, 166, 0.1);
            border-radius: 6px;
        }

        .course-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 8px;
            padding: 10px 14px;
            color: #e2e8f0;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .course-input:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
            transform: translateY(-1px);
        }

        .course-input:hover {
            border-color: rgba(20, 184, 166, 0.3);
        }

        .course-input::placeholder {
            color: #64748b;
        }

        .grade-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 8px;
            padding: 10px 14px;
            color: #e2e8f0;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2314b8a6' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
            -webkit-tap-highlight-color: transparent;
        }

        .grade-select:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
            transform: translateY(-1px);
        }

        .grade-select:hover {
            border-color: rgba(20, 184, 166, 0.3);
        }

        .grade-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
        }

        .grade-A { background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .grade-B { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .grade-C { background: rgba(251, 191, 36, 0.2); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }
        .grade-D { background: rgba(251, 146, 60, 0.2); color: #fb923c; border: 1px solid rgba(251, 146, 60, 0.3); }
        .grade-E { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .grade-F { background: rgba(239, 68, 68, 0.3); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.4); }

        .remove-btn {
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 1.25rem;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            transform: scale(1.1);
        }

        .remove-btn:active {
            transform: scale(0.95);
        }

        /* Table Header */
        .table-header {
            display: grid;
            grid-template-columns: 36px 1fr 120px 100px 36px;
            gap: 10px;
            padding: 0 14px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:active::before {
            width: 300px;
            height: 300px;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.1) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(45deg) translate(-100%, -100%);
            transition: transform 0.6s;
        }

        .btn:hover::after {
            transform: rotate(45deg) translate(100%, 100%);
        }

        .btn-add {
            background: rgba(20, 184, 166, 0.1);
            color: #2dd4bf;
            border: 1px solid rgba(20, 184, 166, 0.2);
            flex: 1;
        }

        .btn-add:hover {
            background: rgba(20, 184, 166, 0.2);
            border-color: rgba(20, 184, 166, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        }

        .btn-add:active {
            transform: translateY(0);
        }

        .btn-calculate {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            flex: 2;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-calculate::before {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.5), rgba(52, 211, 153, 0.5));
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        .btn-calculate:active {
            transform: translateY(0);
        }

        /* Calculate button success animation */
        .btn-calculate.calculating {
            pointer-events: none;
        }

        .btn-calculate.calculating::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-reset {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 12px 18px;
        }

        .btn-reset:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-reset:active {
            transform: translateY(0);
        }

        .btn-view-analytics {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            width: 100%;
            margin-top: 16px;
        }

        .btn-view-analytics:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        /* Results Section */
        .results-section {
            margin-top: 32px;
            display: none;
        }

        .results-section.show {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .results-card {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.1), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(20, 184, 166, 0.1);
        }

        .cgpa-display {
            margin-bottom: 24px;
        }

        .cgpa-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #94a3b8;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .cgpa-value {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #14b8a6, #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            text-shadow: 0 0 30px rgba(20, 184, 166, 0.3);
        }

        .cgpa-class {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .class-first { background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .class-second-upper { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .class-second-lower { background: rgba(251, 191, 36, 0.2); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }
        .class-third { background: rgba(251, 146, 60, 0.2); color: #fb923c; border: 1px solid rgba(251, 146, 60, 0.3); }
        .class-pass { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .class-fail { background: rgba(239, 68, 68, 0.3); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.4); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(20, 184, 166, 0.1);
        }

        .stat-item {
            text-align: center;
            padding: 12px;
            background: rgba(15, 23, 42, 0.3);
            border-radius: 12px;
            transition: all 0.3s;
        }

        .stat-item:hover {
            background: rgba(15, 23, 42, 0.5);
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 1.35rem;
            font-weight: 700;
            color: #e2e8f0;
        }

        .stat-label {
            font-size: 0.7rem;
            color: #64748b;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Grading Scale Info */
        .grading-info {
            margin-top: 32px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 16px;
            padding: 20px;
            animation: fadeIn 0.8s ease-out 0.4s backwards;
        }

        .grading-info h3 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e2e8f0;
        }

        .grading-table {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
            gap: 8px;
        }

        .grading-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: rgba(51, 65, 85, 0.3);
            border-radius: 8px;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .grading-item:hover {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(20, 184, 166, 0.2);
            transform: translateY(-2px);
        }

        .grading-grade {
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .grading-points {
            font-size: 0.8rem;
            color: #94a3b8;
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
            transition: all 0.3s;
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .footer-links a:hover {
            color: #14b8a6;
            background: rgba(20, 184, 166, 0.1);
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
            color: #14b8a6;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-credit a:hover {
            text-decoration: underline;
            color: #10b981;
        }

        /* Analytics Charts Section */
        .analytics-section {
            margin-top: 32px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 16px;
            padding: 24px;
            animation: fadeIn 0.8s ease-out 0.6s backwards;
            display: none;
        }

        body.light-mode .analytics-section {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .analytics-section.show {
            display: block;
        }

        .analytics-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .analytics-header h3 {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e2e8f0;
        }

        body.light-mode .analytics-header h3 {
            color: #1e293b;
        }

        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .chart-card {
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(20, 184, 166, 0.1);
        }

        body.light-mode .chart-card {
            background: rgba(241, 245, 249, 0.5);
        }

        .chart-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 16px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .grade-bar-chart {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .grade-bar-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .grade-label {
            font-size: 0.75rem;
            font-weight: 600;
            width: 30px;
            text-align: center;
        }

        .grade-bar-container {
            flex: 1;
            height: 24px;
            background: rgba(15, 23, 42, 0.5);
            border-radius: 12px;
            overflow: hidden;
        }

        body.light-mode .grade-bar-container {
            background: rgba(255, 255, 255, 0.5);
        }

        .grade-bar {
            height: 100%;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 8px;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
            min-width: 0;
            transition: width 0.5s ease-out;
        }

        .grade-count {
            font-size: 0.75rem;
            color: #94a3b8;
            width: 30px;
            text-align: center;
        }

        body.light-mode .grade-count {
            color: #64748b;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-top: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        /* Grades View Section */
        .grades-view-section {
            margin-top: 32px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 16px;
            padding: 24px;
            animation: fadeIn 0.8s ease-out 0.6s backwards;
            display: none;
        }

        body.light-mode .grades-view-section {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .grades-view-section.show {
            display: block;
        }

        .grades-view-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .grades-view-header h3 {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e2e8f0;
        }

        body.light-mode .grades-view-header h3 {
            color: #1e293b;
        }

        .grades-table-container {
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(20, 184, 166, 0.1);
        }

        body.light-mode .grades-table-container {
            background: rgba(241, 245, 249, 0.5);
        }

        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        }

        .grades-table td {
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #e2e8f0;
            border-bottom: 1px solid rgba(20, 184, 166, 0.1);
        }

        body.light-mode .grades-table td {
            color: #1e293b;
        }

        .grades-table tbody tr:hover {
            background: rgba(20, 184, 166, 0.05);
        }

        .grades-table tbody tr:last-child td {
            border-bottom: none;
        }

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

        .grades-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            padding-top: 20px;
            border-top: 1px solid rgba(20, 184, 166, 0.1);
        }

        .summary-item {
            text-align: center;
            padding: 12px;
            background: rgba(15, 23, 42, 0.3);
            border-radius: 8px;
        }

        body.light-mode .summary-item {
            background: rgba(255, 255, 255, 0.5);
        }

        .summary-label {
            font-size: 0.7rem;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .summary-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #14b8a6;
        }

        /* Target Calculator Section */
        .target-calculator {
            margin-top: 32px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 16px;
            padding: 24px;
            animation: fadeIn 0.8s ease-out 0.8s backwards;
        }

        body.light-mode .target-calculator {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(20, 184, 166, 0.2);
        }

        .target-calculator h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e2e8f0;
        }

        body.light-mode .target-calculator h3 {
            color: #1e293b;
        }

        .target-inputs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .target-input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .target-input-group label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #94a3b8;
        }

        .target-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.1);
            border-radius: 8px;
            padding: 12px 14px;
            color: #e2e8f0;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        body.light-mode .target-input {
            background: rgba(255, 255, 255, 0.8);
            color: #1e293b;
        }

        .target-input:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .target-results {
            background: rgba(51, 65, 85, 0.3);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(20, 184, 166, 0.1);
            display: none;
        }

        body.light-mode .target-results {
            background: rgba(241, 245, 249, 0.5);
        }

        .target-results.show {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        .target-result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(20, 184, 166, 0.1);
        }

        .target-result-item:last-child {
            border-bottom: none;
        }

        .target-result-label {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        .target-result-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #e2e8f0;
        }

        body.light-mode .target-result-value {
            color: #1e293b;
        }

        .target-result-value.highlight {
            color: #14b8a6;
            background: rgba(20, 184, 166, 0.1);
            padding: 4px 12px;
            border-radius: 6px;
        }

        .btn-calculate-target {
            background: linear-gradient(135deg, #14b8a6, #10b981);
            color: white;
            width: 100%;
            margin-top: 16px;
        }

        .btn-calculate-target:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        /* Social Media Icons */
        .social-media {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.2);
            color: #94a3b8;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .social-icon:hover {
            background: rgba(20, 184, 166, 0.2);
            border-color: rgba(20, 184, 166, 0.4);
            color: #14b8a6;
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 6px 20px rgba(20, 184, 166, 0.3);
        }

        .social-icon:active {
            transform: translateY(-2px) scale(1.05);
        }

        /* Prevent text selection on interactive elements */
        .social-icon,
        .btn,
        .theme-btn,
        .theme-picker-btn,
        .remove-btn {
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        /* Responsive */

        /* Tablet (768px and below) */

        @media (max-width: 768px) {

            .header {

                padding: 12px 16px;

                flex-wrap: wrap;

            }


            .logo {

                flex: 1;

                min-width: 200px;

            }


            .logo-text {

                font-size: 1.1rem;

            }


            .logo-icon {

                width: 36px;

                height: 36px;

                font-size: 18px;

            }


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


            body.light-mode .header-nav {

                background: rgba(255, 255, 255, 0.98);

            }


            .header-nav.active {

                transform: translateY(0);

                opacity: 1;

                visibility: visible;

            }


            .header-nav a {

                font-size: 1rem;

                padding: 12px 16px;

                border-radius: 8px;

                background: rgba(20, 184, 166, 0.05);

            }


            .header-nav a:hover {

                background: rgba(20, 184, 166, 0.15);

                transform: translateX(8px);

            }


            .theme-picker, .theme-toggle {

                order: 3;

                margin-left: 0;

                margin-right: 0;

            }


            .theme-picker-btn, .theme-btn {

                padding: 8px 14px;

                font-size: 0.8rem;

                min-height: 40px;

            }


            .theme-picker-dropdown {

                right: 0;

                left: auto;

                min-width: 200px;

            }


            .hamburger {

                display: flex;

                order: 2;

            }


            .main-content {

                padding: 20px 16px;

                max-width: 100%;

            }


            .hero h1 {

                font-size: 1.8rem;

                line-height: 1.2;

            }


            .hero p {

                font-size: 0.95rem;

                line-height: 1.6;

            }


            .calculator-card {

                padding: 20px;

                border-radius: 16px;

            }


            .card-header {

                flex-direction: column;

                gap: 12px;

                align-items: flex-start;

            }


            .card-title {

                font-size: 1rem;

            }


            .semester-badge {

                font-size: 0.7rem;

                padding: 5px 14px;

            }


            .course-row {

                grid-template-columns: 32px 1fr 100px 85px 32px;

                gap: 8px;

                padding: 12px 10px;

            }


            .table-header {

                grid-template-columns: 32px 1fr 100px 85px 32px;

                font-size: 0.65rem;

                padding: 0 10px 12px;

            }


            .course-input, .grade-select {

                padding: 10px 12px;

                font-size: 0.85rem;

            }


            .grade-select {

                padding-right: 32px;

                background-size: 10px;

                background-position: right 10px center;

            }


            .button-group {

                flex-direction: column;

                gap: 10px;

            }


            .btn {

                width: 100%;

                padding: 14px 20px;

                font-size: 0.9rem;

                min-height: 48px;

            }


            .stats-grid {

                grid-template-columns: repeat(2, 1fr);

                gap: 12px;

            }


            .cgpa-value {

                font-size: 2.8rem;

            }


            .cgpa-class {

                font-size: 0.8rem;

                padding: 6px 16px;

            }


            .grading-info {

                padding: 18px;

            }


            .grading-table {

                grid-template-columns: repeat(2, 1fr);

                gap: 10px;

            }


            .charts-container {

                grid-template-columns: 1fr;

            }


            .target-inputs {

                grid-template-columns: 1fr;

            }


            .target-results {

                padding: 16px;

            }


            .footer {

                padding: 24px 16px 20px;

            }


            .social-media {

                gap: 12px;

            }


            .social-icon {

                width: 36px;

                height: 36px;

                font-size: 1rem;

            }


            .footer-links {

                gap: 12px;

                flex-wrap: wrap;

            }


            .footer-links a {

                font-size: 0.75rem;

                padding: 6px 10px;

            }

        }


        /* Mobile (480px and below) */

        @media (max-width: 480px) {

            .header {

                padding: 10px 12px;

                gap: 8px;

            }


            .logo {

                min-width: 180px;

            }


            .logo-text {

                font-size: 1rem;

            }


            .logo-icon {

                width: 32px;

                height: 32px;

                font-size: 16px;

            }


            .header-nav {

                padding: 20px 16px;

                gap: 12px;

            }


            .header-nav a {

                font-size: 0.95rem;

                padding: 10px 14px;

            }


            .theme-picker-btn, .theme-btn {

                padding: 6px 12px;

                font-size: 0.75rem;

                min-height: 36px;

            }


            .theme-picker-dropdown {

                min-width: 180px;

            }


            .hamburger {

                padding: 6px;

            }


            .hamburger span {

                width: 22px;

                height: 2px;

            }


            .main-content {

                padding: 16px 12px;

            }


            .hero {

                margin-bottom: 24px;

            }


            .hero h1 {

                font-size: 1.5rem;

                line-height: 1.3;

            }


            .hero p {

                font-size: 0.9rem;

                line-height: 1.5;

            }


            .calculator-card {

                padding: 16px 12px;

                border-radius: 12px;

            }


            .card-title {

                font-size: 0.95rem;

            }


            .card-title-icon {

                width: 28px;

                height: 28px;

                font-size: 0.9rem;

            }


            .semester-badge {

                font-size: 0.65rem;

                padding: 4px 12px;

            }


            .course-row {

                grid-template-columns: 1fr 1fr;

                gap: 8px;

                padding: 12px 8px;

                background: rgba(51, 65, 85, 0.4);

            }


            .course-number {

                grid-column: 1;

                font-size: 0.65rem;

                padding: 3px 6px;

            }


            .course-input[name="courses[]"] {

                grid-column: 2;

            }


            .course-input[name="units[]"] {

                grid-column: 1;

            }


            .grade-select {

                grid-column: 2;

            }


            .remove-btn {

                grid-column: span 2;

                justify-self: end;

                font-size: 1.1rem;

                padding: 3px;

            }


            .table-header {

                display: none;

            }


            .course-input, .grade-select {

                padding: 8px 10px;

                font-size: 0.8rem;

            }


            .grade-select {

                padding-right: 28px;

            }


            .button-group {

                gap: 8px;

            }


            .btn {

                padding: 12px 16px;

                font-size: 0.85rem;

                min-height: 44px;

            }


            .results-card {

                padding: 18px 14px;

                border-radius: 14px;

            }


            .cgpa-value {

                font-size: 2.2rem;

            }


            .cgpa-class {

                font-size: 0.75rem;

                padding: 5px 14px;

            }


            .stats-grid {

                grid-template-columns: 1fr;

                gap: 10px;

            }


            .stat-item {

                padding: 10px;

            }


            .stat-value {

                font-size: 1.2rem;

            }


            .grading-info {

                padding: 14px;

                border-radius: 12px;

            }


            .grading-info h3 {

                font-size: 0.9rem;

            }


            .grading-table {

                grid-template-columns: 1fr;

                gap: 8px;

            }


            .grading-item {

                padding: 8px 10px;

            }


            .chart-card {

                padding: 16px;

            }


            .chart-title {

                font-size: 0.8rem;

            }


            .target-calculator {

                padding: 16px 12px;

            }


            .target-calculator h3 {

                font-size: 0.95rem;

            }


            .target-input {

                padding: 10px 12px;

                font-size: 0.85rem;

            }


            .target-results {

                padding: 14px;

            }


            .target-result-item {

                padding: 10px 0;

            }


            .target-result-label {

                font-size: 0.85rem;

            }


            .target-result-value {

                font-size: 1rem;

            }


            .footer {

                padding: 20px 12px 16px;

            }


            .social-media {

                gap: 10px;

                margin-bottom: 14px;

            }


            .social-icon {

                width: 34px;

                height: 34px;

                font-size: 0.95rem;

            }


            .footer-links {

                gap: 8px;

                margin-bottom: 10px;

            }


            .footer-links a {

                font-size: 0.7rem;

                padding: 5px 8px;

            }


            .footer-copyright {

                font-size: 0.7rem;

                margin-bottom: 6px;

            }


            .footer-credit {

                font-size: 0.65rem;

            }


            .grades-view-section {

                padding: 16px 12px;

            }


            .grades-view-header h3 {

                font-size: 0.95rem;

            }


            .grades-table-container {

                padding: 16px;

            }


            .grades-table th {

                padding: 10px 8px;

                font-size: 0.7rem;

            }


            .grades-table td {

                padding: 10px 8px;

                font-size: 0.8rem;

            }


            .grade-badge {

                padding: 3px 8px;

                font-size: 0.7rem;

            }


            .summary-item {

                padding: 10px;

            }


            .summary-value {

                font-size: 1.1rem;

            }

        }


        /* Extra Small Mobile (360px and below) */

        @media (max-width: 360px) {

            .header {

                padding: 8px 10px;

            }


            .logo-text {

                font-size: 0.9rem;

            }


            .logo-icon {

                width: 28px;

                height: 28px;

                font-size: 14px;

            }


            .hero h1 {

                font-size: 1.3rem;

            }


            .hero p {

                font-size: 0.85rem;

            }


            .calculator-card {

                padding: 12px 10px;

            }


            .course-row {

                padding: 10px 6px;

                gap: 6px;

            }


            .course-input, .grade-select {

                padding: 7px 8px;

                font-size: 0.75rem;

            }


            .btn {

                padding: 10px 14px;

                font-size: 0.8rem;

                min-height: 40px;

            }


            .cgpa-value {

                font-size: 1.8rem;

            }


            .stat-value {

                font-size: 1.1rem;

            }


            .social-icon {

                width: 32px;

                height: 32px;

                font-size: 0.9rem;

            }

        }

        /* PDF Button Styling */
        .btn-download-pdf {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            flex: 1;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-download-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* PDF Generation Styles */
        .pdf-content {
            background: white;
            color: #1e293b;
            padding: 40px;
            font-family: 'Inter', sans-serif;
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

    <!-- Gradient Orbs -->
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="gradient-orb orb-3"></div>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <div class="logo-icon">📊</div>
            <span class="logo-text">CGPA Calculator</span>
        </div>
        <nav class="header-nav" id="headerNav">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/help">Help</a>
        </nav>
        <div class="theme-picker">
            <button class="theme-picker-btn" id="themePickerBtn" onclick="toggleThemePicker()">
                <span>🎨</span>
                <span>Theme</span>
            </button>
            <div class="theme-picker-dropdown" id="themePickerDropdown">
                <div class="theme-option active" onclick="setTheme('teal')">
                    <div class="theme-color" style="background: linear-gradient(135deg, #14b8a6, #10b981);"></div>
                    <span class="theme-name">Teal Green</span>
                </div>
                <div class="theme-option" onclick="setTheme('purple')">
                    <div class="theme-color" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);"></div>
                    <span class="theme-name">Purple</span>
                </div>
                <div class="theme-option" onclick="setTheme('blue')">
                    <div class="theme-color" style="background: linear-gradient(135deg, #3b82f6, #06b6d4);"></div>
                    <span class="theme-name">Blue Cyan</span>
                </div>
                <div class="theme-option" onclick="setTheme('orange')">
                    <div class="theme-color" style="background: linear-gradient(135deg, #f97316, #eab308);"></div>
                    <span class="theme-name">Orange Amber</span>
                </div>
                <div class="theme-option" onclick="setTheme('pink')">
                    <div class="theme-color" style="background: linear-gradient(135deg, #ec4899, #f43f5e);"></div>
                    <span class="theme-name">Pink Rose</span>
                </div>
            </div>
        </div>
        <div class="theme-toggle">
            <button class="theme-btn" id="themeToggle" onclick="toggleTheme()">
                <span>🌙</span>
                <span id="themeText">Dark</span>
            </button>
        </div>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Calculate Your CGPA</h1>
            <p>Enter your course units and grades to instantly calculate your Cumulative Grade Point Average with precision.</p>
        </section>

        <!-- Calculator Card -->
        <div class="calculator-card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon">📝</div>
                    Course Entries
                </div>
                <span class="semester-badge" id="courseCount">0 Courses</span>
            </div>

            <!-- Real-time CGPA Preview -->
            <div class="cgpa-preview" id="cgpaPreview">
                <div class="cgpa-preview-header">
                    <span class="cgpa-preview-title">Live Preview</span>
                </div>
                <div class="cgpa-preview-value" id="previewCgpaValue">0.00</div>
                <div class="cgpa-preview-meta">
                    <span id="previewTotalUnits">📊 0 Units</span>
                    <span id="previewTotalPoints">⭐ 0 Points</span>
                </div>
            </div>

            <form method="POST" action="/calculate" id="cgpaForm">
                @csrf

                <!-- Table Header -->
                <div class="table-header">
                    <span>#</span>
                    <span>Course Name</span>
                    <span>Credit Units</span>
                    <span>Grade</span>
                    <span></span>
                </div>

                <!-- Courses Container -->
                <div class="courses-container" id="courses">
                    <!-- Initial course rows will be added by JavaScript -->
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="button" class="btn btn-add" onclick="addCourse()">
                        <span>+</span> Add Course
                    </button>
                    <button type="submit" class="btn btn-calculate">
                        <span>🧮</span> Calculate CGPA
                    </button>
                    <button type="button" class="btn btn-reset" onclick="resetForm()">
                        <span>🔄</span> Reset
                    </button>
                </div>
            </form>

            <!-- Results Section -->
            @if(isset($cgpa))
            <div class="results-section show">
                <div class="results-card">
                    <div class="cgpa-display">
                        <div class="cgpa-label">Your Cumulative GPA</div>
                        <div class="cgpa-value">{{ number_format($cgpa, 2) }}</div>
                        <div class="cgpa-class {{ $classClass ?? '' }}">
                            {{ $class ?? '' }}
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">{{ $totalUnits ?? 0 }}</div>
                            <div class="stat-label">Total Units</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $totalPoints ?? 0 }}</div>
                            <div class="stat-label">Total Points</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $courseCount ?? 0 }}</div>
                            <div class="stat-label">Courses</div>
                        </div>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-calculate" onclick="showAnalytics()" style="flex: 1; min-width: 150px;">
                            <span>📊</span> View Grade Analytics
                        </button>
                        <button class="btn btn-calculate" onclick="showGradesView()" style="flex: 1; min-width: 150px;">
                            <span>📋</span> View Your Grades
                        </button>
                        <button class="btn btn-calculate" onclick="downloadPDF()" style="flex: 1; min-width: 150px;">
                            <span>📄</span> Download PDF
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Analytics Section -->
        <div class="analytics-section" id="analyticsSection">
            <div class="analytics-header">
                <h3>📊 Grade Analytics</h3>
                <button class="btn btn-reset" onclick="toggleAnalytics()" style="padding: 6px 12px; font-size: 0.75rem;">
                    <span>✕</span> Close
                </button>
            </div>
            <div class="charts-container">
                <div class="chart-card">
                    <div class="chart-title">Grade Distribution</div>
                    <div class="grade-bar-chart" id="gradeBarChart">
                        <!-- Bars will be generated by JavaScript -->
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-title">Grade Statistics</div>
                    <div id="gradeStatistics" style="text-align: center; padding: 20px;">
                        <!-- Statistics will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades View Section -->
        <div class="grades-view-section" id="gradesViewSection">
            <div class="grades-view-header">
                <h3>📋 Your Grades Summary</h3>
                <div style="display: flex; gap: 8px;">
                    <button class="btn btn-calculate" onclick="downloadGradesPDF()" style="padding: 6px 12px; font-size: 0.75rem;">
                        <span>📄</span> Download PDF
                    </button>
                    <button class="btn btn-reset" onclick="toggleGradesView()" style="padding: 6px 12px; font-size: 0.75rem;">
                        <span>✕</span> Close
                    </button>
                </div>
            </div>
            <div class="grades-table-container">
                <table class="grades-table" id="gradesTable">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Units</th>
                            <th>Grade</th>
                            <th>Points</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="gradesTableBody">
                        <!-- Grades will be populated by JavaScript -->
                    </tbody>
                </table>
                <div class="grades-summary" id="gradesSummary">
                    <!-- Summary will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Target Calculator -->
        <div class="target-calculator">
            <h3>🎯 Target CGPA Calculator</h3>
            <p style="color: #94a3b8; margin-bottom: 20px; font-size: 0.9rem;">
                Calculate what grades you need to achieve your target CGPA
            </p>
            <div class="target-inputs">
                <div class="target-input-group">
                    <label for="currentCgpa">Current CGPA</label>
                    <input type="number" id="currentCgpa" class="target-input" placeholder="e.g., 3.50" step="0.01" min="0" max="5.00">
                </div>
                <div class="target-input-group">
                    <label for="currentUnits">Current Total Units</label>
                    <input type="number" id="currentUnits" class="target-input" placeholder="e.g., 30" min="1">
                </div>
                <div class="target-input-group">
                    <label for="targetCgpa">Target CGPA</label>
                    <input type="number" id="targetCgpa" class="target-input" placeholder="e.g., 4.00" step="0.01" min="0" max="5.00">
                </div>
                <div class="target-input-group">
                    <label for="futureUnits">Future Course Units</label>
                    <input type="number" id="futureUnits" class="target-input" placeholder="e.g., 15" min="1">
                </div>
            </div>
            <button class="btn btn-calculate-target" onclick="calculateTarget()">
                <span>🎯</span> Calculate Required Grades
            </button>
            <div class="target-results" id="targetResults">
                <!-- Results will be generated by JavaScript -->
            </div>
        </div>

        <!-- Grading Scale Information -->
        <div class="grading-info">
            <h3>📋 Grading Scale Reference</h3>
            <div class="grading-table">
                <div class="grading-item">
                    <span class="grading-grade grade-A">A</span>
                    <span class="grading-points">5.0 Points</span>
                </div>
                <div class="grading-item">
                    <span class="grading-grade grade-B">B</span>
                    <span class="grading-points">4.0 Points</span>
                </div>
                <div class="grading-item">
                    <span class="grading-grade grade-C">C</span>
                    <span class="grading-points">3.0 Points</span>
                </div>
                <div class="grading-item">
                    <span class="grading-grade grade-D">D</span>
                    <span class="grading-points">2.0 Points</span>
                </div>
                <div class="grading-item">
                    <span class="grading-grade grade-E">E</span>
                    <span class="grading-points">1.0 Point</span>
                </div>
                <div class="grading-item">
                    <span class="grading-grade grade-F">F</span>
                    <span class="grading-points">0.0 Points</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="social-media">
            <a href="https://wa.me/2348073866899" target="_blank" class="social-icon" title="WhatsApp">💬</a>
            <a href="https://www.linkedin.com/in/studywell" target="_blank" class="social-icon" title="LinkedIn">💼</a>
            <a href="https://x.com/WETech33" target="_blank" class="social-icon" title="X (Twitter)">🐦</a>
        </div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contact Us</a>
            <a href="#">FAQ</a>
        </div>
        <div class="footer-copyright">
            © {{ date('Y') }} University CGPA Calculator. Built with care for students.
        </div>
        <div class="footer-credit">
            Built by <a href="#" target="_blank">Akingbehin Abideen (WETech)</a>
        </div>
    </footer>

    <script>
        // Grade to points mapping
        const gradePoints = {
            'A': 5.0,
            'B': 4.0,
            'C': 3.0,
            'D': 2.0,
            'E': 1.0,
            'F': 0.0
        };

        let courseCounter = 0;

        // Initialize with 5 empty course rows
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's data from previous calculation
            const savedCourses = {{ isset($courses) ? json_encode($courses) : '[]' }};
            const savedUnits = {{ isset($units) ? json_encode($units) : '[]' }};
            const savedGrades = {{ isset($grades) ? json_encode($grades) : '[]' }};

            if (savedCourses.length > 0) {
                // Pre-populate courses with saved data
                for (let i = 0; i < savedCourses.length; i++) {
                    addCourse(savedCourses[i], savedUnits[i], savedGrades[i]);
                }
            } else {
                // Initialize with 5 empty course rows
                for (let i = 0; i < 5; i++) {
                    addCourse();
                }
            }

            createParticles();
            init
SmoothScroll();
            initInputAnimations();
            initThemeToggle();
            initRealtimeCgpa();

            // Check if there are results from previous calculation and show analytics
            const resultsSection = document.querySelector('.results-section.show');
            if (resultsSection) {
                showAnalytics();
            }
        });

        function addCourse(courseName = '', unitValue = '', gradeValue = 'A') {
            courseCounter++;
            const container = document.getElementById('courses');

            const row = document.createElement('div');
            row.className = 'course-row';
            row.id = `course-${courseCounter}`;

            row.innerHTML = `
                <span class="course-number">${courseCounter}</span>
                <input type="text" name="courses[]" class="course-input" placeholder="Course name (e.g., MATH 101)" value="${courseName}">
                <input type="number" name="units[]" class="course-input" placeholder="Units" min="1" max="6" required value="${unitValue}">
                <select name="grades[]" class="grade-select" onchange="updateGradeBadge(this)">
                    <option value="A" ${gradeValue === 'A' ? 'selected' : ''}>A (5.0)</option>
                    <option value="B" ${gradeValue === 'B' ? 'selected' : ''}>B (4.0)</option>
                    <option value="C" ${gradeValue === 'C' ? 'selected' : ''}>C (3.0)</option>
                    <option value="D" ${gradeValue === 'D' ? 'selected' : ''}>D (2.0)</option>
                    <option value="E" ${gradeValue === 'E' ? 'selected' : ''}>E (1.0)</option>
                    <option value="F" ${gradeValue === 'F' ? 'selected' : ''}>F (0.0)</option>
                </select>
                <button type="button" class="remove-btn" onclick="removeCourse(this)" title="Remove course">×</button>
            `;

            container.appendChild(row);
            updateCourseNumbers();
            updateCourseCount();

            // Add focus animation to new inputs
            const inputs = row.querySelectorAll('.course-input, .grade-select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateX(8px)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = '';
                });
            });
        }

        function removeCourse(btn) {
            const row = btn.closest('.course-row');
            const container = document.getElementById('courses');

            // Don't remove if it's the last row
            if (container.children.length <= 1) {
                showNotification('You must have at least one course.', 'warning');
                return;
            }

            row.style.animation = 'slideOut 0.3s ease-out forwards';
            setTimeout(() => {
                row.remove();
                updateCourseNumbers();
                updateCourseCount();
            }, 300);
        }

        function updateCourseNumbers() {
            const rows = document.querySelectorAll('.course-row');
            rows.forEach((row, index) => {
                row.querySelector('.course-number').textContent = index + 1;
            });
        }

        function updateCourseCount() {
            const count = document.querySelectorAll('.course-row').length;
            document.getElementById('courseCount').textContent = `${count} Course${count !== 1 ? 's' : ''}`;
        }

        function resetForm() {
            if (confirm('Are you sure you want to reset all entries?')) {
                document.getElementById('cgpaForm').reset();
                // Clear course names
                document.querySelectorAll('.course-input[name="courses[]"]').forEach(input => {
                    input.value = '';
                });
                // Reset grades to A
                document.querySelectorAll('.grade-select').forEach(select => {
                    select.value = 'A';
                });
                showNotification('Form has been reset.', 'success');
            }
        }

        // Create background particles
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (10 + Math.random() * 10) + 's';
                particle.style.opacity = Math.random() * 0.5 + 0.2;
                container.appendChild(particle);
            }
        }

        // Add slide out animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(20px);
                }
            }
        `;
        document.head.appendChild(style);

        // Hamburger menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            const nav = document.getElementById('headerNav');
            const hamburger = document.getElementById('hamburger');
            const isActive = nav.classList.toggle('active');
            hamburger.classList.toggle('active');

            // Prevent body scroll when mobile menu is open
            if (isActive) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.header-nav a').forEach(link => {
            link.addEventListener('click', function() {
                const nav = document.getElementById('headerNav');
                const hamburger = document.getElementById('hamburger');
                nav.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('headerNav');
            const hamburger = document.getElementById('hamburger');

            if (nav.classList.contains('active')) {
                const isClickInsideNav = nav.contains(event.target);
                const isClickOnHamburger = hamburger.contains(event.target);

                if (!isClickInsideNav && !isClickOnHamburger) {
                    nav.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            }
        });

        // Form validation
        document.getElementById('cgpaForm').addEventListener('submit', function(e) {
            const units = document.querySelectorAll('input[name="units[]"]');
            const grades = document.querySelectorAll('select[name="grades[]"]');
            let hasError = false;
            let hasValidData = false;

            units.forEach((input, index) => {
                const unitValue = parseFloat(input.value);
                const gradeValue = grades[index].value;

                // Check if this course has valid data
                if (!isNaN(unitValue) && unitValue > 0) {
                    hasValidData = true;
                }

                // Validate unit range
                if (input.value && (input.value < 1 || input.value > 6)) {
                    hasError = true;
                    input.style.borderColor = '#ef4444';
                    input.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                } else {
                    input.style.borderColor = '';
                    input.style.boxShadow = '';
                }
            });

            if (hasError) {
                e.preventDefault();
                showNotification('Please enter valid credit units (1-6) for all courses.', 'error');
            } else if (!hasValidData) {
                e.preventDefault();
                showNotification('Please enter valid course data first', 'warning');
            } else {
                // Add loading animation
                const calculateBtn = document.querySelector('.btn-calculate');
                calculateBtn.classList.add('calculating');
                calculateBtn.innerHTML = '<span></span> Calculating...';

                // Remove loading state after form submission (server will handle actual calculation)
                setTimeout(() => {
                    calculateBtn.classList.remove('calculating');
                    calculateBtn.innerHTML = '<span>🧮</span> Calculate CGPA';
                }, 2000);
            }
        });

        // Grade badge update function
        function updateGradeBadge(select) {
            // Visual feedback for grade selection
            select.style.borderColor = '#14b8a6';
            select.style.boxShadow = '0 0 0 3px rgba(20, 184, 166, 0.2)';
            setTimeout(() => {
                select.style.borderColor = '';
                select.style.boxShadow = '';
            }, 500);
        }

        // Smooth scroll for anchor links
        function initSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Input focus animations
        function initInputAnimations() {
            document.querySelectorAll('.course-input, .grade-select').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateX(8px)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = '';
                });
            });
        }

        // Theme Toggle Functionality
        const colorThemes = {
            teal: {
                primary: '#14b8a6',
                secondary: '#10b981',
                accent: '#34d399',
                light: '#2dd4bf',
                dark: '#0f766e',
                gradient: 'linear-gradient(135deg, #14b8a6, #10b981, #34d399)'
            },
            purple: {
                primary: '#6366f1',
                secondary: '#8b5cf6',
                accent: '#a78bfa',
                light: '#818cf8',
                dark: '#4f46e5',
                gradient: 'linear-gradient(135deg, #6366f1, #8b5cf6, #a78bfa)'
            },
            blue: {
                primary: '#3b82f6',
                secondary: '#06b6d4',
                accent: '#0ea5e9',
                light: '#60a5fa',
                dark: '#2563eb',
                gradient: 'linear-gradient(135deg, #3b82f6, #06b6d4, #0ea5e9)'
            },
            orange: {
                primary: '#f97316',
                secondary: '#eab308',
                accent: '#fbbf24',
                light: '#fb923c',
                dark: '#ea580c',
                gradient: 'linear-gradient(135deg, #f97316, #eab308, #fbbf24)'
            },
            pink: {
                primary: '#ec4899',
                secondary: '#f43f5e',
                accent: '#fb7185',
                light: '#f472b6',
                dark: '#db2777',
                gradient: 'linear-gradient(135deg, #ec4899, #f43f5e, #fb7185)'
            }
        };

        let currentColorTheme = 'teal';

        function initThemeToggle() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            const savedColorTheme = localStorage.getItem('colorTheme') || 'teal';

            if (savedTheme === 'light') {
                document.body.classList.add('light-mode');
                document.getElementById('themeToggle').querySelector('span:first-child').textContent = '☀️';
                document.getElementById('themeText').textContent = 'Light';
            }

            if (savedColorTheme && colorThemes[savedColorTheme]) {
                setColorTheme(savedColorTheme);
            }
        }

        function toggleTheme() {
            const body = document.body;
            const themeToggle = document.getElementById('themeToggle');
            const themeText = document.getElementById('themeText');
            const icon = themeToggle.querySelector('span:first-child');

            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                icon.textContent = '🌙';
                themeText.textContent = 'Dark';
                localStorage.setItem('theme', 'dark');
                showNotification('Switched to dark mode', 'info');
            } else {
                body.classList.add('light-mode');
                icon.textContent = '☀️';
                themeText.textContent = 'Light';
                localStorage.setItem('theme', 'light');
                showNotification('Switched to light mode', 'info');
            }
        }

        function toggleThemePicker() {
            const dropdown = document.getElementById('themePickerDropdown');
            dropdown.classList.toggle('show');
        }

        function setTheme(themeName) {
            setColorTheme(themeName);
            localStorage.setItem('colorTheme', themeName);

            // Update active state
            document.querySelectorAll('.theme-option').forEach(option => {
                option.classList.remove('active');
            });
            event.currentTarget.classList.add('active');

            // Close dropdown
            setTimeout(() => {
                document.getElementById('themePickerDropdown').classList.remove('show');
            }, 200);

            showNotification(`Switched to ${themeName.charAt(0).toUpperCase() + themeName.slice(1)} theme`, 'success');
        }

        function setColorTheme(themeName) {
            currentColorTheme = themeName;
            const theme = colorThemes[themeName];

            if (!theme) return;

            // Update CSS variables and styles dynamically
            const styleElement = document.getElementById('dynamic-theme') || document.createElement('style');
            styleElement.id = 'dynamic-theme';

            const css = `
                body:not(.light-mode) { --primary-color: ${theme.primary}; --secondary-color: ${theme.secondary}; --accent-color: ${theme.accent}; }
                body.light-mode { --primary-color: ${theme.dark}; --secondary-color: ${theme.primary}; --accent-color: ${theme.light}; }
            `;

            styleElement.textContent = css;
            document.head.appendChild(styleElement);

            // Update specific elements
            updateThemeColors(theme);
        }

        function updateThemeColors(theme) {
            // This is a simplified version - in production, you'd update all theme-related CSS
            // For now, the dynamic CSS variables will handle most cases

            // Update gradient orbs
            document.querySelector('.orb-1').style.background = theme.primary;
            document.querySelector('.orb-2').style.background = theme.secondary;
            document.querySelector('.orb-3').style.background = theme.dark;

            // Update particles
            document.querySelectorAll('.particle').forEach(p => {
                p.style.background = `rgba(${hexToRgb(theme.primary)}, 0.3)`;
                p.style.boxShadow = `0 0 6px rgba(${hexToRgb(theme.primary)}, 0.4)`;
            });
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ?
                `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` :
                '20, 184, 166';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const themePicker = document.querySelector('.theme-picker');
            if (!themePicker.contains(event.target)) {
                document.getElementById('themePickerDropdown').classList.remove('show');
            }
        });

        // Real-time CGPA Calculation
        function initRealtimeCgpa() {
            const container = document.getElementById('courses');

            // Use event delegation for better performance
            container.addEventListener('input', debounce(updateRealtimeCgpa, 300));
            container.addEventListener('change', updateRealtimeCgpa);
        }

        function updateRealtimeCgpa() {
            const units = document.querySelectorAll('input[name="units[]"]');
            const grades = document.querySelectorAll('select[name="grades[]"]');
            const preview = document.getElementById('cgpaPreview');
            const previewValue = document.getElementById('previewCgpaValue');
            const previewUnits = document.getElementById('previewTotalUnits');
            const previewPoints = document.getElementById('previewTotalPoints');

            let totalUnits = 0;
            let totalPoints = 0;
            let hasValidData = false;

            for (let i = 0; i < units.length; i++) {
                const unitValue = parseFloat(units[i].value);
                const gradeValue = grades[i].value;

                if (!isNaN(unitValue) && unitValue > 0 && gradePoints[gradeValue] !== undefined) {
                    totalUnits += unitValue;
                    totalPoints += unitValue * gradePoints[gradeValue];
                    hasValidData = true;
                }
            }

            if (hasValidData && totalUnits > 0) {
                const cgpa = totalPoints / totalUnits;
                previewValue.textContent = cgpa.toFixed(2);
                previewUnits.textContent = `📊 ${totalUnits} Units`;
                previewPoints.textContent = `⭐ ${totalPoints.toFixed(1)} Points`;
                preview.classList.add('show');
            } else {
                preview.classList.remove('show');
            }
        }

        // Debounce function to prevent excessive calculations
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Add event listeners to update real-time CGPA when courses are added/removed
        const originalAddCourse = addCourse;
        addCourse = function() {
            originalAddCourse.apply(this, arguments);
            setTimeout(updateRealtimeCgpa, 100);
        };

        const originalRemoveCourse = removeCourse;
        removeCourse = function(btn) {
            originalRemoveCourse.apply(this, arguments);
            setTimeout(updateRealtimeCgpa, 350);
        };

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;

            const colors = {
                success: 'rgba(34, 197, 94, 0.9)',
                error: 'rgba(239, 68, 68, 0.9)',
                warning: 'rgba(251, 191, 36, 0.9)',
                info: 'rgba(59, 130, 246, 0.9)'
            };

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${colors[type]};
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                animation: slideInRight 0.3s ease-out;
                font-size: 0.9rem;
                font-weight: 500;
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Add notification animations
        const notificationStyle = document.createElement('style');
        notificationStyle.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
            }
            }
            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100px);
                }
            }
        `;
        document.head.appendChild(notificationStyle);

        // Add parallax effect to gradient orbs
        document.addEventListener('mousemove', function(e) {
            const orbs = document.querySelectorAll('.gradient-orb');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            orbs.forEach((orb, index) => {
                const speed = (index + 1) * 20;
                orb.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });

        // Grades View Functions
        function toggleGradesView() {
            const gradesViewSection = document.getElementById('gradesViewSection');
            gradesViewSection.classList.toggle('show');
        }

        function showGradesView() {
            // Check if there are valid courses
            const units = document.querySelectorAll('input[name="units[]"]');
            let hasValidData = false;

            units.forEach(input => {
                const unitValue = parseFloat(input.value);
                if (!isNaN(unitValue) && unitValue > 0) {
                    hasValidData = true;
                }
            });

            if (!hasValidData) {
                showNotification('Please enter valid course data first', 'warning');
                return;
            }

            updateGradesView();
            document.getElementById('gradesViewSection').classList.add('show');
        }

        function updateGradesView() {
            const courseNames = document.querySelectorAll('input[name="courses[]"]');
            const units = document.querySelectorAll('input[name="units[]"]');
            const grades = document.querySelectorAll('select[name="grades[]"]');

            const tableBody = document.getElementById('gradesTableBody');
            const summaryContainer = document.getElementById('gradesSummary');

            let html = '';
            let totalUnits = 0;
            let totalPoints = 0;
            let passingCourses = 0;
            let failingCourses = 0;
            let validCourses = 0;

            for (let i = 0; i < grades.length; i++) {
                const courseName = courseNames[i].value.trim() || `Course ${i + 1}`;
                const unitValue = parseFloat(units[i].value);
                const gradeValue = grades[i].value;
                const points = gradePoints[gradeValue];

                if (!isNaN(unitValue) && unitValue > 0) {
                    const coursePoints = unitValue * points;
                    const isPassing = gradeValue !== 'F' && gradeValue !== 'E';

                    totalUnits += unitValue;
                    totalPoints += coursePoints;
                    validCourses++;

                    if (isPassing) {
                        passingCourses++;
                    } else {
                        failingCourses++;
                    }

                    html += `
                        <tr>
                            <td>${courseName}</td>
                            <td>${unitValue}</td>
                            <td>
                                <span class="grade-badge grade-${gradeValue}">${gradeValue}</span>
                            </td>
                            <td>${coursePoints.toFixed(1)}</td>
                            <td>
                                ${isPassing ?
                                    '<span class="grade-status-pass">✓ Pass</span>' :
                                    '<span class="grade-status-fail">✗ Fail</span>'
                                }
                            </td>
                        </tr>
                    `;
                }
            }

            tableBody.innerHTML = html;

            // Calculate summary statistics
            const averageCgpa = totalUnits > 0 ? (totalPoints / totalUnits).toFixed(2) : '0.00';
            const passingRate = validCourses > 0 ? ((passingCourses / validCourses) * 100).toFixed(1) : '0.0';

            summaryContainer.innerHTML = `
                <div class="summary-item">
                    <div class="summary-label">Total Courses</div>
                    <div class="summary-value">${validCourses}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Units</div>
                    <div class="summary-value">${totalUnits}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Points</div>
                    <div class="summary-value">${totalPoints.toFixed(1)}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">CGPA</div>
                    <div class="summary-value">${averageCgpa}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Passing Rate</div>
                    <div class="summary-value" style="color: ${passingRate >= 70 ? '#22c55e' : passingRate >= 50 ? '#fbbf24' : '#ef4444'}">${passingRate}%</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Passed</div>
                    <div class="summary-value" style="color: #22c55e;">${passingCourses}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Failed</div>
                    <div class="summary-value" style="color: ${failingCourses > 0 ? '#ef4444' : '#22c55e'}">${failingCourses}</div>
                </div>
            `;
        }

        // Analytics Functions
        function toggleAnalytics() {
            const analyticsSection = document.getElementById('analyticsSection');
            analyticsSection.classList.toggle('show');
        }

        function showAnalytics() {
            // Check if there are valid courses
            const units = document.querySelectorAll('input[name="units[]"]');
            let hasValidData = false;

            units.forEach(input => {
                const unitValue = parseFloat(input.value);
                if (!isNaN(unitValue) && unitValue > 0) {
                    hasValidData = true;
                }
            });

            if (!hasValidData) {
                showNotification('Please enter valid course data first', 'warning');
                return;
            }

            updateAnalytics();
            document.getElementById('analyticsSection').classList.add('show');
        }

        function updateAnalytics() {
            const grades = document.querySelectorAll('select[name="grades[]"]');
            const units = document.querySelectorAll('input[name="units[]"]');

            let gradeCounts = {
                'A': 0, 'B': 0, 'C': 0, 'D': 0, 'E': 0, 'F': 0
            };

            let totalUnits = 0;
            let totalPoints = 0;
            let validCourses = 0;

            for (let i = 0; i < grades.length; i++) {
                const unitValue = parseFloat(units[i].value);
                const gradeValue = grades[i].value;

                if (!isNaN(unitValue) && unitValue > 0) {
                    gradeCounts[gradeValue] += unitValue;
                    totalUnits += unitValue;
                    totalPoints += unitValue * gradePoints[gradeValue];
                    validCourses++;
                }
            }

            if (validCourses > 0) {
                renderGradeBarChart(gradeCounts, totalUnits);
                renderGradeStatistics(gradeCounts, totalUnits, totalPoints, validCourses);
            }
        }

        function renderGradeBarChart(gradeCounts, totalUnits) {
            const chartContainer = document.getElementById('gradeBarChart');
            const gradeColors = {
                'A': '#22c55e', 'B': '#3b82f6', 'C': '#fbbf24',
                'D': '#fb923c', 'E': '#f87171', 'F': '#ef4444'
            };

            let html = '';
            const grades = ['A', 'B', 'C', 'D', 'E', 'F'];

            grades.forEach(grade => {
                const count = gradeCounts[grade];
                const percentage = totalUnits > 0 ? (count / totalUnits * 100).toFixed(1) : 0;
                const color = gradeColors[grade];

                html += `
                    <div class="grade-bar-item">
                        <span class="grade-label">${grade}</span>
                        <div class="grade-bar-container">
                            <div class="grade-bar" style="width: ${percentage}%; background: ${color};">
                                ${percentage > 15 ? `${percentage}%` : ''}
                            </div>
                        </div>
                        <span class="grade-count">${count}</span>
                    </div>
                `;
            });

            chartContainer.innerHTML = html;
        }

        function renderGradeStatistics(gradeCounts, totalUnits, totalPoints, validCourses) {
            const statsContainer = document.getElementById('gradeStatistics');
            const averageCgpa = totalUnits > 0 ? (totalPoints / totalUnits).toFixed(2) : '0.00';

            // Find most common grade
            let mostCommonGrade = 'None';
            let maxCount = 0;
            Object.entries(gradeCounts).forEach(([grade, count]) => {
                if (count > maxCount && count > 0) {
                    maxCount = count;
                    mostCommonGrade = grade;
                }
            });

            // Calculate passing rate (A, B, C, D are passing, E and F are failing)
            const passingUnits = gradeCounts['A'] + gradeCounts['B'] + gradeCounts['C'] + gradeCounts['D'];
            const passingRate = totalUnits > 0 ? ((passingUnits / totalUnits) * 100).toFixed(1) : '0.0';

            statsContainer.innerHTML = `
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                    <div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">Average CGPA</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #14b8a6;">${averageCgpa}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">Most Common Grade</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #e2e8f0;">${mostCommonGrade}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">Passing Rate</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #22c55e;">${passingRate}%</div>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">Total Units</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #e2e8f0;">${totalUnits}</div>
                    </div>
                </div>
            `;
        }

        // Target Calculator Functions
        function calculateTarget() {
            const currentCgpa = parseFloat(document.getElementById('currentCgpa').value);
            const currentUnits = parseInt(document.getElementById('currentUnits').value);
            const targetCgpa = parseFloat(document.getElementById('targetCgpa').value);
            const futureUnits = parseInt(document.getElementById('futureUnits').value);

            // Validation
            if (isNaN(currentCgpa) || isNaN(currentUnits) || isNaN(targetCgpa) || isNaN(futureUnits)) {
                showNotification('Please fill in all fields with valid numbers', 'error');
                return;
            }

            if (currentCgpa < 0 || currentCgpa > 5 || targetCgpa < 0 || targetCgpa > 5) {
                showNotification('CGPA values must be between 0.00 and 5.00', 'error');
                return;
            }

            if (currentUnits <= 0 || futureUnits <= 0) {
                showNotification('Units must be greater than 0', 'error');
                return;
            }

            // Calculate required total points
            const currentPoints = currentCgpa * currentUnits;
            const totalUnits = currentUnits + futureUnits;
            const requiredTotalPoints = targetCgpa * totalUnits;
            const requiredFuturePoints = requiredTotalPoints - currentPoints;
            const requiredAverage = requiredFuturePoints / futureUnits;

            const resultsContainer = document.getElementById('targetResults');

            let html = '';
            let isAchievable = requiredAverage <= 5.0 && requiredAverage >= 0;

            html += `<div class="target-result-item">`;
            html += `<span class="target-result-label">Current Status</span>`;
            html += `<span class="target-result-value">${currentCgpa.toFixed(2)} CGPA (${currentUnits} units)</span>`;
            html += `</div>`;

            html += `<div class="target-result-item">`;
            html += `<span class="target-result-label">Target Status</span>`;
            html += `<span class="target-result-value">${targetCgpa.toFixed(2)} CGPA (${totalUnits} units)</span>`;
            html += `</div>`;

            html += `<div class="target-result-item">`;
            html += `<span class="target-result-label">Required Average</span>`;
            html += `<span class="target-result-value ${isAchievable ? 'highlight' : ''}" style="color: ${isAchievable ? '#14b8a6' : '#ef4444'}">${requiredAverage.toFixed(2)}</span>`;
            html += `</div>`;

            html += `<div class="target-result-item">`;
            html += `<span class="target-result-label">Required Total Points</span>`;
            html += `<span class="target-result-value">${requiredFuturePoints.toFixed(1)} points</span>`;
            html += `</div>`;

            if (isAchievable) {
                // Calculate required grade breakdown
                const requiredGrade = getRequiredGrade(requiredAverage);
                html += `<div class="target-result-item" style="border: none; margin-top: 16px; padding-top: 16px;">`;
                html += `<span class="target-result-label">Recommendation</span>`;
                html += `<span class="target-result-value" style="color: #14b8a6;">Aim for ${requiredGrade} average</span>`;
                html += `</div>`;
            } else {
                html += `<div class="target-result-item" style="border: none; margin-top: 16px; padding-top: 16px;">`;
                html += `<span class="target-result-label" style="color: #ef4444;">Not Achievable</span>`;
                html += `<span class="target-result-value" style="color: #ef4444;">Target too high</span>`;
                html += `</div>`;
            }

            resultsContainer.innerHTML = html;
            resultsContainer.classList.add('show');
        }

        function getRequiredGrade(average) {
            if (average >= 4.5) return 'A grades';
            if (average >= 3.5) return 'A-B mix';
            if (average >= 2.5) return 'B-C mix';
            if (average >= 1.5) return 'C-D mix';
            if (average >= 0.5) return 'D-E mix';
            return 'any passing grade';
        }

        // Update analytics when courses change
        const originalUpdateCourseCount = updateCourseCount;
        updateCourseCount = function() {
            originalUpdateCourseCount.apply(this, arguments);
            updateAnalytics();
        };

        // Initialize analytics on page load if there are results (handled in main DOMContentLoaded)

        // PDF Download Function
        function downloadGradesPDF() {
            // Check if html2pdf is available
            if (typeof html2pdf === 'undefined') {
                showNotification('PDF library not loaded. Please refresh the page.', 'error');
                return;
            }

            // Get current data
            const courseNames = document.querySelectorAll('input[name="courses[]"]');
            const units = document.querySelectorAll('input[name="units[]"]');
            const grades = document.querySelectorAll('select[name="grades[]"]');

            let gradesTableHTML = '';
            let totalUnits = 0;
            let totalPoints = 0;
            let passingCourses = 0;
            let failingCourses = 0;
            let validCourses = 0;

            for (let i = 0; i < grades.length; i++) {
                const courseName = courseNames[i].value.trim() || `Course ${i + 1}`;
                const unitValue = parseFloat(units[i].value);
                const gradeValue = grades[i].value;
                const points = gradePoints[gradeValue];

                if (!isNaN(unitValue) && unitValue > 0) {
                    const coursePoints = unitValue * points;
                    const isPassing = gradeValue !== 'F' && gradeValue !== 'E';

                    totalUnits += unitValue;
                    totalPoints += coursePoints;
                    validCourses++;

                    if (isPassing) {
                        passingCourses++;
                    } else {
                        failingCourses++;
                    }

                    gradesTableHTML += `
                        <tr>
                            <td>${validCourses}</td>
                            <td>${courseName}</td>
                            <td>${unitValue}</td>
                            <td><span class="pdf-grade-badge pdf-grade-${gradeValue}">${gradeValue}</span></td>
                            <td>${coursePoints.toFixed(1)}</td>
                            <td>${isPassing ? '✓ Pass' : '✗ Fail'}</td>
                        </tr>
                    `;
                }
            }

            if (validCourses === 0) {
                showNotification('No valid courses to include in PDF', 'warning');
                return;
            }

            const averageCgpa = totalUnits > 0 ? (totalPoints / totalUnits).toFixed(2) : '0.00';
            const passingRate = validCourses > 0 ? ((passingCourses / validCourses) * 100).toFixed(1) : '0.0';

            // Create PDF HTML structure
            const pdfHTML = `
                <div class="pdf-content">
                    <div class="pdf-header">
                        <h1>📋 Detailed Grades Report</h1>
                        <p>Generated on ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    </div>

                    <div class="pdf-cgpa-display">
                        <div style="font-size: 14px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Summary Statistics</div>

                        <div class="pdf-stats-grid" style="grid-template-columns: repeat(4, 1fr);">
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${validCourses}</div>
                                <div class="pdf-stat-label">Total Courses</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${totalUnits}</div>
                                <div class="pdf-stat-label">Total Units</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${averageCgpa}</div>
                                <div class="pdf-stat-label">CGPA</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${passingRate}%</div>
                                <div class="pdf-stat-label">Passing Rate</div>
                            </div>
                        </div>

                        <div class="pdf-stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-top: 16px;">
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value" style="color: #16a34a;">${passingCourses}</div>
                                <div class="pdf-stat-label">Passed</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value" style="color: ${failingCourses > 0 ? '#dc2626' : '#16a34a'};">${failingCourses}</div>
                                <div class="pdf-stat-label">Failed</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${totalPoints.toFixed(1)}</div>
                                <div class="pdf-stat-label">Total Points</div>
                            </div>
                        </div>
                    </div>

                    <h3 style="color: #0f766e; margin-bottom: 16px; font-size: 18px;">📋 Detailed Course Breakdown</h3>
                    <table class="pdf-grades-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Units</th>
                                <th>Grade</th>
                                <th>Points</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${gradesTableHTML}
                        </tbody>
                    </table>

                    <div class="pdf-footer">
                        <p>© ${new Date().getFullYear()} University CGPA Calculator. Built with care for students.</p>
                        <p>Generated by <strong>Akingbehin Abideen (WETech)</strong></p>
                        <p style="margin-top: 8px;">📞 WhatsApp: <strong>08073866899</strong></p>
                    </div>
                </div>
            `;

            // Configure PDF options
            const opt = {
                margin:       [10, 10, 10, 10],
                filename:     `Detailed_Grades_Report_${new Date().toISOString().split('T')[0]}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Show loading notification
            showNotification('Generating detailed grades PDF...', 'info');

            try {
                // Create a temporary container for PDF content
                const tempContainer = document.createElement('div');
                tempContainer.style.position = 'absolute';
                tempContainer.style.left = '-9999px';
                tempContainer.style.top = '0';
                tempContainer.innerHTML = pdfHTML;
                document.body.appendChild(tempContainer);

                // Generate and download PDF
                html2pdf().set(opt).from(tempContainer).save().then(() => {
                    // Clean up
                    if (document.body.contains(tempContainer)) {
                        document.body.removeChild(tempContainer);
                    }
                    showNotification('Detailed grades PDF downloaded successfully!', 'success');
                }).catch((error) => {
                    // Clean up on error
                    if (document.body.contains(tempContainer)) {
                        document.body.removeChild(tempContainer);
                    }
                    console.error('PDF generation error:', error);
                    showNotification('Error generating PDF. Please try again.', 'error');
                });
            } catch (error) {
                console.error('PDF setup error:', error);
                showNotification('Error setting up PDF generation. Please try again.', 'error');
            }
        }

        // PDF Download Function
        function downloadPDF() {
            // Check if there are calculated results
            const resultsSection = document.querySelector('.results-section');
            if (!resultsSection || !resultsSection.classList.contains('show')) {
                showNotification('Please calculate your CGPA first before downloading PDF', 'warning');
                return;
            }

            // Check if html2pdf is available
            if (typeof html2pdf === 'undefined') {
                showNotification('PDF library not loaded. Please refresh the page.', 'error');
                return;
            }

            // Get CGPA and class from the results section
            const cgpaValue = document.querySelector('.cgpa-value')?.textContent || '0.00';
            const classText = document.querySelector('.cgpa-class')?.textContent || '';
            const totalUnits = document.querySelectorAll('.stat-value')[0]?.textContent || '0';
            const totalPoints = document.querySelectorAll('.stat-value')[1]?.textContent || '0';
            const courseCount = document.querySelectorAll('.stat-value')[2]?.textContent || '0';

            // Get current data from form inputs
            const courseNames = document.querySelectorAll('input[name="courses[]"]');
            const units = document.querySelectorAll('input[name="units[]"]');
            const grades = document.querySelectorAll('select[name="grades[]"]');

            // Generate PDF content
            let gradesTableHTML = '';
            let validCourses = 0;

            for (let i = 0; i < grades.length; i++) {
                const courseName = courseNames[i].value.trim() || `Course ${i + 1}`;
                const unitValue = parseFloat(units[i].value);
                const gradeValue = grades[i].value;
                const points = gradePoints[gradeValue];

                if (!isNaN(unitValue) && unitValue > 0) {
                    const coursePoints = unitValue * points;
                    validCourses++;

                    gradesTableHTML += `
                        <tr>
                            <td>${validCourses}</td>
                            <td>${courseName}</td>
                            <td>${unitValue}</td>
                            <td><span class="pdf-grade-badge pdf-grade-${gradeValue}">${gradeValue}</span></td>
                            <td>${coursePoints.toFixed(1)}</td>
                        </tr>
                    `;
                }
            }

            // If no valid courses in form, but results exist, show simple results PDF
            if (validCourses === 0 && parseInt(courseCount) > 0) {
                showNotification('Generating PDF with calculated results.', 'success');
                gradesTableHTML = `
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px; background: rgba(20, 184, 166, 0.05);">
                            <div style="font-size: 16px; color: #64748b; margin-bottom: 10px;">
                                <strong>📊 CGPA Calculation Results</strong>
                            </div>
                            <div style="font-size: 14px; color: #94a3b8;">
                                This PDF contains your calculated CGPA results. Detailed course breakdown is not available after page reload.
                            </div>
                        </td>
                    </tr>
                `;
            } else if (validCourses === 0) {
                showNotification('No valid courses to include in PDF', 'warning');
                return;
            }

            // Create PDF HTML structure
            const pdfHTML = `
                <div class="pdf-content">
                    <div class="pdf-header">
                        <h1>📊 CGPA Calculator Report</h1>
                        <p>Generated on ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    </div>

                    <div class="pdf-cgpa-display">
                        <div style="font-size: 14px; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">Your Cumulative GPA</div>
                        <div class="pdf-cgpa-value">${cgpaValue}</div>
                        <div class="pdf-class-badge" style="background: rgba(20, 184, 166, 0.1); color: #0f766e; border: 1px solid rgba(20, 184, 166, 0.2);">${classText}</div>

                        <div class="pdf-stats-grid">
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${totalUnits}</div>
                                <div class="pdf-stat-label">Total Units</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${totalPoints}</div>
                                <div class="pdf-stat-label">Total Points</div>
                            </div>
                            <div class="pdf-stat-item">
                                <div class="pdf-stat-value">${courseCount}</div>
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
                            ${gradesTableHTML}
                        </tbody>
                    </table>

                    <div class="pdf-footer">
                        <p>© ${new Date().getFullYear()} University CGPA Calculator. Built with care for students.</p>
                        <p>Generated by <strong>Akingbehin Abideen (WETech)</strong></p>
                        <p style="margin-top: 8px;">📞 WhatsApp: <strong>08073866899</strong></p>
                    </div>
                </div>
            `;

            // Configure PDF options
            const opt = {
                margin:       [10, 10, 10, 10],
                filename:     `CGPA_Report_${new Date().toISOString().split('T')[0]}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Show loading notification
            showNotification('Generating PDF...', 'info');

            try {
                // Create a temporary container for PDF content
                const tempContainer = document.createElement('div');
                tempContainer.style.position = 'absolute';
                tempContainer.style.left = '-9999px';
                tempContainer.style.top = '0';
                tempContainer.innerHTML = pdfHTML;
                document.body.appendChild(tempContainer);

                // Generate and download PDF
                html2pdf().set(opt).from(tempContainer).save().then(() => {
                    // Clean up
                    if (document.body.contains(tempContainer)) {
                        document.body.removeChild(tempContainer);
                    }
                    showNotification('PDF downloaded successfully!', 'success');
                }).catch((error) => {
                    // Clean up on error
                    if (document.body.contains(tempContainer)) {
                        document.body.removeChild(tempContainer);
                    }
                    console.error('PDF generation error:', error);
                    showNotification('Error generating PDF. Please try again.', 'error');
                });
            } catch (error) {
                console.error('PDF setup error:', error);
                showNotification('Error setting up PDF generation. Please try again.', 'error');
            }
        }
    </script>
</body>
</html>