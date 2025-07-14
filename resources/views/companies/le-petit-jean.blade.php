@extends('layouts.app')

@section('title', 'Le Petit Jean')

@section('content')

    <!-- Bandeau Entreprise -->
    <div class="company-banner">
        <img src="{{ asset('img/lpj-banner.jpg') }}" alt="Bandeau entreprise" />
        <div class="overlay"></div>

        <div class="company-header">
            <div class="company-logo">
                <a href="https://lepetitjean-grenoble.com/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('img/petit-jean.png') }}" alt="Logo de l'entreprise" />
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
                </ul>
            </nav>

            {{-- Section entreprise --}}
            <section id="company" tabindex="-1">
                <h2>L'entreprise</h2>
                <p>Le Petit Jean assure <span class="highlight-blue">un service d’aide à domicile à Grenoble</span> et dans les agglomérations situées dans un rayon de 20 km environ. Créée à l’initiative d’une personne dont l’épouse a été atteinte de la maladie d’Alzheimer, notre société a conservé son caractère familial. Ses intervenants sont sélectionnés pour leurs <span class="highlight-blue">qualités humaines</span> autant que pour leur professionnalisme et leur sens des responsabilités. Tous font preuve d’empathie envers les personnes qu’ils assistent et de rigueur dans l’exercice de leur métier.</p>

                <div class="two-columns" role="list">
                    <div class="column" role="listitem">
                        <h4>Les valeurs qui nous définissent</h4>
                        <ul>
                            <li>✓ Le respect de nos clients comme de nos salariés</li>
                            <li>✓ L’excellence de nos prestations</li>
                            <li>✓ Le professionnalisme de notre personnel</li>
                            <li>✓ La transparence et l’honnêteté</li>
                        </ul>
                    </div>
                    <div class="column" role="listitem">
                        <h4>Nos engagements</h4>
                        <ul>
                            <li>✓ Vous écouter pour définir ensemble les prestations</li>
                            <li>✓ Choisir le bon personnel qui saura répondre précisément à vos attentes</li>
                            <li>✓ Vous fournir un contrat clair, sans surprise</li>
                            <li>✓ Garantir votre satisfaction à travers un suivi qualité permanent.</li>
                        </ul>
                    </div>
                </div>

                <div class="image-grid" aria-label="Galerie photos des services">
                    <img src="{{ asset('img/menage.jpg') }}" alt="Service ménage" />
                    <img src="{{ asset('img/repas.jpg') }}" alt="Service repas" />
                    <img src="{{ asset('img/nourriture.jpg') }}" alt="Nourriture" />
                </div>

                <h2>Les services</h2>
                <p>Les services rendus par Le Petit Jean se sont étendus depuis sa création, et couvrent désormais le champ intégral des services d’aide à domicile :
                    <strong class="orangish">Ménage-Repassage</strong>,
                    <strong class="orangish">Aide aux Seniors</strong> et aux personnes dépendantes, et
                    <strong class="orangish">Jardinage</strong>.
                </p>
            </section>

            {{-- Équipe --}}
            <section id="equipe" tabindex="-1">
                <h2>L'équipe</h2>
                <p>Les <strong>fondateurs</strong> de la société sont des <strong>enfants de personnes âgées et dépendantes</strong>, impliqués dans des vies professionnelle et familiale. Ils connaissent bien les besoins de chaque famille à tout âge de la vie en matière de services d'aide à domicile : <strong>soin aux seniors, ménage, repassage, jardinage</strong>.</p>
                <div class="team-grid" role="list">
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/emilie-dupont.jpg') }}" alt="Émilie Dupont" />
                        <h3>Émilie Dupont</h3>
                        <p><strong>Directrice Générale</strong></p>
                        <p>Visionnaire et passionnée, Émilie dirige Azaé avec ambition depuis 10 ans.</p>
                    </article>
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/thomas-leroy.jpg') }}" alt="Thomas Leroy" />
                        <h3>Thomas Leroy</h3>
                        <p><strong>Responsable des Opérations</strong></p>
                        <p>Thomas orchestre avec brio l’ensemble des services pour garantir un accompagnement optimal.</p>
                    </article>
                    <article class="team-member" role="listitem">
                        <img src="{{ asset('img/sophie-martin.jpg') }}" alt="Sophie Martin" />
                        <h3>Sophie Martin</h3>
                        <p><strong>Chargée de Relations Clients</strong></p>
                        <p>Proche des bénéficiaires, Sophie veille à leur satisfaction et au bien-être des intervenants.</p>
                    </article>
                </div>

                <div class="team-video">
                    <h3>Découvrez notre équipe en action :</h3>
                    <video controls>
                        <source src="{{ asset('img/lpj/team-video.mp4') }}" type="video/mp4" />
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
                <p>Découvrez en images l’univers et l’énergie chez <strong>Le Petit Jean</strong>.</p>
                <div class="photo-collage" aria-label="Galerie photos médias">
                    <div class="collage-item"><img src="{{ asset('img/lpj/badiss-lucette-balancelle.jpg') }}" alt="Lucette sur la balançoire"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/remi-badiss-fauteuil.jpg') }}" alt="Rémi dans un fauteuil"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-badiss.jpg') }}" alt="Pierre Badiss"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-orange.jpg') }}" alt="Pierre avec vêtement orange"></div>
                    <div class="collage-item large"><img src="{{ asset('img/lpj/lucette-ely-marie.jpg') }}" alt="Lucette, Ély et Marie"></div>
                    <div class="collage-item"><img src="{{ asset('img/lpj/pierre-badiss-biblio.jpg') }}" alt="Pierre à la bibliothèque"></div>
                </div>
            </section>

        </div>

        {{-- Sidebar --}}
        <aside class="sidebar-container" aria-label="Informations complémentaires">

            <!-- Section Infos Entreprise -->
            <section class="sidebar-infos" aria-labelledby="sidebar-infos-title">
                <h3 id="sidebar-infos-title" class="sidebar-title">À propos</h3>
                <ul class="infos-list">
                    <li><span class="material-symbols-outlined">call</span> <span>09 83 09 35 74</span></li>
                    <li><span class="material-symbols-outlined">mail</span> <span>contact@lepetitjean-grenoble.com</span></li>
                    <li><span class="material-symbols-outlined">home</span> <span>5 avenue Albert 1er de Belgique, 38000 Grenoble</span></li>
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
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/" class="apply-btn">Postuler</a>
                    </li>

                    <li class="job-card">
                        <h4>Jardinier(ère)-paysagiste</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Grenoble, France</p>
                        <p><i class="fa-solid fa-file-contract"></i> Temps partiel</p>
                        <p><i class="fa-regular fa-calendar"></i> Publiée le 11/11/1111</p>
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/" class="apply-btn">Postuler</a>
                    </li>

                    <li class="job-card">
                        <h4>Homme/Femme Toutes Mains</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Grenoble, France</p>
                        <p><i class="fa-solid fa-file-contract"></i> Temps partiel</p>
                        <p><i class="fa-regular fa-calendar"></i> Publiée le 11/11/1111</p>
                        <a href="https://lepetitjean-grenoble.com/index.php/recrutement-aide-a-la-personne/" class="apply-btn">Postuler</a>
                    </li>
                </ul>
                <a href="offers.php" class="cta-button-transparent"><i class="fa-solid fa-arrow-right"></i> Voir toutes les offres</a>
            </section>

        </aside>

    </div>

@endsection
