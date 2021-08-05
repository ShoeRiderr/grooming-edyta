<?php

namespace App\Http\Controllers\Json\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(User $user, UpdateRequest $request): Responsable
    {
        $user->update([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return UserResource::make($user);
    }
}
