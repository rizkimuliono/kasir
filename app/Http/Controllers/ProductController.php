<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_nama' => 'required',
            'pro_deskripsi' => 'required',
            'pro_stok' => 'required|integer',
            'pro_harga_beli' => 'required|numeric',
            'pro_harga_jual' => 'required|numeric',
            'pro_categori_id' => 'required|exists:categories,id',
            'pro_gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('pro_gambar')) {
            $data['pro_gambar'] = $request->file('pro_gambar')->store('images', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'pro_nama' => 'required',
            'pro_deskripsi' => 'required',
            'pro_stok' => 'required|integer',
            'pro_harga_beli' => 'required|numeric',
            'pro_harga_jual' => 'required|numeric',
            'pro_categori_id' => 'required|exists:categories,id',
            'pro_gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('pro_gambar')) {
            if ($product->pro_gambar) {
                Storage::disk('public')->delete($product->pro_gambar);
            }
            $data['pro_gambar'] = $request->file('pro_gambar')->store('images', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->pro_gambar) {
            Storage::disk('public')->delete($product->pro_gambar);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function getProduct($id){
        $product = Product::with('category')->find($id);
        return response()->json($product);
    }

    public function update_stok(Request $request)
    {
        $request->validate([
            'stok_baru' => 'required|integer',
        ]);
        $id = $request->input('id');
        $product = Product::find($id);
        if ($product) {
            $product->pro_stok = $product->pro_stok + $request->input('stok_baru');
            $product->save();
            return redirect()->route('products.index')->with('success', 'Product Stok updated successfully.');
        } else {
            return redirect()->route('products.index')->with('error', 'Product Stok gagal Update.');
        }

    }
}

