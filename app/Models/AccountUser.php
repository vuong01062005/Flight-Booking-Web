<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountUser extends Model
{
    use Notifiable;

    protected $table = 'account_user';

    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'Email',
        'BirthDay',
        'Phone',
        'Avatar',
        'password',
        'wallet',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAccount($id) {
        return AccountUser::where('id', $id)->first();
    }

    public function updateInfo($id, $firstName, $lastName, $phone, $email) {
        AccountUser::where('id', $id)->update([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'Phone' => $phone,
            'Email' => $email,
        ]);
    }

    public function updateAvatar($id, $avatar) {
        AccountUser::where('id', $id)->update([
            'Avatar' => $avatar,
        ]);
    }

    public function updatePass($id, $pass) {
        AccountUser::where('id', $id)->update([
            'password' => $pass,
        ]);
    }

    public function getAccountList($a) {
        return self::select('*')->paginate($a);
    }

    public function getWalletbyID($id) {
        return self::select('wallet')->where('id', $id)->first();
    }

    public function updateWallet($id, $wallet) {
        return self::where('id', $id)->update(['wallet' => $wallet]);
    }
}
