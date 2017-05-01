<div class="scheduler">
    <div class="md-block show_form_errors">
        <ul>
            <li ng-repeat="error in formErrors">{{error[0]}}</li>
        </ul>
    </div>
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.everyday.exists">
        Job Should run everyday
        </md-checkbox>
    </md-input-container>
    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.weekly.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.weekly.should_run" class="inline-flex">
                <md-option ng-value="'T'">Should</md-option>
                <md-option ng-value="'F'">Shouldn't</md-option>
            </md-select>
        </md-input-container> run on a specific weekday
    </md-input-container>
    <md-input-container  class="md-block" ng-show="job.scheduler.weekly.exists == 'T'">
        <label>Select Weekdays</label>
        <md-select name="weekdays" ng-model="job.scheduler.weekly.list" multiple="true" ng-required="job.scheduler.weekly.exists == 'T'">
            <md-option value="7">Sunday</md-option>
            <md-option value="1">Monday</md-option>
            <md-option value="2">Tuesday</md-option>
            <md-option value="3">Wednesday</md-option>
            <md-option value="4">Thursday</md-option>
            <md-option value="5">Friday</md-option>
            <md-option value="6">Saturday</md-option>
        </md-select>
        <div class="error_message" ng-show="jobForm.weekdays.$invalid && showFieldErrors">You have missed to select weekdays!</div>

    </md-input-container>
    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.spmd.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.spmd.should_run" class="inline-flex">
                <md-option ng-value="'T'">Should</md-option>
                <md-option ng-value="'F'">Shouldn't</md-option>
            </md-select>
        </md-input-container> run on a specific weekday
    </md-input-container>
    <md-input-container  class="md-block" ng-show="job.scheduler.spmd.exists == 'T'">
        <div class="error_message" ng-show="showSpmdError && showFieldErrors">You have missed to select days!</div>
        <strong>Days of Month</strong>
        <div class="spmdlist">
            <md-button ng-class="{'md-raised': true, 'md-primary': job.scheduler.spmd.list.indexOf(n) != -1}" ng-repeat="n in range(1, 31)" ng-click="addDay(n)">{{n}}</md-button>
        </div>
        <strong>Days from end of Month</strong>
        <div class="spmdlist">
            <md-button ng-class="{'md-raised': true, 'md-primary': job.scheduler.spmd.list.indexOf(n) != -1}" ng-repeat="n in range(-10, -1)" ng-click="addDay(n)">{{n}}</md-button>
        </div>
    </md-input-container>
    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.months.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.months.should_run" class="inline-flex">
                <md-option ng-value="'T'">Should</md-option>
                <md-option ng-value="'F'">Shouldn't</md-option>
            </md-select>
        </md-input-container> run in specific months
    </md-input-container>
    
    <md-input-container  class="md-block" ng-show="job.scheduler.months.exists == 'T'">
        <label>Select Month</label>
        <md-select name="months" ng-model="job.scheduler.months.list" multiple="true" ng-required="job.scheduler.months.exists == 'T'">
            <md-option value="1">January</md-option>
            <md-option value="2">February</md-option>
            <md-option value="3">March</md-option>
            <md-option value="4">April</md-option>
            <md-option value="5">May</md-option>
            <md-option value="6">June</md-option>
            <md-option value="7">July</md-option>
            <md-option value="8">August</md-option>
            <md-option value="9">September</md-option>
            <md-option value="10">October</md-option>
            <md-option value="11">November</md-option>
            <md-option value="12">December</md-option>
        </md-select>
    </md-input-container>
    <div class="error_message" ng-show="jobForm.months.$invalid && showFieldErrors">You have missed to select months!</div>

    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.days.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.days.should_run" class="inline-flex">
                <md-option ng-value="'T'">Should</md-option>
                <md-option ng-value="'F'">Shouldn't</md-option>
            </md-select>
        </md-input-container> run in specific day
    </md-input-container>
    
    
    <div  ng-show="job.scheduler.days.exists == 'T'">
        <div class="md-block" ng-repeat="date in job.scheduler.days.list track by $index">
            <md-input-container flex="50">
                <md-datepicker md-placeholder="Select Date" 
                    ng-model="job.scheduler.days.list[$index]"
                    md-current-view="month"
                    md-date-locale="specificDaysFormat">
                </md-datepicker>
            </md-input-container>
            <md-input-container flex="50">
                <md-button class="md-icon-button" aria-label="Delete" ng-click="removeDate($index)">
                    <md-icon md-svg-icon="/assets/images/delete.svg"></md-icon>
                </md-button>
            </md-input-container>
            </div>
        <div class="error_message" ng-show="showDaysError && showFieldErrors">You have missed to add days!</div>
        <md-button class="md-raised md-primary" ng-click="addNewDate()">Add New Date</md-button>
    </div>
</div>
