<?php

namespace App\Filament\Resources\Users\Concerns;

use Filament\Actions\Action;

trait CustomActions
{
    /**
     * @param  class-string<\Filament\Resources\Resource>  $resource
     */
    public static function backAction(string $resource, string $page = 'index'): Action
    {
        return Action::make('back')
            ->label('Back')
            ->icon('heroicon-o-arrow-left')
            ->color('gray')
            ->url($resource::getUrl($page));
    }
}