@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                {{--@include('_partials.logged_in')--}}

                @include('_partials.file_uploader')

                @include('_partials.number_tester')

            </div>
        </div>
    </div>
@endsection

