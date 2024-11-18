<?php

namespace App\Orchid\Screens\Site;

use App\Containers\Site\Models\Site;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteListScreen extends Screen
{
    public function name(): ?string
    {
        return "Sites";
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
            'sites' => Site::paginate(10)
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.site.create')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('sites', [
                TD::make('id', 'ID'),
                TD::make('position', 'Position'),
                TD::make('image', __('Image'))
                    ->cantHide()
                    ->width(100)
                    ->render(function (Site $site) {
                        return '<img style="width: 100%" src="' . $site->image . '" alt="box" />';
                    }),
                TD::make('category_id', 'Category')
                    ->render(function (Site $site) {
                        return $site->category->name;
                    }),
                TD::make('price', 'Price'),
                TD::make('promo', 'Promo'),
                TD::make('link', 'Link')
                    ->render(function (Site $site) {
                        return Link::make('Link')
                            ->href($site->link)
                            ->target('_blank');
                    }),
                TD::make('is_new', 'Is new')
                    ->render(function (Site $site) {
                        return Button::make($site->is_new ? 'Off' : 'On')
                            ->method('toggleSwitchers', [
                                'id' => $site->id,
                                'key' => 'is_new'
                            ]);
                    }),
                TD::make('is_hot', 'Is hot')
                    ->render(function (Site $site) {
                        return Button::make($site->is_hot ? 'Off' : 'On')
                            ->method('toggleSwitchers', [
                                'id' => $site->id,
                                'key' => 'is_hot'
                            ]);
                    }),
                TD::make('is_vpn', 'Is vpn')
                    ->render(function (Site $site) {
                        return Button::make($site->is_vpn ? 'Off' : 'On')
                            ->method('toggleSwitchers', [
                                'id' => $site->id,
                                'key' => 'is_vpn'
                            ]);
                    }),
                TD::make('is_active', 'Is show')
                    ->render(function (Site $site) {
                        return Button::make($site->is_active ? 'Off' : 'On')
                            ->method('toggleSwitchers', [
                                'id' => $site->id,
                                'key' => 'is_active'
                            ]);
                    }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (Site $site) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->icon('pencil')
                                    ->route('platform.site.edit', $site->id),
                            ]);
                    }),
            ])
        ];
    }

    public function toggleSwitchers(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $site = Site::findOrFail($request->get('id'));
            $key = $request->get('key');
            $site->$key = !$site->$key;
            $site->save();
        });
        Toast::info('Success');
    }
}
