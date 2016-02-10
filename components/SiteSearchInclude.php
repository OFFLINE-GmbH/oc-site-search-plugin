<?php namespace OFFLINE\SiteSearch\Components;

use Cms\Classes\ComponentBase;

class SiteSearchInclude extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'offline.sitesearch::lang.siteSearchInclude.title',
            'description' => 'offline.sitesearch::lang.siteSearchInclude.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}