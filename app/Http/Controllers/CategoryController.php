<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'title' => 'Kategori Berita'
        ];
        // $this->authorize('admin');
        return view('admin.category.index', $data);
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
        $rules = [
            'name' => 'required',
        ];
        $pesan = [
            'name.required' => 'Kategori tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_token']);
            $data['uuid'] = Str::orderedUuid();
            Category::create($data);
            return response()->json(['success' => 'Kategori Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required',
        ];
        $pesan = [
            'name.required' => 'Kategori tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_token']);
            unset($data['_method']);
            Category::where('uuid', $category->uuid)->update($data);
            return response()->json(['success' => 'Kategori Berhasil Ditambahkan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return response()->json(['success' => 'Kategori Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = Category::where('name', '!=', 'Zona Integrasi')->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            if (strtolower($row->name) == 'kegiatan') {
                $actionBtn = '-';
            } else {

                $actionBtn =
                    '
                    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            }
            return $actionBtn;
        })->make(true);
    }
}
