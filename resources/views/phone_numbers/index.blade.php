@extends('layouts.app')

@section('title','Phone Numbers')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Phone Numbers</div>
                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($phone_numbers->count())
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>GUID</th>
                                    <th>Input</th>
                                    <th>Output</th>
                                    <th>State</th>
                                    <th>Correction</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($phone_numbers as $phone_number)
                                    <tr>
                                        <td>{{ $phone_number->guid }}</td>
                                        <td>{{ $phone_number->input }}</td>
                                        <td>{{ $phone_number->output }}</td>
                                        <td>{{ $phone_number->state }}</td>
                                        <td>{{ $phone_number->correction }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        There are {{ $phone_number->count() }} records.
                    @else
                        <span>There are no mobile numbers imported yet. Please go to the <a href="/home">Dashboard</a> to import some.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection