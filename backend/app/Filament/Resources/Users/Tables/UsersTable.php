<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\User;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->copyMessageDuration(1500),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('role_label')
                    ->label('Role')
                    ->badge()
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
                    ->color(function (?string $state): string {
                        if (blank($state)) {
                            return 'gray';
                        }

                        return match ($state) {
                            'super_admin' => 'danger',
                            'panel_user' => 'info',
                            default => 'gray',
                        };
                    })
                    ->placeholder('No role'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
            ->searchPlaceholder('Search (Name, Email, Role)')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->stackedOnMobile();
    }
}
