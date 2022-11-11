<?php

namespace App\Repositories;

use App\Factories\UserFactory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    private UserFactory $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    /**
     * Store a new user.
     *
     * @param string $city
     * @param string $country
     * @param string $email
     * @param string $firstname
     * @param bool $is_online
     * @param string $lastname
     * @param string $password
     * @param Role $role
     * @param string|null $bio
     * @param string|null $phone
     *
     * @return User
     */
    public function store(

        string $city,
        string $country,
        string $email,
        string $firstname,
        bool $is_online,
        string $lastname,
        string $password,
        Role $role,
        string $bio = null,
        string $phone = null
    ): User {
        $user = $this->userFactory
            ->create($city, $country, $email, $firstname, $is_online, $lastname, $password, $role, $bio, $phone);
        $user->save();

        return $user;
    }

    /**
     * Get the number of devices a user owned.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function getNumberOfDevicesByUser(User $user): int
    {
        $devices = User::withCount(['devices' => function (Builder $query) use ($user) {
            $query->whereBelongsTo($user);
        }])->get();

        return $devices[0]->devices_count;
    }
}
