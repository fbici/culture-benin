@extends('layouts.app')

@section('title', 'Contact - Culture Benin')

@push('styles')
<style>
    /* ===== STYLES POUR LA PAGE CONTACT ===== */
    :root {
        --contact-primary: #3498db; /* Bleu au lieu de vert */
        --contact-secondary: #2c3e50; /* Bleu foncé */
        --contact-accent: #e74c3c; /* Rouge */
    }

    .contact-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: calc(100vh - 180px);
        padding-top: 30px;
        padding-bottom: 60px;
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Hero Section */
    .contact-hero {
        background: linear-gradient(135deg, 
            rgba(52, 152, 219, 0.95) 0%, 
            rgba(41, 128, 185, 0.9) 100%);
        border-radius: 20px;
        padding: 4rem 3rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    .contact-icon {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 2rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .contact-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Layout principal */
    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    /* Section Contact Info */
    .contact-info {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-title {
        font-size: 1.8rem;
        font-weight: 900;
        color: #1a1d21;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .info-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--contact-primary), var(--contact-accent));
        border-radius: 2px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e9ecef;
    }

    .contact-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .contact-icon-item {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--contact-primary) 0%, #2980b9 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .contact-details h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #1a1d21;
    }

    .contact-details p {
        color: #6c757d;
        line-height: 1.6;
        margin: 0;
    }

    /* Réseaux sociaux */
    .social-contact {
        margin-top: 2rem;
    }

    .social-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1a1d21;
    }

    .social-links-contact {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-link-contact {
        width: 50px;
        height: 50px;
        background: #f8f9fa;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--contact-primary);
        font-size: 1.3rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .social-link-contact:hover {
        background: var(--contact-primary);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(52, 152, 219, 0.2);
    }

    /* Section Formulaire */
    .contact-form-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: 900;
        color: #1a1d21;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--contact-primary), var(--contact-accent));
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #1a1d21;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .form-control:focus {
        border-color: var(--contact-primary);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        background: white;
        outline: none;
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--contact-primary) 0%, #2980b9 100%);
        color: white;
        border: none;
        padding: 1.2rem 2.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(52, 152, 219, 0.3);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Map Section */
    .map-section {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 3rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .map-header {
        background: linear-gradient(135deg, var(--contact-primary) 0%, #2980b9 100%);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    #contactMap {
        width: 100%;
        height: 400px;
    }

    /* FAQ Section */
    .faq-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .faq-item {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1.5rem;
    }

    .faq-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .faq-question {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1a1d21;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .faq-question:hover {
        color: var(--contact-primary);
    }

    .faq-answer {
        color: #6c757d;
        line-height: 1.6;
        margin: 0;
        display: none;
        padding-left: 2.5rem;
    }

    .faq-answer.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-info, .contact-form-section {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .contact-container {
            padding: 0 1rem;
        }
        
        .contact-hero {
            padding: 3rem 2rem;
        }
        
        .contact-hero h1 {
            font-size: 2.2rem;
        }
        
        .contact-info, .contact-form-section, .faq-section {
            padding: 2rem;
        }
        
        .info-title, .form-title {
            font-size: 1.6rem;
        }
        
        .contact-item {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }
        
        .contact-icon-item {
            margin: 0 auto;
        }
        
        #contactMap {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .contact-hero h1 {
            font-size: 1.8rem;
        }
        
        .contact-icon {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="contact-page" id="contact">
    <div class="contact-container">
        <!-- Hero Section -->
        <div class="contact-hero">
            <div class="contact-icon">
                <i class="bi bi-envelope"></i>
            </div>
            <h1>Contactez-nous</h1>
            <p>
                Une question, une suggestion ou une collaboration ? 
                Notre équipe est à votre écoute pour toute demande concernant le patrimoine culturel béninois.
            </p>
        </div>

        <!-- Contact Content -->
        <div class="contact-content">
            <!-- Informations de contact -->
            <div class="contact-info">
                <h2 class="info-title">Nos Coordonnées</h2>
                
                <div class="contact-item">
                    <div class="contact-icon-item">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Adresse</h3>
                        <p>
                            Siège social<br>
                            Cotonou, Bénin<br>
                            
                        </p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon-item">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Téléphone</h3>
                        <p>
                            +229 40 63 10 61<br>
                            Lundi - Vendredi: 8h - 18h<br>
                            Samedi: 9h - 13h
                        </p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon-item">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Email</h3>
                        <p>
                            salaousouleyman@gmail.com<br>
                            
                        </p>
                    </div>
                </div>
                
                <!-- Réseaux sociaux -->
                <div class="social-contact">
                    <h3 class="social-title">Suivez-nous</h3>
                    <div class="social-links-contact">
                        <a href="#" class="social-link-contact">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link-contact">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="social-link-contact">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link-contact">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="social-link-contact">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div class="contact-form-section">
                <h2 class="form-title">Envoyez-nous un message</h2>
                
                <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" id="name" name="name" class="form-control" required 
                               placeholder="Votre nom et prénom">
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse email *</label>
                        <input type="email" id="email" name="email" class="form-control" required 
                               placeholder="votre@email.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="form-label">Sujet *</label>
                        <input type="text" id="subject" name="subject" class="form-control" required 
                               placeholder="Objet de votre message">
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Message *</label>
                        <textarea id="message" name="message" class="form-control" required 
                                  placeholder="Décrivez votre demande en détail..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="category" class="form-label">Catégorie</label>
                        <select id="category" name="category" class="form-control">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="general">Demande générale</option>
                            <option value="partnership">Partenariat</option>
                            <option value="contribution">Contribution</option>
                            <option value="technical">Problème technique</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="bi bi-send"></i> Envoyer le message
                    </button>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
            <div class="map-header">
                <i class="bi bi-geo-alt"></i>
                <h3 style="margin: 0; font-weight: 700;">Notre localisation</h3>
            </div>
            <div id="contactMap"></div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <h2 class="info-title">Questions fréquentes</h2>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <i class="bi bi-question-circle"></i>
                    Comment puis-je contribuer au contenu de Culture Benin ?
                </div>
                <p class="faq-answer">
                    Vous pouvez contribuer en créant un compte sur notre plateforme. 
                    Une fois connecté, vous aurez accès à l'interface de contribution 
                    où vous pourrez soumettre des contenus culturels, des photos, 
                    des vidéos ou des documents. Toutes les contributions sont modérées 
                    par notre équipe avant publication.
                </p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <i class="bi bi-question-circle"></i>
                    Puis-je utiliser les contenus pour mes recherches académiques ?
                </div>
                <p class="faq-answer">
                    Oui, tous les contenus de Culture Benin sont disponibles 
                    pour la recherche académique et l'éducation. Nous vous demandons 
                    simplement de citer Culture Benin comme source dans vos travaux. 
                    Pour les utilisations commerciales, veuillez nous contacter.
                </p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <i class="bi bi-question-circle"></i>
                    Comment devenir partenaire de Culture Benin ?
                </div>
                <p class="faq-answer">
                    Nous accueillons avec enthousiasme les partenariats avec institutions, 
                    organisations et entreprises partageant nos valeurs. Contactez-nous 
                    via le formulaire en sélectionnant "Partenariat" comme catégorie, 
                    et notre équipe vous recontactera dans les plus brefs délais.
                </p>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <i class="bi bi-question-circle"></i>
                    Culture Benin est-il accessible sur mobile ?
                </div>
                <p class="faq-answer">
                    Absolument ! Notre plateforme est entièrement responsive et optimisée 
                    pour tous les appareils : smartphones, tablettes et ordinateurs. 
                    Vous pouvez également ajouter Culture Benin à l'écran d'accueil 
                    de votre mobile pour un accès plus rapide.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Remplacer la fonction toggleFaq existante par celle-ci
function toggleFaq(element) {
    const answer = element.nextElementSibling;
    const isVisible = answer.classList.contains('show');
    
    // Fermer toutes les autres FAQ
    document.querySelectorAll('.faq-answer.show').forEach(el => {
        if (el !== answer) {
            el.classList.remove('show');
            const question = el.previousElementSibling;
            const icon = question.querySelector('i');
            icon.className = 'bi bi-question-circle';
        }
    });
    
    // Basculer l'état actuel
    if (isVisible) {
        answer.classList.remove('show');
        const icon = element.querySelector('i');
        icon.className = 'bi bi-question-circle';
    } else {
        answer.classList.add('show');
        const icon = element.querySelector('i');
        icon.className = 'bi bi-chevron-up';
    }
}

// Initialiser toutes les FAQs au chargement
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter des gestionnaires d'événements
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', function() {
            toggleFaq(this);
        });
    });
    
    // Ouvrir la première FAQ par défaut
    const firstFaq = document.querySelector('.faq-question');
    if (firstFaq) {
        toggleFaq(firstFaq);
    }
});
    
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion du formulaire
        const contactForm = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                // Empêcher l'envoi pour la démo
                e.preventDefault();
                
                // Validation basique
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const subject = document.getElementById('subject').value.trim();
                const message = document.getElementById('message').value.trim();
                
                if (!name || !email || !subject || !message) {
                    alert('Veuillez remplir tous les champs obligatoires (*)');
                    return;
                }
                
                // Simuler l'envoi
                submitBtn.innerHTML = '<i class="bi bi-hourglass"></i> Envoi en cours...';
                submitBtn.disabled = true;
                
                // Simulation d'un envoi réussi
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle"></i> Message envoyé !';
                    submitBtn.style.background = 'linear-gradient(135deg, #27ae60 0%, #229954 100%)';
                    
                    // Réinitialiser le formulaire
                    contactForm.reset();
                    
                    // Afficher un message de confirmation
                    const confirmation = document.createElement('div');
                    confirmation.innerHTML = `
                        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-top: 20px; border: 1px solid #c3e6cb;">
                            <i class="bi bi-check-circle-fill" style="color: #155724; margin-right: 10px;"></i>
                            <strong>Merci pour votre message !</strong> Nous vous répondrons dans les plus brefs délais.
                        </div>
                    `;
                    
                    // Insérer après le bouton
                    contactForm.insertBefore(confirmation, contactForm.lastElementChild);
                    
                    // Supprimer le message après 5 secondes
                    setTimeout(() => {
                        confirmation.remove();
                    }, 5000);
                    
                    // Réactiver le bouton après 3 secondes
                    setTimeout(() => {
                        submitBtn.innerHTML = '<i class="bi bi-send"></i> Envoyer le message';
                        submitBtn.disabled = false;
                        submitBtn.style.background = 'linear-gradient(135deg, var(--contact-primary) 0%, #2980b9 100%)';
                    }, 3000);
                }, 2000);
            });
        }
        
        // Initialiser les FAQ
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', function() {
                toggleFaq(this);
            });
        });
        
        // Initialiser la carte de contact (version simplifiée sans Google Maps API)
        const mapContainer = document.getElementById('contactMap');
        if (mapContainer) {
            // Créer une carte statique simple
            mapContainer.innerHTML = `
                <div style="width: 100%; height: 100%; background: #f8f9fa; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #6c757d;">
                    <i class="bi bi-geo-alt" style="font-size: 4rem; margin-bottom: 1rem; color: var(--contact-primary);"></i>
                    <h4 style="margin-bottom: 0.5rem; color: var(--contact-secondary);">Cotonou, Bénin</h4>
                    <p style="text-align: center; max-width: 300px;">
                        Siège social de Culture Benin<br>
                        Centre culturel national
                    </p>
                    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                        <button onclick="openGoogleMaps()" style="background: var(--contact-primary); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 8px; cursor: pointer;">
                            <i class="bi bi-map"></i> Ouvrir dans Google Maps
                        </button>
                        <button onclick="openOpenStreetMap()" style="background: var(--contact-accent); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 8px; cursor: pointer;">
                            <i class="bi bi-globe"></i> OpenStreetMap
                        </button>
                    </div>
                </div>
            `;
        }
    });
    
    // Fonctions pour ouvrir les cartes externes
    function openGoogleMaps() {
        window.open('https://www.google.com/maps?q=Cotonou+Benin', '_blank');
    }
    
    function openOpenStreetMap() {
        window.open('https://www.openstreetmap.org/search?query=Cotonou%2C%20Benin', '_blank');
    }
</script>
@endpush