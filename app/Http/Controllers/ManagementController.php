<?php

namespace App\Http\Controllers;

use App\Action\Notification;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard',[
            'title' => 'DASHBOARD',
            'products_count' => Product::count(),
            'appointments_count' => Appointment::count(),
            'reminders_count' => Reminder::count(),
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

    
}
