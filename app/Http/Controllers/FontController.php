<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Font;
use App\Models\UserFont;
use App\Http\Controllers\Media\Traits\FontHelper;

class FontController extends Controller
{
    use FontHelper;
    
    public function store(Request $request)
    {
        $fontDirectory = 'app/fonts/';

        $user = $request->user();
        $fontName = $request->input('fontName');
        $font = $request->file('newFont');
        
        $hash = hash_file('sha256', $request->file('newFont'));
        $fontPath = $fontDirectory . '/' . $hash;

        if(!file_exists(storage_path($fontPath))) {
            $store_font = $font->move(storage_path($fontDirectory), $hash);
            $newFont = Font::create([
                'url' => $fontPath,
                'hash' => $hash,
            ]);

            $userFont = UserFont::create([
                'user_id' => $user->id,
                'font_id' => $newFont->id,
                'name' => $fontName,
            ]);

            return $userFont;
        }
    }
}
