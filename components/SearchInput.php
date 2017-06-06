<?php namespace OFFLINE\SiteSearch\Components;

use Cms\Classes\Page;
use DomainException;
use OFFLINE\SiteSearch\Classes\ResultCollection;
use OFFLINE\SiteSearch\Classes\SearchService;
use Request;

class SearchInput extends BaseComponent
{
    /**
     * The user's search query.
     *
     * @var string
     */
    public $query;

    /**
     * Display this many autocomplete results max.
     *
     * @var int
     */
    protected $autoCompleteResultCount = 5;

    /**
     * The component's details.
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'offline.sitesearch::lang.searchInput.title',
            'description' => 'offline.sitesearch::lang.searchInput.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'autoCompleteResultCount' => [
                'title'             => 'offline.sitesearch::lang.searchInput.properties.auto_complete_result_count.title',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Please enter only numbers',
                'default'           => '5',
            ],
            'searchPage'              => [
                'title'       => 'offline.sitesearch::lang.searchInput.properties.search_page.title',
                'description' => 'offline.sitesearch::lang.searchInput.properties.search_page.description',
                'type'        => 'dropdown',
            ],
        ];
    }

    /**
     * Returns all available pages.
     *
     * @return array
     */
    public function getSearchPageOptions()
    {
        $pages = Page::all();

        $options = $pages->pluck('title', 'url')->toArray();

        return ['' => trans('offline.sitesearch::lang.searchInput.properties.search_page.null_value'),] + $options;
    }

    /**
     * Triggered by October's AJAX framework when
     * the users enters a query
     *
     * @return array
     */
    public function onType()
    {
        $this->setVar('query', post('q', ''));
        $this->setVar('autoCompleteResultCount');
        $this->setVar('searchPage');

        $results = $this->search();

        $this->setVar('results', $results);
    }

    /**
     * Fetch the search results.
     *
     * @throws DomainException
     * @return ResultCollection
     */
    protected function search()
    {
        $search = new SearchService($this->query, $this->controller);

        return $search->results();
    }
}
