<?php

namespace OFFLINE\SiteSearch\Classes\Providers;

use OFFLINE\Boxes\Models\Page;
use OFFLINE\SiteSearch\Classes\Result;
use OFFLINE\SiteSearch\Models\Settings;
use Tailor\Classes\BlueprintIndexer;

class TailorSectionResultsProvider extends ResultsProvider
{
    const ALLOWED_FIELD_TYPES = [
        'text',
        'textarea',
        'richeditor',
    ];

    public function search()
    {
        if (!$this->isEnabled() && !starts_with(\System::VERSION, '3')) {
            return $this;
        }

        $controller = \Cms\Classes\Controller::getController() ?? new \Cms\Classes\Controller();
        $sections = BlueprintIndexer::instance()->listSections();

        foreach ($sections as $section) {
            if (!$section->siteSearch) {
                continue;
            }
            $entryRecord = \Tailor\Models\EntryRecord::inSection($section->handle);
            $fields = $entryRecord->getBlueprintAttribute()->attributes['fields'];

            $items = $entryRecord->applyPublishedStatus()
                ->where(function ($q) use ($fields) {
                    foreach ($fields as $field => $definitions) {
                        if (!collect(self::ALLOWED_FIELD_TYPES)->contains($definitions['type'])) {
                            continue;
                        }
                        $q->orWhere($field, 'like', "%{$this->query}%");
                    }
                })
                ->get();

            $items->map(function ($item) use ($section, $controller) {
                $titleField = array_key_exists('titleField', $section->siteSearch) ?
                    $item->{$section->siteSearch['titleField']} :
                    $item->title;
                $textField = array_key_exists('textField', $section->siteSearch) ?
                    $item->{$section->siteSearch['textField']} :
                    '';

                $urlParams = null;
                if (array_key_exists('withSlug', $section->siteSearch)) {
                    $urlParams = ['slug' => $item->slug];
                }

                $url = $controller->pageUrl($section->siteSearch['url'], $urlParams) ?:
                    Page::getAttributeWhereSlug($section->siteSearch['url']);

                $relevance = mb_stripos($titleField, $this->query) !== false ? 2 : 1;

                $result = new Result($this->query, $relevance);
                $result->title = $titleField;
                $result->text = $textField;
                $result->url = $url;

                $this->addResult($result);
            });

            return $this;
        }
    }

    /**
     * Checks if this provider is enabled
     * in the config.
     *
     * @return bool
     */
    protected function isEnabled()
    {
        return Settings::get('tailor_sections_enabled', false);
    }

    public function displayName()
    {
        return Settings::get('tailor_section_label', 'Tailor Sections');
    }

    public function identifier()
    {
        return 'Tailor.Sections';
    }
}