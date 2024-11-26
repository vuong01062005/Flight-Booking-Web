<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function addContact($userID_account, $first_name, $last_name, $phone, $email, $image_transfer) {
        $contact = self::create([
            'userID_account' => $userID_account,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'email' => $email,
            'image_transfer' => $image_transfer,
        ]);

        return $contact->id;
    }

    function customerContactList($a) {
        $query = self::query()
            ->select('*')
            ->paginate($a);

        return $query;
    }

    public function customerContactListByID($id) {
        $query = self::select('id_contact', $id)->paginate(1);

        return $query;
    }
}
