<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=> $this->expense,
            'amount'=> $this->amount,
            'status'=> $this->status,
            'category'=> $this->category->name,
            'category_id'=> $this->category_id,
            'expense_date'=> $this->expense_date,
        ];
    }
}
