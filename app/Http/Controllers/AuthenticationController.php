<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Reminder;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Pusher\PushNotifications\PushNotifications;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt($request->only(['email','password']),$request->has('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('auth');
        }

        return back()->withError('Invalid credentials provided.');
    }

    public function auth()
    {
        $role = Auth::user()->role;

        if($role == 'CLIENT') {
            return redirect()->route('client.dashboard');
        }

        if($role == 'ADMIN' || $role == 'STAFF') {
            return redirect()->route('staff.dashboard');
        }

        return abort(404);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['unique:users','required'],
            'name' => 'required',
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'contact_number' => 'required',
            'pet_name' => 'required',
            'pet_category' => 'required',
            'password' => 'required',
            'address' => 'required'
        ],[
            'email.unique' => 'Email is already exists.',
            'email.required' => 'Email is required.',
            'name.required' => 'Name is required.',
            'avatar.required' => 'Avatar is required.',
            'contact_number.required' => 'Contact number is required.',
            'pet_category.required' => 'Pet category is required.',
            'passwword.required' => 'Password is required.',
            'avatar.mimes' => 'Avatar accept image only.',
            'address.required' => 'Address is required.',
            'avatar.max' => 'Image filesize should 10mb below.'
        ]);

        if($validation->fails()) {
            return back()->withError($validation->errors()->first());
        }
        
        $file = $request->file('avatar');
        $avatar = url('assets/media/avatars/'.$file->getClientOriginalName());
        $file->move(public_path('assets/media/avatars/'),$file->getClientOriginalName());

        $validated = collect($validation->validated())
            ->merge(['avatar' => $avatar])
            ->toArray();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'CLIENT'
        ])
        ->detail()
        ->create([
            'address' => $validated['address'],
            'contact_number' => $validated['contact_number'],
            'avatar' => $validated['avatar'],
        ]);

        Pet::create([
            'user_id' => $user->id,
            'name' => $validated['pet_name'],
            'category' => $validated['pet_category']
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('client.dashboard');
    }

    public function profile()
    {
        return view('global.profile',[
            'title' => 'MY PROFILE'
        ]);
    }

    public function updateProfile(Request $request)
    {
        if($request->type === 'basic') {

            $validation = Validator::make($request->all(),[
                'email' => [Rule::unique('users')->ignore(Auth::id()),'required'],
                'name' => 'required',
                'contact_number' => 'required',
                'address' => 'required'
            ],[
                'email.unique' => 'Email is already exists.',
                'email.required' => 'Email is required.',
                'name.required' => 'Name is required.',
                'contact_number.required' => 'Contact number is required.',
                'address.required' => 'Address is required.',
            ]);

            if($validation->fails()) {
                return back()->withError($validation->errors()->first());
            }

            if($request->has('avatar')) {
                $file = $request->file('avatar');
                $avatar = url('assets/media/avatars/'.$file->getClientOriginalName());
                $file->move(public_path('assets/media/avatars/'),$file->getClientOriginalName());

                // Update first
                UserDetail::where('user_id',Auth::id())->update(['avatar' => $avatar]);
            }

            Auth::user()->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            UserDetail::where('user_id',Auth::id())->update([
                'contact_number' => $request->contact_number,
                'address' => $request->address
            ]);

            return back();
            
        } else {

            $hashPassword = Auth::user()->password;

            if(!Hash::check($request->current_password,$hashPassword)) {
                return back()->withError("Current password does not match the orignal password.");
            }

            Auth::user()->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back();
        }
    }

    public function token(Request $request, PushNotifications $beamsClient)
    {
        $userID = "user_id_".$request->user()->id;
        $userIDInQueryParam = $request->user_id;

        if ($userID != $userIDInQueryParam) {
            return response('Authentication request error', 401);
        } else {
            $beamsToken = $beamsClient->generateToken($userID);
            return response()->json($beamsToken);
        }
    }

    public function readNotif()
    {
        Reminder::query()->update([
            'is_read' => true
        ]);
    }
}
