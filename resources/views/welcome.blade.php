<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NHM Hridyam | Kerala Govt Initiative</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #0ea5e9;
            --accent: #10b981;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            line-height: 1.6;
        }

        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05);
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar .logo span {
            color: var(--text-main);
            font-size: 1rem;
            font-weight: 500;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .btn-outline {
            color: var(--primary);
            background: transparent;
            border: 2px solid var(--primary);
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-solid {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .btn-solid:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
        }

        /* Hero Section */
        .hero {
            padding: 10rem 5% 6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 50%;
            height: 200%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
            transform: rotate(-45deg);
        }

        .hero-badge {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.6s ease-out;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #0f172a;
            max-width: 800px;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero p {
            font-size: 1.125rem;
            color: var(--text-muted);
            max-width: 650px;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1.2s ease-out;
        }

        .hero-actions .btn-solid {
            padding: 0.875rem 2rem;
            font-size: 1.125rem;
        }

        /* Stats Section */
        .stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            padding: 4rem 5%;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .stat-card {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.875rem;
        }

        /* Features Section */
        .features {
            padding: 6rem 5%;
            background: var(--background);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--text-main);
            margin-bottom: 1rem;
        }

        .section-header p {
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: var(--border);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-main);
        }

        .feature-desc {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: #0f172a;
            color: white;
            padding: 4rem 5% 2rem;
            text-align: center;
        }

        .footer p {
            color: #94a3b8;
            margin-bottom: 1rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .stats { flex-direction: column; gap: 2rem; }
            .nav-links { display: none; } /* Could implement a hamburger menu here */
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"></path></svg>
            Hridyam
            <span>| Kerala Govt</span>
        </a>
        <div class="nav-links">
            <a href="{{ route('register.resumeForm') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500;">Resume Application</a>
            <a href="/login" class="btn-outline">Official Login</a>
            <a href="{{ route('register.index') }}" class="btn-solid">Public Registration</a>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-badge">Est. 2017 • Government of Kerala</div>
        <h1>Comprehensive <span>Congenital Heart Disease</span> Care for Children</h1>
        <p>A pioneering initiative to provide free, world-class treatment, including life-saving surgeries, for children up to 18 years. We focus on early detection, priority neonatal care, and comprehensive post-operative support.</p>
        <div class="hero-actions">
            <a href="{{ route('register.index') }}" class="btn-solid">Start Registration</a>
            <a href="{{ route('register.resumeForm') }}" class="btn-outline" style="border: none; background: rgba(37,99,235,0.1); border: 2px solid transparent;">Resume Existing</a>
        </div>
    </header>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-number">8,000+</div>
            <div class="stat-label">Children Treated</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">100%</div>
            <div class="stat-label">Free Treatment</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">18</div>
            <div class="stat-label">Years Max Age Limit</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Neonatal Support</div>
        </div>
    </section>

    <section class="features">
        <div class="section-header">
            <h2>Why NHM Hridyam?</h2>
            <p>We are dedicated to ensuring that no child is left behind due to congenital heart conditions, bringing state-of-the-art care to those who need it most.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <h3 class="feature-title">Early Detection</h3>
                <p class="feature-desc">We emphasize early screening and diagnosis across Kerala to identify congenital heart diseases at the earliest possible stage, allowing for timely medical intervention.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                </div>
                <h3 class="feature-title">High-Priority Care</h3>
                <p class="feature-desc">Specialized neonatal care and surgical prioritization based on medical urgency to ensure immediate attention to critical cases.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="feature-title">Complete Coverage</h3>
                <p class="feature-desc">100% free comprehensive treatment spanning from initial investigations to complex surgical procedures and intensive post-operative care.</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2026 National Health Mission (NHM) Kerala. All rights reserved.</p>
        <p style="font-size: 0.875rem;">A state government initiative dedicated to pediatric heart health.</p>
    </footer>

</body>
</html>
