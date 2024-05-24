<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $products = Product::all();

            return response()->json([
                'status' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        }
        return view('manajemen-produk.data-produk');
    }

    public function show(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $products = Product::where('namaProduk', 'like', '%' . $searchTerm . '%')->get();
            } else {
                $products = Product::all();
            }

            return response()->json([
                'status' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        }

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $products = Product::where('namaProduk', 'like', '%' . $searchTerm . '%')->get();
        } else {
            $products = Product::all();
        }

        return view('produk.product')->with(compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function showProdukId(Product $product, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'true',
                'data' => new ProductResource($product)
            ], 201);
        }

        return response()->json(['status' => false,], 401);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $req = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('fotoProduk')) {
                $file = $request->file('fotoProduk');
                $originalName = $file->getClientOriginalName();
                $path = $file->store('public/fotoProduk');
                $fotoProdukPath = str_replace('public', 'storage', $path);
            } else {
                throw new Exception('Foto produk tidak ditemukan.');
            }

            $product = new Product();
            $product->id_admin = auth()->user()->id;
            $product->fotoProduk = $fotoProdukPath;
            $product->nama_foto_original = $originalName;
            $product->namaProduk = $req['namaProduk'];
            $product->hargaProduk = $req['hargaProduk'];
            $product->stokProduk = $req['stokProduk'];
            $product->beratProduk = $req['beratProduk'];
            $product->deskripsiProduk = $req['deskripsiProduk'];
            $product->kategoriProduk = $req['kategoriProduk'];
            $product->save();

            DB::commit();

            return redirect()->route('daftar-produk')->with("res-status", [
                'msg' => "Produk berhasil ditambahkan.",
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('tambah-produk')
                ->with("res-status", [
                    'msg' => "Terjadi kesalahan: " . $e->getMessage(),
                    'status' => 'danger'
                ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function showTambahProduk()
    {
        return view('manajemen-produk.tambah-produk');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $request->validated();

                $fotoProdukPath = $product->fotoProduk;
                $originalName = $product->nama_foto_original;

                if ($request->hasFile('fotoProduk')) {
                    $file = $request->file('fotoProduk');
                    $originalName = $file->getClientOriginalName();

                    if ($product->fotoProduk) {
                        $oldFilePath = str_replace('storage', 'public', $product->fotoProduk);
                        if (Storage::exists($oldFilePath)) {
                            Storage::delete($oldFilePath);
                        }
                    }
                    $path = $file->store('public/fotoProduk');
                    $fotoProdukPath = str_replace('public', 'storage', $path);
                }

                $product->namaProduk = $request->namaProduk;
                $product->hargaProduk = $request->hargaProduk;
                $product->stokProduk = $request->stokProduk;
                $product->beratProduk = $request->beratProduk;
                $product->kategoriProduk = $request->kategoriProduk;
                $product->deskripsiProduk = $request->deskripsiProduk;

                if ($request->hasFile('fotoProduk')) {
                    $product->fotoProduk = $fotoProdukPath;
                    $product->nama_foto_original = $originalName;
                }

                $product->save();

                return response()->json([
                    'status' => true,
                    'data' => new ProductResource($product)
                ], 201);
            } catch (ValidationException $e) {
                return response()->json([
                    'status' => false,
                    'errors' => $e->errors(),
                ], 422);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['status' => false], 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                'status' => true,
            ], 201);
        }
        return abort(404);
    }
}
