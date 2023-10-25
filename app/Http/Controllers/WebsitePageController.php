<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResourceCheck\AccessCheck;
use App\Models\Website;
use App\Models\WebsitePage;
use App\Models\SectionBanner;
use App\Models\SectionCarousel;
use App\Models\WebsitePageSection;
use App\Models\SectionCart;
use App\Models\SectionClimber;
use App\Models\SectionHeading;
use App\Models\SectionImageText;
use App\Models\SectionLiveChat;
use App\Models\SectionTab;
use App\Models\SectionTile;

class WebsitePageController extends Controller
{
    use AccessCheck;

    public function show (Request $request)
    {
        $user = $request->user();
        $page_id = $request->input('pageID');

        $page = $user->websitePages->find($page_id);

        $pageObject = (object)[
            'id' => $page->id,
            'name' => $page->name,
            'sections' => $page->sections(),
        ];

        return json_encode($pageObject);
    }

    public function store (Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');
        $website_id = $request->input('websiteID');
        $website = Website::find($website_id);

        $newPage = $website->pages()->create([
            'name' => $name,
        ]);

        return json_encode($newPage->only(['id', 'name']));
    }

    public function update (Request $request, $id)
    {
        $user = $request->user();
        $page = $user->websitePages->find($id);
        $website = $page->website;

        if ($this->checkAccess($user, $website)) {
            $name = $request->input('name');
            $sections = $request->input('sections');
            $page->sectionPivot()->delete();
            
            foreach($sections as $section){
                $page->sectionPivot()->create([
                    'order' => $section['order'],
                    'section_id' => $section['id'],
                    'section_type' => $section['type'],
                    'component_type' => $section['componentID'],
                ]);
            }
        }

        return json_encode($sections);
    }
}
