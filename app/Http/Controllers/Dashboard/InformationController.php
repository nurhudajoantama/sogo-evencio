<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $informations = Information::with(['user'])->where('title', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(5)
            // ->withQueryString();
            ->appends($request->query());
        return view('dashboard.information.index', compact('informations'));
    }

    public function active($id) {
        try {
            Information::where('id',$id)->update([
                'is_status' => true
            ]);

            \Session::flash('sukses','Article has been Activated');
        } catch (\exception $e) {
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect()->back();
    }
    public function nonactive($id) {
        try {
            Information::where('id',$id)->update([
                'is_status' => false
            ]);

            \Session::flash('sukses','Article has been Nonactivated');
        } catch (\exception $e) {
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|min:3',
            'body' => 'required|min:3',
            'video' => 'string',
            'image' => 'image',
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('information-images');
        }
        // $merchant = Merchant::where('user_id',auth()->id())->first();

        // $merchant_id = $merchant->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 30);
        // $validatedData['merchant_id'] = $merchant->id;
        $validatedData['user_id'] = auth()->id();

        $information = Information::create($validatedData);
        return redirect()->route('dashboard.information.index')->with('success', 'Article created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Information $information)
    {
        return view('information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information)
    {
        return view('dashboard.information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Information $information)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|min:3|unique:information,slug,'. $information->id,
            'body' => 'required|min:3',
            'video' => 'string',
            'image' => 'image',
        ]);
        if ($request->file('image')) {
            if ($information->image) {
                Storage::delete($information->image);
            }
            $validatedData['image'] = $request->file('image')->store('information-images');
        }
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 30);
        $information->update($validatedData);
        return redirect()->route('dashboard.information.index')->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        if ($information->image) {
            Storage::delete($information->image);
        }
        $information->delete();
        return redirect()->route('dashboard.information.index')->with('success', 'Article deleted successfully');
    }
}
