<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Services\EmailsHandler;
use App\Http\Services\ResponseHandler;
use App\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use ResponseHandler, EmailsHandler;

    public function influencerProfile(Request $request){
        $categories = Category::all();
        $user = Auth::user();
        if(isset($request->id)){
            $id = decrypt($request->id);
            $user = User::find($id);
        }
        $subCategories = SubCategory::where('category_id', $user->category_id)->get();
       return view('pages.backend.influencer-profile', get_defined_vars());
    }

    public function adminProfile(){
        $user = Auth::user();
        return view('pages.backend.admin-profile', get_defined_vars());
    }

    public function updatePersonalInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
//            'address' => 'sometimes|string'
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = !empty($request->address)?$request->address:' ';
        $user->slug =  strtolower(preg_replace("/\s+/", "", $request->name));
        $user->update();
        return $this->successResponseHandler('Personal info updated successfully');
    }

    public function updateOccupationalInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'tags' => 'required|string',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        $user->category_id = $request->category_id;
        $user->sub_category_id = $request->sub_category_id;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->tags = $request->tags;
        $user->update();
        return $this->successResponseHandler('Occupation info updated successfully');
    }

    public function updateProfileMedia(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'profile_video' => 'sometimes|mimes:mp4,mkv,flv,wmv',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        if ($request->file('profile_image') ) {
            $file = $request->file('profile_image');
            $imageName = time().$file->getClientOriginalName();
            $imagePath = 'images/profile/' . $imageName;
            $file->move(public_path('images/profile'), $imageName);
            $user->profile_image_url = $imagePath;
        }
        if ($request->file('profile_video') ) {
            $file = $request->file('profile_video');
            $videoName = time().$file->getClientOriginalName();
            $videoPath = 'videos/profile/' . $videoName;
            $file->move(public_path('videos/profile'), $videoName);
            $user->profile_video_url = $videoPath;
        }
        $user->update();
        return $this->successResponseHandler('Profile media updated successfully');
    }

    public function updateSocialLinks(Request $request){
        $validator = Validator::make($request->all(), [
            'facebook_url' => 'sometimes|string',
            'instagram_url' => 'sometimes|string',
            'twitter_url' => 'sometimes|string',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        $user->facebook_url = $request->facebook_url;
        $user->instagram_url = $request->instagram_url;
        $user->twitter_url = $request->twitter_url;
        $user->update();
        return $this->successResponseHandler('Social links has been updated successfully');
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        if(!Hash::check($request->old_password, $user->password)) return $this->errorResponseHandler('The old password you entered is incorrect');
        $user->password = Hash::make($request->password);
        $user->update();
        $this->passwordChanged($user);
        return $this->successResponseHandler('Your password has been changed successfully');
    }
}
