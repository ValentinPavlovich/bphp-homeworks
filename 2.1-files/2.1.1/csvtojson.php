<?php
    $handle = fopen('data.csv', 'r');
    $head = fgetcsv($handle, 100, ';');
    $name = $head[0];
    $art = $head[1];
    $price = $head[2];    
    $json = [];
    
    while ($data = fgetcsv($handle, 1000, ';')) {                      
        $list = [
            $name => $data[0],
            $art => $data[1],
            $price => $data[2],
        ];
        echo '<pre>';
        print_r($list);       
        array_push($json, $list);        
    }
    fclose($handle);

file_put_contents('data.json', json_encode($json, JSON_UNESCAPED_UNICODE));
echo 'Conversion complete.';
?>