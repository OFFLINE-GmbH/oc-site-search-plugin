<?php return [
    'plugin' => [
        'name' => '网站搜索',
        'description' => '在前端添加全局搜素',
        'author' => 'OFFLINE LLC',
        'manage_settings' => '管理 网站搜索 配置',
        'manage_settings_permission' => '可管理 网站搜索 的设置',
    ],
    'settings' => [
        'mark_results' => '在搜索结果中标记符合项',
        'mark_results_comment' => '在搜索项两端添加<mark>标签',
        'log_queries'                => '查询日志',
        'log_queries_comment'        => '将所有查询记录到数据库',
        'log_keep_days'              => '几天后清理日志',
        'log_keep_days_comment'      => '在那几天之后删除旧的日志条目（默认值：365）',
        'excerpt_length' => '摘录的长度',
        'excerpt_length_comment' => '在搜索结果列表中摘录的长度.',
        'use_this_provider' => '使用这个数据提供者',
        'use_this_provider_comment' => '启用该数据提供者的显示结果',
        'provider_badge' => '数据提供者标记',
        'provider_badge_comment' => '在一次搜索结果的标记位中显示的文本',
        'blog_posturl' => '内容文章页面的链接',
        'blog_posturl_comment' => '只指定URL的固定部分，没有任何动态参数',
        'blog_page' => '内容文章页面',
        'blog_page_comment' => '选择一个用来显示单个内容文章的页面。需要生成这些文章的URL',
        'album_page' => '相册页',
        'album_page_comment' => '选择一个用来显示相册的页面。需要为相册生成URL',
        'photo_page' => '相册页',
        'photo_page_comment' => '选择一个用来显示单个照片的页面。需要形成照片的URL',
        'news_page' => '新闻文章页',
        'news_page_comment' => '选择一个用来显示单个新闻文章的页面。需要形成新闻URL',
        'portfolio_itemurl' => 'portfolio详情页面的Url',
        'portfolio_itemurl_comment' => '只指定URL的固定部分，不包含任何动态参数',
        'brands_itemurl' => '品牌详情页面Url',
        'brands_itemurl_comment' => '只指定URL的固定部分，不包含任何动态参数',
        'showcase_itemurl' => '展示详情页面Url',
        'showcase_itemurl_comment' => '只指定URL的固定部分，不包含任何动态参数',
        'octoshop_itemurl' => '产品详情页面的Url',
        'octoshop_itemurl_comment' => '只指定URL的固定部分，不包含任何动态参数',
        'octoshop_itemurl_badge' => '产品',
        'snipcartshop_itemurl_badge' => '产品',
        'jkshop_itemurl' => '产品详情页的url',
        'jkshop_itemurl_comment' => '只指定URL的固定部分，不包含任何动态参数',
        'jkshop_itemurl_badge' => '产品',
        'experimental' => '试验特点:',
        'experimental_refer_to_docs' => '该数据提供者是试验性的!使用前请参考 <a target="_blank"
href="https://octobercms.com/plugin/bbctop-sitesearch#documentation">文件</a> .',
    ],
    'searchResults' => [
        'title' => '搜索结果列表',
        'description' => '显示一个搜索结果的列表',
        'properties' => [
            'no_results' => [
                'title' => '搜索不到您想要的信息',
                'description' => '如果没有结果，你想要显示的内容',
            ],
            'provider_badge' => [
                'title' => '显示数据提供者标记',
                'description' => '显示每个结果的数据提供者',
            ],
            'results_per_page' => [
                'title' => '每页搜索结果',
                'validationmessage' => '只能输入数字',
            ],
            'visit_page' => [
                'title' => '访问页面标签',
                'description' => '此链接文本置于每个结果下方',
            ],
            'filter' => [
                'title' => '过滤器',
                'description' => '选择您想要允许搜索的插件,最少选择一项',
            ],
        ],
    ],
    'searchInput' => [
        'title' => '搜索搜索框',
        'description' => '显示一个搜索框',
        'properties' => [
            'use_auto_complete' => [
                'title' => '输入的时候同时搜索',
            ],
            'auto_complete_result_count' => [
                'title' => '最大数量的自动搜索结果',
            ],
            'search_page' => [
                'title' => '搜索结果页面',
                'description' => '您的搜索查询将被发送到这个页面',
                'null_value' => '-- 不要显示任何链接',
            ],
        ],
    ],
    'siteSearchInclude' => [
        'title' => '包含在 ‘网站搜索’ 插件中',
        'description' => '把这个包含在CMS页面中，使得该页面能被搜索',
    ],
    'log'               => [
        'id'           => 'ID',
        'description'  => '所有搜索查询的日志',
        'title'        => '搜索查询',
        'title_update' => '查看搜索查询',
        'query'        => '询问',
        'created_at'   => '创建于',
        'domain'       => '域名',
        'location'     => '路径',
        'session_id'   => 'Session',
        'export'       => '导出日志',
        'useragent'    => 'UA',
    ],
];
