<?php

//get html code from web-page
$url = 'https://rigacoding.lv';
$html = file_get_contents($url);
//echo $html; //for test

//create object, load  html code into object
$dom = new DOMDocument();
$dom->loadHTML($html);

//Course name is in tag <a></a> inside tag <h3></h3>
$courseElements = $dom->getElementsByTagName('h3');

$courses = [];

foreach ($courseElements as $element) {
    $link = $element->getElementsByTagName('a')->item(0);
    if ($link) {
        // Get "text content" from link
        $courseName = $link->nodeValue;
        $courses[] = $courseName;
    } /*else {
        echo "Cannot find link in tag h3:\n";
        echo $element->ownerDocument->saveHTML($element) . "\n";
    }*/
}
//print_r($courses); //for array test

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
</head>
<body>
    <h3>Riga Coding School piedāvātie kursi</h3>
    <table border="1">
        <tr>
            <th>Nr.</th>
            <th>Kursa nosaukums</th>
        </tr>
        <?php $count = 1; ?>
        <?php foreach ($courses as $course) : ?>
           <tr>
              <td><?= $count++; ?></td>
              <td><?= $course; ?></td> 
           </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>