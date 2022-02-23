<?php
    echo "<pre>";
    $first_array = array('A','B');
    $second_array = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red", 
            "color4" => "Yellow",
            "color5" => "Orange");
    $third_array = array();

    $str = "Jayveer";


    echo "Print using varDump\n";
    var_dump($first_array);
    echo "<br>";
    echo "<br>";
    echo "Print using print_r\n";
    print_r($second_array);

    //array_push(): insert element at last
    echo "<br>";
    echo "<br>";
    echo "Push";
    array_push($first_array, 'C','D','E');
    echo "<br>";
    print_r($first_array);


    //array_pop(): remove last element
    echo "<br>";
    echo "<br>";
    echo "Pop";
    array_pop($first_array);
    echo "<br>";
    print_r($first_array);


    //array_search(): returns the first corresponding key if not found then return nothing
    echo "<br>";
    echo "<br>";
    echo "Search";
    echo "<br>";
    echo "index: ";
    echo(array_search('D',$first_array));


    //array_key_exists(): Checks if the given key or index exists - if exists then give 1 otherwise give nothing
    echo "<br>";
    echo "<br>";
    echo "Key exists";
    echo "<br>";
    echo(array_key_exists(2,$first_array));
    echo "<br>";
    echo(array_key_exists("color4",$second_array));
    


    //array_keys(): Return all the keys
    echo "<br>";
    echo "<br>";
    echo "Return Keys";
    echo "<br>";
    print_r(array_keys($first_array));
    echo "<br>";
    print_r(array_keys($second_array));
    echo "<br>";
    print_r(array_keys($third_array));


    //array_values(): Return all the values
    echo "<br>";
    echo "<br>";
    echo "Return value";
    echo "<br>";
    print_r(array_values($first_array));
    echo "<br>";
    print_r(array_values($second_array));
    echo "<br>";
    print_r(array_values($third_array));


    //array_merge(): Merge array-if there is any empty array then it will not merge that array-if key value match then it will append that value
    echo "<br>";
    echo "<br>";
    echo "Merge";
    echo "<br>";
    print_r(array_merge($first_array,$second_array,$third_array));
    echo "<br>";
    print_r(array_values($first_array));
    echo "<br>";
    print_r(array_values($second_array));
    echo "<br>";
    print_r(array_values($third_array));


    //array_change_key_case(): Changes the case of keys - by default lowercase
    echo "<br>";
    echo "<br>";
    echo "Change key case: ";
    echo "<br>";
    print_r(array_change_key_case($second_array,CASE_LOWER));
    echo "<br>";
    print_r(array_change_key_case($second_array,CASE_UPPER));


    //sizeof(): return array size
    echo "<br>";
    echo "<br>";
    echo "Sizeof: ";
    echo "<br>";
    echo(sizeof($first_array));
    echo "<br>";
    echo(sizeof($second_array));
    echo "<br>";
    echo(sizeof($third_array));


    //is_array(): Finds variable is an array or not - if array then return 1 or else return nothing
    echo "<br>";
    echo "<br>";
    echo "Is array: ";
    echo "<br>";
    echo(is_array($first_array));
    echo "<br>";
    echo(is_array($second_array));
    echo "<br>";
    echo(is_array($str));


    //empty(): check a array is empty - if empty then return 1 or else return nothing
    echo "<br>";
    echo "<br>";
    echo "Empty: ";
    echo "<br>";
    echo(empty($first_array));
    echo "<br>";
    echo(empty($second_array));
    echo "<br>";
    echo(empty($third_array));


    //array_rand(): Pick number of random keys out of an array - by deafult select only 1 element - If there is empty array then return error - if number is greater than array size than give error
    echo "<br>";
    echo "<br>";
    echo "Random: ";
    echo "<br>";
    print_r(array_rand($first_array));
    echo "<br>";
    print_r(array_rand($second_array,2));
    /* Give error
    echo "<br>";
    print_r(array_rand($first_array,8));*/
    /* Give error
    echo "<br>";
    print_r(array_rand($third_array,2));*/


    //array_combine(): Creates another array by using 1st array as a keys and 2nd array as a values - if key and value array array size is not matched then give error - If there is already key in array then overwrite key
    $arrKey = array('a1','a2','a3','a4','a5');
    $arrVal = array('A','B','C','D','E');
    echo "<br>";
    echo "<br>";
    echo "Combine: ";
    echo "<br>";
    print_r(array_combine($arrKey,$arrVal));
    echo "<br>";
    print_r(array_combine($arrKey,$second_array));


    //array_count_values(): Counts all the values of array
    $arrKey = array('a1','a2','a1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Count value: ";
    echo "<br>";
    print_r(array_count_values($arrKey));
    echo "<br>";
    print_r(array_count_values($tempArr2));
    echo "<br>";
    print_r(array_count_values($third_array));


    //array_unique(): Removes duplicate values from array - it is Case sensitive
    $arrKey = array('a1','a2','a1','A1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Unique value: ";
    echo "<br>";
    print_r(array_unique($arrKey));
    echo "<br>";
    print_r(array_unique($tempArr2));
    echo "<br>";
    print_r(array_unique($third_array));


    //array_reverse(): Return an array with elements in reverse order - If we add true parameter then it will show original array index
    $arrKey = array('a1','a2','a1','A1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Reverse Array: ";
    echo "<br>";
    print_r(array_reverse($arrKey,true));
    echo "<br>";
    print_r(array_reverse($tempArr2));
    echo "<br>";
    print_r(array_reverse($tempArr2,true));
    echo "<br>";
    print_r(array_reverse($third_array));


    //array_flip(): Interchange keys values of array - If value repeated than it will overwrite
    echo "<br>";
    echo "<br>";
    echo "Flip: ";
    echo "<br>";
    print_r(array_flip($first_array));
    echo "<br>";
    print_r(array_flip($second_array));
    echo "<br>";
    print_r(array_flip($tempArr2));

    //sort(): Sort array in ascending order - if array sort then give 1 or else empty - if array is multi dimensonal then it will sort in 1D array
    echo "<br>";
    echo "<br>";
    echo "Sort in ascending: ";
    echo "<br>";
    print_r(sort($first_array));
    echo "<br>";
    print_r($first_array);
    echo "<br>";
    print_r(sort($second_array));
    echo "<br>";
    print_r($second_array);
    echo "<br>";
    print_r(sort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(sort($third_array));
    echo "<br>";
    print_r($third_array);

    //rsort(): Sort array in descending order - if array sort then give 1 or else empty - if array is multi dimensonal then it will sort in 1D array
    echo "<br>";
    echo "<br>";
    echo "Sort in descending : ";
    echo "<br>";
    print_r(rsort($first_array));
    echo "<br>";
    print_r($first_array);
    echo "<br>";
    print_r(rsort($second_array));
    echo "<br>";
    print_r($second_array);
    echo "<br>";
    print_r(rsort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(rsort($third_array));
    echo "<br>";
    print_r($third_array);


    //asort(): Sort an array in ascending order and maintain original index
    $first_array = array('A','B');
    $second_array = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red", 
            "color4" => "Yellow",
            "color5" => "Orange");
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");

    echo "<br>";
    echo "<br>";
    echo "Sort in ascending: ";
    echo "<br>";
    print_r(asort($first_array));
    echo "<br>";
    print_r($first_array);
    echo "<br>";
    print_r(asort($second_array));
    echo "<br>";
    print_r($second_array);
    echo "<br>";
    print_r(asort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(asort($third_array));
    echo "<br>";
    print_r($third_array);

    //arsort(): Sort an array in descending order and maintain original index
    echo "<br>";
    echo "<br>";
    echo "Sort in descending: ";
    echo "<br>";
    print_r(arsort($first_array));
    echo "<br>";
    print_r($first_array);
    echo "<br>";
    print_r(arsort($second_array));
    echo "<br>";
    print_r($second_array);
    echo "<br>";
    print_r(arsort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(arsort($third_array));
    echo "<br>";
    print_r($third_array);
?>
