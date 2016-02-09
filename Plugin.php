<?php namespace OFFLINE\SiteSearch;

use Backend;
use System\Classes\PluginBase;

/**
 * SiteSearch Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'offline.sitesearch::lang.plugin.name',
            'description' => 'offline.sitesearch::lang.plugin.description',
            'author'      => 'offline.sitesearch::lang.plugin.author',
            'icon'        => 'icon-search',
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'OFFLINE\SiteSearch\Components\SearchResults' => 'searchResults',
            'OFFLINE\SiteSearch\Components\SiteSearchInclude' => 'siteSearchInclude',
        ];
    }
}
