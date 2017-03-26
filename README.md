# README #

php REST interface for the E-Bus Project


Get all stations

    GET /stations
    
    [
          {
            "id": 1,
            "name": "amal6",
            "latitude": 33.969423,
            "longtitude": -6.89846,
            "description": "de hay el fath vers bab el had"
          },
          {
            "id": 2,
            "name": "massira ",
            "latitude": 33.97057,
            "longtitude": -6.89454,
            "description": "de hay el fath vers bab lhad "
          }
     ]


Get all buses passing by a station

    GET /stations/{id}/buses
    
    [
      {
        "id": 1,
        "name": "bus1",
        "number": 57,
        "latitude": 33.97057,
        "longtitude": -6.89454,
        "description": "de hay el fath vers hassan",
        "pivot": {
          "station_id": 1,
          "bus_id": 1,
          "time": 120
        }
      },
      {
        "id": 2,
        "name": "bus2",
        "number": 30,
        "latitude": null,
        "longtitude": null,
        "description": "de hay el fath vers bab el had",
        "pivot": {
          "station_id": 1,
          "bus_id": 2,
          "time": 120
        }
      }
    ]


Get all buses

    GET /buses
    
    [
          {
            "id": 1,
            "name": "bus1",
            "number": 57,
            "latitude": 33.97057,
            "longtitude": -6.89454,
            "description": "de hay el fath vers hassan",
            "pivot": {
              "station_id": 1,
              "bus_id": 1,
              "time": 120
            }
          },
          {
            "id": 2,
            "name": "bus2",
            "number": 30,
            "latitude": null,
            "longtitude": null,
            "description": "de hay el fath vers bab el had",
            "pivot": {
              "station_id": 1,
              "bus_id": 2,
              "time": 120
            }
          }
     ]
    
    
Get a bus by its number


    GET /buses/{num}
    
    {
      "id": 1,
      "name": "bus1",
      "number": 57,
      "latitude": 33.97057,
      "longtitude": -6.89454,
      "description": "de hay el fath vers hassan"
    }


Update a bus

    PUT /buses/{num:[0-9]+}
    
    {
      "name": "bus1",
      "number": 57,
      "latitude": 33.97057,
      "longtitude": -6.89454,
      "description": "de hay el fath vers hassan"
    }


Get all stations for a bus number

    GET /buses/{num}/stations
    
    [
      {
        "id": 1,
        "name": "amal6",
        "latitude": 33.969423,
        "longtitude": -6.89846,
        "description": "de hay el fath vers bab el had",
        "pivot": {
          "bus_id": 1,
          "station_id": 1,
          "time": 120
        }
      },
      {
        "id": 2,
        "name": "massira ",
        "latitude": 33.97057,
        "longtitude": -6.89454,
        "description": "de hay el fath vers bab lhad ",
        "pivot": {
          "bus_id": 1,
          "station_id": 2,
          "time": 4500
        }
      }
    ]

    
     
Update time between the bus and the stations

    PUT /buses/{num}/stations


        [
            {
                "bus_id": 1,
                "station_id": 2,
                "time": 4500
            },
            {
                "bus_id": 1,
                "station_id": 3,
                "time": 4500
            } 
        ]
