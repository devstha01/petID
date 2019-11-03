<?php

use App\Cloudsa9\Entities\Models\User\User;

/**
 * Phone code
 *
 * @return string
 */
function uniquePhoneCode()
{
    $uniqueId = substr(uniqid(), 0, 6);

    return str_shuffle($uniqueId);
}

/**
 * @param $id
 * @return mixed
 */
function subscriberByCustomerId($id)
{
    return User::where('stripe_id', $id)->first();
}

/**
 * Convert cent to dollar
 *
 * @param $cent
 * @return string
 */
function centToDollar($cent)
{
    return number_format(($cent / 100), 2, '.', ' ');
}