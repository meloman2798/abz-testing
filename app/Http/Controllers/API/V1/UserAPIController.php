<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
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

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
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

        $user = User::query()->where('id',$data['user_id'])
            ->update(['name'=>$data['name'], 'email'=> $data['email'], 'password'=>Hash::make($data['password'])]);

        if ($user){
            $result['result'] = 'success';
        }

        return response()->json($result);
    }

}
