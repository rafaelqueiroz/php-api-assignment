<?php
class VehicleControllerTest extends TestCase
{
	
    public function testRequirement1()
    {
        $response = $this->get('/vehicles/2015/Audi/A3');
        $response->seeJson(['Count' => 4, 'Results' => [["Description" =>"2015 Audi A3 4 DR AWD","VehicleId"=>9403],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406]]]);

        $response = $this->get('/vehicles/2015/Toyota/Yaris');
        $response->seeJson(["Count"=>2,"Results"=>[["Description"=>"2015 Toyota Yaris 3 HB FWD","VehicleId"=>9791],["Description"=>"2015 Toyota Yaris Liftback 5 HB FWD","VehicleId"=>9146]]]);

        $response = $this->get('/vehicles/2015/Ford/Crown');
        $response->seeJson(["Count"=>0,"Results"=>[]]);

        $response = $this->get('/vehicles/undefined/Ford/Fusion');
        $response->seeJson(["Count"=>0,"Results"=>[]]);
    }

    public function testRequirement2()
    {
        $response = $this->post('/vehicles', ['modelYear' => 2015, 'manufacturer' => 'Audi', 'model' => 'A3']);
        $response->seeJson(['Count' => 4, 'Results' => [["Description" =>"2015 Audi A3 4 DR AWD","VehicleId"=>9403],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406]]]);

        $response = $this->post('/vehicles', ['modelYear' => 2015, 'manufacturer' => 'Toyota', 'model' => 'Yaris']);
        $response->seeJson(["Count"=>2,"Results"=>[["Description"=>"2015 Toyota Yaris 3 HB FWD","VehicleId"=>9791],["Description"=>"2015 Toyota Yaris Liftback 5 HB FWD","VehicleId"=>9146]]]);

        $response = $this->post('/vehicles', ['manufacturer' => 'Honda', 'model' => 'Accord']);
     	$response->seeJson(["Count"=>0,"Results"=>[]]);
    }

    public function testRequirement3()
    {
        $response = $this->get('/vehicles/2015/Audi/A3?withRating=true');
        $response->seeJson(["Count"=>4,"Results"=>[["Description"=>"2015 Audi A3 4 DR AWD","VehicleId"=>9403,"CrashRating"=>"5"],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408,"CrashRating"=>"5"],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405,"CrashRating"=>"Not Rated"],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406,"CrashRating"=>"Not Rated"]]]);

        $response = $this->get('/vehicles/2015/Audi/A3?withRating=false');
        $response->seeJson(['Count' => 4, 'Results' => [["Description" =>"2015 Audi A3 4 DR AWD","VehicleId"=>9403],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406]]]);

        $response = $this->get('/vehicles/2015/Audi/A3?withRating=bananas');
        $response->seeJson(['Count' => 4, 'Results' => [["Description" =>"2015 Audi A3 4 DR AWD","VehicleId"=>9403],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406]]]);

        $response = $this->get('/vehicles/2015/Audi/A3');
        $response->seeJson(['Count' => 4, 'Results' => [["Description" =>"2015 Audi A3 4 DR AWD","VehicleId"=>9403],["Description"=>"2015 Audi A3 4 DR FWD","VehicleId"=>9408],["Description"=>"2015 Audi A3 C AWD","VehicleId"=>9405],["Description"=>"2015 Audi A3 C FWD","VehicleId"=>9406]]]);
    }
   
}