<div class="panel-body">
    <!-- New Connection Form -->
    <div class="form-group {{($model->errors()->has('name') ? ' has-error' : '')}}">
            {{ Form::label('name', 'Connection Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            @if ($model->errors()->has('name'))
                <small class="text-danger">{{ $model->errors()->first('name') }}</small>
            @endif
        </div>
    <div class="form-group {{($model->errors()->has('connection_type_id') ? ' has-error' : '')}}">
            <label for="connection-type">Connection Type</label>
            {{ Form::select('connection_type_id', $connection_types, null, ['class' => 'form-control', 'placeholder' => 'Select Type']) }}
            @if ($model->errors()->has('connection_type_id'))
                <small class="text-danger">{{ $model->errors()->first('connection_type_id') }}</small>
            @endif
        </div>
    <div class="form-group {{($model->errors()->has('host') ? ' has-error' : '')}}">
            {{ Form::label('host', 'Host') }}
            {{ Form::text('host', null, ['class' => 'form-control']) }}
            @if ($model->errors()->has('host'))
                <small class="text-danger">{{ $model->errors()->first('host') }}</small>
            @endif
        </div>
    <div class="form-group {{($model->errors()->has('user') ? ' has-error' : '')}}">
            {{ Form::label('user', 'Username') }}
            {{ Form::text('user', null, ['class' => 'form-control' ]) }}
            @if ($model->errors()->has('user'))
                <small class="text-danger">{{ $model->errors()->first('user') }}</small>
            @endif
        </div>
    <div class="form-group {{($model->errors()->has('password') ? ' has-error' : '')}}">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            @if ($model->errors()->has('password'))
                <small class="text-danger">{{ $model->errors()->first('password') }}</small>
            @endif
        </div>
    <div class="form-group">
            {{ Form::button('<i class="fa fa-plus"></i> Add Connection', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
            {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Test Connection', 
                    ['class' => 'btn btn-success']) }}
        </div>
</div> 
