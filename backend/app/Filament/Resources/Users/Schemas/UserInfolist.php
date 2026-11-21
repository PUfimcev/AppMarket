<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use App\Models\User;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('role_label')
                    ->label('Role')
                    ->getStateUsing(
                        fn (User $record): ?string => $record->roles->first()?->name,
                    )
                    ->formatStateUsing(function (?string $state): string {
                        if (blank($state)) {
                            return 'No role';
                        }

                        return match ($state) {
                            'super_admin' => 'Super admin',
                            'panel_user' => 'User editor',
                            default => $state,
                        };
                    })
                    ->placeholder('No role'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
