<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaptainAPIController extends Controller
{

    public function toggle_status()
    {
        $user = auth()->user();
        
        $user->status = ! $user->status;

        $user->save();

        return response()->withData(__('api.status_changed_successfully'), ['status' => (int)$user->status]);
    }

}
