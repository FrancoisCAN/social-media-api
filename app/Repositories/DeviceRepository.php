<?php

namespace App\Repositories;

use App\Factories\DeviceFactory;
use App\Models\Device;
use App\Models\User;

class DeviceRepository
{
    private DeviceFactory $deviceFactory;

    public function __construct(DeviceFactory $deviceFactory)
    {
        $this->deviceFactory = $deviceFactory;
    }

    /**
     * Store a new device.
     *
     * @param string $country
     * @param string $ip
     * @param string $name
     * @param string $organization
     * @param string $region
     * @param string $zip
     * @param User $user
     *
     * @return Device
     */
    public function store(
        string $country,
        string $ip,
        string $name,
        string $organization,
        string $region,
        string $zip,
        User $user
    ): Device {
        $device = $this->deviceFactory
            ->create($country, $ip, $name, $organization, $region, $zip, $user);
        $device->save();

        return $device;
    }
}
