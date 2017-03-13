<div class="panel-body">
    <div class="form-group">
            {{ Form::label('name', 'Group Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('description', 'Group Description') }}
            {{ Form::textarea ('description', null, ['class' => 'form-control']) }}
            <small class="text-danger hidden"></small>
    </div>
    
    <div class="form-group">
        {{ Form::button('<i class="fa fa-plus"></i> Save Group', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
    </div>
</div>