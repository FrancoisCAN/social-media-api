<?php

namespace App\Factories;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory
{
    /**
     * Create a new user.
     *
     * @param string $email
     * @param string $firstname
     * @param bool $is_online
     * @param string $lastname
     * @param string $password
     * @param City $city
     * @param Role $role
     * @param string|null $bio
     * @param string|null $phone
     *
     * @return User
     */
    public function create(
        string $email,
        string $firstname,
        bool $is_online,
        string $lastname,
        string $password,
        City $city,
        Role $role,
        string $bio = null,
        string $phone = null,
    ): User {
        $user = new User;
        $user->bio = $bio;
        $user->email = $email;
        $user->firstname = $firstname;
        $user->is_online = $is_online;
        $user->lastname = $lastname;
        $user->password = Hash::make($password);
        $user->phone = $phone;
        $user->city()->associate($city);
        $user->role()->associate($role);
        $user->save();

        return $user;
    }
}
