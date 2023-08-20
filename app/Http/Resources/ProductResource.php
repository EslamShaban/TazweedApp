<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::find($this->id);
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'image'   => $this->image_path,
            'price'   => $this->price,
            'discount_price'  => $this->discount_price,
            'desc'  => $this->desc,
            'variants'  => $this->productVariants($product),
        ];
    }

    public function productVariants(Product $product){
        $variants = ProductVariant::where('product_id',$product->id)->get();
        return $variants;
    }
}
