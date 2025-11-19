<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="ADHD Bridge helps adults with ADHD communicate better with their loved ones using structured mood tracking and empathy-based tools.">
    <title>About Us - ADHD Bridge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6f42c1;
            --primary-light: #f0e6ff;
            --secondary: #6c757d;
            --dark: #212529;
            --light: #f8f9fa;
            --accent: #8b5cf6;
            --bg-color: #ffffff;
            --text-color: #212529;
            --card-bg: #ffffff;
            --border-color: rgba(0, 0, 0, 0.05);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #121212;
                --text-color: #e9ecef;
                --card-bg: #1e1e1e;
                --primary-light: #1e0d3a;
                --secondary: #adb5bd;
                --border-color: rgba(255, 255, 255, 0.05);
            }
        }

        [data-bs-theme="dark"] {
            --bg-color: #121212;
            --text-color: #e9ecef;
            --card-bg: #1e1e1e;
            --primary-light: #1e0d3a;
            --secondary: #adb5bd;
            --border-color: rgba(255, 255, 255, 0.05);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.7;
            background-color: var(--bg-color);
        }

        /* Fade-in animation */
        [data-animate] {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.7s ease;
        }

        [data-animate].visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--bg-color) 100%);
            padding: 4rem 0 3rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 2rem;
            position: relative;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .highlight {
            color: var(--primary);
            font-weight: 600;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            height: 100%;
            border-top: 4px solid var(--primary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .mission-section {
            background-color: var(--primary-light);
            padding: 4rem 0;
        }

        .value-item {
            text-align: center;
            padding: 2rem 1rem;
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--primary);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            padding: 4rem 1rem;
            border-radius: 16px;
            text-align: center;
            margin: 3rem 0;
        }

        .btn-light-custom {
            background: white;
            color: var(--primary);
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-light-custom:hover {
            background: #f8f5ff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            color: var(--secondary);
            font-weight: 500;
        }

        .text-muted {
            color: var(--secondary) !important;
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" data-animate>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h1 class="display-5 fw-bold mb-4">About <span class="highlight">ADHD Bridge</span></h1>
                    <p class="lead mb-3">Empowering adults with ADHD to express themselves and connect more effectively
                        with their loved ones.</p>
                    <p class="text-muted">We provide structured tools and a supportive environment to bridge
                        communication gaps and strengthen relationships.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container" data-animate>
            <h2 class="section-title center text-center">Our Mission</h2>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p class="fs-5">We provide a <span class="highlight">safe, private, and user-friendly space</span>
                        where adults with ADHD can share emotions, track moods, and communicate in a supportive
                        environment.</p>
                    <p>Our goal is to strengthen emotional bonds and create a world where neurodiverse voices are
                        understood and valued.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="fas fa-heart"></i></div>
                        <h4>Emotional Support</h4>
                        <p>Helping users identify and express emotions through structured, compassionate tools.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="fas fa-comments"></i></div>
                        <h4>Better Communication</h4>
                        <p>Empowering families and individuals to build clearer, more meaningful conversations.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h4>Progress Tracking</h4>
                        <p>Monitor growth, emotional trends, and improvements in understanding over time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why It Matters -->
    <section class="py-5">
        <div class="container" data-animate>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&w=900&q=80"
                        alt="Family connection" class="img-fluid rounded-3 shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Why It Matters</h2>
                    <p>Communication is the foundation of empathy. With ADHD Bridge, adults can share thoughts openly
                        and be heard — leading to healthier emotional well-being and closer family relationships.</p>
                    <div class="row mt-4">
                        <div class="col-6 mb-3 text-center">
                            <div class="stat-number">85%</div>
                            <div class="stat-label">Improved communication</div>
                        </div>
                        <div class="col-6 mb-3 text-center">
                            <div class="stat-number">72%</div>
                            <div class="stat-label">Feel more understood</div>
                        </div>
                        <div class="col-6 mb-3 text-center">
                            <div class="stat-number">90%</div>
                            <div class="stat-label">Find our tools helpful</div>
                        </div>
                        <div class="col-6 mb-3 text-center">
                            <div class="stat-number">78%</div>
                            <div class="stat-label">Experience less stress</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section bg-light">
        <div class="container" data-animate>
            <h2 class="section-title center text-center mb-5">Our Values</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                        <h4>Privacy & Safety</h4>
                        <p>Your data is always secure — transparency and protection are at the core of ADHD Bridge.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4>Empathy First</h4>
                        <p>We build with compassion, ensuring every tool supports neurodiverse communication needs.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                        <h4>Innovation</h4>
                        <p>Driven by feedback and research, we continuously refine features to make lives easier.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="container" data-animate>
        <div class="cta-section">
            <h2 class="mb-4">Ready to Improve Communication?</h2>
            <p class="fs-5 mb-4">Join ADHD Bridge today and begin building stronger, more understanding relationships.
            </p>
            <a href="" class="btn btn-light-custom">Get Started</a>
        </div>
    </section>

    <?php include("footer.php"); ?>

    <script>
        // Simple scroll-triggered fade-in
        const elements = document.querySelectorAll('[data-animate]');
        const reveal = () => {
            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) el.classList.add('visible');
            });
        };
        document.addEventListener('scroll', reveal);
        window.addEventListener('load', reveal);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>