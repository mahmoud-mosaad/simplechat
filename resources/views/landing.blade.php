<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Realtime Chat Application. Send text, images, voice. Voice Call, Video Call">
        <meta name="author" content="Mahmoud Mosaad">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>Enjoy The Experience</title>

        <link href="{{ asset('static/css/bootstrap-landing.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('static/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('static/css/landing.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('static/css/landing2.css') }}" rel="stylesheet" type="text/css">

        <style>

            .container-fluid{
                padding: 0
            }

            .nav-guard{
                padding-top: 0.7rem;
                /* padding-bottom: 0.7rem; */
            }

        </style>

    </head>
    <body>

        <div class="container-fluid">
            <div class="container">
                <nav class="navbar nav-guard">
                    <a class="navbar-brand" href="/">
                    <h1 class="logo">SimpleChat</h1>
                    </a>
                    <ul class="nav">
            <!--          <li ><a href="/"><span>Home</span></a></li>-->
                    <li ><a href="/register"><span>Get Started</span></a></li>
                    <li ><a href="/login"><span>Login</span></a></li>
                    <li ><a href="/#about"><span>About</span></a></li>
                    <li ><a href="/#contact"><span>Contact</span></a></li>
                    </ul>
                </nav>
            </div>

            <section class="section-a">
                <div class="container">
                    <div>
                        <h1>Chat With Friends.</h1>
                        <p>
                            Send Messages, Voice, Files and photos. <br>
                            Audio/Video Call With Person or Group.
                        </p>
                        <!--          <a href="#about" class="btn">Read More</a>-->
                        <div class="scroll-down"></div>
                    </div>
                    <img src="{{ asset('static/img/demo-1.png') }}" alt="" />
                </div>
            </section>

            <section id="about" class="section-b">
                <div class="overlay">
                    <div class="section-b-inner py-5">
                        <h3 class="text-2 hw">Easy &amp; Simple</h3>
                        <h2 class="text-5 mt-1 hw">Send Your ID Then Start Your Chat</h2>
                        <p class="mt-1">
                            Every One has ID, Share it and enjoy a powerful simple conversation.
                        </p>
                    </div>
                </div>
            </section>

            <section class="section-c">
                <div class="gallery">
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-anna-shvets-5257221.jpg') }}" alt=""/></a>
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-andrea-piacquadio-3807763.jpg') }}" alt=""/></a>
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-andrea-piacquadio-3771127.jpg') }}" alt=""/></a>
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-george-milton-6954210.jpg') }}" alt=""/></a>
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-ketut-subiyanto-4350099.jpg') }}" alt=""/></a>
                    <a class="big"><img src="{{ asset('static/materials/images/pexels-muhammadtaha-ibrahim-maaji-4959241.jpg') }}" alt=""/></a>
                </div>
            </section>

            <div id="videowrapper">
                <div id="fullScreenDiv">
                    <video id="video" role="presentation" preload="auto" playsinline="" crossorigin="anonymous" loop="" muted="" autoplay="" class="blur">
                        <source src="{{ asset('static/materials/videos/video-chat.mp4') }}" type="video/mp4">
                    </video>
                    <div id="videoMessage" class="styling">
                        <h1>Make Group and Chat With Friends</h1>
                        <p class="videoClick"><a href="/register">Register now</a></p>
                    </div>
                </div>
            </div>

            <section id="aftergalery" class="section-d">
                <div class="overlay">
                    <div class="section-b-inner py-5">
                        <h2 class="text-5 mt-1 hw">Meet Strangers &amp; Make Relationships</h2>
                        <p class="mt-1">
                            Search for people in your area or by email/phone.
                        </p>
                    </div>
                </div>
            </section>

            <footer class="new_footer_area bg_color">
                <div class="new_footer_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                    <h3 class="f-title f_600 t_color f_size_18">Get in Touch</h3>
                                    <p>Don’t miss any updates of our work and news.!</p>
                                    <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true" _lpchecked="1">
                                        <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                                        <button class="btn btn_get btn_get_two" type="submit">Subscribe</button>
                                        <p class="mchimp-errmessage" style="display: none;"></p>
                                        <p class="mchimp-sucmessage" style="display: none;"></p>
                                    </form>
                                </div>
                            </div>
                <!--            <div class="col-lg-3 col-md-6">-->
                <!--              <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">-->
                <!--                <h3 class="f-title f_600 t_color f_size_18">Download</h3>-->
                <!--                <ul class="list-unstyled f_list">-->
                <!--                  <li><a href="#">Company</a></li>-->
                <!--                  <li><a href="#">Android App</a></li>-->
                <!--                  <li><a href="#">ios App</a></li>-->
                <!--                  <li><a href="#">Desktop</a></li>-->
                <!--                  <li><a href="#">Projects</a></li>-->
                <!--                  <li><a href="#">My tasks</a></li>-->
                <!--                </ul>-->
                <!--              </div>-->
                <!--            </div>-->
                            <div class="col-lg-4 col-md-6 col-sm-12 px-lg-5">
                                <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                                    <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                                    <ul class="list-unstyled f_list">
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Terms &amp; conditions</a></li>
                                    <li><a href="#">Reporting</a></li>
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">Support Policy</a></li>
                                    <li><a href="#">Privacy</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="contact" class="col-lg-4 col-md-6 col-sm-12">
                                <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                                    <h3 class="f-title f_600 t_color f_size_18">Social Media</h3>
                                    <div class="f_social_icon">
                                    <a href="https://www.linkedin.com/in/mahmoudmosaad50/" class="fab fa-linkedin"></a>
                                    <a href="https://github.com/mahmoud-mosaad" class="fab fa-github"></a>
                                    <a href="https://www.facebook.com/mahmoud.mosaad.17/" class="fab fa-facebook-messenger"></a>
                                    <a href="https://wa.me/+201017747328" class="fab fa-whatsapp"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_bg">
                        <div class="footer_bg_one"></div>
                        <div class="footer_bg_two"></div>
                    </div>
                </div>
                <div class="footer_bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-7">
                                <p class="mb-0 f_400">© <a href="https://github.com/mahmoud-mosaad"><span class="mb-0 f_400">Mahmoud Mosaad</span></a> 2021 All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    
        <script src="{{ asset('static/js/jquery.min.js.download') }}"></script>
        <script src="{{ asset('static/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('static/js/landing.js') }}"></script>

    </body>
</html>
