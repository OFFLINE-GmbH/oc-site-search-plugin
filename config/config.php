<?php

return [
    'mark_results'   => true,
    'excerpt_length' => 250,
    'providers'      => [
        'rainlab_blog'  => [
            'enabled' => true,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.rainlab_blog'),
            'posturl' => '/blog/post',
        ],
        'rainlab_pages' => [
            'enabled' => true,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.rainlab_pages'),
        ],
        'cms_pages' => [
            'enabled' => false,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.cms_pages'),
        ],
    ],
];