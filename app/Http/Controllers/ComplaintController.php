<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // hanya tampilan pengaduan milik user yang login

    public function index(){
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
        return view('complaints.index', compact('complaints'));
    }

    public function create (){
        return view('complaints.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title'=> 'required|string|max:225',
            'content'=> 'required|string',
            'image'=> 'nullable|image|mimes:jpeg, png, jpg|max:2048',
        ]);

         if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('complaints', 'public');
        }
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Menunggu';

        Complaint::create($validated);
        return redirect()->route('complaints.index')->with('success', 'Pengaduan terkirim!');
    }
}
