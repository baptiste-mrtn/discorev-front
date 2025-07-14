@extends('layouts.app')

@section('title', 'Altidom')

@section('content')

    <!-- Bandeau Entreprise -->
    <div class="company-banner">
        <img src="{{ asset('img/altidom/altidom.webp') }}" alt="Bandeau entreprise"/>
        <div class="overlay"></div>

        <div class="company-header">
            <div class="company-logo">
                <a href="https://lepetitjean-grenoble.com/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('img/altidom/logo-altidom.webp') }}" alt="Logo de l'entreprise"/>
                </a>
            </div>
            <div class="company-info">
                <h1>Le Petit Jean</h1>
                <p><i class="fa-solid fa-briefcase"></i> Secteur : Services d'aide à domicile</p>
                <p><i class="fa-solid fa-map-pin"></i> Localisation : Grenoble, France</p>
            </div>
        </div>
    </div>

    <!-- Conteneur principal -->
    <div class="container content-wrapper" role="main" aria-label="Présentation de l'entreprise Le Petit Jean">
        <div class="main-content">

            {{-- Navigation locale --}}
            <nav class="company-nav" aria-label="Navigation section entreprise">
                <ul>
                    <li><a class="hover-underline-animation left" href="#company">L'entreprise</a></li>
                    <li><a class="hover-underline-animation left" href="#equipe">L'équipe</a></li>
                    <li><a class="hover-underline-animation left" href="#medias">Médias</a></li>
                    <li><a class="hover-underline-animation left" href="#rejoindre">Pourquoi nous rejoindre ?</a></li>
                    <li><a class="hover-underline-animation left" href="#rejoindre">Les offres</a></li>
                </ul>
            </nav>

            {{-- Section entreprise --}}
            <section id="company" tabindex="-1">
                <h2>L'entreprise</h2>
                <p>Altidom est née en 2009, de l’idée de transposer au servuce à la personne le modèle des sociétées de
                    services en ingénierie( CDI temps plein, interlocuteur unique, etc.) , afin de proposer aux
                    particuliers des prestations de <span class="highlight-orange">qualité profeionnelle.</span></p>

                <div class="two-columns" role="list">
                    <div class="column" role="listitem">
                        <h4>Notre mission</h4>
                        <p>Apporter une aide de grande qualité à toutes celles et ceux qui en on besoin, tout en
                            procurant une formation et un emploi stable à toutes celles et ceux qui le veulent. </p>
                    </div>
                    <div class="column" role="listitem">
                        <h4>Nos valeurs</h4>
                        <ul>
                            <li>✓ Contre l’uberisation du travail</li>
                            <li>✓ Pour la stabilité de l’emploi</li>
                            <li>✓ Liberté et flexibilité totale auprès de ses bénéficaires</li>
                        </ul>
                    </div>
                </div>

                <div class="image-grid" aria-label="Galerie photos des services">
                    <img src="{{ asset('img/altidom/img1.webp') }}" alt="Service ménage"/>
                    <img src="{{ asset('img/altidom/img2.webp') }}" alt="Service repas"/>
                </div>

                <div class="key-elements" role="list">
                    <h2>Les élements clefs</h2>
                    <ul>
                        <li>✓ Depuis 2009</li>
                        <li>✓ Strcture 100% inépendante</li>
                        <li>✓ Recrute quotidiennement</li>
                        <li>✓ Flexibilité des horaires et des lieux</li>
                        <li>✓ Rémunération attractive : à partir de 1800€ brut/mois en temps plein</li>
                    </ul>
                </div>

            </section>

            {{-- Équipe --}}
            <section id="equipe" tabindex="-1">
                <h2>L'équipe</h2>
                <div class="team-grid" role="list">
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/emilie-dupont.jpg') }}" alt="Émilie Dupont"/>
                        <h3>Émilie Dupont</h3>
                        <p><strong>Directrice Générale</strong></p>
                        <p>Visionnaire et passionnée, Émilie dirige Azaé avec ambition depuis 10 ans.</p>
                    </article>
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/thomas-leroy.jpg') }}" alt="Thomas Leroy"/>
                        <h3>Thomas Leroy</h3>
                        <p><strong>Responsable des Opérations</strong></p>
                        <p>Thomas orchestre avec brio l’ensemble des services pour garantir un accompagnement
                            optimal.</p>
                    </article>
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/sophie-martin.jpg') }}" alt="Sophie Martin"/>
                        <h3>Sophie Martin</h3>
                        <p><strong>Chargée de Relations Clients</strong></p>
                        <p>Proche des bénéficiaires, Sophie veille à leur satisfaction et au bien-être des
                            intervenants.</p>
                    </article>
                </div>

                <div class="team-video">
                    <h3>Découvrez notre équipe en action :</h3>
                    <video controls>
                        <source src="{{ asset('img/lpj/team-video.mp4') }}" type="video/mp4"/>
                        Votre navigateur ne supporte pas la lecture des vidéos.
                    </video>
                </div>
            </section>

            {{-- Pourquoi nous rejoindre --}}
            <section id="rejoindre" tabindex="-1">
                <h2>Pourquoi nous rejoindre ?</h2>
                <div class="benefits-grid">
                    <div class="benefit-card" tabindex="0" role="button" aria-pressed="false">
                        <h3>🌱 Formation continue</h3>
                        <p>Développez vos compétences grâce à des formations adaptées.</p>
                    </div>
                    <div class="benefit-card" tabindex="0" role="button" aria-pressed="false">
                        <h3>💼 Évolution de carrière</h3>
                        <p>Nous offrons des opportunités de croissance au sein de l'entreprise.</p>
                    </div>
                    <div class="benefit-card" tabindex="0" role="button" aria-pressed="false">
                        <h3>❤️ Esprit d'équipe</h3>
                        <p>Un environnement de travail collaboratif et bienveillant.</p>
                    </div>
                </div>
            </section>

            {{-- Médias --}}
            <section id="medias" tabindex="-1">
                <h2>Médias</h2>
                <p>Découvrez en images l’univers et l’énergie chez <strong>Altidom</strong>.</p>
                <div class="photo-collage" aria-label="Galerie photos médias">
                    <div class="collage-item"><img src="{{ asset('img/lpj/badiss-lucette-balancelle.jpg') }}"
                                                   alt="Lucette sur la balançoire"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/remi-badiss-fauteuil.jpg') }}"
                                                   alt="Rémi dans un fauteuil"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-badiss.jpg') }}" alt="Pierre Badiss">
                    </div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-orange.jpg') }}"
                                                   alt="Pierre avec vêtement orange"></div>
                    <div class="collage-item large"><img src="{{ asset('img/lpj/lucette-ely-marie.jpg') }}"
                                                         alt="Lucette, Ély et Marie"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-badiss-biblio.jpg') }}"
                                                   alt="Pierre à la bibliothèque"></div>
                </div>
            </section>

        </div>

        {{-- Sidebar --}}
        <aside class="sidebar-container" aria-label="Informations complémentaires">

            <!-- Section Infos Entreprise -->
            <section class="sidebar-infos" aria-labelledby="sidebar-infos-title">
                <h3 id="sidebar-infos-title" class="sidebar-title">À propos</h3>
                <ul class="infos-list">
                    <li><span class="material-symbols-outlined">call</span> <span>01 30 15 09 00</span></li>
                    <li><span class="material-symbols-outlined">mail</span> <span>contact@altidom.fr</span></li>
                    <li><span class="material-symbols-outlined">home</span> <span>9 Rue Chaptal, 75009 Paris</span></li>
                </ul>
                <a href="#" class="contact-btn">Contacter l'entreprise</a>
            </section>

            <!-- Section Offres -->
            <section class="sidebar-offers" aria-labelledby="sidebar-offers-title">
                <h3 id="sidebar-offers-title" class="sidebar-title">Dernières offres</h3>
                <ul class="job-list">
                    <li class="job-card">
                        <h4>Auxiliaire de vie sociale (AVS) F/H</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Grenoble, France</p>
                        <p><i class="fa-solid fa-file-contract"></i> CDD ou CDI</p>
                        <p><i class="fa-regular fa-calendar"></i> Publiée le 11/11/1111</p>
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/"
                           class="apply-btn">Postuler</a>
                    </li>

                    <li class="job-card">
                        <h4>Jardinier(ère)-paysagiste</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Grenoble, France</p>
                        <p><i class="fa-solid fa-file-contract"></i> Temps partiel</p>
                        <p><i class="fa-regular fa-calendar"></i> Publiée le 11/11/1111</p>
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/"
                           class="apply-btn">Postuler</a>
                    </li>

                    <li class="job-card">
                        <h4>Homme/Femme Toutes Mains</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Grenoble, France</p>
                        <p><i class="fa-solid fa-file-contract"></i> Temps partiel</p>
                        <p><i class="fa-regular fa-calendar"></i> Publiée le 11/11/1111</p>
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/"
                           class="apply-btn">Postuler</a>
                    </li>
                </ul>
                <a href="offers.php" class="cta-button-transparent"><i class="fa-solid fa-arrow-right"></i> Voir toutes
                    les offres</a>
            </section>

        </aside>

    </div>

@endsection
