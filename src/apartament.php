<?php
namespace Project\City;
class Apartament {

    public $room; //кол комнат
    public $square; //площадь
    public $floor; //этаж
    public $roomer; //кол жильцов
    public $balcony; //балкон
    public $heatingType; //тип отопления
    public $electricPower; //электричество  
    public $roomerUpdate; // добавление/удаление человека

    const TARIFFWATERIN = 2.448;  //водоснабжение      (грн/м³)
    const NORMWATERIN = 11.10;                     // (м³ / чел.)
    const TARIFFWATEROUT = 1.116;    //водоотвод       м³ / чел.
    const NORMWATEROUT = 11.10;                     // грн / м³
    const TARIFFELECTRICITY = 0.3084;   //электроэнергия    кВт·час / чел.
    const TARRIFGAS = 20.73;            //газ          грн / м³
    const TARIFFHEATING = 9.58;      //отопление      Гкал / м²

    public function apartamentRand() {
        $input = array('central', 'autonomous');
        return array(
            "room" => rand(1, 4),
            "heatingType" => $input[array_rand($input, 1)],
            "balcony" => rand(1, 2),
            "roomer" => rand(1, 5),
            "electricPower" => rand(0, 150),
            "square" => rand(25, 150),
            "floor" => rand(0, 24),
            "roomerUpdate" => rand(0, 2)
        );
    }

    public function __construct() {
        $obj = $this->apartamentRand();
        $this->room = $obj['room'];
        $this->square = $obj['square'];
        $this->floor = $obj['floor'];
        $this->roomer = $obj['roomer'];  //кол жильцов
        $this->balcony = $obj['balcony']; //балкон
        $this->electricPower = $obj['electricPower'];
        $this->heatingType = $obj['heatingType']; //тип отопления     
        $this->roomerUpdate = $obj['roomerUpdate']; // добавление/удаление человека
    }

    public function ServiceWaterIn() {          // водоснабжение
        return round(self::TARIFFWATERIN * self::NORMWATERIN * $this->roomer, 2);
    }

    public function ServiceWaterOut() {       // водотвод
        return round(self::TARIFFWATEROUT * self::NORMWATEROUT * $this->roomer, 2);
    }

    public function ServiceElectricity() {     //электроэнергия
        return round(self::TARIFFELECTRICITY * $this->electricPower, 2);
    }

    public function ServiceGas() {        // газ
        return round(self::TARRIFGAS * $this->roomer, 2);
    }

    public function ServiceHeating() {     //отопление
        return round(self::TARIFFHEATING * $this->square, 2);
    }

    public function ServiceAll() {      // все услуги
        return $this->ServiceWaterIn() + $this->ServiceWaterOut() + $this->ServiceElectricity() + $this->ServiceGas() + $this->ServiceHeating();
    }

    public function DeliteRoomer() {       // удаляет жильца
        return max($this->roomer - $this->roomerUpdate, 0);
    }

    public function AddRoomer() {       // добавляет жильца
        return $this->roomer + $this->roomerUpdate;
    }

    public function ApartamentInfo() {
        $output = "<strong>Apartament info :</strong>
            quantity of rooms - {$this->room} 
            square - {$this->square}
            stands on  {$this->floor} floor 
            {$this->roomer} roomers 
            quantity of balcony - {$this->balcony}
            heating type is: {$this->heatingType}
            water supply - {$this->ServiceWaterIn()}
            outfall -  {$this->ServiceWaterOut()}
            electric power - {$this->ServiceElectricity()}
            gas - {$this->ServiceGas()}
            heating - {$this->ServiceHeating()}
            all services - {$this->ServiceAll()}
            </br>";

        echo nl2br($output);
    }

}
?>       
