<?php

namespace App\Http\Controllers\Subscriber;

use App\Domain\Subscriber\Requests\User\AccountRequest;
use App\Domain\Subscriber\Requests\User\PasswordRequest;
use App\Domain\Subscriber\Services\User\AccountService;
use App\Http\Controllers\Controller;

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
        $user = currentUser();

        return view('subscriber.modules.account', ['user' => $user]);
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
            $this->accountService->update($request->all(), currentUser()->id);

            $response = [
                'error' => false,
                'message' => 'Account information successfully updated.',
            ];

            if ($request->ajax()) {
                return response()->json($response);
            }

            flash()->success($response['message']);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ]);
            }

            logger()->error($e);
            flash()->error('Unable to update account information.');
        }

        return redirect()->back();
    }

    /**
     * Show password update form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getChangePassword()
    {
        return view('subscriber.modules.change-password');
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

            if ($request->ajax()) {
                return response()->json($response);
            }

            flash()->success($response['message']);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ]);
            }

            logger()->error($e);
            flash()->error('Unable to update password.');
        }

        return redirect()->back();
    }
}
