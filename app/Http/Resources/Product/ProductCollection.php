<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends JsonResource {

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request) {
       //  return parent::toArray($request);

        return [
            'name'        => $this->name,
            'totalPrice'  => round( ( 1 - ($this->discount / 100) ) * $this->price ,2),
            'rating'      => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No Reviews Rating Yet',
            'discount'    => $this->discount,
            'href'        => [
                'reviews' => route('products.show',$this->id)
            ]
        ];

    }

}
