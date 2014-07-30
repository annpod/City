<?php
namespace Annpod\City;
class City {

    public $title; //название города
    public $year; //год основания
    public $coordinates; //координаты
    public $street; //улицы

    public function CityRand() {
        $titleStreet = array("1city", "2city", "3city");
        $coord = (array(rand(0, 180), rand(0, 180)));
        return array(
            "title" => $titleStreet[array_rand($titleStreet, 1)],
            "year" => rand(1940, 2014),
            "coordinates" => implode(", ", $coord)
        );
    }

    public function __construct() {
        $obj = $this->CityRand();
        $this->title = $obj['title'];
        $this->year = $obj['year'];
        $this->coordinates = $obj['coordinates'];
        $streetnew = array();
        $n = rand(2, 4);
        for ($i = 0; $i < $n; $i++) {
            $streetnew[$i] = new Street();
            $this->street = $streetnew;
        }
    }

    public function budgetCity() {     //бюджет города
        $sum = 0;
        foreach ($this->street as $value) {
            foreach ($value->houses as $value1) {
                $sum += $value1->LandTax();
            }
        }
        return $sum;
    }

    public function CountPeople() {     //количество населения
        $sum = 0;
        foreach ($this->street as $value) {
            foreach ($value->houses as $value1) {
                foreach ($value1->apartament as $value2) {
                    $sum += $value2->roomer;
                }
            }
        }
        return $sum;
    }

    public function CityInfo() {
        $output2 = "<strong>City info : </strong>
            street title - {$this->title}
            length Street - {$this->year}
            coordinates - {$this->coordinates}
            count people - {$this->CountPeople()}
            budget city - {$this->budgetCity()}
            </br>";

        echo nl2br($output2);

        foreach ($this->street as $value) {
            echo '<div class="left">';
            echo $value->StreetInfo();
            echo '</div>';
        }
        echo "<div class='new'></div>";
    }
}

?>