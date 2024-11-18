<?php

namespace App\Orchid\Screens\Site;

use App\Containers\Site\Models\SiteCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Fields\Switcher;

class SiteCategoryEditScreen extends Screen
{
    public $site_category;

    public function name(): ?string
    {
        return $this->site_category->exists ? 'Edit' : 'Create';
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function query(SiteCategory $site_category): array
    {
        return [
            'site_category' => $site_category
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->site_category->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->site_category->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->site_category->exists),
        ];
    }

    public function layout(): array
    {
        $categories = SiteCategory::get();
        $positions = $categories->pluck('position');
        $positions->push($categories->count() + 1);
        $options = [];
        foreach ($positions as $position)
            $options[$position] = $position;

        return [
            Layout::rows([
                Select::make('site_category.position')
                    ->options($options)
                    ->empty('Empty')
                    ->title('Position')
                    ->required(),

                Input::make('site_category.name')
                    ->title('Name')
                    ->required(),

                Switcher::make('site_category.is_active')
                    ->sendTrueOrFalse()
                    ->title('Is active?'),
            ])
        ];
    }

    public function create(SiteCategory $site_category, Request $request)
    {
        $params = $request->get('site_category');
        DB::transaction(function () use ($params, $site_category) {
            SiteCategory::where('position', '>=', $params['position'])->orderBy('position', 'desc')->increment('position');
            $site_category->fill($params)->save();
        });

        Alert::info('Success');
        return redirect()->route('platform.site-category.list');
    }

    public function update(SiteCategory $site_category, Request $request)
    {
        $params = $request->get('site_category');
        DB::transaction(function () use ($params, $site_category) {
            $site_category->position < $params['position']
                ? SiteCategory::where([['position', '<=', $params['position']], ['position', '>', $site_category->position]])->decrement('position')
                : SiteCategory::where([['position', '>=', $params['position']], ['position', '<', $site_category->position]])->increment('position');

            $site_category->fill($params);
            $site_category->save();
        });

        Alert::info('Success');
        return redirect()->route('platform.site-category.list');
    }

    public function remove(SiteCategory $site_category)
    {
        DB::transaction(function () use ($site_category) {
            $site_category->delete();
            SiteCategory::where('position', '>', $site_category->position)->decrement('position');
        });

        Alert::info('Success');
        return redirect()->route('platform.site.list');
    }
}
