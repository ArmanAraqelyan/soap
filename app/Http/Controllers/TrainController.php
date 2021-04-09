<?php

namespace App\Http\Controllers;

use App\Http\Requests\Train\GetRoutesRequest;
use App\Services\TrainService;


class TrainController extends Controller
{
    private $train_service;

    public function __construct()
    {
        $this->train_service = new TrainService();
    }

    public function index(GetRoutesRequest $req)
    {
        info('Jump Validation GetRoutesRequest');
        $request_data = $req->only(['train','station_source' , 'station_destination' , 'day']);

        $response = $this->train_service->getTrainRoutes($request_data);

        if($req->ajax()) return self::responseJson($response);

        return redirect(route('home'))->with(['message' => $response]);
    }
}
