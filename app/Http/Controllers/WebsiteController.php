<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\WebsiteDetail;

class WebsiteController extends Controller
{
    public function list(Request $request)
    {
        $user = $request->user();
        return json_encode($user->websites);
    }

    public function show(Request $request)
    {
        $website_id = $request->input('websiteID');
        $website = Website::with(['pages'])->find($website_id);

        return $website;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');
        $link = $request->input('link');
        $image = $request->input('image');

        $newWebsite = Website::create([
            'user_id' => $user->id,
            'name' => $name,
            'link' => $link,
            'image' => $image,
        ]);

        $newWebsite->details()->save(
            new WebsiteDetail()
        );
        
        return json_encode($newWebsite->load('details'));
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $name = $request->input('name');
        $link = $request->input('link');
        $image = $request->input('image');

        $website = Website::findOrFail($id);
        $website->update([
            'name' => $name,
            'link' => $link,
            'image' => $image,
        ]);

        return json_encode($website);
    }

    public function destroy(Request $request, $id)
    {
        $website = Website::findOrFail($id);
        $website->pages()->delete();
        $website->delete();
    }
}
