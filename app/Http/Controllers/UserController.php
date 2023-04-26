<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.users.index');
    }

    public function getProfile() {
        return view('pages.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        Validator::make($request->all(), [
            'name' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->all());

        if($request->hasFile('image')) {
            if($user->image != 'default.jpg'){
                // dd($user->image);
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $image_resized = Image::make($image)->resize(300, 300)->encode('png', 100);

            Storage::disk('public')->put('upload/' . $image->hashName(), $image_resized);

            $name = 'upload/' . $image->hashName();

            $user->image = $name;

            $user->save();
        }


        return redirect()->back()->with('success', __('Profile updated successfully'));
    }

    public function allChefs(){
        $chefs = User::role('chef')->get();
        return view('pages.chefs', ['chefs' => $chefs]);
    }

    public function showChef(User $user){
        $user = $user->load('recipes');
        return view('pages.chef', ['chef' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->back()->with('success', __('User deleted successfully'));
    }
}
