<?php

if (!function_exists('get_columns_in_lowercase')) {
    function get_columns_in_lowercase($tableColumns)
    {
        return array_map('strtolower', $tableColumns);
    }
}

// if (!function_exists('is_search_present')) {
//     function is_search_present($array)
//     {
//         return (bool)(
//             array_key_exists('searchQuery', $array) &&
//             !empty($array['searchQuery']) &&
//             strlen($array['searchQuery']) >= config('constants.smart_data_listing_min_valid_search_symbols')
//         );
//     }
// }

// if (!function_exists('are_filters_present')) {
//     function are_filters_present($array)
//     {
//         if(!array_key_exists('filters', $array)) {
//             return false;
//         }

//         $filters = json_decode($array['filters']);
//         return (bool)(
//             is_object($filters) &&
//             !empty((array) $filters)
//         );
//     }
// }

if (!function_exists('enable_query_log')) {
    /**
     * Enable Query Log - after this every query persist will be logged
     */
    function enable_query_log()
    {
        if(!(bool)getenv('APP_DEBUG', false)) {
            return;
        }

        \DB::enableQueryLog();
    }
}

if (!function_exists('get_query_log_executed')) {
    /**
     * Get executed queries with binded values
     * Calling this method will disable query log
     *
     * @NOTE Make sure you have called enableQueryLog()
     *
     * @param array $queries optional
     * @param string $needle optional
     * @return array $resultSet
     */
    function get_query_log_executed(array $queries = [], string $needle = '?')
    {
        $resultSet = [];
        if(!(bool)getenv('APP_DEBUG', false)) {
            return $resultSet;
        }

        if(count($queries) == 0) {
            $queries = \DB::getQueryLog();
        }

        foreach ($queries as $value) {
            if(!isset($value['query'], $value['bindings'])) {
                continue;
            }
            $sql = $value['query'];
            $bindings = $value['bindings'];
            if(!empty($bindings)) {
                foreach ($bindings as $param) {
                    $pos = strpos($sql, $needle);
                    if($pos !== false) {
                        if(gettype($param) === "string") {
                            $param  = ' "' . addslashes($param) . '" ';
                        }
                        $sql = substr_replace($sql, $param, $pos, strlen($needle));
                    }
                }
            }
            $resultSet[] = $sql;
        }
        \DB::disableQueryLog();
        return $resultSet;
    }
}

if (!function_exists('get_query_log_executed_dd')) {
    /**
     * Dump and die executed queries with binded values
     *
     * @NOTE Calling this method will disable query log
     * @NOTE Make sure you have called enableQueryLog()
     *
     * @param array $queries optional
     * @param string $needle optional
     * @param mixed $dumpData optional - in case you want to dump more data
     * @return void
     */
    function get_query_log_executed_dd(array $queries = [], string $needle = '?', ...$dumpData)
    {
        dd([
            'query_log' => get_query_log_executed($queries, $needle),
            'data' => $dumpData
        ]);
    }
}

if (!function_exists('starts_with')) {
    function starts_with(string $string, string $target, int $position = 0)
    {
        return (substr(trim($string), $position, strlen($target)) === $target);
    }
}
