<?php

namespace App\Http\Controllers\Front;

use App\Domain\Front\Requests\NewsletterRequest;
use Newsletter;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    /**
     * @param NewsletterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewsletter(NewsletterRequest $request)
    {
        try {
            Newsletter::subscribe($request->input('email'));

            flash()->overlay('Successfully subscribed to newsletter.');

            return redirect()->back();
        } catch (Exception $e) {
            logger()->error($e);
            flash()->overlay('Unable to subscribe newsletter.');
        }

        return redirect()->back()->withInput();
    }
}
