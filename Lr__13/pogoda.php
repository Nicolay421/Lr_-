<?php
include "WebPageScraper.php";
$url = 'https://weather.com/weather/today/l/8d61fe0298405a2caf36ceadc442079a41a66bc97c8b3fd49f0641ac93ad8878';
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
