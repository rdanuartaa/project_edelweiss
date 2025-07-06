@extends('main.layouts.main')
@section('content')
<section class="page-banner overlay pt-170 pb-170 bg_cover" style="background-image: url(assets/images/bg/page-bg.jpg);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="page-banner-content text-center text-white">
                            <h1 class="page-title">Contact Us</h1>
                            <ul class="breadcrumb-link text-white">
                                <li><a href="index.html">Home</a></li>
                                <li class="active">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Breadcrumb Section ======-->
        <!--====== Start Info Section ======-->
        <section class="contact-info-section pt-100 pb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <!--=== Section Title ===-->
                        <div class="section-title text-center mb-45 wow fadeInDown">
                            <span class="sub-title">Contact Us</span>
                            <h2>Ready to Get Our Best Services!
                            Feel Free to Contact With Us</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <!--=== Contact Info Item ===-->
                        <div class="contact-info-item text-center mb-40 wow fadeInUp">
                            <div class="icon">
                                <img src="assets/images/icon/icon-1.png" alt="icon">
                            </div>
                            <div class="info">
                                <span class="title">Office Location</span>
                                <p>55 Main Street, 2nd Floor
                                    New York City</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <!--=== Contact Info Item ===-->
                        <div class="contact-info-item text-center mb-40 wow fadeInDown">
                            <div class="icon">
                                <img src="assets/images/icon/icon-2.png" alt="icon">
                            </div>
                            <div class="info">
                                <span class="title">Email Address</span>
                                <p><a href="mailto:supportinfo@gmail.com">supportinfo@gmail.com</a></p>
                                <p><a href="mailto:traveladventure.net">traveladventure.net</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <!--=== Contact Info Item ===-->
                        <div class="contact-info-item text-center mb-40 wow fadeInUp">
                            <div class="icon">
                                <img src="assets/images/icon/icon-3.png" alt="icon">
                            </div>
                            <div class="info">
                                <span class="title">Hotline</span>
                                <p><a href="tel:+000(123)45688">+000 (123) 456 88</a></p>
                                <p><a href="tel:+8596320">+859 63 20</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Info Section ======-->
        <!--====== Start Contact Map Section ======-->
        <section class="contact-page-map pb-100 wow fadeInUp">
            <!--=== Map Box ===-->
            <div class="map-box">
                <iframe src="https://maps.google.com/maps?q=new%20york&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
            </div>
        </section><!--====== End Contact Map Section ======-->
        <!--====== Start Contact Section ======-->
        <section class="contact-section pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section-title text-center mb-50 wow fadeInDown">
                            <span class="sub-title">Get In Touch</span>
                            <h2>Send Us Message</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="contact-area wow fadeInUp">
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <input type="text" placeholder="Name" class="form_control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <input type="text" placeholder="Phone Number" class="form_control" name="number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <input type="email" placeholder="Email Address" class="form_control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <input type="url" placeholder="Website" class="form_control" name="website" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <textarea name="message" placeholder="Write Message" class="form_control" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group text-center">
                                            <button class="main-btn primary-btn">Send Us Message<i class="fas fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Contact Section ======-->
@endsection
