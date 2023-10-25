<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResourceCheck\AccessCheck;
use App\Models\WebsitePageSection;
use App\Models\WebsitePage;
use App\Models\SectionOption;
use App\Models\SectionHeading;
use App\Models\SectionTitle;
use App\Models\SectionSubtitle;
use App\Models\SectionButtons;
use App\Http\Controllers\Media\MediaHelper;

class HeadingController extends Controller
{
    //
    use AccessCheck;

    public function store(Request $request, $pageId)
    {
        $user = $request->user();
        $page = WebsitePage::find($pageId);

        if($this->checkAccess($user, $page)) {
            $heading = $request->input('heading');
            
            $newHeading = SectionHeading::create([
                'website_page_id' => $page->id,
                'component_id' => $heading['componentID'],
            ]);

            $newWebsitePageSection = WebsitePageSection::create([
                'website_page_id' => $page->id,
                'order' => $heading['order'],
                'section_id' => $newHeading->id,
                'section_type' => 'heading',
                'component_type' => $heading['componentID'],
            ]);

            foreach($heading['title'] as $parameter => $value){
                SectionTitle::create([
                    'website_page_section_id' => $newWebsitePageSection->id,
                    'parameter' => $parameter,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'datatype' => strtoupper(gettype($value)),
                ]);
            }

            foreach($heading['subtitle'] as $parameter => $value){
                SectionSubtitle::create([
                    'website_page_section_id' => $newWebsitePageSection->id,
                    'parameter' => $parameter,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'datatype' => strtoupper(gettype($value)),
                ]);
            }

            foreach($heading['buttons'] as $parameter => $value){
                SectionButtons::create([
                    'website_page_section_id' => $newWebsitePageSection->id,
                    'parameter' => $parameter,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'datatype' => strtoupper(gettype($value)),
                ]);
            }

            foreach($heading['options'] as $parameter => $value){
                SectionOption::create([
                    'website_page_section_id' => $newWebsitePageSection->id,
                    'parameter' => $parameter,
                    'value' => $value,
                    'datatype' => strtoupper(gettype($value)),
                ]);
            }

            return response($newHeading, 201);
        }else{
            abort(403, 'User does not have access to the page');
        }
    }
}
