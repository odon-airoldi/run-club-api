<?php

$sports = [
  [
    "id" => 1,
    "nomeSport" => "Corsa su Strada",
    "richiedeAttrezzaturaComplessa" => false,
    "calorieConsumateOra" => 700,
  ],
  [
    "id" => 2,
    "nomeSport" => "Ciclismo",
    "richiedeAttrezzaturaComplessa" => true,
    "calorieConsumateOra" => 600,
  ],
  [
    "id" => 3,
    "nomeSport" => "Salto con la Corda",
    "richiedeAttrezzaturaComplessa" => false,
    "calorieConsumateOra" => 750,
  ],
  [
    "id" => 4,
    "nomeSport" => "Canottaggio",
    "richiedeAttrezzaturaComplessa" => true,
    "calorieConsumateOra" => 650,
  ],
];

$nomiSport = [];

foreach($sports as $sport) {

    $nomiSport[] = $sport['nomeSport'];

}

$totale = 0;



foreach($sports as $sport) {

    $totale += $sport['calorieConsumateOra'];
    
}

$media = $totale / count($sports);

dd($media);

dd($nomiSport);