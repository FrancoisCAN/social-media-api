<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\Role as RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Repositories\DeviceRepository;
use App\Repositories\UserRepository;
use App\Services\IpService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthenticationController extends Controller
{
    public DeviceRepository $deviceRepository;
    public IpService $ipService;
    public UserRepository $userRepository;

    /**
     * @param DeviceRepository $deviceRepository
     * @param IpService $ipService
     * @param UserRepository $userRepository
     */
    public function __construct(
        DeviceRepository $deviceRepository,
        IpService $ipService,
        UserRepository $userRepository
    ) {
        $this->deviceRepository = $deviceRepository;
        $this->ipService = $ipService;
        $this->userRepository = $userRepository;
    }

    /**
     * Register a new user as a member.
     *
     * @param RegisterRequest $registerRequest
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        try {
            $user = $this->userRepository->store(
                $registerRequest->input('email'),
                $registerRequest->input('firstname'),
                true,
                $registerRequest->input('lastname'),
                $registerRequest->input('password'),
                City::find($registerRequest->input('city')),
                Role::find(RoleEnum::MEMBER),
                $registerRequest->input('bio'),
                $registerRequest->input('phone'),
            );

            $response = [
                'status' => [
                    'message' => 'The user has been created successfully.',
                    'state' => true,
                ],
                'token' => $user->createToken('authentication-token')->plainTextToken,
                'user' => $user->with(['role', 'devices'])->get(),
            ];

            Log::channel('api')->info('New user created', [
                'email' => $user->email,
                'id' => $user->id,
            ]);
        } catch (Exception $exception) {
            Log::channel('api')->error($exception->getMessage(), [
                $exception->getCode(),
                $exception->getFile(),
            ]);

            return response()->json([
                'status' => [
                    'error' => 'An error occurred trying to create a user.',
                    'state' => false,
                ],
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $ipInformations = $this->ipService->getIpInformations($registerRequest->input('ip'));

            $device = $this->deviceRepository->store(
                $ipInformations['countryCode'],
                $registerRequest->input('ip'),
                'Device '.$this->userRepository->getNumberOfDevicesByUser($user) + 1,
                $ipInformations['org'],
                $ipInformations['regionName'],
                $ipInformations['zip'],
                $user
            );

            Log::channel('api')->info('New device created for user with id: '.$user->id, [
                'ip' => $device->ip,
            ]);
        } catch (Exception $exception) {
            Log::channel('api')->error($exception->getMessage(), [
                $exception->getCode(),
                $exception->getFile(),
            ]);

            $response['status']['warning'] = [
                'message' => 'Error trying to associate the device to user '.$user->id.'.',
            ];
        }

        return response()->json($response, HttpResponse::HTTP_CREATED);
    }

    /**
     * Login a user.
     *
     * @param LoginRequest $loginRequest
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $user = User::where('email', $loginRequest->email)->first();
        if (!$user || !Hash::check($loginRequest->password, $user->password)) {
            return response()->json([
                'status' => [
                    'error' => 'The provided credentials are incorrect.',
                    'state' => false,
                ],
            ], HttpResponse::HTTP_UNAUTHORIZED);
        }
        $user->is_online = true;
        $user->save();

        return response()->json([
            'status' => [
                'message' => 'The user is login successfully.',
                'state' => true,
            ],
            'token' => $user->createToken('authentication-token')->plainTextToken,
            'user' => $user->with(['role', 'devices'])->get(),
        ]);
    }

    /**
     * Sign out a user.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function signout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->is_online = false;
        $user->save();
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => [
                'message' => 'The user signout successfully.',
                'state' => true,
            ],
        ]);
    }
}
