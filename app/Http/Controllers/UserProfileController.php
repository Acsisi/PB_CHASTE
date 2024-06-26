<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required','max:255', 'min:2'],
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'about' => ['max:255']
        ]);

        auth()->user()->update([
            'username' => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email') ,
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'postal' => $request->get('postal'),
            'about' => $request->get('about')
        ]);
        return back()->with('succes', 'Profile succesfully updated');
    }

    public function deleteUser(Request $request){
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $user = User::where('user_id', $request->id)->first();
    
        if ($user) {
            $user->update(['status' => 0]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return redirect('/user-management');
    }

    public function updateUser(Request $request){
        // dd("hai");
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $user = User::where('user_id', $request->id)->first();
    
        if ($user) {
            $user->update(['status_galon' => 1]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return redirect('/user-management');
    }

    public function editRole(Request $request){
        return redirect('/editRole?user_id=' . ($request->id));
    }

    public function changeRole(Request $request){
        $request->validate(
            [
                "exampleRadio" => "required",
            ],
            [
                "required" => "Fill the blank",
            ]
        );
        $id = $request->id;
        if($request->exampleRadio == "2"){
            DB::table('user')->where('user_id', '=', $id)->update([
                'role' => 2,
            ]);
        }else{
            DB::table('user')->where('user_id', '=', $id)->update([
                'role' => 3,
            ]);
        }
        return redirect('/user-management');
    }
}
