<div class="container mb-5">
    <div class="card mt-5">
        <div class="card-body">
            <form id="create-filter-form" wire:submit.prevent="save">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">User name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                   wire:model.defer="userName">
                        </div>
                        @error('userName')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" wire:model.defer="email">
                        </div>
                        @error('email')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" wire:model.defer="password">
                        </div>
                        @error('password')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        @if($photo)
                            <div class="mb-3 d-flex align-items-start">
                                <img
                                    src="{{ $isUploaded ? asset('storage/photos/'.$photo) : $photo->temporaryUrl() }}"
                                    class="me-3" alt="photo"
                                    style="max-height: 242px;max-width: 300px;object-fit: contain;object-position: left;">
                                <a class="btn btn-danger" wire:click="deletePhoto">delete</a>
                            </div>

                        @else
                            <div class="mb-3">
                                <label for="link" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo"
                                       wire:model.defer="photo">
                                <div wire:loading wire:target="photo">Uploading...</div>
                            </div>
                        @endif
                        @error('photo')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-3">Save</button>
                    <button class="btn btn-secondary me-3" wire:click.prevent="resetForm">Reset</button>
                </div>
            </form>
        </div>
    </div>
    @if(session('status'))
    <div id="alert-2 mt-3"
         class="flex p-4 mb-4 bg-blue-100 rounded-lg dark:bg-green shadow sm:rounded-md sm:overflow-hidden"
         role="alert">
        <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
            {{session('status')}}
        </div>
    </div>
    @endif
</div>
