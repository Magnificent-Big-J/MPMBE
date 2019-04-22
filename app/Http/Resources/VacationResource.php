<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacationResource extends JsonResource
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
            'id'=> $this->id,
            'destination'=> $this->destination,
            'start'=>$this->start_date,
            'end'=>$this->end_date,
            'status'=>$this->status,
            'activities'=> unserialize($this->activities),
            'duration'=> \Carbon\Carbon::parse($this->start_date)->diffInDays($this->end_date)
        ];
    }
}
