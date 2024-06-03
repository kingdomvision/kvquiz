<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserList extends Component
{
    protected int $paginate = 10;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-list', [
            'users' => User::onlyUser()->paginate($this->paginate),
            'i' => (request()->input('page', 1) - 1) * $this->paginate
        ]);
    }

    public function delete(User $user)
    {
        abort_if(!auth()->user()->is_admin, ResponseAlias::HTTP_FORBIDDEN, 403);

        $user->delete();
    }
}
