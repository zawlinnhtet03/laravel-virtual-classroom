<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--
      - primary meta tag
-->
    <title>Classfinity</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <meta name="title" content="EduWeb - The Best Program to Enroll for Exchange">
    <meta name="description" content="This is an education html template made by codewithsadee">

    <!--
      - favicon
-->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!--
      - custom css link
-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!--
      - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">

    <!--
      - preload images
-->
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-bg.svg') }}">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-banner-1.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-banner-2.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-shape-1.svg') }}">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-shape-2.png') }}">

</head>

<body id="top">

    <!--
  - #HEADER
-->
    <header class="header" data-header>
        <div class="container">

            <a href="#" class="logo">
                <img src="{{ asset('assets/img/logo3.jpeg') }}" width="102" height="20" alt="EduWeb logo">
            </a>

            <nav class="navbar" data-navbar>

                <div class="wrapper">
                    <a href="#" class="logo">
                        <img src="{{ asset('assets/img/logo.svg') }}" width="162" height="50" alt="EduWeb logo">
                    </a>

                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="#home" class="navbar-link" data-nav-link>Home</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#about" class="navbar-link" data-nav-link>About</a>
                    </li>



                    <li class="navbar-item">
                        <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#footer" class="navbar-link" data-nav-link>Contact</a>
                    </li>

                </ul>

            </nav>

            <div class="header-actions">

                <a href="{{ route('login') }}" class="btn has-before">
                    <span class="span">Try for free</span>

                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

                <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
                    <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
                </button>

            </div>

            <div class="overlay" data-nav-toggler data-overlay></div>

        </div>
    </header>



    <main>
        <article>

            <!--
              - #HERO
            -->

            <section class="section hero has-bg-image" id="home" aria-label="home"
                style="background-image: url('{{ asset('assets/img/hero-bg.svg') }}')">
                <div class="container">

                    <div class="hero-content">

                        <h1 class="h1 section-title">
                            Partner for <span class="span">Lifelong</span> Learning
                        </h1>

                        <p class="hero-text">
                            Elevate every learning moment with seamless digital tools that fit your unique needs.
                        </p>

                        <a href="{{ route('login') }}" class="btn has-before">
                            <span class="span">Join Our Program -></span>

                        </a>

                    </div>

                    <figure class="hero-banner">

                        <div class="img-holder one" style="--width: 270; --height: 300;">
                            <img src="{{ asset('assets/img/hero-banner-1.jpg') }}" width="270" height="300"
                                alt="hero banner" class="img-cover">
                        </div>

                        <div class="img-holder two" style="--width: 240; --height: 370;">
                            <img src="{{ asset('assets/img/hero-banner-2.jpg') }}" width="240" height="370"
                                alt="hero banner" class="img-cover">
                        </div>

                        <img src="{{ asset('assets/img/about-shape-2.svg') }}" width="380" height="190"
                            alt="" class="shape hero-shape-1">

                        <img src="{{ asset('assets/img/hero-shape-2.png') }}" width="622" height="551"
                            alt="" class="shape hero-shape-2">

                    </figure>

                </div>
            </section>

            <!--
              - #CATEGORY
            -->

            <section class="section category" aria-label="category" id="feature">
                <div class="container">

                    <p class="section-subtitle">Features</p>

                    <h2 class="h2 section-title">
                        Digital <span class="span">Tools</span> For Remote Learning.
                    </h2>

                    <p class="section-text">
                        All-in-one digital tools designed to enhance learning and inspire growth.
                    </p>

                    <ul class="grid-list">

                        <li>
                            <div class="category-card" style="--color: 170, 75%, 41%">

                                <div class="card-icon">
                                    <img src="{{ asset('assets/img/category-1.svg') }}" width="40"
                                        height="40" loading="lazy" alt="Online Degree Programs" class="img">
                                </div>

                                <h3 class="h3">
                                    <a href="#" class="card-title"> Live Classes</a>
                                </h3>

                                <p class="card-text">
                                    Interactive Video Classes for Teachers and Students
                                </p>



                            </div>
                        </li>

                        <li>
                            <div class="category-card" style="--color: 351, 83%, 61%">

                                <div class="card-icon">
                                    <img src="{{ asset('assets/img/category-2.svg') }}" width="40"
                                        height="40" loading="lazy" alt="Non-Degree Programs" class="img">
                                </div>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Assignments and Quizzes</a>
                                </h3>

                                <p class="card-text">
                                    For Assessment
                                </p>



                            </div>
                        </li>

                        <li>
                            <div class="category-card" style="--color: 229, 75%, 58%">

                                <div class="card-icon">
                                    <img src="{{ asset('assets/img/category-3.svg') }}" width="40"
                                        height="40" loading="lazy" alt="Off-Campus Programs" class="img">
                                </div>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Study Materials</a>
                                </h3>

                                <p class="card-text">
                                    All-in-One place for Powerpoints and PDFs
                                </p>



                            </div>
                        </li>

                        <li>
                            <div class="category-card" style="--color: 42, 94%, 55%">

                                <div class="card-icon">
                                    <img src="{{ asset('assets/img/category-4.svg') }}" width="40"
                                        height="40" loading="lazy" alt="Hybrid Distance Programs" class="img">
                                </div>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Notifications</a>
                                </h3>

                                <p class="card-text">

                                    <span style="color: #FF6347; display: inline;">Connect with everyone </span>
                                    <span style="color: #4682B4; display: inline;">everytime everywhere</span>
                                </p>


                            </div>
                        </li>

                    </ul>

                </div>
            </section>




            <!--
      - #ABOUT
    -->

            <section class="section about" id="about" aria-label="about">
                <div class="container">

                    <figure class="about-banner">

                        <div class="img-holder" style="--width: 520; --height: 370;">
                            <img src="{{ asset('assets/img/about_htn.jpg') }}" width="520" height="370"
                                loading="lazy" alt="about banner" class="img-cover">
                        </div>

                        <img src="{{ asset('assets/img/about-shape-1.svg') }}" width="260" height="320"
                            loading="lazy" alt="" class="shape about-shape-1">

                        <img src="{{ asset('assets/img/about_htn4.jpg') }}" width="150" height="100"
                            loading="lazy" alt="" class="shape about-shape-2" id="about_htn2_img">

                        <img src="{{ asset('assets/img/about-shape-3.png') }}" width="722" height="528"
                            loading="lazy" alt="" class="shape about-shape-3">

                    </figure>

                    <div class="about-content">

                        <p class="section-subtitle">About Us</p>

                        <h2 class="h2 section-title">
                            <span class="span">Passionate Enthusiastic </span>Developers based in Yangon
                        </h2>

                        <p class="section-text">
                            We are a team of creative and driven developers with a passion for building
                            innovative digital solutions.
                            Based in the heart of Yangon, we bring a local touch with global expertise.
                        </p>

                        <ul class="about-list">

                            <li class="about-item">
                                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                                <span class="span">Energetic and Driven Scholars</span>
                            </li>

                            <li class="about-item">
                                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                                <span class="span">Ability to Adapt and Implement Changes</span>
                            </li>

                            <li class="about-item">
                                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                                <span class="span">Clinet-Focused Approach with Tailor Solutions</span>
                            </li>

                        </ul>

                        <img src="{{ asset('assets/img/about-shape-4.svg') }}" width="100" height="100"
                            loading="lazy" alt="" class="shape about-shape-4">

                    </div>

                </div>
            </section>

            <!--
              - #COURSE
            -->



            <!--
              - #STATE
            -->

            <section class="section stats" aria-label="stats">
                <div class="container">

                    <ul class="grid-list">

                        <li>
                            <div class="stats-card" style="--color: 170, 75%, 41%">
                                <h3 class="card-title">29.3k</h3>

                                <p class="card-text">Student Enrolled</p>
                            </div>
                        </li>

                        <li>
                            <div class="stats-card" style="--color: 351, 83%, 61%">
                                <h3 class="card-title">32.4K</h3>

                                <p class="card-text">Class Completed</p>
                            </div>
                        </li>

                        <li>
                            <div class="stats-card" style="--color: 260, 100%, 67%">
                                <h3 class="card-title">100%</h3>

                                <p class="card-text">Satisfaction Rate</p>
                            </div>
                        </li>

                        <li>
                            <div class="stats-card" style="--color: 42, 94%, 55%">
                                <h3 class="card-title">354+</h3>

                                <p class="card-text">Top Instructors</p>
                            </div>
                        </li>

                    </ul>

                </div>
            </section>

            <!--
              - #BLOG
            -->

            <section class="section blog has-bg-image" id="blog" aria-label="blog"
                style="background-image: url('{{ asset('assets/img/blog-bg.svg') }}')">
                <div class="container">

                    <p class="section-subtitle">Latest Articles</p>

                    <h2 class="h2 section-title">Get to Know About Our System</h2>

                    <ul class="grid-list">

                        <li>
                            <div class="blog-card">

                                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                                    <img src="{{ asset('assets/img/blog-1.jpg') }}" width="370" height="370"
                                        loading="lazy" alt="Teacher View: How to Use Our System" class="img-cover">
                                </figure>

                                <div class="card-content">

                                    <a href="/blog1" class="card-btn" aria-label="read more">
                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>

                                    <a href="/blog1" class="card-subtitle">System</a>

                                    <h3 class="h3">
                                        <a href="/blog1" class="card-title"><b>Student View</b> How to Use Our
                                            System</a>
                                    </h3>

                                    <ul class="card-meta-list">

                                        <li class="card-meta-item">
                                            <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Sep 1, 2024</span>
                                        </li>

                                        <li class="card-meta-item">
                                            <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Com 09</span>
                                        </li>

                                    </ul>

                                    <p class="card-text">
                                        Step-by-Step on: How to use our System as A Student
                                    </p>

                                </div>

                            </div>
                        </li>

                        <li>
                            <div class="blog-card">

                                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                                    <img src="{{ asset('assets/img/blog-2.jpg') }}" width="370" height="370"
                                        loading="lazy" alt="Become A Better Blogger: Content Planning"
                                        class="img-cover">
                                </figure>

                                <div class="card-content">

                                    <a href="/blog2" class="card-btn" aria-label="read more">
                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>

                                    <a href="/blog2" class="card-subtitle">System</a>

                                    <h3 class="h3">
                                        <a href="/blog2" class="card-title"><b>Teacher View</b> How to Use Our
                                            System</a>
                                    </h3>

                                    <ul class="card-meta-list">

                                        <li class="card-meta-item">
                                            <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Sep 1, 2024</span>
                                        </li>

                                        <li class="card-meta-item">
                                            <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Com 09</span>
                                        </li>

                                    </ul>

                                    <p class="card-text">
                                        Step-by-Step on: How to use our System as A Instructor
                                    </p>

                                </div>

                            </div>
                        </li>

                        <li>
                            <div class="blog-card">

                                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                                    <img src="{{ asset('assets/img/blog-3.jpg') }}" width="370" height="370"
                                        loading="lazy" alt="Become A Better Blogger: Content Planning"
                                        class="img-cover">
                                </figure>

                                <div class="card-content">

                                    <a href="/blog3" class="card-btn" aria-label="read more">
                                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                    </a>

                                    <a href="/blog3" class="card-subtitle">Education/Life</a>

                                    <h3 class="h3">
                                        <a href="/blog3" class="card-title">How to Ace Exam Without Studying</a>
                                    </h3>

                                    <ul class="card-meta-list">

                                        <li class="card-meta-item">
                                            <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Sep 1, 2024</span>
                                        </li>

                                        <li class="card-meta-item">
                                            <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                                            <span class="span">Com 09</span>
                                        </li>

                                    </ul>

                                    <p class="card-text">
                                        Step-by-Step on: How to ace your next exam
                                    </p>

                                </div>

                            </div>
                        </li>

                    </ul>

                    <img src="{{ asset('assets/img/blog-shape.png') }}" width="186" height="186"
                        loading="lazy" alt="" class="shape blog-shape">

                </div>
            </section>

            <!--
              - #FOOTER
            -->

            <footer id="footer" class="footer"
                style="background-image: url('{{ asset('assets/img/footer-bg.png') }}')">

                <div class="footer-top section">
                    <div class="container grid-list">

                        <div class="footer-brand">

                            <a href="#" class="logo">
                                <img src="{{ asset('assets/img/logo3.jpeg') }}" width="162" height="50"
                                    alt="EduWeb logo">
                            </a>

                            <br>
                            <br>
                            <div class="wrapper">


                                <address class="address">University Of Information Technology</address>
                            </div>

                            <div class="wrapper">
                                <span class="span">Call:</span>

                                <a href="tel:+011234567890" class="footer-link">+01 123 4567 890</a>
                            </div>

                            <div class="wrapper">

                                <span class="span">Email:</span>

                                <a href="uit.edu.com" class="footer-link">uit.edu.com</a>
                            </div>

                        </div>

                        <ul class="footer-list">

                            <li>
                                <p class="footer-list-title">Our Features</p>
                            </li>

                            <li>
                                <a href="#feature" class="footer-link">Live Classes</a>
                            </li>



                            <li>
                                <a href="#feature" class="footer-link">Assignments</a>
                            </li>

                            <li>
                                <a href="#feature" class="footer-link">Quizes</a>
                            </li>

                            <li>
                                <a href="#feature" class="footer-link">Notifications</a>
                            </li>

                            <li>
                                <a href="#feature" class="footer-link">Study Materials</a>
                            </li>

                        </ul>

                        <ul class="footer-list">

                            <li>
                                <p class="footer-list-title">Links</p>
                            </li>

                            <li>
                                <a href="/" class="footer-link">Home</a>
                            </li>

                            <li>
                                <a href="#about" class="footer-link">About</a>
                            </li>

                            <li>
                                <a href="#blog" class="footer-link">Blog</a>
                            </li>

                            <li>
                                <a href="/faq" class="footer-link">FAQ's</a>
                            </li>

                            <li>
                                <a href="/login" class="footer-link">Sign In/Registration</a>
                            </li>

                            <li>
                                <a href="/future_update" class="footer-link">Coming Soon</a>
                            </li>

                        </ul>

                        <div class="footer-list">

                            <p class="footer-list-title">Contacts</p>

                            <p class="footer-list-text">
                                Enter your email address to register to our newsletter subscription
                            </p>

                            <form action="" class="newsletter-form">
                                <input type="email" name="email_address" placeholder="Your email" required
                                    class="input-field">

                                <button type="submit" class="btn has-before">
                                    <span class="span">Subscribe</span>

                                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                </button>
                            </form>

                            <ul class="social-list">

                                <li>
                                    <a href="#" class="social-link">
                                        <ion-icon name="logo-facebook"></ion-icon>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="social-link">
                                        <ion-icon name="logo-linkedin"></ion-icon>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="social-link">
                                        <ion-icon name="logo-instagram"></ion-icon>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="social-link">
                                        <ion-icon name="logo-twitter"></ion-icon>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="social-link">
                                        <ion-icon name="logo-youtube"></ion-icon>
                                    </a>
                                </li>

                            </ul>

                        </div>

                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">

                        <p class="copyright">
                            UIT PHP Project <a href="#" class="copyright-link">Group 5</a>
                        </p>

                    </div>
                </div>

            </footer>

            <!--
              - #BACK TO TOP
            -->

            <a href="#" class="back-top-btn" aria-label="back to top" data-back-top-btn>
                <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
            </a>

            <!--
              - custom js link
            -->
            <script src="{{ asset('js/app.js') }}" defer></script>

            <!--
              - ionicon link
            -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        </article>
    </main>
</body>

</html>
