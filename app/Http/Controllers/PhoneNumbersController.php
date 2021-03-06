<?php

namespace App\Http\Controllers;

use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use Facades\ {
    App\Number
};

class PhoneNumbersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $phone_numbers = PhoneNumber::orderBy('output', 'desc')->paginate();
        return view('phone_numbers.index', compact('phone_numbers'));
    }

    public function test(Request $request) {
        $this->validator($request->all())->validate();
        $result = Number::check($request->number);
        $state = $result['state'];
        if ($state == 'error') $state = 'danger'; // Convert to Bootstrap friendly status
        return redirect('/home')
            ->with('state', $state)
            ->with('correction', $result['correction'])
            ->with('output', $result['output']);
    }

    public function api($number) {
        return json_encode(Number::check($number));
    }

    public function download() {
        $table = PhoneNumber::where('state', 'success')->get();
        $filename = "mobile_numbers.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['id', 'number']);
        foreach($table as $row) {
            fputcsv($handle, [
                $row['guid'],
                $row['output'],
            ]);
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, $filename, $headers);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'number' => 'required',
        ]);
    }

}
