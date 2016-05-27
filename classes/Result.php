<?php

namespace OFFLINE\SiteSearch\Classes;

use Config;
use Html;
use OFFLINE\SiteSearch\Models\Settings;
use Str;

/**
 * Object to store a result's data.
 *
 * @package OFFLINE\SiteSearch\Classes
 */
class Result
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $text;
    /**
     * @var string
     */
    public $excerpt;
    /**
     * @var string
     */
    public $url;
    /**
     * @var float
     */
    public $relevance;
    /**
     * @var string
     */
    public $provider;
    /**
     * @var string
     */
    public $query;

    /**
     * Result constructor.
     *
     * @param string $title
     * @param string $text
     * @param string $url
     * @param int    $relevance
     */
    public function __construct($query, $field_data, $relevance = 1, $provider = '')
    {
        $this->setQuery($query);
        foreach ($field_data as $field => $data):
            $this->setFieldData($field,$data);
        endforeach;
        $this->setRelevance($relevance);
        $this->setProvider($provider);
    }

    public function setFieldData($field,$data) {
        $setMethod = 'set'.ucwords(strtolower($field));
        if (method_exists($this,$setMethod)):
            $this->$setMethod($data);
            return true;
        endif;

        return false;
    }

    /**
     * @param $query
     *
     * @return Result
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Result
     */
    public function setTitle($title)
    {
        $this->title = $this->markQuery($title);

        return $this;

        $this->title = $this->markQuery($this->prepare($title));

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets this results text property and creates
     * a separate excerpt to display in the results
     * listing.
     *
     * @param string $text
     *
     * @return Result
     */
    public function setText($text)
    {
        $this->text    = $this->prepare($text);
        $this->excerpt = $this->createExcerpt(
            $this->markQuery($this->text)
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Result
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $url
     *
     * @return Result
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * @return float
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * @param float $relevance
     *
     * @return $this
     */
    public function setRelevance($relevance)
    {
        $this->relevance = (float)$relevance;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Shortens a string and removes all HTML.
     *
     * @param string $string
     *
     * @return string
     */
    private function prepare($string)
    {
        // Add a space before each tag to prevent
        // paragraphs from sticking together after
        // removing the html.
        $string = str_replace('<', ' <', $string);

        return Html::strip($string);
    }

    /**
     * Surrounds all instances of the query
     * in $text with <mark> tags.
     *
     * @param $text
     *
     * @return string
     */
    private function markQuery($text)
    {
        // Only mark the query if this feature is enabled
        if ( ! Settings::get('mark_results', true)) {
            return $text;
        }

        return (string)preg_replace('/(' . preg_quote($this->query, '/') . ')/i', '<mark>$0</mark>', $text);
    }

    /**
     * Creates an excerpt of the query-relevant parts of $text
     * to display below a search result.
     *
     * @param $text
     *
     * @return string
     */
    private function createExcerpt($text)
    {
        $length = Settings::get('excerpt_length', 250);

        $position = strpos($text, '<mark>' . $this->query . '</mark>');
        $start    = (int)$position - ($length / 2);

        if ($start < 0) {
            return Str::limit($text, $length);
        }

        // The relevant part is in the middle of the string, so surround
        // it with ...
        return '...' . trim(substr($text, $start, $length)) . '...';
    }

}