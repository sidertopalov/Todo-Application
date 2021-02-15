<?php

namespace App\Http\Resources;

use App\Http\Resources\ResponseTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralSingleResourceResponse extends JsonResource
{
    use ResponseTrait;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
