<?php

namespace App\Http\Controllers\Api\V1\Subscriber;

use App\Domain\Api\V1\Requests\Subscriber\AccountRequest;
use App\Domain\Api\V1\Requests\Subscriber\PasswordRequest;
use App\Domain\Api\V1\Services\Subscriber\AccountService;
use App\Http\Controllers\Controller;
use Exception;

class AccountController extends Controller
{
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * AccountController constructor.
     *
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Show the subscriber account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAccount()
    {
        return currentUser();
    }

    /**
     * Update subscriber account info
     *
     * @param AccountRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function postAccount(AccountRequest $request)
    {
        try {
            $account = $this->accountService->update($request->all(), currentUser()->id);

            $response = [
                'error' => false,
                'message' => 'Account information successfully updated.',
                'user' => $account,
            ];
        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'Unable to update account information.',
                'user' => currentUser(),
            ];
        }

        return response()->json($response);
    }

    /**
     * Update subscriber password
     *
     * @param PasswordRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function postChangePassword(PasswordRequest $request)
    {
        try {
            $this->accountService->updatePassword($request->only('password'), currentUser()->id);

            $response = [
                'error' => false,
                'message' => 'Password successfully changed.',
            ];
        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'Unable to update password.'
            ];
        }

        return response()->json($response);
    }
}
