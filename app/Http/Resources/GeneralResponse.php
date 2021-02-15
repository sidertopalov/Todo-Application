<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResponse extends JsonResource {
    use \App\Http\Resources\ResponseTrait;

    /**
     * GeneralResponse constructor.
     * Just to allow empty data
     * @param array $resource
     */
    public function __construct($resource = [])
    {
        parent::__construct($resource);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return $this|array
     */
    public function toArray($request)
    {
        return $this->data;
    }
}
