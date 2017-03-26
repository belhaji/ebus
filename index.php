<?php


include 'config/bootstrap.php';

use Ebus\Models\Bus;
use Ebus\Models\Station;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Epark\Middleware\Authentication as EparkAuth;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

//$app->add(new EparkAuth());

$app->group('/api', function () {

    $this->map(['GET'], '/stations', function ($req, $res, $args) {
        $stations = Station::all();
        return $res->withStatus(200)->withJson($stations);
    });

    $this->map(['GET'], '/stations/{id}/buses', function ($req, $res, $args) {
        $station = Station::find($args['id']);
        if ($station)
            return $res->withStatus(200)->withJson($station->buses()->get());
        else
            return $res->withStatus(404)->withJson(['msg' => 'no station founds']);
    });

    $this->map(['GET'], '/buses', function ($req, $res, $args) {
        $stations = Bus::all();
        return $res->withStatus(200)->withJson($stations);
    });

    $this->map(['GET'], '/buses/{num}', function ($req, $res, $args) {
        $bus = Bus::all()->where('number', $args['num'])->first();
        if ($bus)
            return $res->withStatus(200)->withJson($bus);
        else
            return $res->withStatus(404)->withJson(['msg' => 'no station founds']);
    });


    $this->map(['PUT'], '/buses/{num:[0-9]+}', function ($req, $res, $args) {
        $json = $req->getBody();
        $data = json_decode($json, true);
        $bus = Bus::all()->where('number', $args['num'])->first();
        if ($bus) {
            $bus->update($data);
            if ($bus->save()) {
                return $res->withStatus(200)->withJson($bus);
            } else {
                return $res->withStatus(404)->withJson(['msg' => 'cannot save the bus']);
            }
        } else {
            return $res->withStatus(404)->withJson(['msg' => 'no bus founds']);
        }

    });

        $this->map(['GET'], '/buses/{num}/stations', function ($req, $res, $args) {
        $bus = Bus::all()->where('number', $args['num'])->first();
        if ($bus)
            return $res->withStatus(200)->withJson($bus->stations()->get());
        else
            return $res->withStatus(404)->withJson(['msg' => 'no station founds']);
    });


    $this->map(['PUT'], '/buses/{num}/stations', function ($req, $res, $args) {
        $json = $req->getBody();
        $data = json_decode($json, true);
        $bus = Bus::all()->where('number', $args['num'])->first();
        if ($bus) {
            foreach ($data as $record) {
                $bus->stations()
                    ->newPivotStatement()
                    ->where('station_id', $record['station_id'])
                    ->update(['time' => $record['time']]);
            }
        } else {
            return $res->withStatus(404)->withJson(['msg' => 'no bus founds']);
        }

    });

});

$app->run();



/*

  $this->map(['POST'], '', function ($req, $res, $args) {
    $json = $req->getBody();
    $data = json_decode($json, true);
    $parking = new Parking();
    $parking->newPark($data);
    $parking->save();
    $message = array('id' => array('uri' => 'parking/' . $parking->id));
    if ($parking->id) {
        return $res->withStatus(201)->withJson($message);
    } else {
        return $res->withStatus(400);
    }

});

$this->map(['PUT'], '/{parking_id:[0-9]+}', function ($req, $res, $args) {
    $json = $req->getBody();
    $data = json_decode($json, true);
    $parking = Parking::find($args['parking_id']);
    $parking->updatePark($data);
    if ($parking->save()) {
        return $res->withStatus(204);
    } else {
        return $res->withStatus(400);
    }
*/