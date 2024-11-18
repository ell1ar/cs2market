<?php

namespace App\Orchid\Screens\Site;

use App\Containers\Site\Models\SiteCategory;
use App\Containers\Site\Models\Site;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteEditScreen extends Screen
{
    public $site;

    public function name(): ?string
    {
        return $this->site->exists ? 'Edit' : 'Create';
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function query(Site $site): array
    {
        return [
            'site' => $site
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->site->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->site->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->site->exists),
        ];
    }

    public function layout(): array
    {
        $positions = Site::orderBy('position')->pluck('position');
        if (!$this->site->exists) $positions->push($positions->count() + 1);
        $options = [];
        foreach ($positions as $position)
            $options[$position] = $position;

        $categories = SiteCategory::get();
        $categories = $categories->mapWithKeys(fn($category) => [$category->id => $category->name])->all();

        return [
            Layout::rows([
                Select::make('site.position')
                    ->options($options)
                    ->empty('Empty')
                    ->title('Position')
                    ->required(),

                Input::make('site.link')
                    ->title('Link')
                    ->required(),

                Input::make('site.price')
                    ->title('Reward')
                    ->required(),

                Select::make('site.category_id')
                    ->options($categories)
                    ->title('Category'),

                Quill::make('site.instruction')
                    ->title('Instroction'),

                Picture::make('site.image')
                    ->required(),

                Input::make('site.promo')
                    ->title('Promocode'),

                Switcher::make('site.is_vip')
                    ->title('Is vip?')
                    ->sendTrueOrFalse(),

                Switcher::make('site.is_new')
                    ->title('Is new?')
                    ->sendTrueOrFalse(),

                Switcher::make('site.is_hot')
                    ->title('Is hot?')
                    ->sendTrueOrFalse(),

                Switcher::make('site.is_vpn')
                    ->title('Is VPN?')
                    ->sendTrueOrFalse(),

                Switcher::make('site.is_active')
                    ->title('Is show?')
                    ->sendTrueOrFalse(),
            ])
        ];
    }

    public function create(Site $site, Request $request)
    {
        DB::transaction(function () use ($site, $request) {
            $params = $request->get('site');
            Site::where('position', '>=', $params['position'])->increment('position');
            $site->fill($params)->save();

            Alert::info('Success');
            return redirect()->route('platform.site.list');
        });
    }

    public function update(Site $site, Request $request)
    {
        DB::transaction(function () use ($site, $request) {
            $params = $request->get('site');

            $site->position < $params['position']
                ? Site::where([['position', '>', $site->position], ['position', '<=', $params['position']]])->decrement('position')
                : Site::where([['position', '>=', $params['position']], ['position', '<', $site->position]])->increment('position');

            $site->fill($params);
            $site->save();

            Alert::info('Success');
            return redirect()->route('platform.site.list');
        });
    }

    /**
     * @param Site $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Site $site)
    {
        DB::transaction(function () use ($site) {
            Site::where('position', '>', $site->position)->decrement('position');
            $site->delete();
        });

        Alert::info('Success');
        return redirect()->route('platform.site.list');
    }
}
