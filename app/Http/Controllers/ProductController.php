<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\FileUploadService;
use App\Traits\APIResponseTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use APIResponseTrait, SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10); // You can adjust the pagination as needed
        return $this->successResponse('List of products',
            ProductResource::collection($products)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, FileUploadService $fileUploadService)
    {

        $product = new Product();
        $product->user_id = Auth::id();

        // Assign values from the request to the product object
        $product->menu_id = $request->input('menuId');
        $product->title = $request->input('title');
        $product->slug = $request->input('slug');
        $product->short_description = $request->input('short_description');
        $product->stock = $request->input('stock');
        $product->brand = $request->input('brand');
        $product->sku = $request->input('sku');
        $product->regular_price = $request->input('regular_price');
        $product->sale_price = $request->input('sale_price');
        $product->color = $request->input('color');
        $product->material = $request->input('material');
        $product->long_description = $request->input('long_description');
        $product->status = $request->input('status');
        $product->amazon_link = $request->input('amazon_link');
        $product->insta_link = $request->input('insta_link');

        // Upload and assign cover images
        // Upload and assign cover images
        if ($request->hasFile('coverImages')) {
            $coverImagesPaths = [];
            foreach ($request->file('coverImages') as $coverImage) {
                $coverImagePath = $fileUploadService->upload(
                    $coverImage,
                    $coverImage->getClientOriginalName(), // Use the original file name for uniqueness
                    '/images/products/cover' // Upload path for cover images
                );
                $coverImagesPaths[] = $coverImagePath;
//                $image = new ProductImage(['path' => $coverImagePath]);
//                $product->images()->save($image); // Associate the image with the product
            }
            $product->pictures = json_encode($coverImagesPaths);
//            $product->pictures = array('url1', 'url2');
        }



        $product->tags = json_encode($request->input('tags'));

        // Assign specifications (assuming specifications are provided as an array of key-value pairs)
// Receive specifications from the request
        $specifications = $request->input('specification');

// Initialize an empty array to store specifications
        $parsedSpecifications = [];

// Iterate over the received parameters
        foreach ($specifications as $key => $value) {
            // Add each specification to the parsedSpecifications array
            $parsedSpecifications[$key] = $value;
        }

// Convert specifications to JSON format before storing
        $product->specification = json_encode($parsedSpecifications);


//        return $product;
        // Save the product
        $product->save();

//        return $product;

        // Return success response with the created product
        return $this->successResponse(
            'Product was created',
            new ProductResource($product)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->successResponse('Product details',
            new ProductResource($product)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $this->successResponse('Product was updated',
            new ProductResource($product)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successResponse('Product was deleted');
    }
}
