<?php

namespace App\Http\Controllers\Json\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public function update(User $user, UpdateRequest $request): Responsable
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return UserResource::make($user);
    }
}
