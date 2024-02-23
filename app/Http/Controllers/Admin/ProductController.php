<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\User;
use App\Models\Category;

use function Laravel\Prompts\password;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request() ->ajax()){
            $query = Product::with(['user','category']);
            return DataTables ::of($query)
                ->addColumn('action',function($item){
                    return '
                        <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                          Aksi
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="'.route('product.edit',$item->id). '">Sunting</a></li>
                          <li> <form action="'.route('product.destroy',$item->id).'" method="POST">
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
              
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.product.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.create',[
            'users'=>$users,
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug']= str::slug($request->name);
         
        
        Product::create($data);
        
        return redirect()->route('product.index');
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
        $item = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.edit',[
            'item' => $item,
            'users' => $users,
            'categories' => $categories
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);
        $data['slug']= str::slug($request->name);
      
        $item -> update($data);
        
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        return redirect()->route('product.index');
    }
}
