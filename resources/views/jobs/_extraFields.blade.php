<div class="db_action_cloneable hidden">
    <div class="panel panel-default triggerItemHolder">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent=".accordion" href="#generatedId">Database Action</a>
            </h4>
        </div>
        <div id="generatedId" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="db_action">
                    <div class="form-group">
                        <label for="connection-type">Connection</label>
                        {{ Form::hidden('actions[generatedId][action_type_id]', 1) }}
                        {{ Form::select('actions[generatedId][triggerable][connection_id]', $connections, null, ['class' => 'form-control', 'required' => 'required','placeholder' => 'Select Database Connection']) }}
                        <small class="text-danger hidden"></small>
                    </div>
                    <div class="form-group">
                        {{ Form::checkbox ('actions[generatedId][triggerable][is_csv]', 'T', ['class' => 'form-control']) }}
                        {{ Form::label('is_csv', 'Export to CSV?') }}
                    </div>
                    <div class="form-group">
                        

                        {{ Form::label('query', 'Query') }}
                        {{ Form::textarea ('actions[generatedId][triggerable][query]', null, ['class' => 'form-control', 'required' => 'required']) }}
                            <small class="text-danger hidden"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>