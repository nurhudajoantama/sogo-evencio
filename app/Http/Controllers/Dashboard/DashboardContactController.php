<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::where('name', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(5)
            ->appends($request->query());
        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contacts = Contact::find($id);
        $contacts->delete();
        return redirect()->route('dashboard.contacts.index')->with('success', 'Message deleted successfully.');
    }
}
