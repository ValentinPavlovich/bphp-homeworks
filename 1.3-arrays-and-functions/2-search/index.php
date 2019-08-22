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
            for ($j=0; $j<count($map[$i]); $j++) {
                if (($j + $requiredPlaces) > (count($map[$i]))) {
                    return false;
                }
                if ($map[$i][$j] === false) {                    
                    $requiredPlaces--;
                    if ($requiredPlaces === 0) {
                        return 'Найдены лучшие места: c '.($j-$requiredPlaces+2).' по '.($j+1).' в ряду '.($i+1);
                    }
                }
            }
        }    
        return 'Подходящих мест не найдено';            
    }

    $chairs = 50;
    $map = generate(5, 8, $chairs);
    $map[2][0] = true;
    $map[6][3] = true;
    $requiredPlaces = 6;
    
    echo reserve($map, $requiredPlaces);

?>