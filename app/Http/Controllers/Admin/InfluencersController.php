<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Entities\Models\User\Influencer;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfluencersController extends Controller
{
    public function index()
    {
        $influencers = Influencer::all();
        return view('admin.modules.influencer.index', compact('influencers'));
    }

    public function edit($id)
    {
        $inf = Influencer::find($id);
        return view('admin.modules.influencer.edit', compact('inf'));
    }

    function update($id, Request $request, UserRepository $userRepository)
    {
        $inf = Influencer::find($id);
        $valid = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $inf->user_id,
        ]);
        $userRepository->find($inf->user_id)->update($valid);
        $input = $request->except('_token', 'first_name', 'last_name', 'email');
        $inf->update($input);
        return redirect()->back()->with('success', 'Information updated successfully');
    }

    function status($id, Request $request, UserRepository $userRepository)
    {
        $inf = Influencer::find($id);

        if ($inf->user->status === 'active')
            $status = 'inactive';
        else
            $status = 'active';

        $userRepository->find($inf->user_id)->update(['status' => $status]);

    }

    public function editPass($id)
    {
        $inf = Influencer::find($id);
        return view('admin.modules.influencer.editpass', compact('inf'));
    }

    function updatePass($id, Request $request, UserRepository $userRepository)
    {
        $inf = Influencer::find($id);
        $this->validate($request, [
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required|string|min:6',
        ]);
        $userRepository->find($inf->user_id)->update(['password'=>bcrypt($request->password)]);
        return redirect()->back()->with('success', 'Password updated successfully');
    }

}
