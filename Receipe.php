<?php

class Receipe
{
    private $ingredients;
    private $teespoon_limit = 100;
    private $combinations = [];

    // validate and set ingredients
    public function set_ingredients($ingredients)
    {
        if ($this->validate_ingredient($ingredients)) $this->ingredients = $ingredients;
    }

    // calculate possible highest score
    public function get_highest_score($cal = 0)
    {
        $this->set_combinations();
        $highest_score = 0;
        foreach ($this->combinations as $combination) {
            $overall_score = $this->get_score($combination, $cal);
            if ($overall_score > $highest_score) {
                $highest_score = $overall_score;
            }
        }
        return $highest_score;
    }

    private function set_combinations()
    {
        $teaspoons = $this->teespoon_limit;
        $start_combination = [];
        for ($x = 0; $x < count($this->ingredients); $x++) array_push($start_combination, 0);
        $this->recc($start_combination, $teaspoons, count($this->ingredients));
        return $this->combinations;
    }

    private function recc($combination, $teaspoons, $m_index)
    {
        if ($teaspoons == 0) {
            $new_comb = [];
            foreach ($combination as $ing_spoon) {
                array_push($new_comb, $ing_spoon);
            }
            array_push($this->combinations, $new_comb);
        } else {
            for ($i = 0; $i < count($combination); $i++) {
                $combination_copy = $combination;
                $combination_copy[$i] += 1;
                if ($i <= $m_index) $this->recc($combination_copy, $teaspoons - 1, $i);
            }
        }
    }



    /*
    Calculate Overall score for a given combination of ingredients
    @input
    $combination:  Combination of teaspoons example: [0, 0, 0, 0]
    $cal: Optional, specify calories (Task 2)
    @output integer, overall score, returns 0 if no good match
    */
    private function get_score($combination, $cal = 0)
    {
        $capacity_total = 0;
        $durability_total = 0;
        $flavor_total = 0;
        $texture_total = 0;
        $calories_total = 0;

        for ($i = 0; $i < count($this->ingredients); $i++) {
            $ingredient_name = array_keys($this->ingredients)[$i];
            $ingredient = $this->ingredients[$ingredient_name];

            $capacity_total += $ingredient["capacity"] * $combination[$i];
            $durability_total += $ingredient["durability"] * $combination[$i];
            $flavor_total += $ingredient["flavor"] * $combination[$i];
            $texture_total += $ingredient["texture"] * $combination[$i];
            $calories_total += $ingredient["calories"] * $combination[$i];
        }

        $overall_score = 0;
        if ($capacity_total > 0 && $durability_total > 0 && $flavor_total > 0 && $texture_total > 0) {
            if ($cal == 0 || $cal == $calories_total) {
                $overall_score = $capacity_total * $durability_total * $flavor_total * $texture_total;
            }
        }

        return $overall_score;
    }


    /* 
    Confirming each ingredient has properties: capacity, durability, flavor, texture, calories
    @input $ingredients []
    @output boolean
    */
    private function validate_ingredient($ingredients)
    {
        // TODO
        return true;
    }
}
