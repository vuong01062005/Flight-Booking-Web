<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactList;
use App\Models\CustomerList;
use DateTime;
use Illuminate\Http\Request;
use App\Models\FlightChairList;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function edit_profile()
    {
        return view('edit_profile');
    }

    public function flight_list(Request $request) {
        $userID = session('userID');
        $firstName = session('firstName');
        $lastName = session('lastName');
        $avatar = session('avatar');
        $from = $request->query('from');
        $to = $request->query('to');
        $departure = $request->query('departure');
        $chairType = $request->query('chairType');

        $return_date = '';
        if ($request->has('return-check') && $request->query('return-check') == 'on') {
            $return_date = $request->query('return_date', '');
        }
        $countAdult = $request->query('countAdult');
        $countChild = $request->query('countChild');
        $countInfant = $request->query('countInfant');
        $count_ticket = intval($countAdult) + intval($countChild) + intval($countInfant);

        return view('flight_list', compact(
            'userID',
            'firstName',
            'lastName',
            'avatar',
            'from',
            'to',
            'departure',
            'chairType',
            'return_date',
            'countAdult',
            'countChild',
            'countInfant',
            'count_ticket',
        ));
    }

    public function formatVietnameseDate($date) {
        $datedep = new DateTime($date);

        $daydep = $datedep->format('d');
        $monthdep = $datedep->format('m');
        $yeardep = $datedep->format('Y');

        $daysOfWeek = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
        $dayOfWeekdep = $daysOfWeek[$datedep->format('w')];

        return "$dayOfWeekdep, $daydep thg $monthdep $yeardep";
    }

    public function form_info(Request $request) {
        $countAdult = $request->query('countAdult');
        $countChild = $request->query('countChild');
        $countInfant = $request->query('countInfant');
        $fromName = $request->query('fromName');
        $toName = $request->query('toName');
        $date = $request->query('date');
        $airline = $request->query('airline');
        $chairType = $request->query('chairType');
        $from = $request->query('from');
        $to = $request->query('to');
        $time = $request->query('time');
        $departure_time = $request->query('departure_time');
        $arrival_time = $request->query('arrival_time');

        $return_date = $request->query('return_date');
        $airlineReturn = $request->query('airlineReturn');
        $flight_code = $request->query('flight_code');
        $flight_codeReturn = $request->query('flight_codeReturn');
        $price = $request->query('price');

        return view('form_info', compact(
            'countAdult',
            'countChild',
            'countInfant',
            'fromName',
            'toName',
            'date',
            'airline',
            'chairType',
            'from',
            'to',
            'time',
            'departure_time',
            'arrival_time',
            'return_date',
            'airlineReturn',
            'flight_code',
            'flight_codeReturn',
            'price',
        ));
    }

    public function pay(Request $request) {
        $contact_firstName = $request->input('contact_firstName');
        $contact_lastName = $request->input('contact_lastName');
        $contact_phone = $request->input('contact_phone');
        $contact_email = $request->input('contact_email');
        $countAdult = $request->input('countAdult');
        $countChild = $request->input('countChild');
        $countInfant = $request->input('countInfant');

        $title_Adult = [];
        $firstName_Adult = [];
        $lastName_Adult = [];
        $day_Adult = [];
        $month_Adult = [];
        $year_Adult = [];
        $nation_Adult = [];
        $chair_Adult = [];
        $chair_AdultReturn = [];
        for ($i=0; $i < $countAdult; $i++) { 
            $title_Adult[$i] = $request->input('title_Adult'.$i);
            $firstName_Adult[$i] = $request->input('firstName_Adult'.$i);
            $lastName_Adult[$i] = $request->input('lastName_Adult'.$i);
            $day_Adult[$i] = $request->input('day_Adult'.$i);
            $month_Adult[$i] = $request->input('month_Adult'.$i);
            $year_Adult[$i] = $request->input('year_Adult'.$i);
            $nation_Adult[$i] = $request->input('nation_Adult'.$i);

            $chair_Adult[$i] = $request->input('chair_Adult'.$i);
            $chair_AdultReturn[$i] = $request->input('chair_Adult'. $i. 'Return');
        }

        $title_Child = [];
        $firstName_Child = [];
        $lastName_Child = [];
        $day_Child = [];
        $month_Child = [];
        $year_Child = [];
        $nation_Child = [];
        $chair_Child = [];
        $chair_ChildReturn = [];
        for ($i=0; $i < $countChild; $i++) {
            $title_Child[$i] = $request->input('title_Child'.$i);
            $firstName_Child[$i] = $request->input('firstName_Child'.$i);
            $lastName_Child[$i] = $request->input('lastName_Child'.$i);
            $day_Child[$i] = $request->input('day_Child'.$i);
            $month_Child[$i] = $request->input('month_Child'.$i);
            $year_Child[$i] = $request->input('year_Child'.$i);
            $nation_Child[$i] = $request->input('nation_Child'.$i);

            $chair_Child[$i] = $request->input('chair_Child'.$i);
            $chair_ChildReturn[$i] = $request->input('chair_Child'. $i. 'Return');
        }

        $title_Infant = [];
        $firstName_Infant = [];
        $lastName_Infant = [];
        $day_Infant = [];
        $month_Infant = [];
        $year_Infant = [];
        $nation_Infant = [];
        $chair_Infant = [];
        $chair_InfantReturn = [];
        for ($i=0; $i < $countInfant; $i++) {
            $title_Infant[$i] = $request->input('title_Infant'.$i);
            $firstName_Infant[$i] = $request->input('firstName_Infant'.$i);
            $lastName_Infant[$i] = $request->input('lastName_Infant'.$i);
            $day_Infant[$i] = $request->input('day_Infant'.$i);
            $month_Infant[$i] = $request->input('month_Infant'.$i);
            $year_Infant[$i] = $request->input('year_Infant'.$i);
            $nation_Infant[$i] = $request->input('nation_Infant'.$i);

            $chair_Infant[$i] = $request->input('chair_Infant'.$i);
            $chair_InfantReturn[$i] = $request->input('chair_Infant'. $i. 'Return');
        }
        
        $flight_code = $request->input('flight_code');
        $flight_codeReturn = $request->input('flight_codeReturn');
        $price = $request->input('price');
        $chairType = $request->input('chairType');

        return view('pay', compact(
            'contact_firstName',
            'contact_lastName',
            'contact_phone',
            'contact_email',
            'countAdult',
            'countChild',
            'countInfant',

            'title_Adult',
            'firstName_Adult',
            'lastName_Adult',
            'day_Adult',
            'month_Adult',
            'year_Adult',
            'nation_Adult',
            'chair_Adult',
            'chair_AdultReturn',

            'title_Child',
            'firstName_Child',
            'lastName_Child',
            'day_Child',
            'month_Child',
            'year_Child',
            'nation_Child',
            'chair_Child',
            'chair_ChildReturn',

            'title_Infant',
            'firstName_Infant',
            'lastName_Infant',
            'day_Infant',
            'month_Infant',
            'year_Infant',
            'nation_Infant',
            'chair_Infant',
            'chair_InfantReturn',

            'flight_code',
            'flight_codeReturn',
            'price',
            'chairType',
        ));
    }

    public function updateChair(Request $request) {
        $FlightChairList = new FlightChairList();

        $flightCode = $request->input('flight_code');
        $flight_codeReturn = $request->input('flight_codeReturn');
        $chairType = $request->input('chair_type');
        $chairNumbers = explode(',', $request->input('chair_numbers'));
        $chairReturnNumbers = explode(',', $request->input('chairReturnNumbers'));
        $status = $request->input('status');

        try {
            foreach ($chairNumbers as $chairNumber) {
                $FlightChairList->reservations($status, $flightCode, $chairType, [$chairNumber]);
            }
            foreach ($chairReturnNumbers as $chairReturnNumber) {
                $FlightChairList->reservations($status, $flight_codeReturn, $chairType, [$chairReturnNumber]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Ghế đã được hủy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function booking_ticket(Request $request) {
        $ContactList = new ContactList();
        $CustomerList = new CustomerList();
        $FlightChairList = new FlightChairList();

        $request->validate([
            'userID' => 'required',
            'contact_firstName' => 'required',
            'contact_lastName' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'image_transfer' => 'required',
            'customer_type' => 'required',

            'customerAdult' => 'required',
            'customerChild' => 'required',
            'customerInfant' => 'required',
            'chairAdultReturn' => 'required',
            'chairChildReturn' => 'required',
            'chairInfantReturn' => 'required',

            'flight_code' => 'required',
            'flight_codeReturn' => 'required',
        ]);

        if ($request->hasFile('image_transfer')) {
            $icon = $request->file('image_transfer')->store('images', 'public');
        } else {
            return response()->json([
                'message' => 'Cần phải có file ảnh.'
            ]);
        }

        try {

            $contact_id = $ContactList->addContact($request->userID, $request->contact_firstName, $request->contact_lastName, $request->contact_phone, $request->contact_email, $icon);

            $customerAdults = json_decode($request->customerAdult);
            $chairAdultReturns = json_decode($request->chairAdultReturn);
            if (is_array($customerAdults)) {
                foreach ($customerAdults as $key => $customer) {
                    $CustomerList->addCustomer(
                        $contact_id,
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                    );

                    $FlightChairList->reservations(
                        'Đã đặt',
                        $request->flight_code,
                        $request->customer_type,
                        $customer->chair
                    );

                    if (isset($request->flight_codeReturn)) {
                        $CustomerList->addCustomer(
                            $contact_id,
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairAdultReturns[$key]->chair
                        );

                        $FlightChairList->reservations(
                            'Đã đặt',
                            $request->flight_codeReturn,
                            $request->customer_type,
                            $chairAdultReturns[$key]->chair
                        );
                    }
                }
            }

            $customerChilds = json_decode($request->customerChild);
            $chairChildReturns = json_decode($request->chairChildReturn);
            if (is_array($customerChilds)) {
                foreach ($customerChilds as $key => $customer) {
                    $CustomerList->addCustomer(
                        $contact_id,
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                    );

                    

                    $FlightChairList->reservations(
                        'Đã đặt',
                        $request->flight_code,
                        $request->customer_type,
                        $customer->chair
                    );

                    if (isset($request->flight_codeReturn)) {
                        $CustomerList->addCustomer(
                            $contact_id,
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairChildReturns[$key]->chair
                        );

                        $FlightChairList->reservations(
                            'Đã đặt',
                            $request->flight_codeReturn,
                            $request->customer_type,
                            $chairChildReturns[$key]->chair
                        );
                    }
                }
            }

            $customerInfants = json_decode($request->customerInfant);
            $chairInfantReturns = json_decode($request->chairInfantReturn);
            if (is_array($customerInfants)) {
                foreach ($customerInfants as $key => $customer) {
                    $CustomerList->addCustomer(
                        $contact_id,
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                    );

                    

                    $FlightChairList->reservations(
                        'Đã đặt',
                        $request->flight_code,
                        $request->customer_type,
                        $customer->chair
                    );

                    if (isset($request->flight_codeReturn)) {
                        $CustomerList->addCustomer(
                            $contact_id,
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairInfantReturns[$key]->chair
                        );

                        $FlightChairList->reservations(
                            'Đã đặt',
                            $request->flight_codeReturn,
                            $request->customer_type,
                            $chairInfantReturns[$key]->chair
                        );
                    }
                }
            }

            return response()->json(['message' => 'Booking successful'], 200);
        } catch (\Exception $e) {
            Log::error('Database query failed: ' . $e->getMessage());
            return response()->json(['error' => 'Booking failed'], 500);
        }
    }
}
