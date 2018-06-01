<?php
if() {
    mixed array_search ( mixed $needle , array $jobs [, bool $strict = false ] );
}
elseif() {
    mixed array_search ( mixed $needle , array $people [, bool $strict = false ] );
}
else {
    echo "unexpected error,try again later!";
}


?>

<?php

$haystack = array('a','b','a','b');

$needle = 'a';

print_r(array_search_all($needle, $haystack));

//Output will be
// Array
// (
//         [0]=>1
//         [1]=>3
// )

function array_search_all($needle, $haystack)
{#array_search_match($needle, $haystack) returns all the keys of the values that match $needle in $haystack

    foreach ($haystack as $k=>$v) {

        if($haystack[$k]==$needle){

           $array[] = $k;
        }
    }
    return ($array);


}

?>
