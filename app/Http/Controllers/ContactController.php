<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Notifications\NewComplaint;

class ContactController extends Controller
{
    public function index()
    {
        return view('show.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $complaint = Complaint::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // إشعار الأدمن المسجل دخوله
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->notify(new NewComplaint($complaint));
        }

        return redirect()->route('contact.index')->with('success', '✅ تم إرسال رسالتك بنجاح!');
    }
}