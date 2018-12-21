<?php

namespace MailService\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Log;
use MailService\Events\UserPasswordReset;
use MailService\Events\UserRegistered;
use Throwable;

class AuthenticationMailController extends Controller
{
    public function UserRegistered(Request $request)
    {
        try {
            try {
                $this->validate($request, [
                    'activation_link' => 'required',
                    'email' => 'required|email',
                ]);
            } catch (ValidationException $exception) {

                Log::error('RegisterValidationError', ["error" => $exception]);

                return response()
                    ->json(
                        [
                            'status' => 'Bad Request',
                            'code' => 400,
                            'messages' => ["information is incomplete or malformed"],
                            'data' => [],
                            'error' => [
                                'status' => 400,
                                'error' => 'REQUEST_VALIDATION_ERROR',
                                'description' => 'And error was rased when trying to validate the request',
                                'fields' => [],
                            ],
                        ], 400
                    );

            }

            event(new UserRegistered($request->email, $request->activation_link));

            return response()
                ->json(
                    [
                        'status' => 'ok',
                        'code' => 200,
                        'messages' => ["email queued successfully"],
                        'data' => [
                            'state' => 'queued',
                        ],
                        'error' => [],
                    ], 200
                );
        } catch (Throwable $error) {
            Log::error('UserRegisteredError', ["error" => $error]);
            return response()
                ->json(
                    [
                        'status' => 'Internal Server Error',
                        'code' => 500,
                        'messages' => ["server error"],
                        'data' => [],
                        'error' => [
                            'status' => 500,
                            'error' => 'SERVER_ERROR',
                            'description' => 'An error occured when trying to send an email.',
                            'fields' => [],
                        ],
                    ], 500
                );
        }
    }
    public function UserPasswordReset(Request $request)
    {
        try {

            try {
                $this->validate($request, [
                    'reset_link' => 'required',
                    'email' => 'required|email',
                ]);
            } catch (ValidationException $exception) {

                Log::error('ResetValidationError', ["error" => $exception]);

                return response()
                    ->json(
                        [
                            'status' => 'Bad Request',
                            'code' => 400,
                            'messages' => ["information is incomplete or malformed"],
                            'data' => [],
                            'error' => [
                                'status' => 400,
                                'error' => 'REQUEST_VALIDATION_ERROR',
                                'description' => 'And error was rased when trying to validate the request',
                                'fields' => [],
                            ],
                        ], 400
                    );

            }
            event(new UserPasswordReset($request->email, $request->reset_link));

            return response()
                ->json(
                    [
                        'status' => 'ok',
                        'code' => 200,
                        'messages' => ["email queued successfully"],
                        'data' => [
                            'state' => 'queued',
                        ],
                        'error' => [],
                    ], 200
                );
        } catch (Throwable $error) {
            Log::error('UserPasswordReset', ["error" => $error]);
            return response()
                ->json(
                    [
                        'status' => 'Internal Server Error',
                        'code' => 500,
                        'messages' => ["server error"],
                        'data' => [],
                        'error' => [
                            'status' => 500,
                            'error' => 'SERVER_ERROR',
                            'description' => 'An error occured when trying to send an email.',
                            'fields' => [],
                        ],
                    ], 500
                );
        }
    }
}
