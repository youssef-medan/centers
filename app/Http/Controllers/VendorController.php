<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendors.index', ['vendors' => Vendor::latest()->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|max:2048'
        ], [
            'logo.image' => 'لازم تبعت صورة'
        ]);
        try {
            $vendor = new Vendor();
            $vendor->name = $request->name;
            $vendor->logo = $request->file('logo')->store('vendor_images');
            $vendor->save();
            return to_route('vendors.index')->with('status', 'New Vendor Added');
        } catch (Exception $e) {
            return to_route('vendors.index')->with('status', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|max:2048'
        ], [
            'logo.image' => 'لازم تبعت صورة'
        ]);
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->name =  $request->name;
            if ($vendor->logo && $request->file('logo')) {
                Storage::delete($vendor->logo);
                $vendor->logo = Storage::put('vendor_images', $request->file('logo'));
            } elseif ($request->file('logo')) {
                $vendor->logo = Storage::put('vendor_images', $request->file('logo'));
            }
            $vendor->save();
            return to_route('vendors.index')->with('status', 'vendor Updated');
        } catch (Exception $e) {
            return to_route('vendors.index')->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            if ($vendor->logo) Storage::delete($vendor->logo);
            $vendor->delete();
            return to_route('vendors.index')->with('status', 'vendor Deleted');
        } catch (Exception $e) {
            return to_route('vendors.index')->with('status', $e->getMessage());
        }
    }
}
