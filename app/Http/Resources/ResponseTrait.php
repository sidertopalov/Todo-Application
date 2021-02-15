<?php
namespace App\Http\Resources;

trait ResponseTrait {

    /**
     * Default return status "ok"
     *
     * @var string
     */
    public $status = "ok";

    /**
     * Default return status code 200
     *
     * @var int
     */
    public $code = 200;

    /**
     * Messages to return to client
     *
     * @var array
     */
    public $messages = [];

    /**
     * Data to return to client
     *
     * @var array
     */
    public $data = [];

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            "status"   => $this->status,
            "messages" => $this->messages,
            "code"     => $this->code,
        ];
    }

    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function withCode($code)
    {
        $this->code = $code;
        return $this;
    }
    public function withData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function withMessage($message)
    {
        $decodedJson = json_decode($message);
        if (json_last_error() === JSON_ERROR_NONE) { //if the json is valid , we decode it other way just take the text..
            $message = $decodedJson;
        }

        array_push($this->messages, $message);
        return $this;
    }

    protected function loadEntityRelations($model, array $data, $relations = [], $counts = []) : array
    {
        if(!empty($relations)){
            $loadedResourceWithSlaves = $model->load($relations);

            foreach($relations as $relation){
                $masterResourceName = explode('.',$relation)[0];
                $data[$masterResourceName] = $loadedResourceWithSlaves[$masterResourceName];
            }
        }
        if(!empty($counts)){
            foreach($counts as $count){
                $data[$count.'_count'] = $model->{$count.'_count'};
            }
        }
        return $data;
    }

}
