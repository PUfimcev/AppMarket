<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

#[Fillable("path")]
class Image extends Model
{
    use Notifiable;

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
