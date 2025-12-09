<footer class="main-footer">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo">
                <div class="footer-logo-img">
                    <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="footer-logo-fallback">
                        <i class="bi bi-globe-africa"></i>
                    </div>
                </div>
                <div class="footer-brand-text">CULTURE BENIN</div>
            </div>
            <p class="footer-description">
                Plateforme officielle de préservation et de promotion du patrimoine culturel béninois.
                Nous œuvrons pour la sauvegarde et la valorisation de notre héritage culturel unique.
            </p>

            <div class="social-links">
                <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>

        <div class="footer-nav">
            <h4 class="footer-heading">Navigation</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}" class="footer-link">Accueil</a></li>
                <li><a href="{{ route('contenus.index') }}" class="footer-link">Contenus Culturels</a></li>
                <li><a href="{{ route('medias.index') }}" class="footer-link">Galerie Médias</a></li>
                <li><a href="#regions" class="footer-link">Régions</a></li>
                <li><a href="#langues" class="footer-link">Langues Locales</a></li>
            </ul>
        </div>

        <div class="footer-resources">
            <h4 class="footer-heading">Ressources</h4>
            <ul class="footer-links">
                <li><a href="#apropos" class="footer-link">À Propos</a></li>
                <li><a href="#contact" class="footer-link">Contact</a></li>
                <li><a href="#" class="footer-link">FAQ</a></li>
                <li><a href="#" class="footer-link">Support</a></li>
                <li><a href="#" class="footer-link">Mentions Légales</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h4 class="footer-heading">Contact</h4>
            <div class="contact-item"><i class="bi bi-geo-alt"></i><span>Porto-Novo, Bénin</span></div>
            <div class="contact-item"><i class="bi bi-envelope"></i><span>contact@culturebenin.bj</span></div>
            <div class="contact-item"><i class="bi bi-phone"></i><span>+229 XX XX XX XX</span></div>
            <div class="contact-item"><i class="bi bi-clock"></i><span>Lun - Ven: 8h - 18h</span></div>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="footer-bottom-text">
            &copy; 2025 Culture Benin. Tous droits réservés. |
            <span style="color: var(--accent-color);">Patrimoine Culturel National</span> |
            Développé avec ❤️ pour le Bénin
        </p>
    </div>
</footer>