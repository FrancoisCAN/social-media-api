<?php

namespace App\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory
{
    /**
     * Create a new user.
     *
     * @param string $city
     * @param string $country
     * @param string $email
     * @param string $firstname
     * @param bool $is_online
     * @param string $lastname
     * @param string $password
     * @param string $phone
     * @return User
     */
    public function create(
        string $city,
        string $country,
        string $email,
        string $firstname,
        bool $is_online,
        string $lastname,
        string $password,
        string $phone,
    ): User {
        $user = new User;
        $user->city = $city;
        $user->country = $country;
        $user->email = $email;
        $user->firstname = $firstname;
        $user->is_online = $is_online;
        $user->lastname = $lastname;
        $user->password = Hash::make($password);
        $user->phone = $phone;
        $user->role_id = Role::MEMBER;
        $user->save();

        return $user;
    }
}
