<?php

$genres[] = 'Action';
$genres[] = 'Manga';
$genres[] = 'Superheroes';
$genres[] = 'Science-fiction';
$genres[] = 'Romance Manga';
$genres[] = 'Adventure';
$genres[] = 'History';
$genres[] = 'Biography';


$query = $_REQUEST['query'];
$suggestion = "";  // responseText

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($genres as $genre) {
        if (stristr($query, substr($genre, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $genre;
            } else {
                $suggestion .= ", $genre";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}
