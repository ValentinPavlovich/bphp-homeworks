<?php

    function generate($rows, $placesPerRow, $chairs){
        if ($rows * $placesPerRow > $chairs) {
            return false;
        }
        $arr = [];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $placesPerRow; $j++) {
                $arr[$i][$j] = false;
            }
        }
        return $arr;
    }    

    function reserve($map, $requiredPlaces) {

        for ($i=0; $i<count($map); $i++) {            
            $value = $requiredPlaces;

            for ($j=0; $j<count($map[$i]); $j++) {
                if (($j + $value) > (count($map[$i]))) {
                    return false;
                }
                if ($map[$i][$j] === false) {
                    $value--;
                    if ($value === 0) {
                        return 'Найдены лучшие места: c '.($j-$requiredPlaces + 2).' по '.($j + 1).' в ряду '.($i + 1);
                    }
                }
                elseif (map[$i][$j] === true && (($j + $value) > $requiredPlaces)) {
                    $value = $requiredPlaces;                    
                } else {
                    $j = count($map[$i]) - 1;
                }
            }
        }    
        return 'Подходящих мест не найдено';            
    }

    $chairs = 50;
    $map = generate(2, 7, $chairs);
    $map[1][6] = true;
    $map[2][3] = true;
    $requiredPlaces = 5;
    
    echo reserve($map, $requiredPlaces);

?>