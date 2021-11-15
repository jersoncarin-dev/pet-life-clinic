<?php

namespace App\Http\Controllers;

use App\Action\Notification;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManagementController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard',[
            'title' => 'DASHBOARD',
            'products_count' => Product::count(),
            'appointments_count' => Appointment::count(),
            'notifications_count' => Reminder::selectRaw('count(body) as c')->groupBy('created_at')->get()->count(),
            'pets_count' => Pet::count()
        ]);
    }

    public function products(Request $request)
    {
        if($request->has('action') && $request->action == 'delete') {
            if($product = Product::find($request->id)) {
                Notification::send([
                    'title' => 'Product has been deleted',
                    'body' => "$product->name has been deleted.",
                    'link' => route('client.reminders'),
                    'is_read' => false,
                    'notif_bound_time' => now()->diffForHumans()
                ],User::all('id')->map(fn($user) => $user->id)->toArray());

                $product->delete();
                return back();
            }
        }

        return view('staff.products',[
            'title' => 'PRODUCTS',
            'products' => Product::search($request->q)
                ->latest()
                ->paginate()
        ]);
    }

    public function notification(Request $request)
    {
        return view('staff.notification',[
            'title' => 'Notification',
            'reminders' => Reminder::search($request->q)
                ->groupBy('created_at')
                ->latest()
                ->paginate()
        ]);
    }

    public function reminders(Request $request)
    {
        return view('staff.reminders',[
            'users' => User::search($request->q)
                ->where('role','CLIENT')
                ->paginate()
        ]);
    }

    public function sendReminder(Request $request)
    {
        Notification::send([
            'title' => 'New reminder message',
            'body' => $request->message,
            'link' => route('client.reminders'),
            'is_read' => false,
            'notif_bound_time' => now()->diffForHumans()
        ],[$request->id]);

        return back();
    }

    public function pets(Request $request)
    {
        return view('staff.pets',[
            'title' => 'CLIENT PETS',
            'pets' => Pet::search($request->q)
                ->with('owner')
                ->latest()
                ->paginate()
        ]);
    }

    public function addProduct(Request $request)
    {
        $thumbnail = url('assets/media/photos/photo1.jpg');

        if($request->has('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = url('assets/media/photos/'.$file->getClientOriginalName());
            $file->move(public_path('assets/media/photos/'),$file->getClientOriginalName());
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->category,
            'price' => $request->price,
            'is_available' => $request->has('available'),
            'thumbnail' => $thumbnail
        ]);

        Notification::send([
            'title' => 'Product has been added',
            'body' => "$product->name has been added.",
            'link' => route('client.reminders'),
            'is_read' => false,
            'notif_bound_time' => now()->diffForHumans()
        ],User::all('id')->map(fn($user) => $user->id)->toArray());

        return back();
    }

    public function editProduct(Request $request)
    {
        if($request->has('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = url('assets/media/photos/'.$file->getClientOriginalName());
            $file->move(public_path('assets/media/photos/'),$file->getClientOriginalName());
        }

        if(!($product = Product::find($request->id))) {
            return abort(404);
        }

        $fields = [
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->category,
            'price' => $request->price,
            'is_available' => $request->has('available'),
        ];

        if(isset($thumbnail)) {
            $fields['thumbnail'] = $thumbnail;
        }

        Notification::send([
            'title' => 'Product has been updated',
            'body' => "$product->name has been updated.",
            'link' => route('client.reminders'),
            'is_read' => false,
            'notif_bound_time' => now()->diffForHumans()
        ],User::all('id')->map(fn($user) => $user->id)->toArray());

        $product->update($fields);

        return back();
    }

    public function editUser(Request $request)
    {
        if(!$user = User::find($request->id)) {
            return abort(404);
        }

        $validation = Validator::make($request->all(),[
            'email' => [Rule::unique('users')->ignore($request->id),'required']
        ],[
            'email.unique' => 'Email is already exists.',
            'email.required' => 'Email is required.',
        ]);

        if($validation->fails()) {
            return back()->withError($validation->errors()->first());
        }

        $fields = [
            'main' => [
                'name' => $request->name,
                'email' => $request->email,
            ],
            'detail' => [
                'contact_number' => $request->contact_number,
                'address' => $request->address
            ]
        ];

        if($request->has('password')) {
            $fields['main']['password'] = Hash::make($request->password);
        }

        if($request->has('avatar')) {
            $file = $request->file('avatar');
            $avatar = url('assets/media/avatars/'.$file->getClientOriginalName());
            $file->move(public_path('assets/media/avatars/'),$file->getClientOriginalName());

            $fields['detail']['avatar'] = $avatar;
        }

        $user->update($fields['main']);

        UserDetail::where('user_id',$request->id)
            ->update($fields['detail']);

        return back();
    }

    public function deleteUser(Request $request)
    {
        if($user = User::find($request->id)) {
            $user->delete();

            return back();
        }

        return abort(404);
    }

    public function addUser(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['unique:users','required'],
            'name' => 'required',
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'contact_number' => 'required',
            'password' => 'required',
            'address' => 'required'
        ],[
            'email.unique' => 'Email is already exists.',
            'email.required' => 'Email is required.',
            'name.required' => 'Name is required.',
            'avatar.required' => 'Avatar is required.',
            'contact_number.required' => 'Contact number is required.',
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

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $request->role
        ])
        ->detail()
        ->create([
            'address' => $validated['address'],
            'contact_number' => $validated['contact_number'],
            'avatar' => $validated['avatar'],
        ]);

        return back();
    }

    public function clients(Request $request)
    {
        return view('staff.clients',[
            'title' => 'CLIENTS',
            'type' => 'Client',
            'users' => User::with('detail')
                ->search($request->q)
                ->where('role','CLIENT')
                ->latest()
                ->paginate()
        ]);
    }

    public function admins(Request $request)
    {
        return view('staff.admin',[
            'title' => 'ADMINS',
            'type' => 'Admin',
            'users' => User::with('detail')
                ->search($request->q)
                ->where('role','ADMIN')
                ->latest()
                ->paginate()
        ]);
    }

    public function staffs(Request $request)
    {
        return view('staff.staff',[
            'title' => 'STAFFS',
            'type' => 'Staff',
            'users' => User::with('detail')
                ->search($request->q)
                ->where('role','STAFF')
                ->latest()
                ->paginate()
        ]);
    }

    public function appointments()
    {
        return view('staff.appointments',[
            'title' => 'APPOINTMENTS',
            'events' => Appointment::with('owner')
                ->latest('date')
                ->withTrashed()
                ->get()
                ->map(function($appointment) {
                    return [
                        'id' => $appointment->id,
                        'title' => '('.$appointment->owner->name.')'.$appointment->purpose,
                        'start' => $appointment->date,
                        'purpose' => $appointment->purpose,
                        'is_approved' => $appointment->is_approved,
                        'is_trashed' => $appointment->trashed(),
                        'owner' => $appointment->owner->name,
                        'className' => $appointment->is_approved ? ['bg-success','text-white'] : ($appointment->trashed() ? ['bg-danger','text-white'] : '')
                    ];
                })
                ->toArray()
        ]);
    }

    public function approveAppointments(Request $request)
    {
        if(!$appointment = Appointment::find($request->id)) {
            return abort(404);
        }

        $approve = $request->has('approve');

        $appointment->update([
            'is_approved' => $approve
        ]);

        if(!$approve) {
            $appointment->delete();
        }

        Notification::send([
            'title' => 'New appointment alert',
            'body' => "Appointment [{$appointment->date}] has been ".($approve ? 'Approved' : 'Rejected'),
            'link' => route('client.reminders'),
            'is_read' => false,
            'notif_bound_time' => now()->diffForHumans()
        ],[$appointment->user_id]);

        return back();
    }

    public function listAppointments(Request $request)
    {
        return view('staff.archive',[
            'title' => 'List Appointments',
            'appointments' => Appointment::withTrashed()
                ->with('owner')
                ->search($request->q)
                ->latest('date')
                ->paginate()
        ]);
    }

    public function addNoteAppointments(Request $request)
    {
        if(!$appointment = Appointment::find($request->id)) {
            return abort(404);
        }

        $appointment->update([
            'notes' => $request->note
        ]);

        Notification::send([
            'title' => 'Appointment has been noted',
            'body' => "You're appointment has been noted by the staff.",
            'link' => route('client.reminders'),
            'is_read' => false,
            'notif_bound_time' => now()->diffForHumans()
        ],[$appointment->user_id]);

        return back();
    }
}
