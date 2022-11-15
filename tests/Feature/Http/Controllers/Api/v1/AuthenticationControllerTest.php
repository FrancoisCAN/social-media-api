<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Repositories\DeviceRepository;
use App\Repositories\UserRepository;
use App\Services\IpService;
use Database\Seeders\CitySeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\RoleSeeder;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Api\v1\AuthenticationController
 */
class AuthenticationControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected array $ipInformationsResponse;
    protected array $loginPayload;
    protected array $registerPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CountrySeeder::class);
        $this->seed(CitySeeder::class);
        $this->seed(RoleSeeder::class);

        $this->ipInformationsResponse = [
            'countryCode' => 'CD 1',
            'ip' => '255.0.0.0',
            'org' => 'Organization 1',
            'regionName' => 'Region 1',
            'zip' => 'Zip 1',
        ];
        $this->loginPayload = [
            'email' => 'test.user@gmail.com',
            'password' => 'password',
        ];
        $this->registerPayload = [
            'bio' => 'Bio 1',
            'city' => 1,
            'email' => 'test.user@gmail.com',
            'firstname' => 'Test',
            'ip' => '255.0.0.0',
            'lastname' => 'User',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '0601020304'
        ];
    }

    /**
     * @test
     * @covers \App\Http\Controllers\Api\v1\AuthenticationController::__construct
     *
     * @return void
     */
    public function initializedSuccessfully(): void
    {
        $ipServiceMock = $this->getMockBuilder(IpService::class)->disableOriginalConstructor()->getMock();
        $deviceMock = $this->getMockBuilder(DeviceRepository::class)->disableOriginalConstructor()->getMock();
        $userMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();

        $tested = new AuthenticationController($deviceMock, $ipServiceMock, $userMock);

        $this->assertInstanceOf(AuthenticationController::class, $tested);
    }

    /**
     * @test
     * @covers ::register
     *
     * @return void
     */
    public function registrationIsSuccessful(): void
    {
        $this->instance(IpService::class, $this->getMockIpService($this->ipInformationsResponse));

        $response = $this->postJson('/api/v1/auth/register', $this->registerPayload);

        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertDatabaseHas('users', ['email' => $this->registerPayload['email']]);
        $this->assertDatabaseHas('devices', ['ip' => $this->registerPayload['ip']]);
    }

    /**
     * @test
     * @covers ::register
     *
     * @return void
     */
    public function registrationHasFailed(): void
    {
        $this->instance(UserRepository::class, $this->getMockUserRepository(true));

        $response = $this->postJson('/api/v1/auth/register', $this->registerPayload);

        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseMissing('users', ['email' => $this->registerPayload['email']]);
        $this->assertDatabaseMissing('devices', ['ip' => $this->registerPayload['ip']]);
    }

    /**
     * @test
     * @covers ::register
     *
     * @return void
     */
    public function deviceAssociationHasFailed(): void
    {
        $this->instance(IpService::class, $this->getMockIpService(null, true));

        $response = $this->postJson('/api/v1/auth/register', $this->registerPayload);

        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertDatabaseHas('users', ['email' => $this->registerPayload['email']]);
        $this->assertDatabaseMissing('devices', ['ip' => $this->registerPayload['ip']]);
    }

    /**
     * @test
     * @covers ::login
     * @covers ::signout
     *
     * @return void
     */
    public function loginAndSignoutAreSuccessful(): void
    {
        $registerResponse = $this->postJson('/api/v1/auth/register', $this->registerPayload);
        $signoutResponse = $this->postJson('/api/v1/auth/signout', [], ['Authorization' => 'Bearer '.$registerResponse['token']]);
        $loginResponse = $this->postJson('/api/v1/auth/login', $this->loginPayload);

        $signoutResponse->assertStatus(HttpResponse::HTTP_OK);
        $loginResponse->assertStatus(HttpResponse::HTTP_OK);
    }

    /**
     * @test
     * @covers ::login
     *
     * @return void
     */
    public function loginHasFailed(): void
    {
        $this->loginPayload['password'] = 'wordpass';

        $registerResponse = $this->postJson('/api/v1/auth/register', $this->registerPayload);
        $this->postJson('/api/v1/auth/signout', [], ['Authorization' => 'Bearer '.$registerResponse['token']]);
        $loginResponse = $this->postJson('/api/v1/auth/login', $this->loginPayload);

        $loginResponse->assertStatus(HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @param $result
     * @param bool $hasException
     *
     * @return MockInterface
     */
    private function getMockIpService($result, bool $hasException = false): MockInterface
    {
        $mock = $this->mock(IpService::class);
        $hasException ? $mock->shouldReceive('getIpInformations')->andThrow(new Exception()) :
            $mock->shouldReceive('getIpInformations')->andReturn($result);

        return $mock;
    }

    /**
     * @param bool $hasException
     *
     * @return MockInterface
     */
    private function getMockUserRepository(bool $hasException = false): MockInterface
    {
        $mock = $this->mock(UserRepository::class);
        $hasException ? $mock->shouldReceive('store')->andThrow(new Exception()) :
            $mock->shouldReceive('store');

        return $mock;
    }
}
