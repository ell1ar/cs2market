<?php

namespace App\Orchid\Screens\Site;

use App\Containers\Site\Models\SiteCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;
use Illuminate\Support\Facades\DB;

class SiteCategoryListScreen extends Screen
{
    public function name(): ?string
    {
        return "Categories";
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
            'categories' => SiteCategory::paginate(10)
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.site-category.create')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', [
                TD::make('id', 'ID')->render(function (SiteCategory $category) {
                    return Link::make($category->id)
                        ->route('platform.site-category.edit', $category);
                }),
                TD::make('name', 'Name'),
                TD::make('position', 'Position'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (SiteCategory $category) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->icon('pencil')
                                    ->route('platform.site-category.edit', $category->id),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->method('remove', [
                                        'id' => $category->id,
                                    ]),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(SiteCategory $category)
    {
        DB::transaction(function () use ($category) {
            $category->delete();
            SiteCategory::where('position', '>', $category->position)->decrement('position');
            Toast::info('Success');
        });
    }
}
