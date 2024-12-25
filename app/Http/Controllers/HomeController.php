<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountUser;
use App\Models\ContactList;
use App\Models\CustomerList;
use DateTime;
use Illuminate\Http\Request;
use App\Models\FlightChairList;
use App\Models\FlightList;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function edit_profile($id)
    {
        $AccountUser = new AccountUser();
        $user = $AccountUser->getAccount($id);

        return view('edit_profile', compact('user'));
    }

    public function flight_list(Request $request) {
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
        $departure_city = $request->input('departure_city');
        $arrival_city = $request->input('arrival_city');
        $flight_codeReturn = $request->input('flight_codeReturn');
        $price = $request->input('price');
        $chairType = $request->input('chairType');

        $ContactList = new ContactList();
        $bookingCode = $ContactList->getBookingCode()->booking_code;
        $bookingCode += 1;

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
            'departure_city',
            'arrival_city',
            'flight_codeReturn',
            'price',
            'chairType',
            'bookingCode'
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
        $Payment = new Payment();
        $AccountUser = new AccountUser();

        $request->validate([
            'userID' => 'required',
            'contact_firstName' => 'required',
            'contact_lastName' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'image_transfer' => 'nullable',
            'customer_type' => 'required',

            'customerAdult' => 'required',
            'customerChild' => 'required',
            'customerInfant' => 'required',
            'chairAdultReturn' => 'required',
            'chairChildReturn' => 'required',
            'chairInfantReturn' => 'required',

            'flight_code' => 'required',
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'flight_codeReturn' => 'nullable',

            'price' => 'required',
            'method' => 'required',
            'booking_code' => 'required'
        ]);

        $sub = $request->price;
        if ($request->hasFile('image_transfer')) {
            $icon = $request->file('image_transfer')->store('images', 'public');
            $contact_id = $ContactList->addContact($request->userID, $request->contact_firstName, $request->contact_lastName, $request->contact_phone, $request->contact_email, $icon, $request->booking_code, $request->departure_city, $request->arrival_city, 'Chưa bay');
        } else {
            $wallet = $AccountUser->getWalletbyID($request->userID);
            $wallet = (int) str_replace('.', '', $wallet);
            $price = (int) str_replace('.', '', $request->price);

            if ($wallet < $price) {
                return response()->json([
                    'message' => 'Tiền trong ví của bạn không đủ để thanh toán',
                ]);
            }
            $sub = number_format($wallet - $price, 0, '', '.');
            $contact_id = $ContactList->addContact($request->userID, $request->contact_firstName, $request->contact_lastName, $request->contact_phone, $request->contact_email, '', $request->booking_code, $request->departure_city, $request->arrival_city, 'Chưa bay');
        }

        try {
            $Payment->addPayment($contact_id, $sub, date('Y-m-d'), $request->method);

            $customerAdults = json_decode($request->customerAdult);
            $chairAdultReturns = json_decode($request->chairAdultReturn);
            if (is_array($customerAdults)) {
                foreach ($customerAdults as $key => $customer) {
                    $CustomerList->addCustomer(
                        $contact_id,
                        'Người lớn',
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                        $customer->nation,
                        0
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
                            'Người lớn',
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairAdultReturns[$key]->chair,
                            $customer->nation,
                            1
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
                        'Trẻ em',
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                        $customer->nation,
                        0
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
                            'Trẻ em',
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairChildReturns[$key]->chair,
                            $customer->nation,
                            1
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
                        'Sơ sinh',
                        $request->customer_type,
                        $customer->title,
                        $customer->firstName,
                        $customer->lastName,
                        $customer->birthday,
                        $request->flight_code,
                        $customer->chair,
                        $customer->nation,
                        0
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
                            'Sơ sinh',
                            $request->customer_type,
                            $customer->title,
                            $customer->firstName,
                            $customer->lastName,
                            $customer->birthday,
                            $request->flight_codeReturn,
                            $chairInfantReturns[$key]->chair,
                            $customer->nation,
                            1
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

            return response()->json([
                'message' => 'Đặt vé thành công',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Database query failed: ' . $e->getMessage());
            return response()->json(['error' => 'Booking failed'], 500);
        }
    }


    public function updateInfo(Request $request, $id) {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $acc = new AccountUser();
        $acc->updateInfo($id, $request->fname, $request->lname, $request->phone, $request->email);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }

    public function updateAvatar(Request $request, $id) {
        $request->validate([
            'avatar' => 'required',
        ]);
        $acc = new AccountUser();
        if ($request->hasFile('avatar')) {
            $icon = $request->file('avatar')->store('images', 'public');
            $acc->updateAvatar($id, $icon);
            session(['avatar' => $icon]);
            return redirect()->back()->with('success', 'Cập nhật ảnh thành công.');
        }

        return redirect()->back()->with('error', 'Cần phải có file ảnh.');
    }

    public function updatePass(Request $request, $id) {
        $request->validate([
            'new_pass' => 'required',
            'confirm_pass' => 'required',
        ]);

        if ($request->new_pass !== $request->confirm_pass) {
            return redirect()->back()->with('error', 'Mật khẩu không khớp nhau.');
        }

        $acc = new AccountUser();
        $acc->updatePass($id, bcrypt($request->new_pass));
        return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công');
    }

    public function my_bookings($id) {
        $ContactList = new ContactList();
        $CustomerList = new CustomerList();
        $FlightList = new FlightList();

        $myBookings = $ContactList->getIDbyUserIDAccount($id);
        $tickets = [];
        foreach ($myBookings as $booking) {
            $tickets[] = $CustomerList->getMybookingsByIDContact($booking->id)->toArray();
        }
        return view('my_bookings', compact('myBookings', 'tickets'));
    }

    public function transactionList($id) {
        $Payment = new Payment();
        $ContactList = new ContactList();

        $contacts = $ContactList->getIDbyUserIDAccount($id);
        $payments = [];
        foreach ($contacts as $contact) {
            $payments[] = $Payment->getPayment($contact->id)->toArray();
        }
        return view('transaction_list', compact('payments', 'contacts'));
    }

    public function filterTransactions(Request $request)
    {
        $date = $request->input('date');
        $ID_account = $request->input('ID_account');

        try {
            $Payment = new Payment();
            $ContactList = new ContactList();

            $contacts = $ContactList->getIDbyUserIDAccount($ID_account);
            $payments = [];
            foreach ($contacts as $contact) {
                $payments[] = $Payment->getPaymentByDate($contact->id, $date)->toArray();
            }
            
            return response()->json([
                'status' => 'success',
                'payments' => $payments,
                'contacts' => $contacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function changeTicket($id, $date) {
        $CustomerList = new CustomerList();
        $FlightList = new FlightList();

        $customers = $CustomerList->getCustomerFlightByID($id);

        $flights = $FlightList->get_flights($customers->departure_city, $customers->arrival_city, $date, $customers->customer_type);
        return view('changeTicket.flight_list', compact('customers', 'flights'));
    }
    
    public function filterFlight(Request $request) {
        $FlightList = new FlightList();

        $departure = $request->input('departure');
        $arrival = $request->input('arrival');
        $date = $request->input('date');
        $customer_type = $request->input('customer_type');

        try {
            $flights = $FlightList->get_flights($departure, $arrival, $date, $customer_type);
            return response()->json([
                'success' => true,
                'flights' => $flights]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function changeTicketInfo($customer_id, $flight_id) {
        $CustomerList = new CustomerList();
        $ContactList = new ContactList();
        $FlightList = new FlightList();

        $customers = $CustomerList->getCustomerFlightByID($customer_id);
        $flight = $FlightList->flightByID($flight_id);

        $contact = $ContactList->getContactByID($customers->id_contact);
        return view('changeTicket.form_info', compact('customers', 'contact', 'flight'));
    }

    public function wallet($id) {
        return view('my_wallet', compact('id'));
    }

    public function addPayment(Request $request) {
        $ID_account = $request->input('ID_account');
        $amount = $request->input('amount');
        $method = $request->input('method');

        try {
            $AccountUser = new AccountUser();
            $Payment = new Payment();

            $wallet = $AccountUser->getWalletbyID($ID_account);
            $walletOld = (int) str_replace('.', '', $wallet->wallet);
            $amount = (int) str_replace('.', '', $amount);
            $walletNew = number_format($walletOld + $amount, 0, ',', '.');
            session(['wallet' => $walletNew]);

            $AccountUser->updateWallet($ID_account, $walletNew);

            $Payment->addPayment('', $amount, date('Y-m-d'), $method);
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmChange(Request $request) {
        $customer_id = $request->input('customer_id');
        $titleName = $request->input('titleName');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $nation = $request->input('nation');
        $date = $request->input('date');
        $flight_code = $request->input('flight_code');
        $chair_number = $request->input('chair_number');
        $flight_codeOld = $request->input('flight_codeOld');
        $ticket_type = $request->input('ticket_type');
        $chair_numberOld = $request->input('chair_numberOld');
        $price = $request->input('price');
        $wallet = $request->input('wallet');
        $ID_account = $request->input('ID_account');

        try {
            $CustomerList = new CustomerList();
            $FlightChairList = new FlightChairList();
            $AccountUser = new AccountUser();

            $wallet = (int) str_replace('.', '', $wallet);
            $price = (int) str_replace('.', '', $price);

            $sub = number_format($wallet - $price, 0, '', '.');

            $AccountUser->updateWallet($ID_account, $sub);
            $CustomerList->updateCustomer($customer_id, $titleName, $firstName, $lastName, $date, $flight_code, $chair_number, $nation);
            $FlightChairList->reservations('Chưa đặt', $flight_codeOld, $ticket_type, $chair_numberOld);
            $FlightChairList->reservations('Đã đặt', $flight_code, $ticket_type, $chair_number);
            return response()->json([
                'success' => true,
                'message' => 'Vé của bạn đã được thay đổi thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelTicket(Request $request) {
        $id = $request->input('id');
        $id_account = $request->input('id_account');

        try {
            $CustomerList = new CustomerList();
            $FlightList = new FlightList();
            $AccountUser = new AccountUser();
            $FlightChairList = new FlightChairList();

            $customer = $CustomerList->getCustomerByID($id);
            $flight = $FlightList->getFlightByCode($customer->flight_code);

            $currentDateTime = Carbon::now();
            $flightDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $flight->flight_date . ' ' . $flight->departure_time . ':00');
            $diffInHours = $currentDateTime->diffInHours($flightDateTime, false);
            if ($diffInHours < 12) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vé của bạn không thể hủy vì thời gian bay sắp đến.'
                ]);
            }
            $CustomerList->deleteCustomer($id);

            $wallet = $AccountUser->getWalletbyID($id_account);
            $walletOld = (int) str_replace('.', '', $wallet->wallet);
            $price = 0;
            if ($customer->age_category == 'Người lớn') {
                $pricechair = $FlightChairList->getPrice('price_adult', $customer->flight_code, $customer->customer_type, $customer->chair_number);
                $price = $pricechair->price_adult;
            } elseif ($customer->age_category == 'Trẻ em') {
                $pricechair = $FlightChairList->getPrice('price_child', $customer->flight_code, $customer->customer_type, $customer->chair_number);
                $price = $pricechair->price_child;
            } elseif ($customer->age_category == 'Sơ sinh') {
                $pricechair = $FlightChairList->getPrice('price_infant', $customer->flight_code, $customer->customer_type, $customer->chair_number);
                $price = $pricechair->price_infant;
            }
            $amount = (int) str_replace('.', '', $price);
            $walletNew = number_format($walletOld + $amount, 0, ',', '.');
            $AccountUser->updateWallet($id_account, $walletNew);
            session(['wallet' => $walletNew]);

            return response()->json([
                'success' => true,
                'message' => 'Hủy vé thành công. Số tiền sẽ được trả lại vào ví tiền của bạn. Vào ví của tôi để kiểm tra lại.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
