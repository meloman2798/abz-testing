<?php

namespace App\Http\Livewire;

use App\Http\Traits\ApiService;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use ApiService;
    use WithPagination;

    protected $listeners = [
        'userTableRefresh' => '$refresh',
        'deleteUser'
    ];

    protected string $paginationTheme = 'bootstrap';
    public int $userShow = 6;
    public bool $loadMoreBtn;

    public function loadMore()
    {
        $this->userShow += 6;
    }

    public function render()
    {
        $users = $this->getUsers($this->userShow);
        $this->calcLoadMore($this->userShow, $users->total());
        return view('livewire.user-list', [
            'users' => $users,
        ]);
    }

    public function getUsers($userShow): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()
            ->orderBy('id', 'desc')
            ->paginate($userShow);
    }

    public function deleteUser($userId)
    {
        $this->sendResponse('delete' ,$userId);
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
