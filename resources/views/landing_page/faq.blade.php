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

            <a href="/" class="logo">
                <img src="{{ asset('assets/img/logo3.jpeg') }}" width="102" height="50" alt="EduWeb logo">
            </a>

            <nav class="navbar" data-navbar>

                <div class="wrapper">
                    <a href="/" class="logo">
                        <img src="{{ asset('assets/img/logo.svg') }}" width="162" height="50" alt="EduWeb logo">
                    </a>

                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="/" class="navbar-link" data-nav-link>Home</a>
                    </li>

                    <li class="navbar-item">
                        <a href="/#about" class="navbar-link" data-nav-link>About</a>
                    </li>

                    <li class="navbar-item">
                        <a href="/#blog" class="navbar-link" data-nav-link>Blog</a>
                    </li>

                    <li class="navbar-item">
                        <a href="/#footer" class="navbar-link" data-nav-link>Contact</a>
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


            {{-- FAQ Main Section --}}

            <div class="banner"></div>

            <div class="blog">
                <h1 class="title">Frequently Asked Questions <ion-icon name="receipt"></ion-icon></h1>

                <div class="article">

                    <div class="faq-card">
                        <h4 class="faq-title">How to use your system as an Instructor</h4>

                        <p class="faq-text">You can read more about this in this <a href="/#blog">blog </a></p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">How to use your system as a Student</h4>

                        <p class="faq-text">You can read more about this in this <a href="/#blog">blog </a></p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">How do I log in to the virtual classroom?</h4>
                        <p class="faq-text">To log in, go to the login page and enter your registered email and
                            password. If you have not created an account yet, click on the "Sign Up" button and follow
                            the steps to register.</p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">Can I access the classroom on mobile devices?</h4>
                        <p class="faq-text">Yes, our virtual classroom is fully responsive and can be accessed via
                            smartphones and tablets. </p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">How do I join a live class session?</h4>
                        <p class="faq-text">Once logged in, navigate to your dashboard, and click on the "Join Class"
                            button next to your scheduled class. Ensure you have a stable internet connection for the
                            best experience.</p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">How do I submit assignments?</h4>
                        <p class="faq-text">You can submit assignments through the "Assignments" tab. Simply click on
                            the assignment, upload your file, and hit submit before the deadline.</p>
                    </div>

                    <div class="faq-card">
                        <h4 class="faq-title">Can I interact with the instructor during live classes?</h4>
                        <p class="faq-text">Yes, you can use the chat feature to ask questions during live sessions, or
                            you can raise your hand to participate directly. Instructors may also enable audio or video
                            interaction.</p>
                    </div>

                </div>
            </div>



            <br>
            <br>

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
                                <a href="/#about" class="footer-link">About</a>
                            </li>

                            <li>
                                <a href="/#blog" class="footer-link">Blog</a>
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

            <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
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
