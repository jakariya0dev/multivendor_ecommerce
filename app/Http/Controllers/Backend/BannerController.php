<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.page_banner_all', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.page_banner_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('banner_image');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banners/'.$image_name);

        Banner::insert([
            'banner_title' => $request->input('banner_title'),
            'banner_url' => $request->input('banner_url'),
            'banner_image' => 'upload/banners/'.$image_name,
        ]);

        return redirect()->route('banner.index')->with([
            'message' => 'Banner Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.page_banner_edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('banner_image')){

            $image = $request->file('banner_image');
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banners/'.$image_name);

            if (file_exists($request->input('old_pic'))){
                unlink($request->input('old_pic'));
            }

            Banner::findOrfail($id)->update([
                'banner_title' => $request->input('banner_title'),
                'banner_url' => $request->input('banner_url'),
                'banner_image' => 'upload/banners/'.$image_name,
            ]);

            return redirect()->route('banner.index')->with([
                'message' => 'Banner updated successfully with image',
                'alert-type' => 'success'
            ]);
        }
        else{
            Banner::findOrfail($id)->update([
                'banner_title' => $request->input('banner_title'),
                'banner_url' => $request->input('banner_url'),
            ]);

            return redirect()->route('banner.index')->with([
                'message' => 'Banner updated Successfully',
                'alert-type' => 'success'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        if (file_exists($banner->banner_image)){
            unlink($banner->banner_image);
        }
        return redirect()->back()->with([
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
