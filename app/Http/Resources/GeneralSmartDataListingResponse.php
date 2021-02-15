<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralSmartDataListingResponse extends JsonResource
{
    use \App\Http\Resources\ResponseTrait;

    public function __construct($resource, $includes = [])
    {
        parent::__construct($resource);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return $this|array
     */
    public function toArray($request)
    {
        return [
            "result" => $this['result'],
            "meta"   => ["total" => $this['total']],
        ];
    }
}
