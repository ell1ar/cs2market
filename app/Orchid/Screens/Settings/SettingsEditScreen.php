<?php

namespace App\Orchid\Screens\Settings;

use App\Containers\Settings\Models\Settings;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class SettingsEditScreen extends Screen
{
    public function name(): ?string
    {
        return "Edit";
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function query(): array
    {
        $settings = Settings::first();

        return [
            'settings' => $settings,
        ];
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
            Layout::tabs([
                'Meta' => [
                    Layout::rows([
                        Input::make('settings.data.meta.title')
                            ->title('Title'),

                        Input::make('settings.data.meta.keywords')
                            ->help('Comma separated')
                            ->title('Keywords'),

                        Picture::make('settings.data.meta.favicon')
                            ->title('Favicon'),

                        Picture::make('settings.data.meta.logo')
                            ->title('Logo'),

                        Code::make('settings.data.meta.head')
                            ->help("Before closed head")
                            ->title('Head'),

                        Code::make('settings.data.meta.scripts')
                            ->help('Before closed body')
                            ->title('Scripts'),
                    ]),
                ],

                'API Keys' => [
                    Layout::rows([
                        Input::make('settings.data.api.MARKET_API_KEY')
                            ->title('Market CS:GO Api Key')
                            ->type('password'),
                    ]),
                ],

                'Social' => [
                    Layout::rows([
                        Input::make('settings.data.social.VK_CLIENT_ID')
                            ->title('VK client ID'),

                        Input::make('settings.data.social.VK_CLIENT_SECRET')
                            ->title('VK client secret')
                            ->type('password'),

                        Switcher::make('settings.data.social.is_vk_auth')
                            ->sendTrueOrFalse()
                            ->title('VK auth'),

                        Input::make('settings.data.social.STEAM_CLIENT_SECRET')
                            ->title('Steam client secret')
                            ->type('password'),

                        Switcher::make('settings.data.social.is_steam_auth')
                            ->sendTrueOrFalse()
                            ->title('Steam auth'),

                        Input::make('settings.data.social.TELEGRAM_BOT_TOKEN')
                            ->title('Telegram bot token')
                            ->type('password'),

                        Switcher::make('settings.data.social.is_telegram_auth')
                            ->sendTrueOrFalse()
                            ->title('Telegram auth'),
                    ]),
                ],

                'Wheel' => [
                    Layout::rows([
                        Input::make('settings.data.wheel.limit_max_price')
                            ->type('number')
                            ->step(0.01)
                            ->title('Limit max price'),

                        Switcher::make('settings.data.wheel.is_active')
                            ->sendTrueOrFalse()
                            ->title('is active?'),
                    ]),
                ],
            ]),
        ];
    }

    public function update(Request $request)
    {
        $settings = Settings::first();
        $settings->fill($request->get('settings'))->save();
        Alert::info('Success');
        return redirect()->route('platform.settings');
    }
}
