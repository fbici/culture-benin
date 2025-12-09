:root {
    --primary-color: #e17000;
    --secondary-color: #008000;
    --accent-color: #ffd700;
    --dark-color: #1a1d21;
    --light-color: #f8f9fa;
    --gradient-primary: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
    --gradient-benin: linear-gradient(135deg, #008000 0%, #ffd700 50%, #e17000 100%);
    --gradient-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: #ffffff;
    color: var(--dark-color);
    overflow-x: hidden;
    line-height: 1.6;
}

h1, h2, h3 {
    line-height: 1.2;
}

/* ===== CORRECTION ESPACEMENT HEADER ===== */
main {
    margin-top: 80px; /* Espacement pour le header fixe */
    min-height: calc(100vh - 180px); /* Hauteur minimale moins header/footer */
}

/* ===== HEADER ===== */
.main-header {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    padding: 1rem 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.header-scrolled {
    box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
    padding: 0.8rem 0;
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.logo-wrapper {
    width: 60px;
    height: 60px;
    background: var(--gradient-benin);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(225, 112, 0, 0.3);
    transition: all 0.3s ease;
    padding: 5px;
    position: relative;
    overflow: hidden;
}

.logo-wrapper:hover {
    transform: rotate(-5deg) scale(1.05);
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 10px;
    background: white;
}

.logo-fallback {
    width: 100%;
    height: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 10px;
    color: var(--primary-color);
    font-size: 1.5rem;
}

.brand-text {
    font-size: 1.8rem;
    font-weight: 900;
    background: var(--gradient-benin);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.5px;
}

.brand-tagline {
    font-size: 0.9rem;
    color: #666;
    font-weight: 500;
    margin-top: -2px;
}

.nav-main {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-links {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-link {
    font-weight: 600;
    color: var(--dark-color);
    text-decoration: none;
    padding: 0.8rem 1.2rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
    font-size: 0.95rem;
    display: block;
}

.nav-link:hover {
    color: var(--primary-color);
    background: rgba(225, 112, 0, 0.08);
}

.nav-link.active {
    color: var(--primary-color);
    background: rgba(225, 112, 0, 0.1);
}

.nav-link.active:after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 3px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.btn-auth {
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    border: 2px solid;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}

.btn-dashboard {
    background: var(--gradient-primary);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(225, 112, 0, 0.25);
}

.btn-dashboard:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(225, 112, 0, 0.4);
    color: white;
}

.btn-logout {
    background: transparent;
    color: #dc3545;
    border-color: #dc3545;
}

.btn-logout:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.btn-login {
    background: transparent;
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-login:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(225, 112, 0, 0.3);
}

.btn-register {
    background: var(--gradient-primary);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(225, 112, 0, 0.25);
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(225, 112, 0, 0.4);
    color: white;
}

.menu-toggle-btn {
    display: none;
    background: none;
    border: none;
    font-size: 1.8rem;
    color: var(--dark-color);
    cursor: pointer;
    padding: 0.5rem;
    transition: color 0.3s ease;
}

.menu-toggle-btn:hover {
    color: var(--primary-color);
}

/* ===== HERO SECTION ===== */
.hero-section {
    position: relative;
    height: 100vh;
    min-height: 800px;
    color: white;
    overflow: hidden;
    display: flex;
    align-items: center;
    margin-top: 80px;
    background: linear-gradient(
        135deg,
        rgba(26, 29, 33, 0.85) 0%,
        rgba(26, 29, 33, 0.75) 50%,
        rgba(26, 29, 33, 0.9) 100%
    ), url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -2;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 29, 33, 0.7);
    z-index: -1;
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    text-align: center;
    animation: fadeInTop 1s ease-out;
}

@keyframes fadeInTop {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero-title {
    font-size: 4.5rem;
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 12px rgba(0, 0, 0, 0.5);
}

.hero-accent {
    background: var(--gradient-gold);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 2px 2px 8px rgba(255, 215, 0, 0.3);
}

.hero-subtitle {
    font-size: 1.4rem;
    font-weight: 400;
    margin-bottom: 3rem;
    opacity: 0.95;
    max-width: 600px;
    line-height: 1.6;
    margin-left: auto;
    margin-right: auto;
}

.btn-hero {
    background: var(--gradient-primary);
    border: none;
    color: white;
    padding: 1.3rem 3.5rem;
    font-weight: 700;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 12px 35px rgba(225, 112, 0, 0.5);
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-hero:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 20px 45px rgba(225, 112, 0, 0.6);
    color: white;
}

/* ===== STATISTIQUES ===== */
.stats-section {
    background: #fdfdfd;
    padding: 100px 0;
    position: relative;
}

.stats-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    text-align: center;
}

.stat-item {
    background: white;
    padding: 2rem 1rem;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
    border-top: 5px solid var(--secondary-color);
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
    background: rgba(225, 112, 0, 0.1);
    padding: 10px;
    border-radius: 50%;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--dark-color);
    line-height: 1.2;
}

.stat-label {
    font-size: 0.95rem;
    font-weight: 500;
    color: #666;
    margin-top: 0.5rem;
}

/* ===== SECTIONS GÉNÉRIQUES ===== */
.section-padding {
    padding: 100px 0;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 1rem;
    text-align: center;
    position: relative;
}

.section-title:after {
    content: '';
    display: block;
    width: 100px;
    height: 5px;
    background: var(--gradient-primary);
    margin: 1.5rem auto;
    border-radius: 3px;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #666;
    text-align: center;
    margin-bottom: 4rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Section Contenus Récents */
.recent-section {
    background: #f8f9fa;
}

.content-preview-grid, .media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.preview-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.preview-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
}

.preview-image {
    height: 180px;
    background: var(--gradient-benin);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.preview-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--primary-color);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8rem;
    font-weight: 600;
}

.preview-content {
    padding: 1.5rem;
}

.preview-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.preview-text {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 1rem;
}

.preview-meta, .media-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: #777;
    border-top: 1px solid #eee;
    padding-top: 10px;
    margin-top: 10px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Section Médias Récents */
.media-section {
    background: white;
}

.media-card {
    background: #f8f9fa;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.media-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
}

.media-thumbnail {
    height: 180px;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    position: relative;
}

.media-type {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.5);
    padding: 3px 8px;
    border-radius: 5px;
    font-size: 0.75rem;
}

.media-content {
    padding: 1.5rem;
}

.media-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.media-description {
    font-size: 0.9rem;
    color: #666;
}

/* ===== FOOTER ===== */
.main-footer {
    background: var(--dark-color);
    color: white;
    padding-top: 60px;
    border-top: 5px solid var(--secondary-color);
}

.footer-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem 40px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.footer-logo-img {
    width: 50px;
    height: 50px;
    background: var(--gradient-benin);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px;
    overflow: hidden;
}

.footer-logo-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 5px;
    background: white;
}

.footer-logo-fallback {
    width: 100%;
    height: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 5px;
    color: var(--primary-color);
    font-size: 1.2rem;
}

.footer-brand-text {
    font-size: 1.5rem;
    font-weight: 800;
    background: var(--gradient-gold);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-description {
    font-size: 0.95rem;
    color: #aaa;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.btn-admin {
    background: var(--secondary-color);
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-admin:hover {
    background: #009900;
    box-shadow: 0 5px 20px rgba(0, 128, 0, 0.4);
    transform: translateY(-2px);
    color: white;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    font-size: 1.5rem;
    color: #aaa;
    transition: color 0.3s ease;
}

.social-link:hover {
    color: var(--primary-color);
}

.footer-heading {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-color);
    margin-bottom: 1.5rem;
    position: relative;
}

.footer-heading:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 30px;
    height: 2px;
    background: var(--accent-color);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-link {
    color: #aaa;
    text-decoration: none;
    display: block;
    padding: 5px 0;
    transition: color 0.3s ease, transform 0.2s ease;
}

.footer-link:hover {
    color: white;
    transform: translateX(5px);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #aaa;
    margin-bottom: 10px;
}

.contact-item i {
    color: var(--primary-color);
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 15px 2rem;
    text-align: center;
}

.footer-bottom-text {
    font-size: 0.85rem;
    color: #888;
    margin: 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .hero-title {
        font-size: 3.5rem;
    }
}

@media (max-width: 992px) {
    .nav-main {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 82px;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(15px);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
        padding: 2rem 0;
        transition: transform 0.4s ease-out;
        transform: translateX(-100%);
        height: 100vh;
        overflow-y: auto;
    }

    .nav-main.active {
        display: flex;
        transform: translateX(0);
    }

    .nav-links {
        flex-direction: column;
        width: 100%;
        gap: 0;
    }

    .nav-links li {
        width: 100%;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .nav-link {
        padding: 1rem 2rem;
        border-radius: 0;
        font-size: 1.1rem;
    }

    .nav-link.active:after {
        bottom: auto;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 5px;
        height: 80%;
        right: auto;
    }

    .header-actions {
        display: none;
        flex-direction: column;
        gap: 1rem;
        padding: 1rem 2rem 0;
        width: 100%;
    }

    .nav-main.active .header-actions {
        display: flex;
    }

    .btn-auth {
        width: 100%;
        justify-content: center;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
    }

    .menu-toggle-btn {
        display: block;
    }

    .header-container {
        padding: 0 1rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        padding: 0 1rem 40px;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.8rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 2.2rem;
    }

    .content-preview-grid,
    .media-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }

    .footer-top {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2.2rem;
    }

    .btn-hero {
        padding: 1rem 2.5rem;
        font-size: 1rem;
    }

    .section-padding {
        padding: 60px 0;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}


