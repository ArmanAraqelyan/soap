<?php

namespace App\Services;


class TrainService {

    private $credentials,$soap_client;

    public $allowed_methods;

    const TRAIN_INFO = [
        'station_source'      => 'from',
        'station_destination' => 'to',
        'day'                 => 'date'
    ];

    public function __construct()
    {
        $train_configs     = config('train');
        $this->credentials = array_intersect_key($train_configs, array_flip(['login' , 'psw' , 'terminal' , 'represent_id']));
        $this->soap_client = new \SoapClient($train_configs['base_url']);
        $this->allowed_methods = $train_configs['allowed_methods'];
    }

    public function getTrainRoutes( array $train_info ){
        $f_name = __FUNCTION__;
        try{
            $method_name = $this->checkAllowedMethods($f_name);
            info($f_name . ' method allowed');

            $train = $train_info['train'];
            unset($train_info['train']);

            $this->generateTrainInfo($train_info);

            $routes = $this->soap_client->$method_name($this->credentials , $train , $train_info)->route_list;
        }catch (\Exception $e){
            info('Soap response invalid , Message:  ' . $e->getMessage());
            return ['success' => false , 'message' => $e->getMessage()];
        }
        info('Soap response correct Thanks');
        return ['success' => true , 'routes' => $routes];
    }

    public function generateDateData(&$train_info){
        $date = strtotime($train_info['date']);
        unset($train_info['date']);
        $train_info['day'] = (int) date('d',$date);
        $train_info['month'] = (int) date('m',$date);
    }

    public function generateTrainInfo(&$train_info){
        foreach($train_info as $k => $v){
            if(isset(self::TRAIN_INFO[$k])){
                $train_info[self::TRAIN_INFO[$k]] = $v;
            }
            unset($train_info[$k]);
        }
        $this->generateDateData($train_info);
    }


    /**
     * @return mixed
     */
    public function getAllowedMethods()
    {
        return $this->allowed_methods;
    }

    /**
     * @param string $method_name
     *
     * @throw Exception
     *
     */

    private function checkAllowedMethods($method_name){
        if(isset($this->allowed_methods[$method_name]) && $this->allowed_methods[$method_name]) return $this->allowed_methods[$method_name];
        throw new \Exception("$method_name() Method not allowed");
    }

}
