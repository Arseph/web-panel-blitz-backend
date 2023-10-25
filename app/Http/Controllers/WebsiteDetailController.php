<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\WebsiteDetail;
use App\Models\WebsiteDetailDomain;
use App\Traits\ResourceCheck\AccessCheck;

class WebsiteDetailController extends Controller
{
		use AccessCheck;

		public function store(Request $request, $websiteId)
		{
			$user = $request->user();
			$website = $user->websites->find($websiteId);

			if ($website) {
				dd($request->all());
			} else {
				abort(403);
			}
		}

    public function storeGeneral (Request $request)
    {
				$user = $request->user();
				$domain = $request->input('domain');
				$websiteID = $request->input('websiteID');
				$website = $user->websites->find($websiteID);
				
				if ($this->checkAccess($user, $website)) {
						if($website->details->domain){
								return $website->details->domain()->update($domain);
						}else{
								return $website->details->domain()->save(new WebsiteDetailDomain($domain));
						}
				}
    }

    public function storeMeta (Request $request)
    {
				$meta = $request->input('meta');
				$website_detail_id = $request->input('websiteDetailId');
				dd($website_detail_id);
    }
}
