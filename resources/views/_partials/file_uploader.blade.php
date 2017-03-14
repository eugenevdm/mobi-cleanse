<div class="panel panel-default">
    <div class="panel-heading">CSV File Uploader</div>
    <div class="panel-body">
        Browse for a CSV file and press the upload button<br>
        <br>
        <form id="upload-form" method="POST" action="{{ url('upload') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('csv') ? ' has-error' : '' }}">
                <label class="btn btn-default">
                    Browse <input type="file" id="files" name="csv" style="display: none;">
                </label>
                <output id="filename"></output>
                <div id="help-block">
                    @if ($errors->has('csv'))
                        <span class="help-block">
                            <strong>{{ $errors->first('csv') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <input id="upload-button" class="btn btn-default" type="submit" value="Upload">
        </form>
    </div>
</div>

@push('scripts')
<script>

    function handleFileSelect(evt) {
        document.getElementById('help-block').innerHTML = '';
        var files = evt.target.files;
        document.getElementById('filename').innerHTML = files[0].name;
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);

    $('#upload-form').one('submit', function() {
        $('#upload-button').val('Please wait...');
        $(this).find('input[type="submit"]').attr('disabled','disabled');
    });

</script>
@endpush