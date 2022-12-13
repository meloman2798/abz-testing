<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{

    public function create(UserCreateRequest $request)
    {
        $data = $request->validated();
        $result = [
            'result' => 'error'
        ];

        $photo = $this->img($data['photo']);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->photo = $photo;
        $user->save();

        if ($user->save()){
            $result['result'] = 'success';
        }

        return response()->json($result);
    }

    public function update(UserUpdateRequest $request)
    {

        $data = $request->validated();
        $result = [
            'result' => 'error'
        ];
        $photo = $this->img($data['photo']);

        $user = User::query()->find($data['user_id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->photo = $photo;
        $user->save();

        if ($user){
            $result['result'] = 'success';
        }

        return response()->json($result);
    }

    public function delete(UserDeleteRequest $request)
    {
        $data = $request->validated();
        $result = [
            'result' => 'error'
        ];
        $user = User::query()->find($data['user_id']);
        $user->delete();
        if ($user){
            $result['result'] = 'success';
        }

        return response()->json($result);
    }

    public function img($photo)
    {

        $this->makeSizeImage($photo);

        return $photo;
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
