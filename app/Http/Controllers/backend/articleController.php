<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlePostRequest;
use App\Models\article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ajax
        if (request()->ajax()) {
            return DataTables::of(article::with('category')->latest()->get())
                ->addIndexColumn()
                ->addColumn('category_id', function ($row) {
                    return $row->Category->name;
                })

                ->addColumn('user_id', function ($row) {
                    return $row->User->name;
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge text-bg-success">Published</span>';
                    } else {
                        return '<span class="badge text-bg-danger">Draft</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div>
                                <a href="'.route('article.show', $row->id).'" class="btn btn-info btn-sm">View</a>
                                <a href="'.route('article.edit', $row->id).'" class="btn btn-warning btn-sm">Edit</a>
                                <a href="'.route('article.destroy', $row->id).'" class="btn btn-danger btn-sm">Delete</a>
                            </div>';

                })

                ->rawColumns(['user_id', 'status', 'category_id', 'action'])

                ->make(true);
        }

        return view('backend.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();

        return view('backend.article.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticlePostRequest $request)
    {
        //
        $data = $request->validated();
        // $data['user_id'] = auth()->user()->id;
        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('images', $filename);
        $data['image'] = $filename;
        $data['slug'] = Str::slug($data['title']);

        $data['user_id'] = 1; //sementara belum ada auth

        article::create($data);

        return redirect()->route('article.index')->with('success', 'Article created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return 'OK';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}