<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function setMain(Image $image)
    {
        $image->update(['updated_at' => now()]);
        
        return redirect()->back()->with('success', __('Image updated successfully'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $imagePath = $image->path;
        unlink(storage_path('app/' . $imagePath));
        $image->delete();
        return redirect()->back()->with('success', __('Image deleted successfully'));
    }
}
