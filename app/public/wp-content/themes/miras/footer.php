</main><!-- #primary -->

<footer id="miras-footer">
    <div class="miras-footer-inner">
        <div class="miras-footer-grid">
            <div class="miras-footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="miras-logo" style="margin-bottom:20px;">
                    <span style="display:inline-flex;width:85px;height:85px;background:#fff;border-radius:50%;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.15);align-items:center;justify-content:center;"><img src="<?php echo miras_get_upload_url('miras-logo.png'); ?>" alt="Miras Logo" style="height:100%;width:100%;object-fit:cover;transform:scale(1.5);"></span>
                </a>
                <p class="miras-footer-tagline">من أصالة اليمن إلى بيتك.<br>منصة المنتجات اليمنية الأصلية والموثوقة.</p>
                <div class="miras-footer-social">
                    <a href="https://www.facebook.com/waleed.mohsen.al.ansi" class="miras-social-btn" aria-label="Facebook" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                    <a href="https://wa.me/967773157823" class="miras-social-btn" aria-label="WhatsApp" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg></a>
                    <a href="https://github.com/Waleed310426" class="miras-social-btn" aria-label="GitHub" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
                    <a href="https://waleed-al-ansi-cv.netlify.app" class="miras-social-btn" aria-label="Website" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg></a>
                    <a href="mailto:Waleedalansi2023@gmail.com" class="miras-social-btn" aria-label="Email"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
                </div>
            </div>

            <div class="miras-footer-col">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a></li>
                    <li><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')); ?>">الأقسام</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">من نحن</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">تواصل معنا</a></li>
                </ul>
            </div>

            <div class="miras-footer-col">
                <h4>البائعين</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/become-seller/')); ?>">كن بائعًا</a></li>
                    <li><a href="<?php echo esc_url(home_url('/seller-guide/')); ?>">دليل البائع</a></li>
                    <li><a href="<?php echo esc_url(home_url('/seller-policies/')); ?>">سياسات البيع</a></li>
                </ul>
            </div>

            <div class="miras-footer-col">
                <h4>الدعم والمساعدة</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/faq/')); ?>">الأسئلة الشائعة</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">سياسة الخصوصية</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms-conditions/')); ?>">الشروط والأحكام</a></li>
                    <li><a href="<?php echo esc_url(home_url('/refund-policy/')); ?>">سياسة الاسترجاع</a></li>
                </ul>
            </div>
        </div>
        
        <div class="miras-footer-bottom" style="display:flex; justify-content:center; text-align:center; padding-top:20px;">
            <p style="margin:0; opacity:0.8; font-size:14px;">&copy; <?php echo date("Y"); ?> مِراس | MIRAS. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script>
    // Header Scroll Effect
    window.addEventListener('scroll', () => {
        const header = document.getElementById('miras-header');
        if(header) {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    // Mobile Menu
    const menuToggle = document.querySelector('.miras-menu-toggle');
    const nav = document.querySelector('.miras-nav');
    if(menuToggle && nav) {
        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('open');
            const spans = menuToggle.querySelectorAll('span');
            if(nav.classList.contains('open')){
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    // Scroll Animations Observer
    const animateElements = document.querySelectorAll('.miras-animate-in');
    if(animateElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, { threshold: 0.1 });
        animateElements.forEach(el => observer.observe(el));
    }
</script>
</body>
</html>
