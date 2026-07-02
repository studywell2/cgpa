<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University CGPA Calculator</title>

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
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
            box-shadow: 0 0 6px rgba(99, 102, 241, 0.4);
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
            background: #6366f1;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: #8b5cf6;
            bottom: -50px;
            left: -50px;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: #3b82f6;
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
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
            background: rgba(99, 102, 241, 0.1);
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
            background: #6366f1;
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
            background: #6366f1;
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
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transition: all 0.3s;
        }

        .logo:hover .logo-icon {
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
            transform: translateY(-2px);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
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
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .header-nav a:hover {
            color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(135deg, #f8fafc, #94a3b8, #6366f1);
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
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                        0 0 0 1px rgba(99, 102, 241, 0.05);
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
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .semester-badge {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
            transition: all 0.3s;
        }

        .semester-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
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
            border: 1px solid rgba(99, 102, 241, 0.05);
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
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .course-number {
            font-size: 0.7rem;
            font-weight: 600;
            color: #6366f1;
            text-align: center;
            padding: 4px 8px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 6px;
        }

        .course-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 8px;
            padding: 10px 14px;
            color: #e2e8f0;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .course-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .course-input:hover {
            border-color: rgba(99, 102, 241, 0.3);
        }

        .course-input::placeholder {
            color: #64748b;
        }

        .grade-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 8px;
            padding: 10px 14px;
            color: #e2e8f0;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236366f1' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .grade-select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .grade-select:hover {
            border-color: rgba(99, 102, 241, 0.3);
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

        .btn-add {
            background: rgba(99, 102, 241, 0.1);
            color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.2);
            flex: 1;
        }

        .btn-add:hover {
            background: rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-add:active {
            transform: translateY(0);
        }

        .btn-calculate {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            flex: 2;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-calculate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-calculate:active {
            transform: translateY(0);
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
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            text-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
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
            border-top: 1px solid rgba(99, 102, 241, 0.1);
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
            border: 1px solid rgba(99, 102, 241, 0.1);
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
            border-color: rgba(99, 102, 241, 0.2);
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
            color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
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
            transition: all 0.3s;
        }

        .footer-credit a:hover {
            text-decoration: underline;
            color: #8b5cf6;
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
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #94a3b8;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .social-icon:hover {
            background: rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.4);
            color: #6366f1;
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .social-icon:active {
            transform: translateY(-2px) scale(1.05);
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
                position: fixed;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(15, 23, 42, 0.95);
                backdrop-filter: blur(20px);
                flex-direction: column;
                gap: 20px;
                padding: 20px;
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s;
                border-bottom: 1px solid rgba(99, 102, 241, 0.1);
                z-index: 1000;
            }

            .header-nav.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .hamburger {
                display: flex;
            }

            .main-content {
                padding: 24px 14px;
            }

            .hero h1 {
                font-size: 1.6rem;
            }

            .hero p {
                font-size: 0.9rem;
            }

            .calculator-card {
                padding: 18px;
                border-radius: 16px;
            }

            .course-row {
                grid-template-columns: 28px 1fr 90px 75px 28px;
                gap: 8px;
                padding: 12px 8px;
            }

            .table-header {
                grid-template-columns: 28px 1fr 90px 75px 28px;
                font-size: 0.6rem;
                padding: 0 8px 10px;
            }

            .course-input, .grade-select {
                padding: 8px 10px;
                font-size: 0.75rem;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                width: 100%;
                padding: 12px 18px;
                font-size: 0.8rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .cgpa-value {
                font-size: 2.5rem;
            }

            .grading-info {
                padding: 16px;
            }

            .grading-table {
                grid-template-columns: repeat(2, 1fr);
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

            .hero h1 {
                font-size: 1.4rem;
            }

            .hero p {
                font-size: 0.85rem;
            }

            .calculator-card {
                padding: 14px;
            }

            .card-header {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }

            .course-row {
                grid-template-columns: 1fr 1fr;
                gap: 6px;
                padding: 10px 8px;
            }

            .course-number {
                grid-column: 1;
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
            }

            .table-header {
                display: none;
            }

            .results-card {
                padding: 20px 16px;
            }

            .grading-table {
                grid-template-columns: 1fr;
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
                </div>
            </div>
            @endif
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
            <a href="https://wa.me/08073866899" target="_blank" class="social-icon" title="WhatsApp">💬</a>
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
            for (let i = 0; i < 5; i++) {
                addCourse();
            }
            createParticles();
            initSmoothScroll();
            initInputAnimations();
        });

        function addCourse() {
            courseCounter++;
            const container = document.getElementById('courses');

            const row = document.createElement('div');
            row.className = 'course-row';
            row.id = `course-${courseCounter}`;

            row.innerHTML = `
                <span class="course-number">${courseCounter}</span>
                <input type="text" name="courses[]" class="course-input" placeholder="Course name (e.g., MATH 101)">
                <input type="number" name="units[]" class="course-input" placeholder="Units" min="1" max="6" required>
                <select name="grades[]" class="grade-select" onchange="updateGradeBadge(this)">
                    <option value="A">A (5.0)</option>
                    <option value="B">B (4.0)</option>
                    <option value="C">C (3.0)</option>
                    <option value="D">D (2.0)</option>
                    <option value="E">E (1.0)</option>
                    <option value="F">F (0.0)</option>
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

        function updateGradeBadge(select) {
            // Visual feedback for grade selection
            select.style.borderColor = '#6366f1';
            select.style.boxShadow = '0 0 0 3px rgba(99, 102, 241, 0.2)';
            setTimeout(() => {
                select.style.borderColor = '';
                select.style.boxShadow = '';
            }, 500);
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
            nav.classList.toggle('active');
            hamburger.classList.toggle('active');
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

        // Form validation
        document.getElementById('cgpaForm').addEventListener('submit', function(e) {
            const units = document.querySelectorAll('input[name="units[]"]');
            let hasError = false;

            units.forEach(input => {
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
            }
        });

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
    </script>
</body>
</html>