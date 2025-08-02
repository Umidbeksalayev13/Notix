<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTIX - Eslatmalar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        header {
            background: #ffffff;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .logo-text p {
            font-size: 0.875rem;
            color: #64748b;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #475569;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .nav-links a:hover {
            color: #3b82f6;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .hero {
            padding: 5rem 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.25rem;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.8);
            color: #475569;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature {
            text-align: center;
        }

        .feature-icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-icon.blue {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .feature-icon.green {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        }

        .feature-icon.purple {
            background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
        }

        .feature h3 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .feature p {
            color: #64748b;
            font-size: 0.875rem;
        }

        /* Demo Section */
        .demo {
            text-align: center;
            margin-top: 3rem;
        }

        .phone-mockup {
            max-width: 300px;
            margin: 0 auto;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transform: rotate(-5deg);
            transition: transform 0.3s ease;
        }

        .phone-mockup:hover {
            transform: rotate(0deg);
        }

        .phone-header {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            padding: 1.5rem;
            color: white;
            text-align: center;
        }

        .phone-header h3 {
            font-weight: 600;
        }

        .notes-list {
            padding: 1.5rem;
        }

        .note-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
        }

        .note-item:hover {
            transform: translateX(5px);
        }

        .note-item.blue {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .note-item.green {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        }

        .note-item.yellow {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
        }

        .note-item.purple {
            background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
        }

        .note-dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .note-content h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .note-content p {
            font-size: 0.875rem;
            color: #64748b;
        }

        /* Footer */
        footer {
            background: #f8fafc;
            padding: 2rem 0;
            margin-top: 5rem;
            border-top: 1px solid #e2e8f0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-logo-icon {
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-text {
            color: #64748b;
            font-size: 0.875rem;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .container {
                padding: 0 2rem;
            }

            .hero-content {
                grid-template-columns: 2fr 1fr;
                gap: 4rem;
            }

            .hero-text h1 {
                font-size: 3.5rem;
            }

            .hero-buttons {
                flex-wrap: nowrap;
            }

            .features {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .hero-text h1 {
                font-size: 4rem;
            }

            .hero {
                padding: 6rem 0;
            }
        }

        @media (max-width: 640px) {
            .nav-links {
                gap: 0.5rem;
            }

            .nav-links a {
                padding: 0.5rem;
                font-size: 0.875rem;
            }

            .btn-primary {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .hero {
                padding: 3rem 0;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                text-align: center;
                justify-content: center;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(-5deg); }
        }

        .phone-mockup {
            animation: float 6s ease-in-out infinite;
        }

        .svg-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .svg-icon-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <div class="logo-icon">
                        <svg class="svg-icon" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="logo-text">
                        <h1>NOTIX</h1>
                        <p>Eslatmalar Tizimi</p>
                    </div>
                </div>

                <div class="nav-links">
                    <a href="/login">Kirish</a>
                    <a href="/register" class="btn-primary">Ro'yxatdan o'tish</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>
                        <span class="gradient-text">Eslatmalaringizni</span><br>
                        Boshqaring
                    </h1>
                    <p>
                        NOTIX bilan muhim vazifalar, uchrashuvlar va g'oyalaringizni osonlik bilan kuzatib boring.
                        Zamonaviy va qulay interfeys bilan barcha eslatmalaringiz bir joyda.
                    </p>

                    <div class="hero-buttons">
                        <a href="/register" class="btn-primary">
                            <svg class="svg-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Bepul Boshlash
                        </a>
                        <a href="/login" class="btn-secondary">
                            <svg class="svg-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Hisobga Kirish
                        </a>
                    </div>

                    <div class="features">
                        <div class="feature">
                            <div class="feature-icon blue">
                                <svg class="svg-icon" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3>Vaqt Boshqaruvi</h3>
                            <p>Barcha vazifalaringizni vaqtida bajaring</p>
                        </div>

                        <div class="feature">
                            <div class="feature-icon green">
                                <svg class="svg-icon" fill="none" stroke="#10b981" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3>Oson Boshqaruv</h3>
                            <p>Intuitiv va qulay interfeys</p>
                        </div>

                        <div class="feature">
                            <div class="feature-icon purple">
                                <svg class="svg-icon" fill="none" stroke="#8b5cf6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <h3>Sync</h3>
                            <p>Barcha qurilmalarda sinxronlash</p>
                        </div>
                    </div>
                </div>

                <div class="demo">
                    <div class="phone-mockup">
                        <div class="phone-header">
                            <h3>NOTIX</h3>
                        </div>
                        <div class="notes-list">
                            <div class="note-item blue">
                                <div class="note-dot" style="background-color: #3b82f6;"></div>
                                <div class="note-content">
                                    <h4>Loyiha yakunlash</h4>
                                    <p>Bugun 14:00</p>
                                </div>
                            </div>

                            <div class="note-item green">
                                <div class="note-dot" style="background-color: #10b981;"></div>
                                <div class="note-content">
                                    <h4>Ijrokom yig'ilishi</h4>
                                    <p>Ertaga 09:30</p>
                                </div>
                            </div>

                            <div class="note-item yellow">
                                <div class="note-dot" style="background-color: #f59e0b;"></div>
                                <div class="note-content">
                                    <h4>Mijoz bilan uchrashuv</h4>
                                    <p>Dushanba 11:00</p>
                                </div>
                            </div>

                            <div class="note-item purple">
                                <div class="note-dot" style="background-color: #8b5cf6;"></div>
                                <div class="note-content">
                                    <h4>Hisobot tayyorlash</h4>
                                    <p>Seshanba 16:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <div class="footer-logo-icon">
                        <svg class="svg-icon-sm" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <span>NOTIX</span>
                </div>
                <p class="footer-text">© 2024 NOTIX. Barcha huquqlar himoyalangan.</p>
            </div>
        </div>
    </footer>
</body>
</html>
