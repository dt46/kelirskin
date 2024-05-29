<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Reseller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax() || $request->wantsJson()) {
                $resellerData = Order::join('resellers', 'orders.id_reseller', 'resellers.id')
                    ->select('resellers.nama', 'resellers.alamat_detail', 'orders.no_resi', 'orders.status', 'orders.total_harga', 'orders.id', 'orders.tanggal', 'orders.bukti_pembayaran', 'orders.nama_file_original')
                    ->get();
    
                return response()->json([
                    'status' => true,
                    'data' => $resellerData
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    
        return view('manajemen-produk.data-order');
    }
    public function indexReseller(Request $request)
    {
        try {
            if ($request->ajax() || $request->wantsJson()) {
                $user = auth()->user()->reseller->id;
                $resellerData = Order::join('resellers', 'orders.id_reseller', 'resellers.id')
                    ->select('resellers.nama', 'resellers.alamat_detail', 'orders.no_resi', 'orders.status', 'orders.total_harga', 'orders.id', 'orders.tanggal')
                    ->where('orders.id_reseller', $user)
                    ->get();
    
                return response()->json([
                    'status' => true,
                    'data' => $resellerData
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    
        return view('manajemen-produk.data-order-reseller');
    }

    public function showDetail(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $id_reseller = $order->id_reseller;
        $countCart = Cart::where('id_reseller', $id_reseller)
            ->count();
        
        $totalHarga = Cart::where('id_reseller', $id_reseller)
            ->sum('total_harga');
        
        $alamat = Reseller::where('id', $id_reseller)->value('alamat_detail');
        $no_hp = Reseller::where('id', $id_reseller)->value('no_hp');

        if ($request->ajax() || $request->wantsJson()) {
            $orderDetails = Order::join('resellers', 'orders.id_reseller', 'resellers.id')
                ->join('carts', 'resellers.id', 'carts.id_reseller')
                ->join('products', 'carts.id_produk', 'products.id')
                ->select('products.namaProduk', 'products.fotoProduk', 'carts.total_harga', 'carts.jumlah_produk')
                ->where('orders.id', $order->id)
                ->get();

            return response()->json([
                'status' => true,
                'data' => $orderDetails
            ], 200);
        }

        return view('manajemen-produk.detail-pesanan', compact('order', 'countCart', 'totalHarga', 'alamat', 'no_hp'));
    }
    public function showDetailReseller(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $id_reseller = $order->id_reseller;
        $user = auth()->user()->reseller->id;
        $countCart = Cart::where('id_reseller', $id_reseller)
            ->count();
        
        $totalHarga = Cart::where('id_reseller', $id_reseller)
            ->sum('total_harga');
        
        $alamat = Reseller::where('id', $id_reseller)->value('alamat_detail');
        $no_hp = Reseller::where('id', $id_reseller)->value('no_hp');

        if ($request->ajax() || $request->wantsJson()) {
            $orderDetails = Order::join('resellers', 'orders.id_reseller', 'resellers.id')
                ->join('carts', 'resellers.id', 'carts.id_reseller')
                ->join('products', 'carts.id_produk', 'products.id')
                ->select('products.namaProduk', 'products.fotoProduk', 'carts.total_harga', 'carts.jumlah_produk')
                ->where('orders.id', $order->id)
                ->where('orders.id_reseller', $user)
                ->get();

            return response()->json([
                'status' => true,
                'data' => $orderDetails
            ], 200);
        }

        return view('manajemen-produk.detail-pesanan-reseller', compact('order', 'countCart', 'totalHarga', 'alamat', 'no_hp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $request->validated();
    
            DB::beginTransaction();
            try {
                if ($request->hasFile('bukti_pembayaran')) {
                    $file = $request->file('bukti_pembayaran');
                    $originalName = $file->getClientOriginalName();
                    $path = $file->store('public/bukti_pembayaran');
                    $fotoProdukPath = str_replace('public', 'storage', $path);
                } else {
                    throw new HttpResponseException(response()->json(['message' => 'Bukti Pembayaran tidak ditemukan.'], 422));
                }
            
                $order = new Order;
                $order->id_reseller = auth()->user()->reseller->id;
                $order->ongkos_kirim = $request->ongkos_kirim;
                $order->biaya_layananAplikasi = $request->biaya_layananAplikasi;
                $order->metode_pembayaran = $request->metode_pembayaran;
                $order->total_harga = $request->total_harga;
                $order->bukti_pembayaran = $fotoProdukPath;
                $order->nama_file_original = $originalName;
                $order->tanggal = $request->tanggal;
                $order->save();
    
                $idReseller = auth()->user()->reseller->id;
                $idCarts = $request->input('id_cart');
                if ($idCarts) {
                    Cart::where('id_reseller', $idReseller)
                        ->whereIn('id', $idCarts)
                        ->update(['deleted_at' => now()]);
                }
    
                DB::commit();
            
                return response()->json([
                    'status' => true, 
                    'msg' => "Order placed successfully.",
                ], 201);
            } catch (ValidationException $e) {
                DB::rollBack();
            
                return response()->json([
                    'status' => false,
                    'errors' => $e->errors(),
                    'msg' => "Error: " . $e->getMessage(),
                ], 422);
            } catch (\Exception $e) {
                DB::rollBack();
            
                return response()->json([
                    'status' => false,
                    'msg' => "Error: " . $e->getMessage(),
                ], 500);
            }
        }
    }    

    public function showTabelReseller(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $request->user()->reseller->id;
            $order = Order::join('resellers', 'orders.id_reseller', 'resellers.id')
                ->join('carts', 'resellers.id', 'carts.id_reseller')
                ->join('products', 'carts.id_produk', 'products.id')
                ->select('products.id', 'products.namaProduk', 'products.hargaProduk', 'products.fotoProduk', 'carts.total_harga', 'carts.jumlah_produk')
                ->whereColumn('carts.id_reseller', 'orders.id_reseller')
                ->whereDate('carts.deleted_at', DB::raw('orders.tanggal::date'))
                ->where('orders.id_reseller', $user)
                ->get();
    
            return response()->json([
                'status' => true,
                'data' => $order
            ], 200);
        }

        return redirect()->route('detail-pesann');
    }


    /**
     * Display the specified resource.
     */

    public function showOrderId(Order $order, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'true',
                'data' => new OrderResource($order)
            ], 201);
        }

        return response()->json(['status' => false,], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validated = $request->validated();

            $order->no_resi = $validated['no_resi'];
            $order->status = $validated['status'];
            $order->save();
    
            return response()->json([
                'status' => true,
                'data' => new OrderResource($order)
            ], 201);
        }
    
        return response()->json(['status' => false], 401);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validated = $request->validated();

            $order->status = $validated['status'];
            $order->save();
    
            return response()->json([
                'status' => true,
                'data' => new OrderResource($order)
            ], 201);
        }
    
        return response()->json(['status' => false], 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $product = Order::find($id);
            $product->delete();

            return response()->json([
                'status' => true,
            ], 201);
        }
        return abort(404);
    }
}
