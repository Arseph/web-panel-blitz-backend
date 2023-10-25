<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResourceCheck\AccessCheck;
use App\Models\WebsitePageSection;
use App\Models\WebsitePage;
use App\Models\SectionOption;
use App\Models\SectionCarousel;
use App\Models\SectionCarouselSlide;
use App\Http\Controllers\Media\MediaHelper;

class CarouselController extends Controller
{
    use AccessCheck;

    public function store(Request $request, $pageId)
    {
        $user = $request->user();
        $page = WebsitePage::find($pageId);

        if($this->checkAccess($user, $page)) {
            $carousel = $request->input('carousel');
            
            $newCarousel = SectionCarousel::create([
                'website_page_id' => $page->id,
                'component_id' => $carousel['componentID'],
            ]);

            $newWebsitePageSection = WebsitePageSection::create([
                'website_page_id' => $page->id,
                'order' => $carousel['order'],
                'section_id' => $newCarousel->id,
                'section_type' => 'carousel',
                'component_type' => $carousel['componentID'],
            ]);

            foreach($carousel['slides'] as $slide){
                $newSlide = [
                    'text' => $slide['text'],
                    'backgroundColor' => $slide['backgroundColor'],
                ];
                
                if($slide['media']['src']) {
                    $media = MediaHelper::save($slide['media']);
                    $newSlide['media_id'] = $media->id;
                }

                $newCarousel->slides()->create($newSlide);
            }

            foreach($carousel['options'] as $parameter => $value){
                SectionOption::create([
                    'website_page_section_id' => $newWebsitePageSection->id,
                    'parameter' => $parameter,
                    'value' => $value,
                    'datatype' => strtoupper(gettype($value)),
                ]);
            }

            return response($newCarousel, 201);
        }else{
            abort(403, 'User does not have access to the page');
        }
    }

    public function update(Request $request, $pageId, $carouselId)
    {
        $user = $request->user();
        $page = WebsitePage::find($pageId);

        if($this->checkAccess($user, $page)){
            $carousel = $page->sectionPivot->find($carouselId)->section;
            if($carousel){
                $newCarousel = $request->input('carousel');
                $carousel->update([
                    'component_id' => $newCarousel['componentID'],
                ]);
                $carousel->slides()->delete();

                foreach($newCarousel['slides'] as $slide){
                    $newSlide = [
                        'text' => $slide['text'],
                        'backgroundColor' => $slide['backgroundColor'],
                    ];
                    
                    if($slide['media'] && $slide['media']['src']){
                        $media = MediaHelper::save($slide['media']);
                        $newSlide['media_id'] = $media->id;
                    }

                    $carousel->slides()->create($newSlide);
                }

                $carousel->options()->delete();

                foreach($newCarousel['options'] as $parameter => $value){
                    SectionOption::create([
                        'website_page_section_id' => $carousel->section->id,
                        'parameter' => $parameter,
                        'value' => $value,
                        'datatype' => strtoupper(gettype($value)),
                    ]);
                }

                return $carousel->section;
            }else{
                abort(404, 'Resource not found');
            }
        }else{
            abort(403, 'User does not have access to the page');
        }
    }
}
