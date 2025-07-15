@extends('main.layouts.main')
@section('content')
    <section class="hero-section">
        <div class="hero-wrapper-two">
            <!--=== Hero Slider ===-->
            <div class="hero-slider-two">
                <div class="single-slider">
                    <div class="image-layer bg_cover image-responsive-hero"
                        style="background-image: url(images/bromo.jpg);"></div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--=== Hero Content ===-->
                                <div class="hero-content text-white text-center">
                                    <span class="ribbon">Tour & Travels Advanture</span>
                                    <h1 data-animation="fadeInDown" data-delay=".4s">Booking Dulu Healing Kemudian</h1>
                                    </h1>
                                    <div class="hero-button" data-animation="fadeInRight" data-delay=".6s">
                                        <a href="about.html" class="main-btn primary-btn">Explore More<i
                                                class="fas fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider">
                    <div class="image-layer bg_cover image-responsive-hero"
                        style="background-image: url(images/pronojiwo.jpg);"></div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--=== Hero Content ===-->
                                <div class="hero-content text-white text-center">
                                    <span class="ribbon">Tour & Travels Advanture</span>
                                    <h1 data-animation="fadeInDown" data-delay=".4s">Booking Dulu Healing Kemudian</h1>
                                    </h1>
                                    <div class="hero-button" data-animation="fadeInRight" data-delay=".6s">
                                        <a href="about.html" class="main-btn primary-btn">Explore More<i
                                                class="fas fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider">
                    <div class="image-layer bg_cover image-responsive-hero"
                        style="background-image: url(images/sumberurip.jpg);"></div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--=== Hero Content ===-->
                                <div class="hero-content text-white text-center">
                                    <span class="ribbon">Tour & Travels Advanture</span>
                                    <h1 data-animation="fadeInDown" data-delay=".4s">Booking Dulu Healing Kemudian</h1>
                                    </h1>
                                    <div class="hero-button" data-animation="fadeInRight" data-delay=".6s">
                                        <a href="about.html" class="main-btn primary-btn">Explore More<i
                                                class="fas fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Hero Section ======-->
    <!--====== Start Booking Section ======-->
    <section class="booking-form-section">
        <div class="container-fluid">
            <div class="booking-form-wrapper">
                <form action="index-2.html" class="booking-form-two">
                    <div class="form_group">
                        <span>Check In</span>
                        <label><i class="far fa-calendar-alt"></i></label>
                        <input type="text" class="form_control datepicker" placeholder="Check In">
                    </div>
                    <div class="form_group">
                        <span>Guest</span>
                        <label><i class="far fa-user-alt"></i></label>
                        <input type="text" class="form_control" placeholder="Guest" name="text">
                    </div>
                    <div class="form_group">
                        <span>Accommodations</span>
                        <select class="wide">
                            <option data-display="Accommodations">Accommodations</option>
                            <option value="01">Classic Tent</option>
                            <option value="01">Forest Camping</option>
                            <option value="01">Small Trailer</option>
                            <option value="01">Tree House Tent</option>
                            <option value="01">Tent Camping</option>
                            <option value="01">Couple Tent</option>
                        </select>
                    </div>
                    <div class="form_group">
                        <button class="booking-btn">Check Availability <i
                                class="far fa-angle-double-right mt-32"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section><!--====== End Booking Section ======-->
    <!--====== Start Features Section ======-->
    <section class="features-section pt-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <!--=== Section Title ===-->
                    <div class="section-title text-center mb-45 wow fadeInDown">
                        <span class="sub-title">Keseruan Trip Bareng Kami</span>
                        <h2>Explore Real Adventure</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <!--=== Features Image Item ===-->
                    <div class="single-features-item-two mb-40 wow fadeInUp">
                        <div class="img-holder">
                            <img src="{{ asset('user_assets/images/features/feat-5.jpg') }}" alt="Features Image">
                            <div class="item-overlay">
                                <div class="content">
                                    <h3 class="title">Tent Camping</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <!--=== Features Image Item ===-->
                    <div class="single-features-item-two mb-40 wow fadeInDown">
                        <div class="img-holder">
                            <img src="{{ asset('user_assets/images/features/feat-6.jpg') }}" alt="Features Image">
                            <div class="item-overlay">
                                <div class="content">
                                    <h3 class="title">Mountain Biking</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <!--=== Features Image Item ===-->
                    <div class="single-features-item-two mb-40 wow fadeInUp">
                        <div class="img-holder">
                            <img src="{{ asset('user_assets/images/features/feat-7.jpg') }}" alt="Features Image">
                            <div class="item-overlay">
                                <div class="content">
                                    <h3 class="title">Fishing</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <!--=== Features Image Item ===-->
                    <div class="single-features-item-two mb-40 wow fadeInDown">
                        <div class="img-holder">
                            <img src="{{ asset('user_assets/images/features/feat-8.jpg') }}" alt="Features Image">
                            <div class="item-overlay">
                                <div class="content">
                                    <h3 class="title">Kayaking</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Features Section ======-->
    <!--====== Start About Section ======-->
    <section class="about-section pt-100 pb-50">
        <div class="container">
            <div class="row align-items-xl-center">
                <div class="col-lg-6">
                    <!--=== About Content Box ===-->
                    <div class="about-two_content-box mb-35 wow fadeInLeft">
                        <div class="section-title mb-30">
                            <span class="sub-title">About Company</span>
                            <h2>We Are Most Funning Company About Travel
                                and Adventure</h2>
                        </div>
                        <p>Sit amet consectetur. Velit integer tincidunt sceleries nodalesry volutpat neque fermentum
                            malesuada sceleris quecy massa lacus
                            Ultrices eget leo cras odio blandit rhoncus eues feugiat</p>
                        <div class="card-list">
                            <div class="card-item"><i class="fas fa-badge-check"></i>Family Camping</div>
                            <div class="card-item"><i class="fas fa-badge-check"></i>Wild Camping</div>
                            <div class="card-item"><i class="fas fa-badge-check"></i>Fishing</div>
                            <div class="card-item"><i class="fas fa-badge-check"></i>Mountain Biking</div>
                            <div class="card-item"><i class="fas fa-badge-check"></i>Luxury Cabin</div>
                            <div class="card-item"><i class="fas fa-badge-check"></i>Couple Camping</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--=== About Image Box ===-->
                    <div class="about-one_image-box mb-50 wow fadeInRight">
                        <img src="{{ asset('user_assets/images/about/about-1.jpg') }}" class="radius-top-left-right-288"
                            alt="About image">
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End About Section ======-->
    <!--====== Start We Section ======-->
    <section class="who-we-section">
        <div class="container">
            <div class="row align-items-xl-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <!--=== We Image Box ===-->
                    <div class="we-image-box text-center text-lg-left wow fadeInLeft">
                        <img src="{{ asset('user_assets/images/gallery/we-1.jpg') }}" class="radius-top-left-right-288" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <!--=== We Content Box ===-->
                    <div class="we-one_content-box wow fadeInRight">
                        <div class="section-title mb-30">
                            <span class="sub-title">Who We Are</span>
                            <h2>Great Opportunity For
                                Adventure & Travels</h2>
                        </div>
                        <p>Set perspiciatis unde omnis iste natus error voluptatem accusantium
                            doloremue laudantium totam rem aperiam eaque quae abillo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        <div class="skill-wrapper">
                            <div class="single-skill-circle text-center">
                                <div class="inner-circle">
                                    <div class="line"></div>
                                    <span class="number">60%</span>
                                </div>
                                <h5>Saticfied Clients</h5>
                            </div>
                            <div class="single-skill-circle text-center">
                                <div class="inner-circle">
                                    <div class="line"></div>
                                    <span class="number">93%</span>
                                </div>
                                <h5>Success Rate</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End We Section ======-->
    <!--====== Start Services Section ======-->
    <section class="services-section black-bg pt-100 pb-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <!--=== Section Title ===-->
                    <div class="section-title text-center text-white mb-50 wow fadeInDown">
                        <span class="sub-title">Popular Services</span>
                        <h2>Amazing Adventure Camping
                            Services for Enjoyed</h2>
                    </div>
                </div>
            </div>
            <!--=== Service Slider One ===-->
            <div class="slider-active-4-item wow fadeInUp">
                <!--=== Single Service Item ===-->
                <div class="single-service-item-two">
                    <div class="hover-bg bg_cover" style="background-image: url{{ asset('user_assets/images/service/hover-bg.jpg') }};">
                    </div>
                    <div class="content">
                        <div class="icon">
                            <i class="flaticon-camping"></i>
                        </div>
                        <h3 class="title"><a href="#">Tent Camping</a></h3>
                        <p>Sit amet consectetur integer tincidunt
                            nodalesry volutpat neque ferme malesua
                            da sceleris quecy massa lacus</p>
                        <a href="#" class="btn-link">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--=== Single Service Item ===-->
                <div class="single-service-item-two">
                    <div class="hover-bg bg_cover" style="background-image: url{{ asset('user_assets/images/service/hover-bg.jpg') }};">
                    </div>
                    <div class="content">
                        <div class="icon">
                            <i class="flaticon-cable-car"></i>
                        </div>
                        <h3 class="title"><a href="#">Glamping Cabin</a></h3>
                        <p>Sit amet consectetur integer tincidunt
                            nodalesry volutpat neque ferme malesua
                            da sceleris quecy massa lacus</p>
                        <a href="#" class="btn-link">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--=== Single Service Item ===-->
                <div class="single-service-item-two">
                    <div class="hover-bg bg_cover" style="background-image: url{{ asset('user_assets/images/service/hover-bg.jpg') }};">
                    </div>
                    <div class="content">
                        <div class="icon">
                            <i class="flaticon-trailer"></i>
                        </div>
                        <h3 class="title"><a href="#">RV Caravan Trailers</a></h3>
                        <p>Sit amet consectetur integer tincidunt
                            nodalesry volutpat neque ferme malesua
                            da sceleris quecy massa lacus</p>
                        <a href="#" class="btn-link">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--=== Single Service Item ===-->
                <div class="single-service-item-two">
                    <div class="hover-bg bg_cover" style="background-image: url{{ asset('user_assets/images/service/hover-bg.jpg') }};">
                    </div>
                    <div class="content">
                        <div class="icon">
                            <i class="flaticon-firewood"></i>
                        </div>
                        <h3 class="title"><a href="#">Woodfire & BBQ Party</a></h3>
                        <p>Sit amet consectetur integer tincidunt
                            nodalesry volutpat neque ferme malesua
                            da sceleris quecy massa lacus</p>
                        <a href="#" class="btn-link">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <!--=== Single Service Item ===-->
                <div class="single-service-item-two">
                    <div class="hover-bg bg_cover" style="background-image: url{{ asset('user_assets/images/service/hover-bg.jpg') }};">
                    </div>
                    <div class="content">
                        <div class="icon">
                            <i class="flaticon-cable-car"></i>
                        </div>
                        <h3 class="title"><a href="#">Glamping Cabin</a></h3>
                        <p>Sit amet consectetur integer tincidunt
                            nodalesry volutpat neque ferme malesua
                            da sceleris quecy massa lacus</p>
                        <a href="#" class="btn-link">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Services Section ======-->
    <!--====== Start Team Section ======-->
    <section class="team-section pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <!--====== Section Title ======-->
                    <div class="section-title text-center mb-50 wow fadeInDown">
                        <span class="sub-title">Paket Trip</span>
                        <h2>We’ve Expert Team Members
                            Meet With Team</h2>
                    </div>
                </div>
            </div>
        <div class="slider-active-3-item wow fadeInUp">
                <!--====== Activity Item ======-->
                <div class="single-activity-item mb-40">
                    <div class="img-holder">
                        <img src="{{ asset('user_assets/images/gallery/act-1.jpg') }}" alt="Image">
                    </div>
                    <div class="content">
                        <div class="meta">
                            <ul>
                                <li><span class="icon"><i class="flaticon-blanket"></i></span></li>
                                <li><span class="icon"><i class="flaticon-cat"></i></span></li>
                                <li><span class="icon"><i class="flaticon-tent"></i></span></li>
                                <li><span class="icon"><i class="flaticon-fire"></i></span></li>
                            </ul>
                            <div class="rate"><i class="fas fa-star"></i>4.9</div>
                        </div>
                        <h3 class="title">Classic Tents</h3>
                        <p>Quis autem veleum reprehenderit voluptate velit esse quame
                            nihile molestiae consequatur veillum dolorem eumy</p>
                        <a href="#" class="main-btn filled-btn">Check Now<i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
                <!--====== Activity Item ======-->
                <div class="single-activity-item mb-40">
                    <div class="img-holder">
                        <img src="{{ asset('user_assets/images/gallery/act-2.jpg') }}" alt="Image">
                    </div>
                    <div class="content">
                        <div class="meta">
                            <ul>
                                <li><span class="icon"><i class="flaticon-blanket"></i></span></li>
                                <li><span class="icon"><i class="flaticon-cat"></i></span></li>
                                <li><span class="icon"><i class="flaticon-tent"></i></span></li>
                                <li><span class="icon"><i class="flaticon-fire"></i></span></li>
                            </ul>
                            <div class="rate"><i class="fas fa-star"></i>4.9</div>
                        </div>
                        <h3 class="title">Small Cabin Wood</h3>
                        <p>Quis autem veleum reprehenderit voluptate velit esse quame
                            nihile molestiae consequatur veillum dolorem eumy</p>
                        <a href="#" class="main-btn filled-btn">Check Now<i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
                <!--====== Activity Item ======-->
                <div class="single-activity-item mb-40">
                    <div class="img-holder">
                        <img src="{{ asset('user_assets/images/gallery/act-3.jpg') }}" alt="Image">
                    </div>
                    <div class="content">
                        <div class="meta">
                            <ul>
                                <li><span class="icon"><i class="flaticon-blanket"></i></span></li>
                                <li><span class="icon"><i class="flaticon-cat"></i></span></li>
                                <li><span class="icon"><i class="flaticon-tent"></i></span></li>
                                <li><span class="icon"><i class="flaticon-fire"></i></span></li>
                            </ul>
                            <div class="rate"><i class="fas fa-star"></i>4.9</div>
                        </div>
                        <h3 class="title">RV Caravan Trailer</h3>
                        <p>Quis autem veleum reprehenderit voluptate velit esse quame
                            nihile molestiae consequatur veillum dolorem eumy</p>
                        <a href="#" class="main-btn filled-btn">Check Now<i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Team Section ======-->
    <!--====== Start Activity Section ======-->

    <!--====== Start CTA Section ======-->
    <section class="cta-bg overlay bg_cover pt-150 pb-150"
        style="background-image: url{{ asset('user_assets/images/bg/cta-bg.jpg') }};">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <!--=== CTA Content Box ===-->
                    <div class="cta-content-box text-center text-white wow fadeInUp">
                        <h2 class="mb-35">Masih Bingung Cara Booking Tripnya Gimana?</h2>
                        <a href="about.html" class="main-btn secondary-btn">Cara Booking<i
                                class="far fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End CTA Section ======-->
    <!--====== Start Blog Section ======-->
    <section class="blog-section pt-100 pb-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <!--=== Blog Content Box ===-->
                    <div class="blog-content-box mb-40 wow fadeInLeft">
                        <!--=== Section Title ===-->
                        <div class="section-title mb-30">
                            <span class="sub-title">Artikel</span>
                            <h2>Amazing News & Blog
                                For Every Single Update
                                Articles & Tips</h2>
                        </div>
                        <p class="mb-20">Sit amet consectetur. Velit integer tincidunt sceleries nodalesry volutpat
                            neque fermentum malesuada sceleris quecy massa lacus
                            Ultrices eget leo cras odio blandit rhoncus eues feugiat</p>
                        <a href="blog-list.html" class="btn-link">View More News <i
                                class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <!--=== Single Blog Post ===-->
                    <div class="single-blog-post-two mb-40 wow fadeInUp">
                        <div class="post-thumbnail">
                            <img src="{{ asset('user_assets/images/blog/blog-4.jpg') }}" alt="Blog Image">
                        </div>
                        <div class="entry-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar-alt"></i><a href="#">November 15,
                                        2022</a></span>
                                <h3 class="title"><a href="blog-details.html">Meet Skeleton Svelte Taile
                                        Sind For Reactive UIs</a></h3>
                                <a href="blog-details.html" class="main-btn filled-btn">Read More<i
                                        class="far fa-paper-plane"></i></a>
                            </div>
                        </div>
                    </div>
                    <!--=== Single Blog Post ===-->
                    <div class="single-blog-post-two mb-40 wow fadeInDown">
                        <div class="post-thumbnail">
                            <img src="{{ asset('user_assets/images/blog/blog-5.jpg') }}" alt="Blog Image">
                        </div>
                        <div class="entry-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar-alt"></i><a href="#">November 15,
                                        2022</a></span>
                                <h3 class="title"><a href="blog-details.html">Meet Skeleton Svelte Taile
                                        Sind For Reactive UIs</a></h3>
                                <a href="blog-details.html" class="main-btn filled-btn">Read More<i
                                        class="far fa-paper-plane"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Blog Section ======-->
    <!--====== Start Gallery Section ======-->
    <section class="gallery-section mbm-150">
        <div class="container-fluid">
            <div class="slider-active-5-item wow fadeInUp">
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-1.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-1.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-2.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-2.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-3.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-3.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-4.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-4.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-5.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-5.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!--=== Single Gallery Item ===-->
                <div class="single-gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('user_assets/images/gallery/gl-3.jpg') }}" alt="Gallery Image">
                        <div class="hover-overlay">
                            <a href="{{ asset('user_assets/images/gallery/gl-3.jpg') }}" class="icon-btn img-popup"><i
                                    class="far fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Gallery Section ======-->
@endsection
