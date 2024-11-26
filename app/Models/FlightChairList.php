<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FlightChairList extends Model
{
    use HasFactory;

    protected $table = 'flight_chair_lists';

    protected $fillable = [
        'flight_code',
        'ticket_type',
        'chair_number',
        'price_adult',
        'price_child',
        'price_infant',
        'status',
    ];

    public $timestamps = true;

    public function get_chairType($flight_code, $ticket_type) {
        $chair = self::select('chair_number', 'status')
                ->where('flight_code', $flight_code)
                ->where('ticket_type', $ticket_type)
                ->get();

        return $chair;
    }

    public function addFlightChairList($flight_code, $ticket_type, $chair_number, $price_adult, $price_child, $price_infant) {
        $flight = self::create([
            'flight_code' => $flight_code,
            'ticket_type' => $ticket_type,
            'chair_number' => $chair_number,
            'price_adult' => $price_adult,
            'price_child' => $price_child,
            'price_infant' => $price_infant,
            'status' => 'Chưa đặt',
        ]);

        return $flight;
    }

    public function reservations($status, $flight_code, $ticket_type, $chair_number) {
        return self::where('flight_code', $flight_code)
                ->where('ticket_type', $ticket_type)
                ->where('chair_number', $chair_number)
                ->update(['status' => $status]);
    }
}
