<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboards.admin.index');
    }

    public function profile()
    {
        return view('dashboards.admin.profile');
    }

    public function settings()
    {
        return view('dashboards.admin.settings');
    }



    public function updateInfo(Request $request)
    {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'favoritecolor' => 'required'
            ]);

            
            if (!$validator->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()->toArray(),
                ]); 
                /**
                 *   if ($validator->fails()) {
                * return response()->json($validator->errors()->toJson(), 400);
                *}
                 */
                // ako stavam ,500 ke vrati vo network vo preview nema na dispaly 
            } else {

                $query = User::find(Auth::user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'favoritecolor' => $request->favoritecolor,
                ]);


            
                if (!$query) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Something went wrong',
                    ]);
                } else {
                   // session()->flash('message', 'Your profile info has been updated successfully.');
                   // session()->flash('alert-class', 'alert-success');

                    return response()->json([                    
                        'status' => 1,
                        'message' => 'Your profile info has been updated successfully.',
                    ]);
                }            
            }        
        }

        public function updatePicture(Request $request)
        {
           
            $path = 'users/images/';
            $file = $request->file('admin_image');
            $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';


            // upload new image 
            $upload = $file->move(\public_path($path), $new_name);

            if(!$upload) {
                return response()->json([
                    'status' => 0 ,
                    'message' => 'Something went wrong, cannot upload the picture for admin user',
                ]);
            } else {

                // get old picture from picutre column in table users 
                $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];


                // ako nema slika userot, no kaj mene momentalno oti sum admin i go kreirav po default da nema slika nema da vleze ovde
                    // delete old user images in images directory in public folder 
                if($oldPicture != '') {
                    if(File::exists(\public_path($path.$oldPicture))) {
                        File::delete(\public_path($path.$oldPicture));
                    }
                }


                // update new picture to DB 
                $update = User::find(Auth::user()->id)->update([
                    'picture' => $new_name,
                ]);

                if(!$upload) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Something went wrong, updating picture in db failed.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 1,
                        'message' => 'Your profile Picture has been updated sucessfully',
                    ]);
                }
            }
        }


        public function changePassword(Request $request)
        {

            $validator = Validator::make($request->all(), [
                               // closure function in laravel   
                'oldpassword' => ['required', 'min:8', 'max:30',  function($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                        return $fail(__('The current password is incorrect'));
                    }
                }],
                'newpassword' => ['required', 'min:8', 'max:30'],
                'cnewpassword' => ['required', 'same:newpassword'],
            ],
            
            [
                // change the error message on the inputs 
                'oldpassword.required' => 'Please, enter your current password',
                'newpassword.required' => 'Please, enter your new password',
                'cnewpassword.required' => 'Please, re-enter your new password',

                'oldpassword.min' => 'Old password must have at least 8 characters',
                'oldpassword.max' => 'Old password must not be greater than 30 characters',
                'newpassword.min' => 'New password must have at least 8 characters',
                'newpassword.max' => 'New password must not be greater than 30 characters',

                'cnewpassword.same' => 'New password and Confirm new password must match'

            ]);

          
            if (!$validator->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()->toArray(),
                ]); 
               
            }  else {
                $update = User::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->newpassword),
                ]);

                        if(!$update) {
                            return response()->json([
                                'status' => 0,
                                'message' => "Something went wrong, the password cannot update",
                            ]); 
                        } else {
                            return response()->json([
                                'status' => 1,
                                'message' => "New password has been updated succesfully",
                            ]); 
                        }
                }
        } 
}

