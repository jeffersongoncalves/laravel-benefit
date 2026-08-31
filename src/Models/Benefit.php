<?php

namespace JeffersonGoncalves\Benefit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Benefit\Database\Factories\BenefitFactory;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property array<string, string> $name
 * @property array<string, string> $description
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Benefit extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'name',
        'description',
    ];

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    public function getTable(): string
    {
        return config('benefit.table_names.benefits', parent::getTable());
    }

    protected static function newFactory(): BenefitFactory
    {
        return BenefitFactory::new();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
