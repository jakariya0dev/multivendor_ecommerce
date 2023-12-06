<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.page_slider_all', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.page_slider_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('slider_image');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/sliders/'.$image_name);

        Slider::insert([
            'slider_title' => $request->input('slider_title'),
            'slider_subtitle' => $request->input('slider_subtitle'),
            'slider_image' => 'upload/sliders/'.$image_name,
        ]);

        return redirect()->route('slider.index')->with([
            'message' => 'Slider Added Successfully',
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
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.page_slider_edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('slider_image')){

            $image = $request->file('slider_image');
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/sliders/'.$image_name);

            if (file_exists($request->input('old_pic'))){
                unlink($request->input('old_pic'));
            }

            Slider::findOrfail($id)->update([
                'slider_title' => $request->input('slider_title'),
                'slider_subtitle' => $request->input('slider_subtitle'),
                'slider_image' => 'upload/sliders/'.$image_name,
            ]);

            return redirect()->route('slider.index')->with([
                'message' => 'Slider updated successfully with image',
                'alert-type' => 'success'
            ]);
        }
        else{
            Slider::findOrfail($id)->update([
                'slider_title' => $request->input('slider_title'),
                'slider_subtitle' => $request->input('slider_subtitle'),
            ]);

            return redirect()->route('slider.index')->with([
                'message' => 'Slider updated Successfully',
                'alert-type' => 'success'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        if (file_exists($slider->slider_image)){
            unlink($slider->slider_image);
        }
        return redirect()->back()->with([
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
