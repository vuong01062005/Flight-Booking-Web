<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'contactID',
        'amount',
        'date',
        'method',
    ];

    public function addPayment($contactID, $amount, $date, $method) {
        $query = self::create([
            'contactID' => $contactID,
            'amount' => $amount,
            'date' => $date,
            'method' => $method
        ]);

        return $query;
    }

    public function getPayment($contactID) {
        $day = Carbon::now()->subDays(90);
        $query = self::where('contactID', $contactID)
                    ->where('created_at', '>=', $day)
                    ->get();

        return $query;
    }

    public function getPaymentByDate($contactID, $date) {
        $query = null;
    
        if ($date == '90-days') {
            $day = Carbon::now()->subDays(90);
            $query = self::where('contactID', $contactID)
                        ->where('created_at', '>=', $day)
                        ->get();
        } elseif ($date == '10-2024') {
            $startOfOctober = Carbon::create(2024, 10, 1, 0, 0, 0);
            $endOfOctober = Carbon::create(2024, 10, 31, 23, 59, 59);

            $query = self::where('contactID', $contactID)
                        ->whereBetween('created_at', [$startOfOctober, $endOfOctober])
                        ->get();
        } elseif ($date == '9-2024') {
            $startOfSeptember = Carbon::create(2024, 9, 1, 0, 0, 0);
            $endOfSeptember = Carbon::create(2024, 9, 30, 23, 59, 59);

            $query = self::where('contactID', $contactID)
                        ->whereBetween('created_at', [$startOfSeptember, $endOfSeptember])
                        ->get();
        }

        return $query;
    }

    public function getPaymentonYear($year) {
        $payments = Payment::whereRaw("strftime('%Y', created_at) = ?", [2024])
                    ->selectRaw("strftime('%m', created_at) as month, SUM(amount) as total_amount")
                    ->groupBy(DB::raw("strftime('%m', created_at)"))
                    ->orderBy(DB::raw("strftime('%m', created_at)"))
                    ->get();

        return $payments;
    }
}
