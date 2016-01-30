<?php


namespace OFFLINE\SiteSearch\Classes\Providers;


use OFFLINE\SiteSearch\Classes\Result;

/**
 * Abstract base class for result providers
 *
 * @package OFFLINE\SiteSearch\Classes\Providers
 */
abstract class ResultsProvider
{
    /**
     * The array to store all results in.
     *
     * @var array
     */
    protected $results = [];
    /**
     * The users search query.
     *
     * @var string
     */
    protected $query;

    /**
     * ResultsProvider constructor.
     *
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Search for results.
     *
     * @return ResultsProvider
     */
    abstract public function search();

    /**
     * The display name for a provider.
     * Displayed as badge for each result.
     *
     * @return string
     */
    abstract public function displayName();

    /**
     * Adds a result to the results array.
     *
     * @param string $title
     * @param string $text
     * @param string $url
     * @param string $relevance
     * @param null   $provider
     *
     * @return ResultsProvider
     */
    public function addResult($title, $text = '', $url = '', $relevance = '', $provider = null)
    {
        if ($provider === null) {
            $provider = $this->displayName();
        }

        $this->results[] = new Result($this->query, $title, $text, $url, $relevance, $provider);

        return $this;
    }

    /**
     * Return this provider's results array.
     *
     * @return array
     */
    public function results()
    {
        return $this->results;
    }
}