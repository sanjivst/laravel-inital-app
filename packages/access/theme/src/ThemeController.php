<?php

namespace Access\Theme;
use Illuminate\Support\Facades\Paginator;

use Access\Post\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Access\Setting\Setup;

class ThemeController extends Controller
{
    public function activate($name)
    {
    	$theme = Theme::first();
    	$theme->name = $name;
    	$theme->save();
    	return response()->json($theme);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theme_dir = resource_path('views/themes/');
        $assets_dir = public_path('theme_assets/');
        $all_themes = array();
        if(is_dir($theme_dir) and is_dir($assets_dir))
        {
            $all = scandir($theme_dir);
            foreach ($all as $theme) {
                if ($theme!='.' and $theme !='..' and is_dir($theme_dir.'/'.$theme) and is_dir($assets_dir.'/'.$theme))
                {
                    $theme_thumbnail = file_exists($assets_dir.'/'.$theme.'/thumbnail.png');
                    if($theme_thumbnail)
                    {
                        array_push($all_themes,$theme);
                    }
                }
            }
        }
        $active_theme = Theme::first();
        return view('theme::theme_list')
            ->with('active_theme',$active_theme)
            ->with('themes',$all_themes)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Access\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Access\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Access\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Access\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        //
    }
}
