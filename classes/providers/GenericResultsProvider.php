<?php
namespace OFFLINE\SiteSearch\Classes\Providers;

use DomainException;
use Event;

/**
 * Handles results that are provided by
 * other plugins via the event system.
 *
 * @package OFFLINE\SiteSearch\Classes\Providers
 */
class GenericResultsProvider extends ResultsProvider
{
    /**
     * Runs the search for this provider.
     *
     * @throws DomainException
     * @return ResultsProvider
     */
    public function search()
    {
        $returns = Event::fire('offline.sitesearch.query', $this->query);

        foreach ($returns as $return) {
            $results  = array_key_exists('results', $return) ? $return['results'] : [];
            $provider = array_key_exists('provider', $return) ? $return['provider'] : '';

            $this->addResultsForProvider($results, $provider);
        }

        return $this;
    }

    /**
     * Adds a result to the ResultBag.
     *
     * @param $results
     * @param $provider
     *
     * @throws DomainException
     */
    protected function addResultsForProvider($results, $provider)
    {
        foreach ($results as $result) {
            $result = $this->validateResult($result);
            $this->addResult(
                $result['title'],
                $result['text'],
                $result['url'],
                $result['relevance'],
                $provider
            );
        }
    }

    /**
     * Validates that all mandatory keys are
     * available in the provided results array
     *
     * @param $result
     *
     * @throws DomainException
     * @return array
     */
    protected function validateResult(array $result)
    {
        if ( ! array_key_exists('title', $result)) {
            throw new DomainException('Provide a title key in your results array');
        }

        return $this->fillMissingKeys($result);
    }

    /**
     * Adds the missing keys to the results array.
     *
     * @param array $result
     *
     * @return array
     */
    private function fillMissingKeys(array $result)
    {
        $keys = ['text', 'url', 'relevance'];
        foreach ($keys as $key) {
            if ( ! array_key_exists($key, $result)) {
                $result[$key] = '';
            }
        }

        return $result;
    }

    /**
     * Display name for this provider.
     *
     * @return string
     */
    public function displayName()
    {
        return 'Generic';
    }
}

