<?php

namespace App\Services;

use App\Enums\ExternalUrl;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class IpService
{
    /**
     * Get information on a given IP address.
     * @see https://ip-api.com/
     *
     * @param string $ip
     *
     * @return array
     * @throws RequestException
     */
    public function getIpInformations(string $ip): array
    {
        $response = Http::get(ExternalUrl::IP_API.$ip, [
            'fields' => 'status,message,countryCode,regionName,zip,org',
        ]);

        return $response->throw()->json();
    }
}
