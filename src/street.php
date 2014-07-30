<?php

namespace Project\City;

class Street {

    public $title; //название улицы
    public $lengthStreet; //протяженность
    public $coordinates; //координаты
    public $houses; //дома

    const AREAJANITOR = 500;   //площадь на одного дворника м2

    public function StreetRand() {
        $titleStreet = array("1street", "2street", "3street");
        $coord = (array(rand(0, 180), rand(0, 180), rand(0, 180), rand(0, 180)));
        return array(
            "title" => $titleStreet[array_rand($titleStreet, 1)],
            "lengthStreet" => rand(1, 4),
            "coordinates" => implode(", ", $coord)
        );
    }

    public function __construct() {
        $obj = $this->StreetRand();
        $this->title = $obj['title'];
        $this->lengthStreet = $obj['lengthStreet'];
        $this->coordinates = $obj['coordinates'];

        $housenew = array();
        $n = rand(2, 5);
        for ($i = 0; $i < $n; $i++) {
            $housenew[$i] = new House();
            $this->houses = $housenew;
        }
    }

    public function CountJanitor() {     //количество дворников
        $sum = 0;
        foreach ($this->houses as $value) {
            $sum += $value->area; //площадь всех придомовых территорий
        }
        return ceil($sum / self::AREAJANITOR);
    }

    public function AllServiseStreet() {     //услуги коммунальных платежей со всех домов
        $sum = 0;
        foreach ($this->houses as $value) {
            $sum += $value->AllServiseHouse();
        }
        return $sum;
    }

    public function StreetInfo() {
        $output1 = "<strong>Street info :</strong>
            street title {$this->title}
            length Street{$this->lengthStreet}
            coordinates {$this->coordinates}
            number of janitor {$this->CountJanitor()}
            amount of payments {$this->AllServiseStreet()}
            </br>";
        echo nl2br($output1);

        foreach ($this->houses as $value) {
            echo '<div class="left hide">';
            echo $value->HouseInfo();
            echo '</div>';
        }
        echo "<div class='new'></div>";
    }

}

//street
?>