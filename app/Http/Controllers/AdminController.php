<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function dashboard(Request $request) {
        $query = Complaint::with('user');

        // Logika Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $complaints = $query->latest()->get();
        
        // Statistik untuk kartu dashboard
        $total = Complaint::count();
        $menunggu = Complaint::where('status', 'Menunggu')->count();
        $selesai = Complaint::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact('complaints', 'total', 'menunggu', 'selesai'));
    }

    public function update(Request $request, $id) {
        $request->validate(['status' => 'required|in:Menunggu,Diproses,Selesai', 'response' => 'nullable|string']);
        Complaint::findOrFail($id)->update($request->only(['status', 'response']));
        return back()->with('success', 'Status diupdate!');
    }
}