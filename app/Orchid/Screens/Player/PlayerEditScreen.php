<?php

namespace App\Orchid\Screens\Player;

use App\Containers\Player\Models\Player;
use App\Containers\Player\Tasks\GetPlayerByIdTask;
use App\Containers\Trade\Data\Enums\Type;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PlayerEditScreen extends Screen
{
    public $player;

    public function query(Player $player): array
    {
        return [
            'player' => $player
        ];
    }

    public function name(): ?string
    {
        return 'Edit ' . $this->player->name;
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Update')
                ->icon('note')
                ->method('update')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Picture::make('player.image')
                    ->size(100)
                    ->title(__('Avatar')),

                Input::make('player.trade_link')
                    ->title(__('Trade-link')),

                Input::make('player.balance')
                    ->type('number')
                    ->step(0.01)
                    ->title(__('Balance (USD)')),

                Switcher::make('player.is_ban')
                    ->sendTrueOrFalse()
                    ->title(__('Banned?')),

                Switcher::make('player.is_trade')
                    ->sendTrueOrFalse()
                    ->title(__('Trade?')),
            ])
        ];
    }

    public function update(Player $player, Request $request)
    {
        return DB::transaction(function () use ($player, $request) {
            $player = app(GetPlayerByIdTask::class)->run($player->id, is_locked: true);
            $player->fill($request->get('player'))->save();
            Alert::info(__('Success'));
            return redirect()->route('platform.player.list');
        });
    }
}
