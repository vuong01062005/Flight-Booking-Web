<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

class ContactList extends Model
{
    use HasFactory;

    protected $table = 'contact_lists';

    protected $fillable = [
        'userID_account',
        'first_name',
        'last_name',
        'phone',
        'email',
        'image_transfer',
        'booking_code',
        'departure_city',
        'arrival_city',
        'status'
    ];

    public function addContact($userID_account, $first_name, $last_name, $phone, $email, $image_transfer, $booking_code, $departure_city, $arrival_city, $status) {
        $contact = self::create([
            'userID_account' => $userID_account,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'email' => $email,
            'image_transfer' => $image_transfer,
            'booking_code' => $booking_code,
            'departure_city' => $departure_city,
            'arrival_city' => $arrival_city,
            'status' => $status
        ]);

        return $contact->id;
    }

    public function customerContactList($a) {
        $query = self::query()
            ->select('*')
            ->paginate($a);

        return $query;
    }

    public function customerContactListByID($id) {
        $query = self::select('id_contact', $id)->paginate(1);

        return $query;
    }

    public function getIDbyUserIDAccount($id) {
        $query = self::select('*')->where('userID_account', $id)->get();

        return $query;
    }

    public function getBookingCode() {
        $query = self::orderBy('booking_code', 'desc')->first();

        return $query;
    }

    public function getMyBookingsByID($id) {
        $query = FacadesDB::table('contact_lists as c')
            ->join('customer_lists as cu', 'cu.id_contact', '=', 'c.id')
            ->where('c.userID_account', $id)
            ->select(
                'c.id as contact_id',
                'c.userID_account',
                'c.booking_code',
                'c.departure_city',
                'c.arrival_city',
                'c.status',
                'cu.id as customer_id',
                'cu.id_contact',
                'cu.customer_type',
                'cu.title',
                'cu.first_name as customer_first_name',
                'cu.last_name as customer_last_name',
                'cu.birthday',
                'cu.flight_code',
                'cu.chair_number',
                'cu.nationality',
            )
            ->get();
    
        return $query;
    }

    public function getContactByID($id) {
        $query = self::select('*')->where('id', $id)->first();
        
        return $query;
    }

    public function updateStatus($id, $status) {
        $contact = self::where('id', $id)->update([
            'status' => $status
        ]);
    }
}
