<?php

namespace Mariojgt\Firetakeaway\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Mariojgt\Firetakeaway\Resource\ProductResources;

class OrdersResources extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $products = [];
        foreach ($this->lines as $key => $orderLine) {
            $products[] = New ProductResources($orderLine->product);
        }

        // Description create
        return [
            'id'         => $this->id,
            'user'       => $this->user,
            'status'     => $this->status,
            'total'      => $this->total,
            'items'      => $products,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at,
        ];
    }
}
