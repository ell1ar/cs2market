<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserListScreen extends Screen
{
    public $name = 'User';

    public $description = 'All registered users';

    /**
     * @var string
     */
    public $permission = 'platform.systems.users';

    public function query(): array
    {
        return [
            'users' => User::with('roles')
                ->filters()
                ->filtersApplySelection(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.users.create'),
        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            UserFiltersLayout::class,
            UserListLayout::class,

            Layout::modal('oneAsyncModal', UserEditLayout::class)
                ->async('asyncGetUser'),
        ];
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetUser(User $user): array
    {
        return [
            'user' => $user,
        ];
    }

    /**
     * @param User    $user
     * @param Request $request
     */
    public function saveUser(User $user, Request $request): void
    {
        $request->validate([
            'user.email' => 'required|unique:users,email,'.$user->id,
        ]);

        $user->fill($request->input('user'))
            ->save();

        Toast::info(__('User was saved.'));
    }

    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('User was removed'));
    }
}
