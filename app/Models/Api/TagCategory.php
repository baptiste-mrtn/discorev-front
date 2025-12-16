<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Str;

class TagCategory extends BaseApiModel
{
    protected $fillable = [
        'name',
        'slug',
        'tags',
    ];

    /**
     * Mapping spécifique pour /tags/admin
     */
    public static function fromApiCollection($data): EloquentCollection
    {
        $items = [];

        foreach ($data as $categoryName => $tags) {
            $category = new static();

            $category->name = $categoryName;
            $category->slug = Str::slug($categoryName);

            // Tags → vrais objets Tag
            $category->tags = collect($tags)
                ->map(fn($tag) => Tag::fromApiData($tag))
                ->all();

            $category->exists = true;

            $items[] = $category;
        }

        return new EloquentCollection($items);
    }
}
