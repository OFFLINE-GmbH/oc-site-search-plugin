<?php return [
    'plugin'            => [
        'name'                       => 'SiteSearch',
        'description'                => 'Глобальный поиск для вашего frontend-а',
        'author'                     => 'OFFLINE LLC',
        'manage_settings'            => 'Управление настройками SiteSearch',
        'manage_settings_permission' => 'Разрешить управлять настройками SiteSearch',
    ],
    'settings'          => [
        'mark_results'               => 'Mark matches in search results',
        'mark_results_comment'       => 'Wrap the search term in <mark> tags',
        'excerpt_length'             => 'Excerpt length',
        'excerpt_length_comment'     => 'Length of the excerpt shown in the search results listing.',
        'use_this_provider'          => 'Use this provider',
        'use_this_provider_comment'  => 'Enable to display results for this provider',
        'provider_badge'             => 'Provider badge',
        'provider_badge_comment'     => 'Text to display in a search result\'s badge',
        'blog_posturl'               => 'Url of blog post page',
        'blog_posturl_comment'       => 'Only specify the fixed part of the URL without any dynamic parameters',
        'portfolio_itemurl'          => 'Url of portfolio detail page',
        'portfolio_itemurl_comment'  => 'Only specify the fixed part of the URL without any dynamic parameters',
        'experimental'               => 'Experimental feature:',
        'experimental_refer_to_docs' => 'This provider is experimental! Please refer to <a target="_blank"
href="http://octobercms.com/plugin/offline-sitesearch#documentation">the documentation</a> before using it.',
    ],
    'searchResults'     => [
        'title'       => 'Результаты поиска',
        'description' => 'Отображает список результатов поиска',
        'properties'  => [
            'no_results'       => [
                'title'       => 'Сообщение отсутсвия искомой информации',
                'description' => 'Что показывать, когда ничего не найдено',
            ],
            'provider_badge'   => [
                'title'       => 'Показывать bage провайдера',
                'description' => 'Отображает имя поискового провайдера для каждого результата',
            ],
            'results_per_page' => [
                'title' => 'Результатов на страницу',
            ],
            'visit_page'       => [
                'title'       => 'Метка Посетить страницу',
                'description' => 'Эта текстовая ссылка помещается под каждым результатом поиска',
            ],
        ],
    ],
    'siteSearchInclude' => [
        'title'       => 'Включить в SiteSearch',
        'description' => 'Добавьте это на страницу CMS, чтобы включить в результаты поиска',
    ],
];
