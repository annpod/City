<?php
namespace Annpod\City;

class House {

    public $numHouse; //номер дома
    public $floorcount; //кол этажей
    public $porchcount; //кол подъездов
    public $apartament; //квартиры
    public $area; //прилегающая территория м2
    public $electricLamp; //электричество  на 1 лампочку 

    const TARIFFELECTRICITY = 0.3084;   //электроэнергия    кВт·час / чел.
    const LANDTAX = 0.1;   //налог на землю

    public function HousesRand() {
        return array(
            "numHouse" => rand(1, 100),
            "floorcount" => rand(1, 5),
            "porchcount" => rand(1, 4),
            "area" => rand(700, 1000),
            "lamp" => rand(100, 500),
            "apartmentsFloor" => rand(1, 2)
        );
    }

    public function __construct() {
        $obj = $this->HousesRand();
        $this->numHouse = $obj['numHouse'];
        $this->floorcount = $obj['floorcount'];
        $this->apartmentsFloor = $obj['apartmentsFloor'];
        $this->porchcount = $obj['porchcount'];
        $this->area = $obj['area'];
        $this->electricLamp = $obj['lamp'];
        $apart = array();
        $n = $this->floorcount * $this->apartmentsFloor * $this->porchcount;
        for ($i = 0; $i < $n; $i++) {
            $apart[$i] = new Apartament();
            $this->apartament = $apart;
        }
    }

    public function AllServiseHouse() {     //услуги коммунальных платежей со всех квартир
        $sum = 0;
        foreach ($this->apartament as $value) {
            $sum += $value->ServiceAll();
        }
        return $sum;
    }

    public function AmountOfElectricity() {     //объем потребляемого электричества для освещения подъездов
        return $this->floorcount * $this->porchcount * $this->electricLamp * self::TARIFFELECTRICITY;
    }

    public function LandTax() {  //размер налога на землю
        return $this->area * self::LANDTAX;
    }

    public function HouseInfo() {
        $output = "<strong>House info :</strong>
            house number - {$this->numHouse}
            floor count - {$this->floorcount}
            porchcount - {$this->porchcount} 
            apartmentsFloor - {$this->apartmentsFloor}    
            area - {$this->area}m<sup>2</sup>
            amount of payments - {$this->AllServiseHouse()} 
            amount of electricity - {$this->AmountOfElectricity()}
            land tax - {$this->LandTax()}
            </br>";
        echo nl2br($output);

        //вывод инф о квартирах
        foreach ($this->apartament as $value) {
            echo '<div class="left hide">';
            echo $value->ApartamentInfo();
            echo '</div>';
        }
        echo "<div class='new'></div>";
    }

}

 
?>