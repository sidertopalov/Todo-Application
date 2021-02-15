<?php

namespace App\Repositories;

trait Pager
{

    public function setPaging(&$query, $limit, $offset)
    {
        if($limit === '_all'){
            return;
        }
        if ($limit !== null) {
            $query->limit($limit);

            if ($offset !== null) {
                $query->offset($offset);
            }
        }
    }
}
