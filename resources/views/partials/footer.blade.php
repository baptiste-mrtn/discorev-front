<footer class="footer">
    <div class="footer-container container">
        <div class="footer-col">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('job_offers.index') }}">Offres d'emploi</a></li>
                <li><a href="{{ route('job_offers.index') }}">Trouver une entreprise</a></li>
                <li><a href="{{ route('login') }}">Candidats</a></li>
                <li><a href="{{ route('login') }}">Recruteurs</a></li>
                <li>Blog</li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>À propos</h3>
            <ul>
                <li>Notre mission</li>
                <li>Équipe</li>
                <li>Carrières</li>
                <li>Presse</li>
            </ul>
        </div>

        <div class="footer-col">
            <img src="{{ asset('img/logo-png.png') }}" alt="Logo Discorev">
            <h3>Suivez-nous</h3>
            <div class="social-icons">
                <a href="https://www.linkedin.com/company/discorev/" class="social-icon" target="_blank" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="social-icon" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon" target="_blank" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon" target="_blank" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="social-icon" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>

            </div>
        </div>
    </div>

    <div class="footer-legal-links">
        <a href="#">Mentions légales</a>
        <a href="#">CGU</a>
        <a href="#">Politique de confidentialité</a>
        <a href="#">Charte Discorev</a>
        <a href="#">Politique cookies</a>
        <a href="#">Gestion des cookies</a>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Discorev. Tous droits réservés.</p>
    </div>
</footer>
