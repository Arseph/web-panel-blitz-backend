<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function website ()
    {
        return $this->hasOne('App\Models\Website', 'id', 'website_id');
    }

    public function sections()
    {
        $pageSections = $this->hasMany(WebsitePageSection::class)->get();

        $sections = collect([]);

        foreach($pageSections as $pageSection){

            $sectionObject = (object)[
                'order' => $pageSection->order,
                'id' => $pageSection->section_id,
                'type' => $pageSection->section_type,
                'componentID' => $pageSection->component_type,
                'options' => $this->formatOption($pageSection->options),
            ];

            switch( $pageSection->section_type ) {
                case 'heading':
                    $sectionObject->title = $this->formatOption($pageSection->titles);
                    $sectionObject->subtitle = $this->formatOption($pageSection->subtitles);
                    $sectionObject->buttons = $this->formatOption($pageSection->buttons);
                    break;
                case 'carousel':
                    $sectionObject->slides = $pageSection->section->slides;
                    break;
            }
            
            $sections->push($sectionObject);
        }

        return $sections;
    }

    public function sectionPivot()
    {
        return $this->hasMany(WebsitePageSection::class);
    }

    private function formatOption($options)
    {
        $formattedOptions = [];
        foreach($options as $option){
            $formattedOptions[$option->parameter] = $this->parseOptionValue($option);
        }

        return $formattedOptions;
    }

    private function parseOptionValue($option)
    {
        switch ($option->datatype) {
            case 'INTEGER':
                return intval($option->value);

            case 'DOUBLE':
                return doubleval($option->value);

            case 'FLOAT':
                return floatval($option->value);

            case 'BOOLEAN':
                return $option->value ? true : false;

            case 'ARRAY':
                return json_decode($option->value);

            case 'NULL':
                return null;
            
            default:
                return $option->value;
        }
    }
}
