<div class="scheduler">
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
                <md-option ng-value="T">Should</md-option>
                <md-option ng-value="F">Shouldn't</md-option>
            </md-select>
        </md-input-container> run on a specific weekday
    </md-input-container>
    <md-input-container  class="md-block" ng-show="job.scheduler.weekly.exists == 'T'">
        <label>Select Weekdays</label>
        <md-select ng-model="job.scheduler.weekly.list" multiple="true">
            <md-option value="7">Sunday</md-option>
            <md-option value="1">Monday</md-option>
            <md-option value="2">Tuesday</md-option>
            <md-option value="3">Wednesday</md-option>
            <md-option value="4">Thursday</md-option>
            <md-option value="5">Friday</md-option>
            <md-option value="6">Saturday</md-option>
        </md-select>
    </md-input-container>
    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.spmd.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.spmd.should_run" class="inline-flex">
                <md-option ng-value="T">Should</md-option>
                <md-option ng-value="F">Shouldn't</md-option>
            </md-select>
        </md-input-container> run on a specific weekday
    </md-input-container>
    <md-input-container  class="md-block" ng-show="job.scheduler.spmd.exists == 'T'">
        
        <strong>Days of Month</strong>
        <div class="spmdlist">
            <md-button ng-class="{'md-raised': true, 'md-primary': spmdSchedulers.indexOf(n) != -1}" ng-repeat="n in range(1, 31)" ng-click="addDay(n, job)">{{n}}</md-button>
        </div>
        <strong>Days from end of Month</strong>
        <div class="spmdlist">
            <md-button ng-class="{'md-raised': true, 'md-primary': spmdSchedulers.indexOf(n) != -1}" ng-repeat="n in range(-10, -1)" ng-click="addDay(n, job)">{{n}}</md-button>
        </div>
        
    </md-input-container>
    
    <md-input-container  class="md-block">
        <md-checkbox name="runeveryday" ng-true-value="'T'" ng-false-value="'F'" ng-model="job.scheduler.months.exists"></md-checkbox>
        Job 
        <md-input-container>
            <md-select ng-model="job.scheduler.months.should_run" class="inline-flex">
                <md-option ng-value="T">Should</md-option>
                <md-option ng-value="F">Shouldn't</md-option>
            </md-select>
        </md-input-container> run in specific months
    </md-input-container>
    
    <md-input-container  class="md-block" ng-show="job.scheduler.months.exists == 'T'">
        <label>Select Month</label>
        <md-select ng-model="job.scheduler.months.list" multiple="true">
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
</div>