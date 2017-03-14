<?php

namespace App\Http\Controllers;

use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Facades\ {
    App\Number
};

class FileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {

        $this->validator($request->all())->validate();

        $stored_file = $request->csv->store('uploads');
        $handle = fopen(storage_path() . '/app/' . $stored_file, "r");
        fgetcsv($handle); // Skip first line

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $result = Number::check($data[1]);
            PhoneNumber::updateOrCreate(
                [
                    'guid' => $data[0]
                ],
                [
                    'input'      => $data[1],
                    'output'     => $result['output'],
                    'state'      => $result['state'],
                    'correction' => $result['correction']
                ]
            );
        }
        fclose($handle);
        return redirect()->action('PhoneNumbersController@index')->with('status', 'File uploaded');

    }

    protected function validator(array $data)
    {
        $messages = [
            'csv.required' => 'Please browse for a CSV file',
        ];
        return Validator::make($data, [
            'csv' => 'required',
        ], $messages);
    }

}
