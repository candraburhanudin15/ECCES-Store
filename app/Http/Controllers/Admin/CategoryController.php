<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request() ->ajax()){
            $query = Category::query();
            return DataTables ::of($query)
                ->addColumn('action',function($item){
                    return '
                        <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                          Aksi
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="'.route('category.edit',$item->id). '">Sunting</a></li>
                          <li> <form action="'.route('category.destroy',$item->id).'" method="POST">
                          ' . method_field('delete') . csrf_field() .'
                          <button type="submit" class="dropdown-item text-danger">
                              Hapus
                          </button>
                          </form>
                          </li>
                        </ul>
                    </div>
                    ';
                })
                ->editColumn('photo', function($item){
                    return $item->photo ? '<img src="'. Storage::url($item->photo). '" style="max-height: 48px;" />' : '';
                })
                ->rawColumns(['action','photo'])
                ->make();
        }
        return view('pages.admin.category.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo']= $request->file('photo')->store('assets/category','public');
        
        Category::create($data);
        
        return redirect()->route('category.index');
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
        $item = Category::findOrFail($id);
        return view('pages.admin.category.edit',[
            'item' => $item
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo']= $request->file('photo')->store('assets/category','public');
        
        $item = Category::findOrFail($id);
        $item -> update($data);
        
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        return redirect()->route('category.index');
    }
}
