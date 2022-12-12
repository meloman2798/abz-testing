<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-hove table-sm">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="white-space-nowrap">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>
                            <img style="width: 70px;max-height: 70px;object-fit: contain;object-position: center;" src="{{asset('storage/photos/'.$user->photo)}}">
                        </td>
                        <td class="action" style="vertical-align: middle;">
                            <button type="button"
                                    wire:click="$emit('edit', {{ $user->id }})"
                                    data-toggle="tooltip"
                                    title="Edit Product"
                                    class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                        <td class="action" style="vertical-align: middle;">
                            <button type="button"
                                    wire:click="$emit('deleteUser', {{ $user->id }})"
                                    class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center pb-5 pt-5">
                            <span class="h4">No users found...</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($loadMoreBtn)
                <div class="mt-5 d-flex justify-content-center flex-wrap">
                    <button wire:click="loadMore" type="button"
                            class="btn btn-secondary">Load more</button>
                </div>
            @endif
        </div>
    </div>
</div>

