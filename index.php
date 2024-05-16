<?php

//get html code from web-page
$url = 'https://rigacoding.lv';
$html = file_get_contents($url);
//echo $html; //for test

libxml_use_internal_errors(true); // temporerily disabling error output

//create object, load  html code into object
$dom = new DOMDocument();
$dom->loadHTML($html);

libxml_use_internal_errors(false); // re-enabling error output

//course name is in tag <a></a> inside tag <h3></h3>
$courseElements = $dom->getElementsByTagName('h3');

$courses = [];

foreach ($courseElements as $element) {
    $link = $element->getElementsByTagName('a')->item(0);
    if ($link) {
        // Get "text content" from link
        $courseName = $link->nodeValue;
        $courses[] = $courseName;
    } /*for test
    else {
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
    <table border="1" style="border-collapse: collapse; margin: 40px auto;">
    <caption><h3>Riga Coding School piedāvātie kursi</h3></caption>
        <tr>
            <th style="padding: 8px; background-color: #f2f2f2; font-weight: bold;">Nr.</th>
            <th style="padding: 8px; background-color: #f2f2f2; font-weight: bold;">Kursa nosaukums</th>
        </tr>
        <?php $count = 1; ?>
        <?php foreach ($courses as $course) : ?>
           <tr>
              <td style="padding: 8px; font-weight: bold;"><?= $count++; ?></td>
              <td style="padding: 8px;"><?= $course; ?></td> 
           </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>