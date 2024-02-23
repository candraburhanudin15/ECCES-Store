<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request() ->ajax()){
            $query = Transaction::with(['user']);
            return DataTables ::of($query)
                ->addColumn('action',function($item){
                    return '
                        <div class="dropdown">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Aksi
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="'.route('transaction.edit',$item->id). '">Sunting</a></li>
                            <li> <form action="'.route('transaction.destroy',$item->id).'" method="POST">
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
        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $item = Transaction::findOrFail($id);
    
        return view('pages.admin.transaction.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $item = Transaction::findOrFail($id);
        $item -> update($data);
        
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();
        return redirect()->route('transaction.index');
    }
}
