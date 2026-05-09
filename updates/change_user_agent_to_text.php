<?php namespace OFFLINE\SiteSearch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('offline_sitesearch_query_logs', function ($table) {
            $table->text('useragent')->nullable()->change();
        });
    }

    public function down()
    {
    }
};
