<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    protected $listeners = [
        'userTableRefresh' => '$refresh',
        'deleteUser'
    ];

    protected string $paginationTheme = 'bootstrap';
    public int $productsShow = 6;
    public bool $loadMoreBtn;

    public function loadMore()
    {
        $this->productsShow += 6;
    }

    public function render()
    {
        $users = $this->getUsers($this->productsShow);
        $this->calcLoadMore($this->productsShow, $users->total());
        return view('livewire.user-list', [
            'users' => $users,
            'usersTotal' => $users->total(),
            'productsShow' => $this->productsShow,
            'loadMore' => $this->loadMoreBtn,
        ]);
    }

    public function getUsers($productsShow): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()
            ->orderBy('id', 'desc')
            ->paginate($productsShow);
    }

    public function deleteUser($userId)
    {
        $result = User::query()->find($userId);
        $result->delete();
        $this->emit('userTableRefresh');
    }

    public function calcLoadMore($show, $total)
    {
        if ($show >= $total) {
            $this->loadMoreBtn = false;
        } else {
            $this->loadMoreBtn = true;
        }
    }
}
