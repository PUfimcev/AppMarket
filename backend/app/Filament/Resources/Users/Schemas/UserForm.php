<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('primary_role')
                    ->label('Role')
                    ->options([
                        'no_role' => 'No role',
                        'super_admin' => 'Super admin',
                        'panel_user' => 'User editor',
                    ])
                    ->default('no_role')
                    ->native(false)
                    ->afterStateHydrated(function (Select $component, ?User $record): void {
                        if ($record) {
                            $component->state($record->roles->first()?->name ?? 'no_role');
                        }
                    })
                    ->dehydrated(true)
                    ->helperText('Optional. Choose “No role” to remove panel access via Spatie roles.'),
            ]);
    }
}
