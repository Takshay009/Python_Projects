<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    <svg width="32" height="32" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="margin-right: 10px;">
                        <rect width="36" height="36" rx="8" fill="#0073BB" />
                        <path d="M8 22C8 22 10.5 14 18 14C25.5 14 28 22 28 22" stroke="#FFFFFF" stroke-width="2.5"
                            stroke-linecap="round" />
                        <path d="M6 25C6 25 9.5 18 18 18C26.5 18 30 25 30 25" stroke="rgba(255,255,255,0.5)"
                            stroke-width="2" stroke-linecap="round" />
                        <circle cx="18" cy="13" r="2.5" fill="#FFFFFF" />
                    </svg>
                    <?php echo SITE_NAME; ?>
                </a>
                <p class="footer-description">
                    We help startups and businesses dramatically reduce AWS cloud costs through expert optimization,
                    right-sizing,
                    and intelligent resource management. Managed by <?php echo SITE_FOUNDERS; ?>.
                </p>
            </div>

            <div>
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#services">Services</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Services</h4>
                <ul class="footer-links">
                    <li><a href="index.php#services">AWS Cost Audit</a></li>
                    <li><a href="index.php#services">EC2 Right-Sizing</a></li>
                    <li><a href="index.php#services">S3 Optimization</a></li>
                    <li><a href="index.php#services">Monthly Monitoring</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Contact</h4>
                <ul class="footer-links">
                    <li><a href="index.php#contact">Get Free Audit</a></li>
                    <li><a href="mailto:<?php echo CONTACT_EMAIL; ?>">Email Us</a></li>
                    <li><a href="https://wa.me/91<?php echo WHATSAPP_NUMBER; ?>" target="_blank"
                            rel="noopener">WhatsApp</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 <?php echo SITE_NAME; ?>. All rights reserved. | Helping startups grow with lower cloud
                costs.</p>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="assets/js/main.js"></script>
</body>

</html>