<!-- HEADER / NAVIGATION -->
<header class="header" id="site-header">
    <div class="nav-container">
        <nav class="nav">
            <!-- Left: Logo -->
            <a href="index.php" class="logo">
                <span class="logo-icon">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="36" height="36" rx="8" fill="#0073BB" />
                        <path d="M8 22C8 22 10.5 14 18 14C25.5 14 28 22 28 22" stroke="#FFFFFF" stroke-width="2.5"
                            stroke-linecap="round" />
                        <path d="M6 25C6 25 9.5 18 18 18C26.5 18 30 25 30 25" stroke="rgba(255,255,255,0.5)"
                            stroke-width="2" stroke-linecap="round" />
                        <circle cx="18" cy="13" r="2.5" fill="#FFFFFF" />
                    </svg>
                </span>
                <span class="logo-text">
                    <?php echo SITE_NAME; ?>
                </span>
            </a>

            <!-- Center: Navigation Links -->
            <ul class="nav-menu" id="nav-menu">
                <!-- Services with Dropdown -->
                <li class="nav-item nav-dropdown">
                    <a href="#services" class="nav-link nav-link-dropdown">
                        Services
                        <svg class="nav-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                    <div class="dropdown-panel">
                        <div class="dropdown-grid">
                            <a href="#service-audit" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">AWS Cost Audit</span>
                                    <span class="dropdown-desc">Reduce cloud spend by up to 60%</span>
                                </span>
                            </a>
                            <a href="#service-sizing" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                        <path d="M2 17l10 5 10-5" />
                                        <path d="M2 12l10 5 10-5" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">EC2 Right-Sizing</span>
                                    <span class="dropdown-desc">Optimize instances for usage</span>
                                </span>
                            </a>
                            <a href="#service-s3" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                        <line x1="12" y1="22.08" x2="12" y2="12" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">S3 Optimization</span>
                                    <span class="dropdown-desc">Lifecycle & storage classes</span>
                                </span>
                            </a>
                            <a href="#service-cleanup" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3" />
                                        <path
                                            d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.6 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.6a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">Resource Cleanup</span>
                                    <span class="dropdown-desc">Remove unused volumes & IPs</span>
                                </span>
                            </a>
                            <a href="#service-audit" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                        <line x1="16" y1="13" x2="8" y2="13" />
                                        <line x1="16" y1="17" x2="8" y2="17" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">Architecture Audit</span>
                                    <span class="dropdown-desc">Deep-dive technical review</span>
                                </span>
                            </a>
                            <a href="#service-savings" class="dropdown-item">
                                <span class="dropdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </span>
                                <span class="dropdown-content">
                                    <span class="dropdown-title">Savings Plans</span>
                                    <span class="dropdown-desc">Reserved Instance strategy</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                <!-- Mobile only CTA -->
                <li class="nav-item mobile-cta"><a href="#contact" class="nav-link mobile-cta-btn">Get Free Cost Audit</a></li>
            </ul>

            <!-- Right: Action Buttons -->
            <div class="nav-actions">
                <a href="#contact" class="nav-btn btn-primary">Get Free Cost Audit</a>
            </div>

            <!-- Mobile Toggle -->
            <button class="menu-toggle" id="menu-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </div>
</header>