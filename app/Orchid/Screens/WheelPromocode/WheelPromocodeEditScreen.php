<?php

namespace App\Orchid\Screens\WheelPromocode;

use App\Containers\Wheel\Models\WheelPromocode;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class WheelPromocodeEditScreen extends Screen
{
    public $wheel_promocode;

    public function name(): ?string
    {
        return $this->wheel_promocode->exists ? 'Edit' : 'Create';
    }

    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function query(WheelPromocode $wheel_promocode): array
    {
        return [
            'wheel_promocode' => $wheel_promocode
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('check')
                ->method('createOrUpdate')
                ->canSee(!$this->wheel_promocode->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->wheel_promocode->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->wheel_promocode->exists),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('wheel_promocode.value')
                    ->required()
                    ->title('Value'),

                Input::make('wheel_promocode.limit')
                    ->type('number')
                    ->title('Limit')
                    ->help('Value 0 - infinity'),
            ])
        ];
    }

    public function createOrUpdate(WheelPromocode $wheel_promocode, Request $request)
    {
        $params = $request->get('wheel_promocode');
        if ($params['limit'] == 0) $params['limit'] = null;
        if (WheelPromocode::where([['value', $params['value']], ['id', '!=', $wheel_promocode->id]])->exists()) {
            Toast::error('Such promocode already exists');
            return;
        }
        $wheel_promocode->fill($params)->save();

        Alert::info('Success');
        return redirect()->route('platform.wheel-promocode.list');
    }

    /**
     * @param Request $request
     */
    public function remove(WheelPromocode $wheel_promocode)
    {
        $wheel_promocode->delete();

        Alert::info('Success');
        return redirect()->route('platform.wheel-promocode.list');
    }
}
