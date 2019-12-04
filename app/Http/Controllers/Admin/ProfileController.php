<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        $accountInfo = [];

        return view('admin.modules.profile.index')->with([
            'accountInfo' => $accountInfo
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(Request $request)
    {
        try {
//            $this->accountService->update($request->all());

            flash()->success('Profile successfully updated.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to update profile.');
        }

        return redirect()->back();
    }
}
