<?php


namespace OFFLINE\SiteSearch\Classes\Providers;

use OFFLINE\SiteSearch\Classes\Result;
use RainLab\Translate\Classes\Translator;
use System\Classes\PluginManager;

/**
 * Abstract base class for result providers
 *
 * @package OFFLINE\SiteSearch\Classes\Providers
 */
abstract class ResultsProvider
{
    /**
     * The plugins identifier string.
     *
     * @var string
     */
    protected $identifier = '';
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
     * The display name for this provider.
     *
     * @var string
     */
    protected $displayName;
    /**
     * An instance of a RainLab.Translate Translator class if available.
     *
     * @var Translator|bool
     */
    protected $translator;

    /**
     * ResultsProvider constructor.
     *
     * @param $query
     */
    public function __construct($query)
    {
        $this->query       = $query;
        $this->identifier  = $this->identifier();
        $this->displayName = $this->displayName();
        $this->translator  = $this->translator();
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
     * Returns the plugin's identifier string.
     *
     * @return string
     */
    abstract public function identifier();

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
            $provider = $this->displayName;
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

    /**
     * Check's if a plugin is installed and enabled.
     *
     * @param string Plugin identifier
     *
     * @return bool
     */
    protected function isPluginAvailable($name)
    {
        return PluginManager::instance()->hasPlugin($name)
        && ! PluginManager::instance()->isDisabled($name);
    }


    /**
     * Check if the Rainlab.Translate plugin is installed
     * and if yes, get the translator instance.
     *
     * @return Translator|bool
     */
    protected function translator()
    {
        return $this->isPluginAvailable('RainLab.Translate')
            ? Translator::instance()
            : false;
    }
}