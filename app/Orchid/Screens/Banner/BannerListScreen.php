<?php

namespace App\Orchid\Screens\Banner;

use App\Containers\Banner\Models\Banner;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerListScreen extends Screen
{
    public function name(): ?string
    {
        return "Banner";
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
        return [
            'banners' => Banner::paginate(10)
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.banner.create')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('banners', [
                TD::make('id', 'ID')->render(function (Banner $banner) {
                    return Link::make($banner->id)
                        ->route('platform.banner.edit', $banner);
                }),
                TD::make('type', 'Position')
                    ->render(function (Banner $banner) {
                        switch ($banner->type) {
                            case Banner::TOP_TYPE:
                                return 'Top';
                            case Banner::LEFT_TYPE:
                                return 'Left';
                            case Banner::RIGHT_TYPE:
                                return 'Right';
                        }
                    }),
                TD::make('position', 'Position'),
                TD::make('is_active', 'Is sctive?')
                    ->render(function (Banner $banner) {
                        return Button::make($banner->is_active ? 'Off' : 'On')
                            ->method('toggleSwitchers', [
                                'id' => $banner->id,
                                'key' => 'is_active'
                            ]);
                    }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (Banner $banner) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->icon('pencil')
                                    ->route('platform.banner.edit', $banner->id),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->confirm('Delete?')
                                    ->method('remove', [
                                        'id' => $banner->id,
                                    ]),
                            ]);
                    }),
            ])
        ];
    }

    public function toggleSwitchers(Request $request): void
    {
        $banner = Banner::findOrFail($request->get('id'));
        $banner->update([$request->get('key') => !$banner->{$request->get('key')}]);
        Toast::info('Success');
    }

    public function remove(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $banner = Banner::findOrFail($request->get('id'));
            $banner->delete();
            Banner::where('type', $banner->type)->where('position', '>', $banner->position)->decrement('position');
            Toast::info('Success');
        });
    }
}
