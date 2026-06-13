<?php
/**
 * Configuration Google OAuth
 *
 * Copiez ce fichier en config.php et remplissez vos identifiants :
 * cp config.example.php config.php
 *
 * OAuth :
 * 1. Allez sur https://console.cloud.google.com/
 * 2. Créez un projet ou sélectionnez-en un existant
 * 3. APIs & Services > Credentials > Create Credentials > OAuth 2.0 Client IDs
 * 4. Type: Web application
 * 5. Authorized redirect URI: https://sign.groupe-speed.cloud/callback.php
 * 6. Copiez Client ID et Client Secret ci-dessous
 */

return [
    'google' => [
        'client_id'     => 'VOTRE_CLIENT_ID.apps.googleusercontent.com',
        'client_secret' => 'VOTRE_CLIENT_SECRET',
        'redirect_uri'  => 'https://sign.groupe-speed.cloud/callback.php',
        'hosted_domain' => 'groupe-speed.cloud',
    ],
    'company' => [
        'name'    => 'Groupe Speed Cloud',
        'domain'  => 'groupe-speed.cloud',
        'website' => 'https://groupe-speed.cloud',
        'address' => '10 quai du Moulin, 08600 Givet',
        'logo'    => 'https://sign.groupe-speed.cloud/assets/images/cloudy.png',
    ],

    // Services / Départements
    'services' => [
        'direction' => [
            'name'  => 'Direction',
            'email' => 'direction@groupe-speed.cloud',
        ],
        'rh' => [
            'name'  => 'Ressources Humaines',
            'email' => 'rh@groupe-speed.cloud',
        ],
        'comptabilite' => [
            'name'  => 'Comptabilité',
            'email' => 'comptabilite@groupe-speed.cloud',
        ],
        'communication' => [
            'name'  => 'Communication',
            'email' => 'communication@groupe-speed.cloud',
        ],
        'bureau' => [
            'name'  => 'Bureau',
            'email' => 'bureau@groupe-speed.cloud',
        ],
        'support' => [
            'name'  => 'Support Technique',
            'email' => 'support@groupe-speed.cloud',
        ],
    ],

    // Postes avec variantes masculin (m) et féminin (f)
    // La variante affichée dépend du genre renseigné lors de l'onboarding.
    'jobs' => [
        ''                   => ['m' => '-- Sélectionner un poste --',  'f' => '-- Sélectionner un poste --'],
        'president'          => ['m' => 'Président',                     'f' => 'Présidente'],
        'co_president'       => ['m' => 'Co-Président',                  'f' => 'Co-Présidente'],
        'vice_president'     => ['m' => 'Vice-Président',                'f' => 'Vice-Présidente'],
        'secretaire_general' => ['m' => 'Secrétaire Général',            'f' => 'Secrétaire Générale'],
        'secretaire'         => ['m' => 'Secrétaire',                    'f' => 'Secrétaire'],
        'tresorier'          => ['m' => 'Trésorier',                     'f' => 'Trésorière'],
        'tresorier_adjoint'  => ['m' => 'Trésorier Adjoint',             'f' => 'Trésorière Adjointe'],
        'responsable_rh'     => ['m' => 'Responsable RH',                'f' => 'Responsable RH'],
        'charge_rh'          => ['m' => 'Chargé RH',                     'f' => 'Chargée RH'],
        'responsable_compta' => ['m' => 'Responsable Comptabilité',      'f' => 'Responsable Comptabilité'],
        'comptable'          => ['m' => 'Comptable',                     'f' => 'Comptable'],
        'responsable_com'    => ['m' => 'Responsable Communication',     'f' => 'Responsable Communication'],
        'charge_com'         => ['m' => 'Chargé de Communication',       'f' => 'Chargée de Communication'],
        'responsable_tech'   => ['m' => 'Responsable Technique',         'f' => 'Responsable Technique'],
        'technicien'         => ['m' => 'Technicien Support',            'f' => 'Technicienne Support'],
        'admin_sys'          => ['m' => 'Administrateur Système',        'f' => 'Administratrice Système'],
        'developpeur'        => ['m' => 'Développeur',                   'f' => 'Développeuse'],
        'chef_projet'        => ['m' => 'Chef de Projet',                'f' => 'Cheffe de Projet'],
        'benevole'           => ['m' => 'Bénévole',                      'f' => 'Bénévole'],
        'stagiaire'          => ['m' => 'Stagiaire',                     'f' => 'Stagiaire'],
        '__autre__'          => ['m' => 'Autre...',                      'f' => 'Autre...'],
    ],
];
