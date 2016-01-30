<?php
return [
    'plugin' => [
        'name'        => 'SiteSearch',
        'description' => 'Global search for your frontend',
        'author'      => 'OFFLINE LLC',
    ],

    'provider_badges' => [
        'rainlab_blog'  => 'Blog',
        'rainlab_pages' => 'Page',
    ],

    'searchResults' => [
        'title'       => 'Search results',
        'description' => 'Displays a list of search results',
        'properties'  => [
            'no_results'       => [
                'title'       => 'No results message',
                'description' => 'What to display, if there are no results returned',
            ],
            'provider_badge'   => [
                'title'       => 'Show provider badge',
                'description' => 'Display the name of the search provider for each result',
            ],
            'results_per_page' => [
                'title' => 'Results per page',
            ],
            'visit_page'       => [
                'title'       => 'Visit page label',
                'description' => 'This link text is placed below each result',
            ],
        ],
    ],
];
