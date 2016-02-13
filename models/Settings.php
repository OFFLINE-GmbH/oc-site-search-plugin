<?php namespace OFFLINE\SiteSearch\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'offline_sitesearch_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}