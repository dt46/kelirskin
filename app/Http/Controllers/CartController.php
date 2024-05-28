<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\UpdateJumlahCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Reseller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_reseller = auth()->user()->reseller->id;

        $data = [
            'countCart' => Cart::where('id_reseller', $id_reseller)
                              ->whereNull('deleted_at')
                              ->count(),
            'totalHarga' => Cart::where('id_reseller', $id_reseller)
                              ->whereNull('deleted_at')
                              ->sum('total_harga'),
        ];        

        if ($request->ajax() || $request->wantsJson()) {

            $carts = Cart::join('products', 'carts.id_produk', 'products.id')
            ->select('carts.id','products.namaProduk', 'products.hargaProduk', 'products.fotoProduk', 'carts.total_harga', 'carts.jumlah_produk')
            ->where('id_reseller', $id_reseller)
            ->whereNull('deleted_at')
            ->get();

            return response()->json([
                'status' => true,
                'data' => $carts
            ], 200);
        }

        return view('keranjang.cart', $data);
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
    public function store(StoreCartRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validatedData = $request->validated();

            DB::beginTransaction();
            try {

                if (!auth()->user()->reseller) {
                    throw new Exception('Reseller relationship not found for the authenticated user.');
                }

                $cart = new Cart();
                $cart->id_reseller = auth()->user()->reseller->id;
                $cart->id_produk = $validatedData['id_produk']; 
                $cart->jumlah_produk = $validatedData['jumlah_produk']; 
                $cart->total_harga = $validatedData['total_harga'];
               
                $cart->save();

                DB::commit();
    
                return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang.']);
            } catch (Exception $e) {
                DB::rollBack();
    
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }
    }    
    
    public function updateQuantity(UpdateJumlahCartRequest $request, $id)
    {    
        if ($request->ajax() || $request->wantsJson()) {
            try {
                Log::info('Searching for cart item', ['id' => $id]);
                $cart = Cart::findOrFail($id);
    
                $validated = $request->validated();
    
                $cart->jumlah_produk = $validated['jumlah_produk'];
                $cart->total_harga = $validated['total_harga'];
                $cart->save();
    
                $totalHarga = Cart::whereNull('deleted_at')->sum('total_harga');
    
                return response()->json(['totalHarga' => $totalHarga], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    
    

    public function showPesanan(Request $request)
    {
        $id_reseller = auth()->user()->reseller->id;

        $data = [
            'countCart' => Cart::where('id_reseller', $id_reseller)
                        ->whereNull('deleted_at')
                        ->count(),
            'totalHarga' => Cart::where('id_reseller', $id_reseller)
                        ->whereNull('deleted_at')
                        ->sum('total_harga'),
            'alamat' => Reseller::where('id', $id_reseller)->value('alamat_detail'),
            'no_hp' => Reseller::where('id', $id_reseller)->value('no_hp'),
        ];        

        if ($request->ajax() || $request->wantsJson()) {

            $carts = Cart::join('products', 'carts.id_produk', 'products.id')
            ->select('products.id','products.namaProduk', 'products.hargaProduk', 'products.fotoProduk', 'carts.total_harga', 'carts.jumlah_produk')
            ->where('id_reseller', $id_reseller)
            ->whereNull('deleted_at')
            ->get();

            return response()->json([
                'status' => true,
                'data' => $carts
            ], 200);
        }

        return view('payment.payment', $data);
    }
    
    public function showPayment()
    {
        $id_reseller = auth()->user()->reseller->id;

        $data = [
            'totalHarga' => Cart::where('id_reseller', $id_reseller)->sum('total_harga'),
            'id_cart' => Cart::where('id_reseller', $id_reseller)->select('id')->get()
        ];        

        return view('payment.checkout', $data);
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $cart = Cart::find($id);
            $cart->delete();

            return response()->json([
                'status' => true,
            ], 201);
        }
        return abort(404);
    }
}
