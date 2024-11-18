<?php

namespace App\Orchid\Screens\WheelPromocode;

use App\Containers\Wheel\Models\WheelPromocode;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class WheelPromocodeListScreen extends Screen
{
    public function name(): ?string
    {
        return "Wheel promocode's list";
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
            'wheel_promocodes' => WheelPromocode::filters()->defaultSort('id', 'desc')->paginate(10)
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.wheel-promocode.create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('wheel_promocodes', [
                TD::make('id', 'ID')
                    ->sort(),
                TD::make('value', 'Value')
                    ->sort(),
                TD::make('limit', 'Limit')
                    ->sort()
                    ->render(function (WheelPromocode $wheel_promocode) {
                        if (is_null($wheel_promocode->limit)) return 'Unlimited';
                        return 'Limit left: ' . $wheel_promocode->limit;
                    }),
                TD::make('created_at', 'Created')->render(function (WheelPromocode $wheel_promocode) {
                    return $wheel_promocode->created_at->toDateTimeString();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (WheelPromocode $wheel_promocode) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->icon('pencil')
                                    ->route('platform.wheel-promocode.edit', $wheel_promocode->id),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->confirm('Delete?')
                                    ->method('remove', [
                                        'id' => $wheel_promocode->id,
                                    ]),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        WheelPromocode::findOrFail($request->get('id'))->delete();

        Toast::info('Success');
        return redirect()->route('platform.wheel-promocode.list');
    }
}
