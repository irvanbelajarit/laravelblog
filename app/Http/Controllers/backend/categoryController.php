<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //order by id
        $category = category::orderBy('id', 'desc')->get();

        return view('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $data = $request->validate([
            'name' => 'required|min:3',
        ]);

        $data['slug'] = Str::slug($data['name']);

        category::create($data);

        return redirect()->back()->with('success', 'Category Created Successfully');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //validate
        $data = $request->validate([
            'name' => 'required|min:3',
        ]);

        $data['slug'] = Str::slug($data['name']);

        category::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Category Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        category::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
