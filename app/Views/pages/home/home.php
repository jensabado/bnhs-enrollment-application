<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicons -->
  <link href="<?= base_url('home-assets/img/logo.png') ?>" rel="icon">
  <link href="<?= base_url('home-assets/img/logo.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('home-assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/animate.css/animate.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('home-assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

  <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
  <!-- Template Main CSS File -->
  <link href="<?= base_url('home-assets/css/style.css') ?>" rel="stylesheet">


  <title><?= isset($pageTitle) ? $pageTitle : 'BNHS' ?></title>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php"> <a href="index.html" class="logo me-auto">
            <img src="<?= base_url('home-assets/img/bnhs-logo.png') ?>" alt="" class="img-fluid">
          </a> BNHS</a></h1>


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="./#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="./#about">About</a></li>
          <li><a class="nav-link scrollto" href="./#announcement">Announcement</a></li>
          <li><a class="nav-link scrollto" href="./#admission">Admission</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="/login" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex">
    <div class="container d-flex align-content-center flex-wrap">
      <div class="row d-flex align-content-center flex-wrap">
        <div class="col-lg-3 text-center">
          <a href="index.php"><img src="<?= base_url('home-assets/img/logo.png') ?>" alt="" class="img-logo" width="220px"></a>
        </div>
        <div class="col-lg-9 text-right">
          <h1 style="color: #fff !important;" class="mt-2 font-weight-bold">Bacoor National High School</h1>
          <h2>Molino Main Campus</h2>
          <h4>A better learning future starts here.</h4>
          <a href="registration.php" target="_blank" class="btn-get-started scrollto mt-3"><b>ENROLL NOW</b></a>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="about" class="why-us">
      <div class="container">
        <hr>
        <div class="row">
          <div class="col-lg-5">
            <img src="<?= base_url('home-assets/img/gallery/bnhs2.jpg') ?>" width="500" />
          </div>
          <div class="col-lg-7">
            <h4 class="text-dark mt-3"><b>About BNHS- Molino Main Campus</b></h4>
            <p style="text-align: justify;">Education is the foundation of progress and development for any
              nation. In the Philippines, Bacoor National High School – Molino Main (BNHS Molino Main) stands
              as a beacon of knowledge and empowerment. Established on Tuesday, January 01, 1985, BNHS Molino
              Main has played a crucial role in shaping the minds of countless students in Bacoor, Cavite.
              This essay explores the history, impact, and significance of BNHS Molino Main as an educational
              institution.
              <br><br>
              BNHS Molino Main operates as a monograde class organization, focusing on delivering quality
              education and personalized attention to each student. The curricular class at the school is
              designed to impart essential knowledge and skills to prepare students for higher education and
              future challenges.
            </p>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row text-center">
          <div class="col-lg-4 d-flex align-items-stretch ">
            <div class="content text-white p-4 mb-2" style="background-color: #274c43; border-radius: 5px;">

              <h3><i class="bx bx-book"></i> HISTORY</h3>
              <p style="text-align: justify;">
                BNHS Molino Main, previously known as Bacoor NHS – Molino Annex, originated as an extension
                of Bacoor National High School. Recognizing the need to cater to the growing population in
                the Molino area, the Department of Education (DepEd) established this annex school in 1985.
                It was a strategic move to provide accessible education to the local community without the
                need for students to travel long distances.
              </p>
            </div>
          </div>

          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content text-white p-4 mb-2" style="background-color: #274c43; border-radius: 5px;">
              <h3><i class="bx bx-target-lock"></i> MISSION</h3>
              <p style="text-align: justify;">To protect and promote the right of every Filipino to quality,
                equitable, culture-based, and complete basic education where:<br><br>Students learn in a
                child-friendly, gender-sensitive, safe, and motivating environment.
                Teachers facilitate learning and constantly nurture every learner.
                Administrators and staff, as stewards of the institution, ensure an enabling and supportive
                environment for effective learning to happen.
                Family, community, and other stakeholders are actively engaged and share responsibility for
                developing life-long learners.

              </p>

            </div>
          </div>
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content text-white p-4 mb-2" style="background-color:#274c43; border-radius: 5px;">
              <h3><i class="bx bx-notepad"></i> VISION</h3>
              <p style="text-align: justify;">
                We dream of Filipinos who passionately love their country and whose values and competencies
                enable them to realize their full potential and contribute meaningfully to building the
                nation. <br><br>As a learner-centered public institution, the Department of Education
                continuously improves itself to better serve its stakeholders.
              </p>
            </div>
          </div>
        </div>
    </section>

    <!-- Portfolio-->
    <section id="announcement" style="background-image: url('assets/img/gallery/b5.png'); background-size: cover;">
      <div class="container px-4 px-lg-5 ">
        <div class="section-title">
          <h2 class="text-white">ANNOUNCEMENT</h2>
        </div>
        <div class="row gx-0">
          <div class="col-lg-4 p-1">
            <a class="portfolio-item" href="#!">
              <div class="caption">
                <div class="caption-content">
                  <!-- <div class="h2">Event name</div>
                              <p class="mb-0">Put description here</p> -->
                </div>
              </div>
              <img class="img-fluid" src="<?= base_url('home-assets/img/gallery/A1.jpg') ?>" alt="..." />
            </a>
          </div>
          <div class="col-lg-4  p-1">
            <a class="portfolio-item" href="#!">
              <div class="caption">
                <div class="caption-content">
                  <!-- <div class="h2">Event name</div>
                            <p class="mb-0">Put description here</p> -->
                </div>
              </div>
              <img class="img-fluid" src="<?= base_url('home-assets/img/gallery/A7.jpg') ?>" alt="..." />
            </a>
          </div>
          <div class="col-lg-4  p-1">
            <a class="portfolio-item" href="#!">
              <div class="caption">
                <div class="caption-content">
                  <!-- <div class="h2">Event name</div>
                            <p class="mb-0">Put description here</p> -->
                </div>
              </div>
              <img class="img-fluid" src="<?= base_url('home-assets/img/gallery/A2.jpg') ?>" alt="..." />
            </a>
          </div>

        </div>
      </div>

    </section>
    <!-- ======= Admissions Section ======= -->
    <section id="admission">
      <div class="container">
        <div class="section-title">
          <h2>ADMISSION REQUIREMENTS</h2>
        </div>
        <div class="container">
          <div class="row text-center">
            <div class="col-lg-4 d-flex align-items-stretch ">
              <div class="content p-4 mb-2"
                style="background-color: #fff; border: 3px solid #274c43; border-radius: 5px; color: #274c43 !important;">
                <h3 style="background-color: #274c43; color: #fff; padding: 12px; border-radius: 5px;">
                  <b>NEW STUDENT</b>
                </h3>
                <ul style="text-align: left; ">
                  <li> Application Form</li>
                  <li> Original copy of Form 137</li>
                  <li> Original copy of Form 138 (Student’s report card properly accomplished and signed
                    by the school’s director or principal issuing it.)</li>
                  <li> Certified true copy of Birth Certificate (PSA/NSO)</li>
                  <li> Latest 2×2 photograph (4 copies)</li>
                  <li> Certificate of good moral character by the principal or guidance counselor</li>
                  <li> Barangay Certificate</li>
                </ul>
              </div>
            </div>

            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="content p-4 mb-2"
                style="background-color: #fff; border: 3px solid #274c43; border-radius: 5px; color: #274c43 !important;">
                <h3 style="background-color: #274c43; color: #fff; padding: 12px; border-radius: 5px;">
                  <b>OLD STUDENT</b>
                </h3>
                <ul style="text-align: left;">
                  <li> Original copy of Form 138 (Student’s report card properly accomplished and signed
                    by the school’s director or principal issuing it.)</li>
                  <li> Latest 2×2 photograph (4 copies)</li>
                  <li> Barangay Certificate</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
              <div class="content p-4 mb-2"
                style="background-color: #fff; border: 3px solid #274c43; border-radius: 5px; color: #274c43 !important;">
                <h3 style="background-color: #274c43; color: #fff; padding: 12px; border-radius: 5px;">
                  <b>TRANSFEREE</b>
                </h3>
                <ul style="text-align: left;">
                  <li> Application Form</li>
                  <li> Original copy of Form 138 (Student’s report card properly accomplished and signed
                    by the school’s director or principal issuing it.)</li>
                  <li> Certified true copy of Birth Certificate (PSA/NSO)</li>
                  <li> Latest 2×2 photograph (4 copies)</li>
                  <li> Certificate of good moral character by the principal or guidance counselor</li>
                  <li> Barangay Certificate</li>
                </ul>
              </div>
            </div>
          </div>


        </div>
    </section><!-- End Departments Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-2 col-md-6 footer-links">
            <a href="index.html"><img src="<?= base_url('home-assets/img/logo.png') ?>" alt="" width="200px"></a>
          </div>

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3>BNHS-Molino Main</h3>
            <p>
              Molino Road <br>
              Molino 1 4102 Bacoor,<br>
              Philippines <br><br>
              <strong>Phone:</strong> (046) 417 6149<br>
              <strong>Email:</strong> 301171@deped.gov.ph<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="./index">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./index#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./index#announcement">Announcement</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./index#admission">Admission</a></li>
            </ul>
          </div>


          <div class="col-lg-4 col-md-6">
            <div class="mapouter">
              <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0"
                  marginwidth="0"
                  src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=bacoor national high school molino&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                  href="https://connectionsgame.org/">Connections Game</a></div>
              <style>
              .mapouter {
                position: relative;
                text-align: right;
              }

              .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 300px;
              }

              .gmap_iframe {
                height: 300px !important;
              }
              </style>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Bacoor National High School - Molino Main</span></strong>. All Rights
          Reserved
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://www.google.com/maps/place/Bacoor+National+High+School+-+Main/@14.4227532,120.9406304,14z/data=!4m10!1m2!2m1!1sbacoor+national+high+school+mission!3m6!1s0x3397d279a3f75eff:0x10ef3a203beeee93!8m2!3d14.4227532!4d120.9756493!15sCiNiYWNvb3IgbmF0aW9uYWwgaGlnaCBzY2hvb2wgbWlzc2lvbpIBBnNjaG9vbOABAA!16s%2Fg%2F1tcxm5x6?entry=ttu"
          class="twitter"><i class="bx bxl-google"></i></a>
        <a href="https://www.facebook.com/BacoorNHS.main.OFFICIAL" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://twitter.com/i/flow/login?redirect_after_login=%2Fbnhsmain" class="twitter"><i
            class="bx bxl-twitter"></i></a>
        <!-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('home-assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
  <script src="<?= base_url('home-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('home-assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="<?= base_url('home-assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('home-assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('home-assets/js/main.js') ?>"></script>

  <?= $this->renderSection('script') ?>
</body>

</html>