<?php

namespace App\Orchid\Screens\Player;

use App\Containers\Player\Models\Player;
use App\Containers\Trade\Data\Enums\Type;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PlayerListScreen extends Screen
{
    public function name(): string
    {
        return __('Players');
    }

    public function query(): array
    {
        return [
            'players' => Player::filters()->defaultSort('id', 'desc')->paginate(10)
        ];
    }

    public function commandBar(): array
    {
        return [];
    }

    public function layout(): array
    {
        return [
            Layout::table('players', [
                TD::make('id', 'ID')
                    ->filter(TD::FILTER_TEXT)
                    ->width(60)
                    ->sort(),

                TD::make('image', __('Avatar'))
                    ->render(function (Player $player) {
                        return '<img style="width: 100%; border-radius: 9999px;" src="' . $player->image . '" alt="box" />';
                    })
                    ->width(50),

                TD::make('name', __('Name'))
                    ->filter(TD::FILTER_TEXT)
                    ->sort(),

                TD::make('balance', __('Balance'))
                    ->render(function (Player $player) {
                        return $player->balance . ' USD';
                    })
                    ->sort(),

                TD::make('is_ban', __('Banned?'))
                    ->render(function (Player $player) {
                        return $player->is_ban ? __('Yes') : __('No');
                    }),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (Player $player) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make('Edit')
                                    ->route('platform.player.edit', compact('player')),

                                Button::make(__('Ban'))
                                    ->canSee(!$player->is_ban)
                                    ->method('ban', [
                                        'id' => $player->id,
                                    ]),
                                Button::make(__('Unban'))
                                    ->canSee($player->is_ban)
                                    ->method('unban', [
                                        'id' => $player->id,
                                    ]),
                            ]);
                    }),
            ])
        ];
    }

    public function ban(Request $request): void
    {
        Player::where('id', $request->get('id'))->update(['is_ban' => true]);
        Toast::info(__('Success'));
    }

    public function unban(Request $request): void
    {
        Player::where('id', $request->get('id'))->update(['is_ban' => false]);
        Toast::info(__('Success'));
    }
}
