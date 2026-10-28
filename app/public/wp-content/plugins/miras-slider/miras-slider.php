<?php
/**
 * Plugin Name: Miras Custom Hero Slider
 * Description: A custom professional slider for Miras. Shortcode: [miras_hero_slider]
 * Version: 1.1
 * Author: Antigravity AI
 */

if (!defined('ABSPATH')) {
    exit;
}

function miras_hero_slider_shortcode() {
    ob_start();
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        .miras-hero-slider {
            position: relative;
            width: 100%;
            height: 90vh;
            min-height: 600px;
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
            background-color: #000;
            overflow: hidden;
        }
        .miras-swiper-container {
            width: 100%;
            height: 100%;
        }
        .miras-slide {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 0 12%;
            background-size: cover;
            background-position: center;
        }
        .miras-slide::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: linear-gradient(to left, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 40%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }
        .miras-slide-content {
            position: relative;
            z-index: 2;
            color: #fff;
            max-width: 700px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s ease;
            text-align: right;
        }
        .swiper-slide-active .miras-slide-content {
            opacity: 1;
            transform: translateY(0);
        }
        .miras-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 25px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
        }
        .miras-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.2;
            color: #fff;
        }
        .miras-title span.gold-text {
            color: #e4b869;
            display: block;
        }
        .miras-subtitle {
            font-size: 1.3rem;
            margin-bottom: 45px;
            line-height: 1.8;
            color: #eaeaea;
            font-weight: 400;
        }
        .miras-buttons {
            display: flex;
            gap: 20px;
            justify-content: flex-start;
        }
        .miras-btn {
            padding: 15px 45px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .miras-btn-primary {
            background-color: #0d3b2e;
            color: #fff !important;
            border: 2px solid #0d3b2e;
        }
        .miras-btn-primary:hover {
            background-color: #082920;
            border-color: #082920;
        }
        .miras-btn-secondary {
            background-color: transparent;
            color: #fff !important;
            border: 2px solid rgba(255, 255, 255, 0.6);
        }
        .miras-btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #fff;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: rgba(255, 255, 255, 0.5);
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            color: #fff;
        }
        .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #e4b869;
        }

        @media (max-width: 992px) {
            .miras-title { font-size: 3.5rem; }
            .miras-slide { padding: 0 8%; }
        }
        @media (max-width: 768px) {
            .miras-title { font-size: 2.5rem; }
            .miras-subtitle { font-size: 1.1rem; }
            .miras-buttons { flex-direction: column; width: 100%; }
            .miras-btn { width: 100%; }
            .miras-slide::before {
                background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 60%, rgba(0,0,0,0.3) 100%);
            }
        }
    </style>

    <div class="miras-hero-slider">
        <div class="swiper miras-swiper-container">
            <div class="swiper-wrapper">
                
                <!-- Slide 1: Honey -->
                <div class="swiper-slide miras-slide" style="background-image: url('/wp-content/miras-slider/honey.jpg');">
                    <div class="miras-slide-content">
                        <div class="miras-badge">🍯 عسل يمني أصيل</div>
                        <h2 class="miras-title">من أجود المناحل<br><span class="gold-text">اليمنية الأصيلة</span></h2>
                        <p class="miras-subtitle">عسل طبيعي 100% من مناحل يمنية موثوقة. جودة لا تُضاهى وأصالة لا مثيل لها.</p>
                        <div class="miras-buttons">
                            <a href="#" class="miras-btn miras-btn-primary">تسوق العسل</a>
                            <a href="#" class="miras-btn miras-btn-secondary">اعرف المزيد</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Coffee -->
                <div class="swiper-slide miras-slide" style="background-image: url('/wp-content/miras-slider/coffee.jpg');">
                    <div class="miras-slide-content">
                        <div class="miras-badge">☕ بن يمني أصيل</div>
                        <h2 class="miras-title">عراقة البن<br><span class="gold-text">اليمني الأصيل</span></h2>
                        <p class="miras-subtitle">من أعالي جبال اليمن، نقطف لك أجود حبات البن لتعيش تجربة تذوق غنية وعريقة.</p>
                        <div class="miras-buttons">
                            <a href="#" class="miras-btn miras-btn-primary">تسوق البن</a>
                            <a href="#" class="miras-btn miras-btn-secondary">اكتشف القصة</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Jambiya -->
                <div class="swiper-slide miras-slide" style="background-image: url('/wp-content/miras-slider/jambiya.jpg');">
                    <div class="miras-slide-content">
                        <div class="miras-badge">🗡️ جنابي يمنية صيفاني</div>
                        <h2 class="miras-title">فخر الصناعة<br><span class="gold-text">اليدوية اليمنية</span></h2>
                        <p class="miras-subtitle">الجنبية الصيفاني، رمز الأصالة والشجاعة. تحفة فنية تتوارثها الأجيال وتعكس هويتنا العريقة.</p>
                        <div class="miras-buttons">
                            <a href="#" class="miras-btn miras-btn-primary">تسوق الجنابي</a>
                            <a href="#" class="miras-btn miras-btn-secondary">شاهد التفاصيل</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Agate -->
                <div class="swiper-slide miras-slide" style="background-image: url('/wp-content/miras-slider/agate.jpg');">
                    <div class="miras-slide-content">
                        <div class="miras-badge">💍 عقيق يماني فاخر</div>
                        <h2 class="miras-title">سحر العقيق<br><span class="gold-text">اليماني النادر</span></h2>
                        <p class="miras-subtitle">أحجار كريمة نادرة تنبض بالجمال والفخامة. صُنعت بأيادٍ ماهرة لتتألق بها في كل مناسبة.</p>
                        <div class="miras-buttons">
                            <a href="#" class="miras-btn miras-btn-primary">تسوق العقيق</a>
                            <a href="#" class="miras-btn miras-btn-secondary">تصفح التشكيلة</a>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.miras-swiper-container', {
                direction: 'horizontal',
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('miras_hero_slider', 'miras_hero_slider_shortcode');
