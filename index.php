<?php
require_once('./Receipe.php');




/*------------------------- Puzzle input -------------------------------
Sprinkles: capacity 2, durability 0, flavor -2, texture 0, calories 3
Butterscotch: capacity 0, durability 5, flavor -3, texture 0, calories 3
Chocolate: capacity 0, durability 0, flavor 5, texture -1, calories 8
Candy: capacity 0, durability -1, flavor 0, texture 5, calories 8
-----------------------------------------------------------------------*/
$ingredients = [
    "Sprinkles" => ["capacity" => 2, "durability" => 0, "flavor" => -2, "texture" => 0, "calories" => 3],
    "Butterscotch" => ["capacity" => 0, "durability" => 5, "flavor" => -3, "texture" => 0, "calories" => 3],
    "Chocolate" => ["capacity" => 0, "durability" => 0, "flavor" => 5, "texture" => -1, "calories" => 8],
    "Candy" => ["capacity" => 0, "durability" => -1, "flavor" => 0, "texture" => 5, "calories" => 8]
];






$receipe = new Receipe();
$receipe->set_ingredients($ingredients);

$highest_score = $receipe->get_highest_score();
$highest_score_cal = $receipe->get_highest_score(500);

echo "The total score of the highest-scoring cookie you can make: " . $highest_score . PHP_EOL;
echo "Total score of the highest-scoring cookie you can make with 500 calories: " . $highest_score_cal . PHP_EOL;
