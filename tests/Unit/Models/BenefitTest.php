<?php

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Benefit\Models\Benefit;

it('creates the benefits table via the migration', function () {
    expect(Schema::hasTable('benefits'))->toBeTrue()
        ->and(Schema::hasColumns('benefits', ['id', 'name', 'description', 'slug', 'created_at', 'updated_at']))->toBeTrue();
});

it('enforces a unique slug', function () {
    Benefit::factory()->create(['slug' => 'free-shipping']);

    expect(fn () => Benefit::factory()->create(['slug' => 'free-shipping']))
        ->toThrow(QueryException::class);
});

it('stores and retrieves translated name and description per locale', function () {
    $benefit = Benefit::factory()->create([
        'name' => ['en' => 'Free Shipping', 'pt_BR' => 'Frete Grátis'],
        'description' => ['en' => 'No shipping costs.', 'pt_BR' => 'Sem custo de frete.'],
    ]);

    expect($benefit->getTranslation('name', 'en'))->toBe('Free Shipping')
        ->and($benefit->getTranslation('name', 'pt_BR'))->toBe('Frete Grátis')
        ->and($benefit->getTranslation('description', 'pt_BR'))->toBe('Sem custo de frete.');
});

it('falls back to the fallback locale when a translation is missing', function () {
    config(['app.fallback_locale' => 'en']);

    $benefit = Benefit::factory()->create([
        'name' => ['en' => 'Free Shipping'],
    ]);

    expect($benefit->getTranslation('name', 'es'))->toBe('Free Shipping');
});

it('uses slug as the route key', function () {
    $benefit = Benefit::factory()->create();

    expect($benefit->getRouteKeyName())->toBe('slug');
});

it('creates a valid model via the factory', function () {
    $benefit = Benefit::factory()->create();

    expect($benefit)->toBeInstanceOf(Benefit::class)
        ->and($benefit->getTranslations('name'))->toHaveKeys(['en', 'pt_BR'])
        ->and($benefit->getTranslations('description'))->toHaveKeys(['en', 'pt_BR'])
        ->and($benefit->slug)->not->toBeEmpty();
});
