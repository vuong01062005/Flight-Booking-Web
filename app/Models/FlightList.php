<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightList extends Model
{
    use HasFactory;

    protected $table = 'flight_lists';

    protected $fillable = [
        'flight_code',
        'departure_city',
        'departure_cityName',
        'arrival_city',
        'arrival_cityName',
        'departure_time',
        'arrival_time',
        'time',
        'flight_date',
        'airline',
        'flight_name',
    ];

    public $timestamps = true;

    public function get_flights($from, $to, $depart, $chairType) {
        $flights = self::select('flight_lists.flight_code', 'flight_lists.departure_time', 'flight_lists.arrival_time', 'flight_lists.time', 'flight_lists.airline', 'flight_chair_lists.price_adult', 'flight_chair_lists.price_child', 'flight_chair_lists.price_infant', 'flight_lists.departure_cityName', 'flight_lists.arrival_cityName')
                ->join('flight_chair_lists', 'flight_lists.flight_code', '=', 'flight_chair_lists.flight_code')
                ->where('flight_lists.departure_city', $from)
                ->where('flight_lists.arrival_city', $to)
                ->where('flight_lists.flight_date', $depart)
                ->where('flight_chair_lists.ticket_type', $chairType)
                ->distinct()
                ->get();

        return $flights;
    }

    public function getNameCity($from, $to) {
        $flights = self::select('departure_cityName', 'arrival_cityName', 'time')
                ->distinct()
                ->where('departure_city', $from)
                ->where('arrival_city', $to)
                ->get();

        return $flights;
    }

    public function getAirline($from, $to) {
        $flights = self::select('airline')
                ->distinct()
                ->where('departure_city', $from)
                ->where('arrival_city', $to)
                ->get()
                ->pluck('airline');

        return $flights;
    }

    public function showFlightList() {
        $query = self::select('flight_lists.*', 'flight_chair_lists.*')
                ->join('flight_chair_lists', 'flight_lists.flight_code', '=', 'flight_chair_lists.flight_code')
                ->groupBy('flight_lists.flight_code')
                ->orderByRaw('CAST(SUBSTRING(flight_lists.flight_code, 3) AS UNSIGNED) ASC')
                ->get();

        return $query;
    }

    public function showFlightListPage($a) {
        $query = self::select('flight_lists.*', 'flight_chair_lists.*')
                ->join('flight_chair_lists', 'flight_lists.flight_code', '=', 'flight_chair_lists.flight_code')
                ->groupBy('flight_lists.flight_code')
                ->orderByRaw('CAST(SUBSTRING(flight_lists.flight_code, 3) AS UNSIGNED) ASC')
                ->paginate($a);

        return $query;
    }

    public function addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $flight_date, $airline, $flight_name) {
        $flight = self::create([
            'flight_code' => $flight_code,
            'departure_city' => $departure_city,
            'departure_cityName' => $departure_cityName,
            'arrival_city' => $arrival_city,
            'arrival_cityName' => $arrival_cityName,
            'departure_time' => $departure_time,
            'arrival_time' => $arrival_time,
            'time' => $time,
            'flight_date' => $flight_date,
            'airline' => $airline,
            'flight_name' => $flight_name,
        ]);

        return $flight;
    }
}
