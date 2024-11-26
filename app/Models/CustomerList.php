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
        'customer_type',
        'title',
        'first_name',
        'last_name',
        'birthday',
        'flight_code',
        'chair_number',
    ];

    public function addCustomer($id_contact, $customer_type, $title, $first_name, $last_name, $birthday, $flight_code, $chair_number) {
        $customer = self::create([
            'id_contact' => $id_contact,
            'customer_type' => $customer_type,
            'title' => $title,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birthday' => $birthday,
            'flight_code' => $flight_code,
            'chair_number' => $chair_number,
        ]);

        return $customer;
    }

    public function customerListByID($id_contact) {
        $customers = self::where('*', $id_contact)->paginate(2);

        return $customers;
    }

    public function customerList() {
        $customers = self::select('*')->paginate(3);

        return $customers;
    }
}
