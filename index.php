<?php
require 'vendor/autoload.php';
use Tools\Str;
use Tools\Arr;
use Tools\Stat;
use Tools\Color;
use Tools\Gibberish;
use Tools\Clustering;
use Tools\Sampling;
use Tools\I18n;

// -------------------------------------------------------
// String
// -------------------------------------------------------
    $string = new Str();
    ?><pre><?php print_r('///// Str ------------------------------------------------'); ?></pre><?php

    $result = $string->random(10);
    ?><pre><?php print_r('Str->random : ' . $result); ?></pre><?php

    $result = $string->token(10);
    ?><pre><?php print_r('Str->token : ' . $result); ?></pre><?php

    $txt = "Je suis Bob, j'ai (20) ans et 23€ ;le site de mon maître est le 1er du mo___nde, c'est : http://www.bob.com !"; ;
    $result = $string->clean($txt);
    ?><pre><?php print_r('Str->clean : ' . $result); ?></pre><?php

    $result = $string->removeAcents($txt);
    ?><pre><?php print_r('Str->removeAcents : ' . $result); ?></pre><?php

    $result = $string->removeAllButLetters($txt);
    ?><pre><?php print_r('Str->removeAllButLetters : ' . $result); ?></pre><?php

    $result = $string->removeUrls($txt);
    ?><pre><?php print_r('Str->removeUrls : ' . $result); ?></pre><?php

    $result = $string->removeNumbers($txt);
    ?><pre><?php print_r('Str->removeNumbers : ' . $result); ?></pre><?php

    $result = $string->removePunctuation($txt);
    ?><pre><?php print_r('Str->removePunctuation : ' . $result); ?></pre><?php

    $result = $string->similarity('moucheron', 'mouche');
    ?><pre><?php print_r('Str->similarity : ' . $result); ?></pre><?php

// -------------------------------------------------------
// Array
// -------------------------------------------------------
    $arr = new Arr();
    ?><pre><?php print_r('///// Array ------------------------------------------'); ?></pre><?php

    $a = ['B' => 'manolu', 'A' => 'manolo', 'C' => 'manoli'];
    $result = $arr->shuffleAArray($a);
    ?><pre><?php print_r('Arr->shuffleAArray : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $b = ['B' => ['name' => 'john', 'age'=> 22],
        'A'   => ['name' => 'bob', 'age'=> 34],
        'C'   => ['name' => 'jane', 'age'=> 23], ];

    $result = $arr->sortAArray($b, 'age', SORT_ASC);
    ?><pre><?php print_r('Arr->sortAArray : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $c = [
        '227' => ['0' => 'blue', '1' => 21],
        '365' => ['0' => 'red', '1' => 24],
        '257' => ['0' => 'blue', '1' => 29],
        '847' => ['0' => 'green', '1' => 70],
    ];
    $result = $arr->numericalIndex($c);
    ?><pre><?php print_r('Arr->numericalIndex : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

// -------------------------------------------------------
// Stat
// -------------------------------------------------------
    $stat = new Stat();
    ?><pre><?php print_r('///// STAT -----------------------------------------------'); ?></pre><?php

    $result = $stat->euclideanDistance([12, 24, 34], [27, 49, 50]);
    ?><pre><?php print_r('Stat->euclideanDistance : ' . $result); ?></pre><?php

    $result = $stat->euclideanDistanceMatrix([[12, 24, 34], [27, 49, 50], [34, 76, 87]]);
    ?><pre><?php print_r('Stat->euclideanDistanceMatrix : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $stat->centroid([[12, 24, 34], [27, 49, 50], [34, 76, 87]], [2]);
    ?><pre><?php print_r('Stat->centroid : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $stat->arithmeticMean([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->arithmeticMean : ' . $result); ?></pre><?php

    $result = $stat->geometricMean([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->geometricMean : ' . $result); ?></pre><?php

    $result = $stat->harmonicMean([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->harmonicMean : ' . $result); ?></pre><?php

    $result = $stat->median([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->median : ' . $result); ?></pre><?php

    $result = $stat->standardDeviation([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->standardDeviation : ' . $result); ?></pre><?php

    $result = $stat->quantile([19, 45, 87, 27, 56], 0.67);
    ?><pre><?php print_r('Stat->quantile : ' . $result); ?></pre><?php

    $result = $stat->describe([19, 45, 87, 27, 56], 3);
    ?><pre><?php print_r('Stat->describe : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $stat->inBetween([19, 45, 87, 27, 56], null, 0, 24);
    ?><pre><?php print_r('Stat->inBetween : ' . $result); ?></pre><?php

    $result = $stat->toPercent([19, 45, 87, 27, 56]);
    ?><pre><?php print_r('Stat->toPercent : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $stat->likertConvert(3, 1, 7, 0, 5);
    ?><pre><?php print_r('Stat->likertConvert : ' . $result); ?></pre><?php

// -------------------------------------------------------
// Color
// -------------------------------------------------------
    $color = new Color();
    ?><pre><?php print_r('///// Color ------------------------------------------'); ?></pre><?php

    $result = $color->hex2rgb('#FFFFFF');
    ?><pre><?php print_r('color->hex2rgb : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $color->rgb2hex(255, 255, 255);
    ?><pre><?php print_r('color->rgb2hex : ' . $result); ?></pre><?php

    $result = $color->rgb2hsv(255, 255, 255);
    ?><pre><?php print_r('color->rgb2hsv : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

// -------------------------------------------------------
// Gibberish
// -------------------------------------------------------
    $gibberish = new Gibberish();
    ?><pre><?php print_r('///// Gibberish ------------------------------------------'); ?></pre><?php

    $lang = 'fr';
    // $gibberish->train($lang);

    $result = $gibberish->isGibberish('fdve zefreq fzef', $lang);
    $value = $result ? 'true' : 'false';
    ?><pre><?php print_r('Gibberish->isGibberish : ' . $value); ?></pre><?php

    // fr
    $result = $gibberish->isGibberish('Ton secret vaut-il la peine que je te garde la vie au moins ?', $lang);
    // en
    $result = $gibberish->isGibberish('Judgments shall be signed by the President and the Registrar.', $lang);
    // de
    $result = $gibberish->isGibberish('Alle drei Jahre wird das Gericht teilweise neu besetzt.', $lang);
    // es
    $result = $gibberish->isGibberish('Los miembros del Tribunal General podrán ser llamados a desempeñar las funciones de Abogado General.', $lang);
    // fi
    $result = $gibberish->isGibberish('Komission jäsenet hoitavat puheenjohtajan heille osoittamia tehtäviä tämän valvonnassa.', $lang);
    // it
    $result = $gibberish->isGibberish('Il numero dei membri del Comitato delle regioni non è superiore a trecentocinquanta.', $lang);
    // nl
    $result = $gibberish->isGibberish('Het Verenigd Koninkrijk streeft ernaar een buitensporig overheidstekort te voorkomen.', $lang);
    // pt
    $result = $gibberish->isGibberish('O Conselho de Administração é composto por 26 administradores e 16 administradores suplentes.', $lang);
    $value = $result ? 'true' : 'false';
    ?><pre><?php print_r('Gibberish->isGibberish : ' . $value); ?></pre><?php

// -------------------------------------------------------
// Clustering
// -------------------------------------------------------
    $clustering = new Clustering();
    ?><pre><?php print_r('///// Clustering -----------------------------------------'); ?></pre><?php

    $data = [
        '227' => ['0' => 12, '1' => 21, '2' => 36],
        '365' => ['0' => 56, '1' => 24, '2' => 42],
        '257' => ['0' => 14, '1' => 29, '2' => 42],
        '847' => ['0' => 16, '1' => 30, '2' => 34],
    ];

    $result = $clustering->kMeans($data, 2);
    ?><pre><?php print_r('Clustering->kMeans : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $clustering->kMeans($data, 2, [0], 'ID');
    ?><pre><?php print_r('Clustering->kMeans : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

// -------------------------------------------------------
// Sampling
// -------------------------------------------------------
    $sampling = new Sampling();
    ?><pre><?php print_r('///// Sampling -------------------------------------------'); ?></pre><?php

    $data = [
        '227' => ['0' => 12, '1' => 21, '2' => 36],
        '365' => ['0' => 56, '1' => 24, '2' => 42],
        '257' => ['0' => 14, '1' => 29, '2' => 42],
        '847' => ['0' => 16, '1' => 30, '2' => 34],
    ];

    $result = $sampling->extractSample($data, 2);
    ?><pre><?php print_r('sampling->extractSample : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $sampling->extractSample($data, 2, 'probabilistic', 'IDValues');
    ?><pre><?php print_r('sampling->extractSample : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $sampling->sampleSize(120, 1.96, 0.5, 0.05);
    ?><pre><?php print_r('sampling->sampleSize : ' . $result); ?></pre><?php

// -------------------------------------------------------
// I18n
// -------------------------------------------------------
    $i18n = new I18n();
    ?><pre><?php print_r('///// I18n -----------------------------------------------'); ?></pre><?php

    $result = $i18n->countries('fr');
    ?><pre><?php print_r('i18n->countries : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php

    $result = $i18n->languages('en');
    ?><pre><?php print_r('i18n->languages : '); ?></pre><?php
    ?><pre><?php var_dump($result); ?></pre><?php
