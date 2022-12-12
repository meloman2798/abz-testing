<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserForm extends Component
{
    use WithFileUploads;

    protected $listeners = ['edit'];

    public $userName;
    public $email;
    public $password;
    public $photo;

    public $userId;

    public bool $isUploaded = false;

    protected array $rules = [
        'userName' => 'required|regex:/^[a-zA-Z\s\.]+$/',
        'password' => 'required|min:6',
        'email' => 'required|email',
        'photo' => 'required'
    ];

    protected array $messages = [
        'userName.regex' => 'Only letters',
        'userName.required' => 'This field must be required',
        'password.min' => 'Password must not be less 6 charts',
        'email.unique' => 'This email already exists ',
    ];

    public function render()
    {
        return view('livewire.user-form');
    }

    public function deletePhoto()
    {
        $this->photo = '';
        $this->isUploaded = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->userId) {
            $this->validate([
                'email' => 'required|email|unique:users',
            ]);
        }

        if (is_string($this->photo)) {
            $this->validate([
                'photo' => 'required',
            ]);
            $imgFile = $this->photo;
        } else {
            $this->validate([
                'photo' => 'required|image|max:1024',
            ]);

            $imgFile = $this->photo->store('/', 'photos');
        }

        $this->makeSizeImage($imgFile);

        $userId = 0;
        if ($this->userId) {
            $userId = $this->userId;
        }

       User::updateOrCreate(
            [
                'id' => $userId
            ],
            [
                'name' => $this->userName,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'photo' => $imgFile,
            ]);


        $this->isUploaded = true;
        session()->flash('status', 'User successfully saved!');
        $this->emit('userTableRefresh');
        $this->resetForm();
    }

    public function edit($userId)
    {
        $this->resetForm();
        $user = User::query()->find($userId);

        $this->userName = $user->name;
        $this->email = $user->email;
        if (empty($user->photo)) {
            $this->isUploaded = false;
        } else {
            $this->isUploaded = true;
        }
        $this->photo = $user->photo;
        $this->userId = $user->id;
    }

    public function resetForm()
    {
        $this->reset(['userName', 'email', 'password', 'photo', 'userId']);

        $this->isUploaded = false;
    }

    public function makeSizeImage($imgFile)
    {
        $filepath = 'storage/photos/'.$imgFile;
        \Tinify\setKey("3ZCDnmrBwGxCXzdmkKgGyWY5BsYSYZdd");
        $source = \Tinify\fromFile($filepath);
        $resized = $source->resize(array(
            "method" => "fit",
            "width" => 70,
            "height" => 70
        ));
        $resized->toFile('storage/photos/'.$imgFile);
    }
}
