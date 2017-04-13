

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Scheduling Settings</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <input type="checkbox" name="scheduler[everday][exists]" value="T"> Job should run everyday
        </div>
        
        <div class="form-group">
            <input type="checkbox" value="T" name="scheduler[weekly][exists]" class="toggleItem" data-toggle="weekly_schedule"> 
            Job <select name="scheduler[weekly][should_run]">
                <option value="T">should</option>
                <option value="F">should not</option>
            </select> run on a specific weekday
        </div>
        <div class="weekly_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Week Days</h3>
                </div>
                <div class="panel-body">
                    <select class="multiple-select" name="scheduler[weekly][list][]" multiple="multiple">
                        <option value="7">Sunday</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <input type="checkbox" value="T" name="scheduler[spmd][exists]" class="toggleItem" data-toggle="smd_schedule">
            Job <select name="scheduler[spmd][should_run]">
                <option value="T">should</option>
                <option value="F">should not</option>
            </select>
            run on a specific days in any month
        </div>
        <div class="smd_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Month Days</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Days of Month</strong></p>
                    <div class="showMonthDaysBtns btnPadding extraMargin"></div>
                    <p><strong>Days from end of Month</strong></p>
                    <div class="showDaysOfLast btnPadding"></div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <input type="checkbox" value="T" class="toggleItem" name="scheduler[months][exists]" data-toggle="monthly_schedule">
            Job <select name="scheduler[months][should_run]">
                    <option value="T">should</option>
                    <option value="F">should not</option>
                </select>
                run in a specific months
        </div>
        <div class="monthly_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Specific Month Days</h3>
                </div>
                <div class="panel-body">
                    <select class="multiple-select" name="scheduler[months][list][]" multiple="multiple">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <input type="checkbox" value="T" name="scheduler[days][exists]" class="toggleItem" data-toggle="specific_schedule">
            Job <select name="scheduler[days][should_run]">
                    <option value="T">should</option>
                    <option value="F">should not</option>
            </select>
            run in a specific dates
        </div>
        <div class="specific_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Specific Month Days</h3>
                </div>
                <div class="panel-body">
                    <input type='text' name="scheduler[days][list]" class='datetimepicker form-control' />
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="panel panel-default">-->
<!--    <div class="panel-heading">-->
<!--        <h3 class="panel-title">Rerun Options</h3>-->
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        <div class="form-group">-->
<!--            <input type="checkbox"> Rerun the job-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->




