<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

#[Fillable(["parent_id", "slug", "name", "description", "new_text", "icon_url"])]
class Category extends Model
{
    use HasFactory, Notifiable, softDeletes;

    protected $appends = ['parent_name'];

    protected $touches = ['category'];

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(
            Image::class,
            "imageable"
        );
    }

    public function ParentName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->parent_id ? $this->parent->name : null,
        );
    }

}
