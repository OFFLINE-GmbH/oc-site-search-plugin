<?php

namespace OFFLINE\SiteSearch\Classes;


use Cms\Classes\Controller;
use OFFLINE\SiteSearch\Classes\Providers\ArrizalaminPortfolioResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\CmsPagesResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\FeeglewebOctoshopProductsResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\GenericResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\GrakerPhotoAlbumsResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\IndikatorNewsResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\JiriJKShopResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\OfflineSnipcartShopResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\RadiantWebProBlogResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\RainlabBlogResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\RainlabPagesResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\ResponsivShowcaseResultsProvider;
use OFFLINE\SiteSearch\Classes\Providers\VojtaSvobodaBrandsResultsProvider;

class SearchService
{
    /**
     * @var string
     */
    public $query;
    /**
     * @var Controller
     */
    public $controller;

    public function __construct($query, $controller = null)
    {
        $this->query      = $query;
        $this->controller = $controller ?: new Controller();
    }

    /**
     * Fetch all available results for the provided query
     *
     * @return ResultCollection
     * @throws \DomainException
     */
    public function results()
    {
        $results = new ResultCollection();
        $results->setQuery($this->query);

        if ($this->query === '') {
            return $results;
        }

        $results->addMany([
            (new OfflineSnipcartShopResultsProvider($this->query))->search()->results(),
            (new RadiantWebProBlogResultsProvider($this->query))->search()->results(),
            (new FeeglewebOctoshopProductsResultsProvider($this->query))->search()->results(),
            (new JiriJKShopResultsProvider($this->query))->search()->results(),
            (new IndikatorNewsResultsProvider($this->query))->search()->results(),
            (new ArrizalaminPortfolioResultsProvider($this->query))->search()->results(),
            (new ResponsivShowcaseResultsProvider($this->query))->search()->results(),
            (new RainlabBlogResultsProvider($this->query, $this->controller))->search()->results(),
            (new RainlabPagesResultsProvider($this->query))->search()->results(),
            (new CmsPagesResultsProvider($this->query))->search()->results(),
            (new GenericResultsProvider($this->query))->search()->results(),
            (new VojtaSvobodaBrandsResultsProvider($this->query))->search()->results(),
            (new GrakerPhotoAlbumsResultsProvider($this->query, $this->controller))->search()->results(),
        ]);

        return $results->sortByDesc('relevance');
    }
}