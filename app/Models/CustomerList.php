<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerList extends Model
{
    use HasFactory;

    protected $table = 'customer_lists';

    protected $fillable = [
        'id_contact',
        'age_category',
        'customer_type',
        'title',
        'first_name',
        'last_name',
        'birthday',
        'flight_code',
        'chair_number',
        'nationality',
        'return_date'
    ];

    public function addCustomer($id_contact, $age_category, $customer_type, $title, $first_name, $last_name, $birthday, $flight_code, $chair_number, $nationality, $return_date) {
        $customer = self::create([
            'id_contact' => $id_contact,
            'age_category' => $age_category,
            'customer_type' => $customer_type,
            'title' => $title,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birthday' => $birthday,
            'flight_code' => $flight_code,
            'chair_number' => $chair_number,
            'nationality' => $nationality,
            'return_date' => $return_date
        ]);

        return $customer;
    }

    public function customerListByID($id_contact) {
        $customers = self::where('id_contact', $id_contact)->paginate(2);

        return $customers;
    }

    public function customerList() {
        $customers = self::select('*')->paginate(3);

        return $customers;
    }

    public function getMybookingsByIDContact($id) {
        $customer = self::select('*')->where('id_contact', $id)->get();

        return $customer;
    }

    public function getFlightCodebyID($id) {
        $query = self::select('flight_code')
                    ->distinct()
                    ->where('id_contact', $id)
                    ->get();

        return $query;
    }

    public function getCustomerFlightByID($id) {
        $query = self::select('customer_lists.*', 'flight_lists.*', 'customer_lists.id as customer_id', 'flight_lists.id as flight_id')
                    ->join('flight_lists', 'customer_lists.flight_code', '=', 'flight_lists.flight_code')
                    ->where('customer_lists.id', $id)
                    ->first();

        return $query;
    }

    public function updateCustomer($id, $title, $first_name, $last_name, $birthday, $flight_code, $chair_number, $nationality) {
        $customer = self::where('id', $id)->update([
            'title' => $title,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birthday' => $birthday,
            'flight_code' => $flight_code,
            'chair_number' => $chair_number,
            'nationality' => $nationality
        ]);

        return $customer;
    }

    public function getCustomerByID($id) {
        return self::where('id', $id)->first();
    }

    public function deleteCustomer($id) {
        $customer = self::where('id', $id)->delete();

        return $customer;
    }
}
