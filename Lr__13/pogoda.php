<?php
include "WebPageScraper.php";
$url = 'https://weather.com/';
$scraper = new WebPageScraper($url);
$scraper->loadPage();

$class = 'CurrentConditions--tempValue--3KcTQ'; 
$tagName = 'span';

$elements = $scraper->findElementsByClass($class, $tagName);

if ($elements->length > 0) {
    $temperature = $elements[0]->nodeValue;
    echo "Поточна температура: $temperature";
} else {
    echo "Не вдалося знайти інформацію про погоду.";
}

?>
