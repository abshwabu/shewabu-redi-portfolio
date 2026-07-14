<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable(): void
    {
        static::saving(function ($model): void {
            $source = $model->getSlugSource();

            if (blank($source)) {
                return;
            }

            if (filled($model->slug) && ! $model->isDirty($model->getSlugSourceAttribute())) {
                return;
            }

            if (blank($model->slug) || $model->isDirty($model->getSlugSourceAttribute())) {
                $model->slug = $model->generateUniqueSlug($source);
            }
        });
    }

    protected function getSlugSourceAttribute(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    protected function getSlugSource(): ?string
    {
        $attribute = $this->getSlugSourceAttribute();

        return $this->{$attribute} ?? null;
    }

    protected function generateUniqueSlug(string $value): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $counter = 1;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($this->exists, fn ($query) => $query->whereKeyNot($this->getKey()))
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
