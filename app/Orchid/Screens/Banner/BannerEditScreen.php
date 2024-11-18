<?php

namespace App\Orchid\Screens\Banner;

use App\Containers\Banner\Models\Banner;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Fields\CheckWheel;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Facades\Layout;

class BannerEditScreen extends Screen
{
    public $banner;

    public function name(): ?string
    {
        return $this->banner->exists ? 'Edit' : 'Create';
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function query(Banner $banner): array
    {
        return [
            'banner' => $banner
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->banner->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->banner->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->banner->exists),
        ];
    }

    public function layout(): array
    {
        $banner = $this->banner;

        $top_positions = Banner::top()->orderBy('position')->pluck('position');
        $left_positions = Banner::left()->orderBy('position')->pluck('position');
        $right_positions = Banner::right()->orderBy('position')->pluck('position');

        if (($banner->exists && $banner->type != Banner::TOP_TYPE) || !$banner->exists) $top_positions->push($top_positions->count() + 1);
        $options = [];
        foreach ($top_positions as $top_position) {
            $options['top_' . $top_position] = 'Top: ' . $top_position;
        }

        if (($banner->exists && $banner->type != Banner::LEFT_TYPE) || !$banner->exists) $left_positions->push($left_positions->count() + 1);
        foreach ($left_positions as $left_position) {
            $options['left_' . $left_position] = 'Left: ' . $left_position;
        }

        if (($banner->exists && $banner->type != Banner::RIGHT_TYPE) || !$banner->exists) $right_positions->push($right_positions->count() + 1);
        foreach ($right_positions as $right_position) {
            $options['right_' . $right_position] = 'Right: ' . $right_position;
        }

        return [
            Layout::rows([
                Select::make('banner.edit_position')
                    ->empty('Empty')
                    ->title('Position')
                    ->options($options)
                    ->required(),

                Picture::make('banner.image')
                    ->title('Image')
                    ->required(),

                Input::make('banner.link')
                    ->title('Link')
                    ->required(),

                Switcher::make('banner.is_active')
                    ->sendTrueOrFalse()
                    ->title('Is active?')
            ])
        ];
    }

    public function create(Banner $banner, Request $request)
    {
        DB::transaction(function () use ($banner, $request) {
            $params = $request->get('banner');
            $temp = explode('_', $params['edit_position']);
            unset($params['edit_position']);
            $type = $temp[0];
            $position = $temp[1];

            $params['position'] = intval($position);
            $params['type'] = $type;

            Banner::where('type', $params['type'])->where('position', '>=', $params['position'])->increment('position');
            $banner->fill($params)->save();
        });

        Alert::info('Success');
        return redirect()->route('platform.banner.list');
    }

    public function update(Banner $banner, Request $request)
    {
        DB::transaction(function () use ($banner, $request) {
            $params = $request->get('banner');

            $temp = explode('_', $params['edit_position']);
            unset($params['edit_position']);
            $type = $temp[0];
            $position = $temp[1];

            $params['position'] = intval($position);
            $params['type'] = $type;

            if ($banner->type != $type) {
                Banner::where('id', '!=', $banner->id)->where('type', $banner->type)->where('position', '>=', $banner->position)->decrement('position'); // уменьшаем позиции в старом типе
                Banner::where('type', $params['type'])->where('position', '>=', $params['position'])->increment('position'); // увеличиваем позиции в новом типе
            } else {
                $banner->position < $params['position']
                    ? Banner::where('type', $params['type'])->where([['position', '<=', $params['position']], ['position', '>', $banner->position]])->decrement('position')
                    : Banner::where('type', $params['type'])->where([['position', '>=', $params['position']], ['position', '<', $banner->position]])->increment('position');
            }

            $banner->fill($params)->save();

            Alert::info('Success');
            return redirect()->route('platform.banner.list');
        });
    }

    public function remove(Banner $banner)
    {
        DB::transaction(function () use ($banner) {
            Banner::where('type', $banner->type)->where('position', '>', $banner->position)->decrement('position');
            $banner->delete();
            Alert::info('Success');
            return redirect()->route('platform.banner.list');
        });
    }
}
