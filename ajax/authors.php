<?php

$authors[] = 'Robert Kirkman';
$authors[] = 'Hayao Miyazaki';
$authors[] = 'Dav Pilkey';
$authors[] = 'Gary Larson';
$authors[] = 'Scott Adams';
$authors[] = 'Koyoharu Gotouge';
$authors[] = 'Junji Ito';
$authors[] = 'Jeph Loeb';



$query = $_REQUEST['query'];
$suggestion = "";  // responseText

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($authors as $author) {
        if (stristr($query, substr($author, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $author;
            } else {
                $suggestion .= ", $author";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}
