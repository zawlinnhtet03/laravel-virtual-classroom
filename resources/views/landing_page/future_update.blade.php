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
            {{-- Upcoming Main Section --}}

            <div class="banner"></div>

            <div class="blog">
                <h1 class="title">Further Extensions and Current Limitations <ion-icon name="cog"></ion-icon></h1>

                <div class="up_coming_list">
                    <div class="update-item red">
                        <h4>Near Future Updates</h4>
                        <p>We are planning to implement real-time collaboration features for our dashboards.</p>
                    </div>
                    <div class="update-item yellow">
                        <h4>Medium-Term Updates</h4>
                        <p>Improving user interface and adding more features based on feedback from users.</p>
                    </div>
                    <div class="update-item green">
                        <h4>Long-Term Updates</h4>
                        <p>Enhancing overall system performance and stability..</p>
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
