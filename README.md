# SiteSearch Plugin for October CMS

This plugin adds global search capabilities to October CMS.

## Currently supported content types

* RainLab.Pages
* RainLab.Blog
* Native CMS pages (experimental)

Support for more plugins is added upon request.

**You can easily extend this plugin to search your custom plugin's contents as well. See `Add support for custom plugin contents`.**

## Config

To overwrite default config values create a `config/offline/sitesearch/config.php` and return the values you would 
like to overwrite.

### Rainlab.Pages

No special configuration is required.

If you don't want to provide search results for Rainlab.Pages change 
the `enabled` config value to `false`.

### Rainlab.Blog

Make sure you change the `posturl` config value to point to the right url. If your posts are located under 
`/blog/post/:slug` the default value is okay.

If you don't want to provide search results for Rainlab.Blog change the `enabled` config value to `false`.

### CMS pages (experimental)

If you want to provide search results for CMS pages change the `enabled` config value to `true`.

You have to specifically add the component `siteSearchInclude` to every CMS page you want to be searched.
Pages **without** this component will **not** be searched.

Components on CMS pages will **not** be rendered. Use this provider only for simple html pages. All Twig syntax will be stripped out to prevent the leaking of source code to the search results.

CMS pages with dynamic URLs (like `/page/:slug`) won't be linked correctly from the search results listing.

If you have CMS pages with dynamic contents consider writing your own search provider (see `Add support for custom 
plugin contents`)


### Config file template

```php
return [
    'mark_results'   => true,
    'excerpt_length' => 250,
    'providers'      => [
        'rainlab_blog'  => [
            'enabled' => true,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.rainlab_blog'),
            'posturl' => '/blog/post',
        ],
        'rainlab_pages' => [
            'enabled' => true,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.rainlab_pages'),
        ],
        'cms_pages' => [
            'enabled' => false,
            'label'   => Lang::get('offline.sitesearch::lang.provider_badges.cms_pages'),
        ],
    ],
];
```

## Overwrite default markup

To overwrite the default markup copy all files from `plugins/offline/sitesearch/components/searchresults` to 
`themes/<your-theme>/partials/searchResults` and modify them as needed.

If you gave an alias to the `searchResults` component make sure to put the markup in the appropriate partials directory.

## Components

### searchResults

Place this component on your page to display search results. 

#### Usage example

Create a search form that sends a query to your search page:

##### Search form

```html
<form action="{{ '/search' | app }}" method="get">
    <input name="q" type="text" placeholder="What are you looking for?">
    <button type="submit"></button>
</form>
```

**Important**: Use the `q` parameter to send the user's query.

##### Search results

Create a page to display your search results. Add the `searchResults` component to it.
Use the `searchResults.query` parameter to display the user's search query.

```
title = "Search results"
url = "/search"
...

[searchResults]
resultsPerPage = 10
showProviderBadge = 1
noResultsMessage = "Your search did not return any results."
visitPageMessage = "Visit page"
==
<h2>Search results for {{ searchResults.query }}</h2>

{% component 'searchResults' %}
```

##### Example css to style the component

```css
.ss-result {
    margin-bottom: 2em;
}
.ss-result__title {
    font-weight: bold;
    margin-bottom: .5em;
}
.ss-result__badge {
    font-size: .7em;
    padding: .2em .5em;
    border-radius: 4px;
    margin-left: .75em;
    background: #eee;
    display: inline-block;
}
.ss-result__text {
    margin-bottom .5em;
}
.ss-result__url {
}
```

#### Properties

The following properties are available to change the component's behaviour.

##### resultsPerPage

How many results to display on one page.

##### showProviderBadge

The search works by querying multiple providers (Pages, Blog, or other). If this option is enabled
each search result is marked with a badge to show which provider returned the result.

This is useful if your site has many different entities (ex. teams, employees, pages, blog entries).

##### noResultsMessage

This message is shown if there are no results returned.

##### visitPageMessage

A link is placed below each search result. Use this property to change that link's text.

## Add support for custom plugin contents

To return search results for you own custom plugin, register an event listener for the `offline.sitesearch.query` 
event in your plugin's boot method.

Return an array containing a `provider` string and `results` array. Each result must provide at least a `title` key.  

### Example to search for custom `documents`

```php
public function boot()
{
    Event::listen('offline.sitesearch.query', function ($query) {
    
        // Search your plugin's contents
        $documents = YourCustomDocumentModel::where('title', 'like', "%${query}%")
                                            ->orWhere('content', 'like', "%${query}%")
                                            ->get();

        // Now build a results array
        $results = [];
        foreach ($documents as $document) {
            // Make this result more relevant if the query
            // is found in the result's title
            $relevance = stripos($document->title, $query) !== false ? 2 : 1;
        
            $results[] = [
                'title'     => $document->title,
                'text'      => $document->content,
                'url'       => '/documents/' . $document->slug,
                'relevance' => $relevance, // higher relevance results in a higher 
                                           // position in the results listing
            ];
        }

        return [
            'provider' => 'Document', // The badge to display for this result
            'results'  => $results,
        ];
    });
}
```

That's it!