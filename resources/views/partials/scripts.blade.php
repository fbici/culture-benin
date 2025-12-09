document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('mainHeader');
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    const navLinks = document.querySelectorAll('.nav-link');

    // 1. Animation du header au scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });

    // 2. Gestion du menu mobile (Hamburger)
    menuToggle.addEventListener('click', function() {
        const isExpanded = mainNav.classList.toggle('active');
        menuToggle.querySelector('i').className = isExpanded ? 'bi bi-x-lg' : 'bi bi-list';
        document.body.style.overflow = isExpanded ? 'hidden' : 'auto';
    });

    // Fermer le menu mobile lors du clic sur un lien
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (mainNav.classList.contains('active')) {
                mainNav.classList.remove('active');
                menuToggle.querySelector('i').className = 'bi bi-list';
                document.body.style.overflow = 'auto';
            }
        });
    });

    // 3. Animation des statistiques avec compteur
    function animateCounter(element, target) {
        let current = 0;
        const stepIncrement = target / 75;
        
        const timer = setInterval(() => {
            current += stepIncrement;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 20);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    if (stat.getAttribute('data-counted') !== 'true') {
                        const target = parseInt(stat.getAttribute('data-count'));
                        animateCounter(stat, target);
                        stat.setAttribute('data-counted', 'true');
                    }
                });
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // 4. Navigation active et Smooth scroll
    const sections = document.querySelectorAll('section');

    const updateNavActive = () => {
        let current = '';
        const headerHeight = header.offsetHeight;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (scrollY >= (sectionTop - headerHeight - 1)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('active');
            }
        });
    };

    window.addEventListener('scroll', updateNavActive);
    updateNavActive();

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                const headerHeight = document.getElementById('mainHeader').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight + 1;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 5. Gestion des formulaires de logout
    document.querySelectorAll('form[id^="logout-form"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                e.preventDefault();
            }
        });
    });

    // 6. Ajout de la classe active selon l'URL courante
    function setActiveNavLink() {
        const currentPath = window.location.pathname;
        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentPath || 
                (currentPath.startsWith(linkPath) && linkPath !== '/')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    // Initialisation
    setActiveNavLink();
});