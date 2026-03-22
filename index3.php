<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Astro v5.13.2">
  <title>Carousel Template · Bootstrap v5.3</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
  <!-- <script src="/docs/5.3/assets/js/color-modes.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="carousel.css">
  <script>
    // Dark mode manager – replaces the missing Bootstrap /docs color-modes.js
    (() => {
      const getStoredTheme = () => localStorage.getItem('theme');
      const setStoredTheme = t => localStorage.setItem('theme', t);
      const getPreferredTheme = () => getStoredTheme() || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

      const applyTheme = theme => {
        document.documentElement.setAttribute('data-bs-theme', theme === 'auto'
          ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
          : theme);
      };

      applyTheme(getPreferredTheme());

      window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-bs-theme-value]').forEach(btn => {
          btn.addEventListener('click', () => {
            const theme = btn.getAttribute('data-bs-theme-value');
            setStoredTheme(theme);
            applyTheme(theme);
            // Update active checkmarks
            document.querySelectorAll('[data-bs-theme-value]').forEach(b => {
              const check = b.querySelector('.bi');
              if (check) check.classList.toggle('d-none', b !== btn);
            });
          });
        });
      });
    })();
  </script>
  <style>
    /* ── Placeholder images ── */
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }
    @media (min-width: 768px) {
      .bd-placeholder-img-lg { font-size: 3.5rem; }
    }

    /* ── Bootstrap docs utilities (kept as-is) ── */
    .b-example-divider {
      width: 100%; height: 3rem;
      background-color: rgba(0,0,0,.1);
      border: solid rgba(0,0,0,.15); border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0,0,0,.1), inset 0 .125em .5em rgba(0,0,0,.15);
    }
    .b-example-vr { flex-shrink: 0; width: 1.5rem; height: 100vh; }
    .bi { vertical-align: -.125em; fill: currentColor; }
    .nav-scroller { position: relative; z-index: 2; height: 2.75rem; overflow-y: hidden; }
    .nav-scroller .nav {
      display: flex; flex-wrap: nowrap; padding-bottom: 1rem; margin-top: -1px;
      overflow-x: auto; text-align: center; white-space: nowrap; -webkit-overflow-scrolling: touch;
    }

    /* ── Theme-toggle button ── */
    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }
    .bd-mode-toggle { z-index: 1500; }
    .bd-mode-toggle .bi { width: 1em; height: 1em; }
    .bd-mode-toggle .dropdown-menu .active .bi { display: block !important; }

    /* ════════════════════════════════
       LAYOUT-ONLY OVERRIDES
    ════════════════════════════════ */

    /* Navbar: use a contained width instead of full-fluid */
    .navbar > .container-fluid {
      max-width: 1320px;
      margin-inline: auto;
      padding-inline: 1.5rem;
    }

    /* Push nav-links to center; keep search on the right */
    .navbar-nav.me-auto {
      margin-left: auto !important;
      margin-right: auto !important;
    }

    /* Carousel: account for fixed navbar + consistent height */
    #myCarousel {
      margin-top: 56px;
    }
    #myCarousel .bd-placeholder-img {
      height: 520px;
      display: block;
    }
    .carousel-caption {
      bottom: 3rem;
      padding-bottom: 0;
    }

    /* Marketing wrapper: tighter vertical rhythm */
    .container.marketing {
      padding-top: 4rem;
      padding-bottom: 1rem;
    }

    /* Feature columns: card treatment with equal height */
    .marketing .row:first-child {
      row-gap: 1.5rem;
    }
    .marketing .row:first-child .col-lg-4 {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 2rem 1.75rem;
      border: 1px solid var(--bs-border-color);
      border-radius: .75rem;
      background: var(--bs-body-bg);
      transition: box-shadow .2s, transform .2s;
    }
    .marketing .row:first-child .col-lg-4:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 28px rgba(0,0,0,.18);
    }
    .marketing .row:first-child .col-lg-4 h2 {
      margin-top: 1rem;
      font-size: 1.25rem;
    }
    .marketing .row:first-child .col-lg-4 p:last-of-type {
      margin-top: auto;
      padding-top: 1rem;
    }

    /* Featurette rows: vertically centered, more breathing room */
    .row.featurette {
      align-items: center;
      padding-block: 1rem;
      row-gap: 2rem;
    }
    .featurette-image {
      border-radius: .5rem;
      border: 1px solid var(--bs-border-color);
      display: block;
    }
    .featurette-divider {
      margin-block: 3.5rem;
      border-color: var(--bs-border-color);
    }

    /* Footer: flex row instead of float */
    footer.container {
      display: flex !important;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: .5rem;
      padding-block: 1.75rem;
      margin-top: 1rem;
      border-top: 1px solid var(--bs-border-color);
      font-size: .875rem;
      color: var(--bs-secondary-color);
    }
    footer.container p {
      margin-bottom: 0;
    }
    /* Remove the old float-end paragraph */
    footer.container p.float-end {
      float: none !important;
    }
  </style>
</head>

<body>

<!-- SVG sprite (unchanged) -->
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="check2" viewBox="0 0 16 16">
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
  </symbol>
  <symbol id="circle-half" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
  </symbol>
  <symbol id="moon-stars-fill" viewBox="0 0 16 16">
    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
  </symbol>
  <symbol id="sun-fill" viewBox="0 0 16 16">
    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
  </symbol>
</svg>

<!-- Theme toggle (unchanged) -->
<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
  <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
    <svg class="bi my-1 theme-icon-active" aria-hidden="true"><use href="#moon-stars-fill"></use></svg>
    <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
        <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#sun-fill"></use></svg>
        Light
        <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
      </button>
    </li>
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
        <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#moon-stars-fill"></use></svg>
        Dark
        <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
      </button>
    </li>
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
        <svg class="bi me-2 opacity-50" aria-hidden="true"><use href="#circle-half"></use></svg>
        Auto
        <svg class="bi ms-auto d-none" aria-hidden="true"><use href="#check2"></use></svg>
      </button>
    </li>
  </ul>
</div>

<!-- Header (unchanged) -->
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MANDERA NORTH CDF BURSARY APPLICATION MANAGEMENT SYSTEM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="admin/index.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-disabled="false" href="student/index.php">Student</a>
          </li>
        </ul>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button> -->
        </form>
      </div>
    </div>
  </nav>
</header>

<main>

  <!-- Carousel (unchanged) -->
  <div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/Mount-Kenya-University-24th-graduation-Speeches-1024x384.png" class="bd-placeholder-img d-block w-100" alt="Students on university campus" style="object-fit:cover;height:520px;">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Empowering Tomorrow's Leaders</h1>
            <strong><p class="opacity-100" style="font-size: 14pt;">Building Futures, One Student at a Time</p></strong>
            <p><a class="btn btn-lg btn-primary" href="student/index.php">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/pavallion.jpg" class="bd-placeholder-img d-block w-100" alt="Scholarship award ceremony" style="object-fit:cover;height:520px;">
        <div class="container">
          <div class="carousel-caption">
            <h1>Investing in Education</h1>
            <strong><p style="font-size: 14pt;">A Transparent Process. Fair and Accountable.</p></strong>
            <p><a class="btn btn-lg btn-primary" href="#learnmore">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/students.jpg" class="bd-placeholder-img d-block w-100" alt="University graduation ceremony" style="object-fit:cover;height:520px;">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Your Future Starts Here</h1>
            <strong><p style="font-size: 14pt;">Apply Today. Your Education Can't Wait</p></strong>
            <p><a class="btn btn-lg btn-primary" href="student/index.php">Sign Up</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Marketing messaging and featurettes -->
  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row g-4">
      <div class="col-lg-4">
        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=300&auto=format&fit=crop" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Apply for bursary" style="object-fit:cover;">
        <!-- <p><a class="btn btn-secondary" href="#">View details »</a></p> -->
      </div>
      <div class="col-lg-4">
        <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=300&auto=format&fit=crop" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Check eligibility" style="object-fit:cover;">
        <!-- <p><a class="btn btn-secondary" href="#">View details »</a></p> -->
      </div>
      <div class="col-lg-4">
        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=300&auto=format&fit=crop" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Funds disbursement" style="object-fit:cover;">
        <!-- <p><a class="btn btn-secondary" href="#">View details »</a></p> -->
      </div>
    </div>

    <!-- START THE FEATURETTES -->
    <hr class="featurette-divider">
    <div id="learnmore"></div>
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Bridging the gap between dreams and degrees <span class="text-body-secondary"></span></h2>
        <p class="lead">A management system should do more than just process paperwork; it should clear the path for the next generation of leaders. Our streamlined platform removes the administrative bottlenecks from bursary allocation, ensuring that financial aid reaches the right students faster and more efficiently. We believe that no student should have their journey cut short by a complex application process.</p>
      </div>
      <div class="col-md-5">
        <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=600&auto=format&fit=crop" class="featurette-image img-fluid mx-auto d-block" width="500" height="500" alt="Students studying in library" style="object-fit:cover;border-radius:.5rem;">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Empowering Student Success <span class="text-body-secondary"></span></h2>
        <p class="lead">Take the lead in supporting the next generation. Our streamlined system removes the administrative bottlenecks from bursary allocation, ensuring financial aid reaches the right students faster and more efficiently than ever before.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="https://images.unsplash.com/photo-1560439513-74b037a25d84?w=600&auto=format&fit=crop" class="featurette-image img-fluid mx-auto d-block" width="500" height="500" alt="Officials reviewing bursary applications" style="object-fit:cover;border-radius:.5rem;">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Investing in Future Leaders <span class="text-body-secondary"></span></h2>
        <p class="lead">Our Bursary Management System doesn't just manage funds; it fosters community. By making financial support more accessible, we help students focus on what truly matters: collaborating, learning, and growing together. When the administrative burden is lifted, students have the space to innovate and build the networks that will define their future careers.</p>
      </div>
      <div class="col-md-5">
        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&auto=format&fit=crop" class="featurette-image img-fluid mx-auto d-block" width="500" height="500" alt="Happy graduating students" style="object-fit:cover;border-radius:.5rem;">
      </div>
    </div>

    <hr class="featurette-divider">
    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2026 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>

</main>
<!-- <script src="/docs/5.3/assets/js/color-modes.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>