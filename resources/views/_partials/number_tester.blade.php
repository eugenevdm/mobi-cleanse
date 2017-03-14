<div class="panel panel-default">
    <div class="panel-heading">Mobile Number Tester</div>
    <div class="panel-body">
        Input a mobile number in the +{{ config('app.calling_code') }} calling code and see it's validity<br>
        <br>
        <form method="POST" action="{{ action('PhoneNumbersController@test') }}"
        class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">

                <label for="number" class="col-md-2 control-label">Number</label>
                <div class="col-md-8">
                    <input type="text" name="number" class="form-control" title="" value="{{ session('output') }}">
                </div>
                @if ($errors->has('number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                @endif

            </div>

            @if (session('state'))
                <div class="alert alert-{{ session('state') }}">
                    {{ session('correction') }}
                </div>
            @endif

            <input class="btn btn-default" type="submit" value="Test">
        </form>
    </div>
</div>