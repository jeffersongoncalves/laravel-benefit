<?php

use Illuminate\Support\Facades\Schema;

it('registers the config file', function () {
    expect(config('benefit.table_names.benefits'))->toBe('benefits');
});

it('registers the migration and creates the table', function () {
    expect(Schema::hasTable('benefits'))->toBeTrue();
});
