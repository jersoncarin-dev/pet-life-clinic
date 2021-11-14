<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('clients.dashboard',[
            'title' => 'DASHBOARD',
            'products_count' => Product::count(),
            'appointments_count' => Appointment::where('user_id',Auth::id())->count(),
            'reminders_count' => Reminder::where('user_id',Auth::id())->count(),
            'pets_count' => Pet::where('user_id',Auth::id())->count()
        ]);
    }

    public function products(Request $request)
    {
        return view('clients.products',[
            'title' => 'PRODUCTS',
            'products' => Product::search($request->q)
                ->latest()
                ->paginate()
        ]);
    }

    public function appointments(Request $request)
    {
        if($request->has('action') && $request->action == 'cancel') {
            if($appointment = Appointment::find($request->id)) {
                $appointment->delete();

                return redirect()->route('client.appointments');
            }
        }

        return view('clients.appointments',[
            'title' => 'APPOINTMENTS',
            'appointments' => Appointment::withTrashed()
                ->search($request->q)
                ->where('user_id',Auth::id())
                ->latest()
                ->paginate()
        ]);
    }

    public function addAppointment(Request $request)
    {
        Appointment::create([
            'user_id' => Auth::id(),
            'purpose' => $request->purpose,
            'date' => $request->date
        ]);

        return back();
    }

    public function pets(Request $request)
    {
        if($request->has('action') && $request->action == 'delete') {
            if($pet = Pet::find($request->id)) {
                $pet->delete();

                return redirect()->route('client.pets');
            }
        }

        return view('clients.pets',[
            'title' => 'MY PETS',
            'pets' => Pet::search($request->q)
                ->where('user_id',Auth::id())
                ->latest()
                ->paginate()
        ]);
    }

    public function addPet(Request $request)
    {
        Pet::create([
            'user_id' => Auth::id(),
            'name' => $request->pet_name,
            'category' => $request->pet_category
        ]);

        return back();
    }

    public function reminders(Request $request)
    {
        return view('clients.reminders',[
            'title' => 'REMINDERS',
            'reminders' => Reminder::search($request->q)
                ->where('user_id',Auth::id())
                ->latest()
                ->paginate()
        ]);
    }

}
