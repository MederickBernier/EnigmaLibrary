<?php

namespace EnigmaLibrary\Array;

class DefaultArrayUtils implements ArrayUtilsInterface{

    /**
     * {@inheritDoc}
     */
    public function flatten(array $array): array {
        $result = [];
        array_walk_recursive($array, function($a) use (&$result){
            $result[] = $a;
        });
        return $result;
     }

    /**
     * {@inheritDoc}
     */
    public function pluck(array $array, string $key): array {
        return array_map(function($v) use($key){
            return $v[$key] ?? null;
        },$array);
     }

    /**
     * {@inheritDoc}
     */
    public function mergeRecursiveDistinct(array $array1, array $array2): array {
        $merged = $array1;

        foreach($array2 as $key => $value){
            if(is_array($value) && isset($merged[$key]) && is_array($merged[$key])){
                $merged[$key] = $this->mergeRecursiveDistinct($merged[$key],$value);
            }else{
                $merged[$key] = $value;
            }
        }
        return $merged;
     }

}