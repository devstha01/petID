<?php

namespace App\Http\Controllers\Admin;

use App\Model\Influencer;
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

    function update($id, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:influencers,email,'.$id ,
        ]);
        $inf = Influencer::find($id);
        $input = $request->except('_token');
        $inf->update($input);
        return redirect()->back()->with('success', 'Influencer updated successfully');
    }
}
