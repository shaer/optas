

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Scheduling Settings</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <input type="checkbox"> Job should run everyday
        </div>
        
        <div class="form-group">
            <input type="checkbox" class="toggleItem" data-toggle="weekly_schedule"> 
            Job <select>
                <option>should</option>
                <option>should not</option>
            </select> run on a specific weekday
        </div>
        <div class="weekly_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Week Days</h3>
                </div>
                <div class="panel-body">
                    <select class="multiple-select" multiple="multiple">
                        <option>Sunday</option>
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option>Saturday</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <input type="checkbox" class="toggleItem" data-toggle="smd_schedule">
            Job 
            <select>
                <option>should</option>
                <option>should not</option>
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
            <input type="checkbox" class="toggleItem" data-toggle="monthly_schedule">
                Job
                <select>
                    <option>should</option>
                    <option>should not</option>
                </select>
                run in a specific months
        </div>
        <div class="monthly_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Specific Month Days</h3>
                </div>
                <div class="panel-body">
                    <select class="multiple-select" multiple="multiple">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <input type="checkbox" class="toggleItem" data-toggle="specific_schedule">
            Job 
            <select>
                <option>should</option>
                <option>should not</option>
            </select>
            run in a specific dates
        </div>
        <div class="specific_schedule hidden">
            <div class="panel panel-default">      
                <div class="panel-heading">
                    <h3 class="panel-title">Select Specific Month Days</h3>
                </div>
                <div class="panel-body">
                    <input type='text' class='datetimepicker form-control' />
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




