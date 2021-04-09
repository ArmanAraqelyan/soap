<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;

class TrainTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test void
     */
    public function check_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('/');
    }

    /**
     * A basic feature test example.
     *
     * @test void
     */
    public function get_json_fail_data_pass_only_train()
    {
        $this->generateRequest(['train' => '016Ф']);
//        $this->generateRequest(['train' => '0asdddddsaasaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa16']);
    }



    /**
     * A basic feature test example.
     *
     * @test void
     */
    protected function generateRequest($array)
    {
        $all_keys = [
            'train',
            'station_source',
            'station_destination',
            'day',
        ];

        $k = array_search(array_keys($array)[0] , $all_keys);

        unset($all_keys[$k]);

        $response = $this->get('/train/get-route' , $array)->assertExactJson([
            'success' => false,
            'message' => $all_keys
        ]);
//        $response->assertExactJson();
//        $response->assertStatus(200);

    }




}
