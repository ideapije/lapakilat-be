<?php

namespace Lapakilat\ProductModule\Http\Controllers\API;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lapakilat\ProductModule\Http\Requests\ProductRequest;
use Lapakilat\ProductModule\Http\Resources\ProductCollection;
use Lapakilat\ProductModule\Http\Resources\ProductResource;
use Lapakilat\ProductModule\Models\Product;

class ProductApiController extends Controller
{
    // public function index(Request $request)
    // {
    //     return response()->json(['data' => 'example products API']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new ProductCollection(Product::where('status', 'publish')->paginate());

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $request['slug'] = Str::slug($request->name, '-');

            $product = Product::create($request->except('image', 'images'));

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Carbon::now()->timestamp . "." . $file->getClientOriginalExtension();
                Storage::disk('products')->putFile('', $file);
                $product->update([
                    'image' => $filename
                ]);
            }

            $images = [];
            $i = 1;

            foreach ($request->file('images') as $file) {
                $filename = Carbon::now()->timestamp . " - {$i}." . $file->getClientOriginalExtension();
                Storage::disk('products')->putFile('', $file);
                $images[]['image'] = $filename;
                $i++;
            }

            $product->imageProducts()->createMany($images);

            DB::commit();

            return response()->json(new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new ProductResource(Product::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($request->name != $product->name) {
                $request['slug'] = Str::slug($request->name, '-');
            }

            $product->update($request->except('image', 'images'));

            if ($request->hasFile('image')) {
                Storage::disk('products')->delete($product->image);

                $file = $request->file('image');
                $filename = Carbon::now()->timestamp . "." . $file->getClientOriginalExtension();
                Storage::disk('products')->putFile('', $file);
                $product->update([
                    'image' => $filename
                ]);
            }

            $images = [];
            $i = 1;

            foreach ($request->file('images') as $file) {
                $filename = Carbon::now()->timestamp . " - {$i}." . $file->getClientOriginalExtension();
                Storage::disk('products')->putFile('', $file);
                $images[]['image'] = $filename;
                $i++;
            }

            $product->imageProducts()->createMany($images);

            DB::commit();

            return response()->json(new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'product deleted']);
    }
}
