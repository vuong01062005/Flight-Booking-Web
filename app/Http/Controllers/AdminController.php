<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactList;
use App\Models\CustomerList;
use App\Models\FlightList;
use App\Models\FlightChairList;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function checkFlightCode(Request $request) {
        $flight_code = $request->input('flight_code');

        if (!str_starts_with($flight_code, 'FL')) {
            return response()->json([
                'message' => "Mã chuyến bay phải bắt đầu bằng 'FL'.",
                'status' => 400
            ]);
        }

        $exists = FlightList::where('flight_code', $flight_code)->exists();

        if ($exists) {
            return response()->json([
                'message' => "Mã chuyến bay đã tồn tại.",
                'status' => 409
            ]);
        }
    
        return response()->json([
            'message' => "Mã chuyến bay hợp lệ.",
            'status' => 200
        ]);
    }

    public function add_flight(Request $request) {
        $flight_code = $request->post('flight_code');
        $departure_str = $request->post('departure_city');
        list($departure_city, $departure_cityName) = !empty($departure_str) ? explode(' ', $departure_str, 2) : ['', ''];
        $arrival_str = $request->post('arrival_city');
        list($arrival_city, $arrival_cityName) = !empty($arrival_str) ? explode(' ', $arrival_str, 2) : ['', ''];
        $departure_date = $request->post('departure_date');
        $departure_time = $request->post('departure_time');
        $arrival_time = $request->post('arrival_time');
        $time = $request->post('time');
        $airline = $request->post('airline');
        $aircraft = $request->post('aircraft');
        $business_Adult = $request->post('business_Adult');
        $business_Child = $request->post('business_Child');
        $business_infant = $request->post('business_infant');
        $prenium_Adult = $request->post('prenium_Adult');
        $prenium_Child = $request->post('prenium_Child');
        $prenium_infant = $request->post('prenium_infant');
        $Economy_Adult = $request->post('Economy_Adult');
        $Economy_Child = $request->post('Economy_Child');
        $Economy_infant = $request->post('Economy_infant');

        $flight_lists = new FlightList();
        $flight_chair_lists = new FlightChairList();

        if ($aircraft == 'A321') {
            for ($i = 1; $i <= 2; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
            }
            for ($i = 1; $i <= 30; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
            }
        
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A31', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B31', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C31', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D31', $Economy_Adult, $Economy_Child, $Economy_infant);

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        } else if ($aircraft == 'A320') {
            for ($i = 1; $i <= 2; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
            }
            for ($i = 1; $i <= 27; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
            }

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        } else if ($aircraft == 'Boeing737') {
            for ($i = 1; $i <= 33; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
            }
        
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A34', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B34', $Economy_Adult, $Economy_Child, $Economy_infant);

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        } else if ($aircraft == 'Boeing787') {
            for ($i = 1; $i <= 7; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
            }
        
            for ($i = 1; $i <= 5; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'A6', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'B6', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'C6', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'D6', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'E6', $prenium_Adult, $prenium_Child, $prenium_infant);
        
            for ($i = 1; $i <= 35; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'I36', $Economy_Adult, $Economy_Child, $Economy_infant);

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        } else if ($aircraft == 'A350') {
            for ($i = 1; $i <= 7; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A8', $business_Adult, $business_Child, $business_infant);
        
            for ($i = 1; $i <= 7; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'A8', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'B8', $prenium_Adult, $prenium_Child, $prenium_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'C8', $prenium_Adult, $prenium_Child, $prenium_infant);
        
            for ($i = 1; $i <= 38; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'I39', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'J39', $Economy_Adult, $Economy_Child, $Economy_infant);
            $flight_chair_lists->addFlightChairList($flight_code, 'Economy Class', 'K39', $Economy_Adult, $Economy_Child, $Economy_infant);

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        } else if ($aircraft == 'A330') {
            for ($i = 1; $i <= 7; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
            }
            $flight_chair_lists->addFlightChairList($flight_code, 'Business Class', 'A8', $business_Adult, $business_Child, $business_infant);
        
            for ($i = 1; $i <= 40; $i++) {
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
                $flight_chair_lists->addFlightChairList($flight_code, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
            }

            $flight_lists->addFlightList($flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $departure_date, $airline, $aircraft);
        }

        return redirect('/admin');
    }

    public function getCustomerTicketByID($id) {
        $CustomerList = new CustomerList();
        $customers = $CustomerList->customerListByID($id);
        return view('admin.customer_ticket', compact('customers'));
    }

    public function getCustomerTicket() {
        $CustomerList = new CustomerList();
        $customers = $CustomerList->customerList();
        return view('admin.customer_ticket', compact('customers'));
    }

    public function getCustomerContactByID($id) {
        $ContactList = new ContactList();
        $contacts = $ContactList->customerContactListByID($id);

        return view('admin.customer_contact', compact('contacts'));
    }
}
