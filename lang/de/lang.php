<?php
return [
    'plugin' => [
        'name'        => 'SiteSearch',
        'description' => 'Globale Suchfunktion für dein Frontend',
        'author'      => 'OFFLINE GmbH',
    ],

    'provider_badges' => [
        'rainlab_blog'  => 'Blog',
        'rainlab_pages' => 'Seite',
        'cms_pages'     => 'Seite',
    ],

    'searchResults' => [
        'title'       => 'Suchresultate',
        'description' => 'Listet Suchresultate auf',
        'properties'  => [
            'no_results'       => [
                'title'       => '«Nichts gefunden» Text',
                'description' => 'Was angezeigt werden soll, wenn nichts gefunden wird',
            ],
            'provider_badge'   => [
                'title'       => 'Provider-Label anzeigen',
                'description' => 'Ob der Name des jeweiligen Suchproviders neben einem Resultat angezeigt werden soll',
            ],
            'results_per_page' => [
                'title' => 'Treffer pro Seite',
            ],
            'visit_page'       => [
                'title'       => '«Treffer anzeigen» Text',
                'description' => 'Dieser Text wird unterhalb jedes Suchresultates angezeigt',
            ],
        ],
    ],

    'siteSearchInclude' => [
        'title'       => 'In SiteSearch beachten',
        'description' => 'Zu einer CMS Seite hinzufügen, um diese bei der Suche zu berücksichtigen',
    ],
];
