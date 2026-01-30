<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="The Bridge is a clinical communication and mood documentation platform designed for hospital wards and supported care environments.">
    <title>About Us - The Bridge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0d6efd;
            --primary-light: #e7f1ff;
            --secondary: #6c757d;
            --dark: #1e293b;
            --light: #f8f9fa;
            --bg-color: #ffffff;
            --text-color: #212529;
            --card-bg: #ffffff;
            --border-color: rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.7;
            background-color: var(--bg-color);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
            padding: 4rem 0 3rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
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
            border-left: 4px solid var(--primary);
            transition: transform 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .values-section {
            background: #f9fbff;
            padding: 4rem 0;
        }

        .value-item {
            text-align: center;
            padding: 2rem;
        }

        .value-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .cta-section {
            background: var(--primary);
            color: white;
            padding: 4rem 1rem;
            border-radius: 16px;
            text-align: center;
            margin: 3rem 0;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            color: var(--secondary);
            font-weight: 500;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md navbar-light bg-white py-2 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="Admin_test/worker/dashboard.php">
            <!-- SVG Logo -->
            <svg viewBox="0 0 100 100" width="36" height="36">
                <defs>
                    <linearGradient id="g1" x1="0" x2="1">
                        <stop offset="0" stop-color="#FFD974" />
                        <stop offset="1" stop-color="#FFB4A2" />
                    </linearGradient>
                </defs>
                <circle cx="50" cy="50" r="50" fill="url(#g1)" />
                <path d="M36 60c8-18 28-18 34-6"
                    stroke="#0d6efd"
                    stroke-width="6"
                    stroke-linecap="round"
                    fill="none" />
            </svg>
            <span class="ms-2 fw-bold">The Bridge</span>
        </a>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-5 fw-bold mb-4">About <span class="highlight">The Bridge</span></h1>
        <p class="lead">
            A structured digital communication and mood documentation platform designed for hospital wards,
            supported living services, and clinical environments.
        </p>
        <p class="text-muted">
            The Bridge enables healthcare professionals to document emotional wellbeing, monitor mood patterns,
            and enhance therapeutic communication within secure care settings.
        </p>
    </div>
</section>

<!-- MISSION -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Our Clinical Mission</h2>
        <p class="fs-5">
            The Bridge provides a <span class="highlight">secure and clinically-aligned system</span> for recording
            emotional wellbeing, supporting structured communication, and improving visibility of patient mood trends.
        </p>
        <p>
            Our goal is to support multidisciplinary teams, enhance documentation quality,
            and improve emotional insight within hospital and supported care environments.
        </p>
    </div>
</section>

<!-- FEATURES -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Core Capabilities</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-notes-medical"></i></div>
                    <h5>Structured Mood Documentation</h5>
                    <p>
                        Enables healthcare staff to record mood observations and clinical notes
                        in a consistent, measurable format.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-hospital-user"></i></div>
                    <h5>Ward-Based Communication</h5>
                    <p>
                        Supports improved communication between staff and patients,
                        reducing misunderstandings and improving care engagement.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h5>Data-Driven Insights</h5>
                    <p>
                        Visual trends and reports assist with care planning,
                        reviews, and clinical decision-making.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY IT MATTERS -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Why It Matters in Clinical Care</h2>
        <p>
            Emotional wellbeing significantly impacts patient outcomes.
            The Bridge improves visibility of mood changes,
            supports proactive interventions,
            and strengthens structured care documentation.
        </p>

      <div class="row mt-4 text-center">
    <div class="col-md-3 mb-3">
        <div class="stat-number">
            <span class="counter" data-target="40">0</span>%
        </div>
        <div class="stat-label">Mood Visibility</div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-number">
            <span class="counter" data-target="30">0</span>%
        </div>
        <div class="stat-label">Reduction in Escalations</div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-number">
            <span class="counter" data-target="95">0</span>%
        </div>
        <div class="stat-label">Staff Satisfaction</div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-number">
            <span class="counter" data-target="88">0</span>%
        </div>
        <div class="stat-label">Improved Documentation</div>
    </div>
</div>

    </div>
</section>

<!-- VALUES -->
<section class="values-section">
    <div class="container">
        <h2 class="section-title">Our Clinical Values</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="value-item">
                    <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5>Security & Confidentiality</h5>
                    <p>
                        Role-based access and secure data handling aligned with healthcare standards.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-item">
                    <div class="value-icon"><i class="fas fa-hand-holding-medical"></i></div>
                    <h5>Patient-Centred Care</h5>
                    <p>
                        Designed to support neurodivergent individuals within structured clinical environments.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-item">
                    <div class="value-icon"><i class="fas fa-flask"></i></div>
                    <h5>Evidence-Informed Design</h5>
                    <p>
                        Continuously refined through real-world care feedback and structured evaluation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="container">
    <div class="cta-section">
        <h2>Enhance Clinical Communication Today</h2>
        <p class="fs-5 mt-3">
            Discover how The Bridge App can support your Hospital, Clinic, supported living service,
            or clinical team in delivering structured emotional care.
        </p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const counters = document.querySelectorAll('.counter');

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const speed = 200; // lower = faster
        const increment = target / speed;

        let count = 0;

        const updateCount = () => {
            count += increment;

            if (count < target) {
                counter.innerText = Math.ceil(count);
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    };

    // Trigger animation only when section is visible
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                counters.forEach(counter => {
                    if (!counter.classList.contains("counted")) {
                        animateCounter(counter);
                        counter.classList.add("counted");
                    }
                });
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stat-number').parentElement.parentElement;
    observer.observe(statsSection);

});
</script>

</body>
</html>
