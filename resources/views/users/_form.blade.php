<div class="panel-body">
    <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', ]) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            <label for="connection-type">Usergroup</label>
            {{ Form::select('user_group_id', $usergroups, null, ['class' => 'form-control', 'placeholder' => 'Select User Group', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            <label for="connection-type">Account Status</label>
            {{ Form::select('status', $model->userStatus, null, ['class' => 'form-control', 'placeholder' => 'Select Status', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            <div class="hidden editPassword">
                <input type="checkbox" class="editPassCb" name="checkpassword"> Edit Password
            </div>
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
        {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Save Role', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
    </div>
</div>