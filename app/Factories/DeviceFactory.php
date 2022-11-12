<?php

namespace App\Factories;

use App\Models\Device;
use App\Models\User;

class DeviceFactory
{
    /**
     * Create a new device.
     *
     * @param string $country
     * @param string $ip
     * @param string $name
     * @param string $organization
     * @param string $region
     * @param string $zip
     * @param User $user
     * @return Device
     */
    public function create(
        string $country,
        string $ip,
        string $name,
        string $organization,
        string $region,
        string $zip,
        User $user
    ): Device {
        $device = new Device;
        $device->country = $country;
        $device->ip = $ip;
        $device->name = $name;
        $device->organization = $organization;
        $device->region = $region;
        $device->zip = $zip;
        $device->user()->associate($user);
        $device->save();

        return $device;
    }
}
