<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;
use Throwable;

/**
 *
 */
trait ApiService
{
    public function sendResponse($method, $userId = null, $imgFile = null)
    {
        try {

            $response = Http::timeout(50)
                ->accept('application/json')
                ->post('http://abz-agency.loc/api/v1/user/'.$method, [
                    'api_token' => '2a127d0Vo0aF5vPBCnCC690uieYMIpth9WAXGgFqjqGCgF928AstUUq',
                    'name' => $this->userName ?? '',
                    'email' => $this->email ?? '',
                    'password' => $this->password ?? '',
                    'user_id' => $userId ?? '',
                    'photo' => $imgFile ?? ''
                ]);


            $result = [];
            if ($response->successful()) {
                $result = $response->json();
            }

            return [
                'result' => $result,
                'status' => $response->status(),
            ];
        } catch (Throwable $e) {
            return [
                'result' => [],
                'status' => 401,
            ];
        }
    }
}
