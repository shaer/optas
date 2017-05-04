<md-content class="md-padding" layout-xs="column" layout="row" layout-wrap >
    <md-card ng-repeat="(key, job) in jobs" class="jobCard">
        <md-card-header ng-class="{job_running: job.job_status == 'R', job_pending: job.job_status == 'P', job_error: job.job_status == 'F', job_success: job.job_status == 'S', job_disabled: job.is_automated == 'F'}">
            <!--<md-card-avatar>-->
            <!--    <img src="/assets/images/database.svg"/>-->
            <!--</md-card-avatar>-->
            <md-card-header-text>
                <span class="md-title">{{job.name}}</span>
                <span class="job_namespace" ng-bind-html="job.namespace | namespaceFormat"></span>
            </md-card-header-text>
        </md-card-header>
        <md-card-content>
          <ul class="job_run_time">
              <li><span class="last">Last Run:</span> {{job.started_at | dateToISO | date:'EEE, dd MMM HH:mm'}}</li>
              <li><span class="next">Next Run:</span> {{job.next_run_date | dateToISO | date:'EEE, dd MMM HH:mm'}}</li>
          </ul>
          
        </md-card-content>
        
        <md-card-footer  md-colors="{background: 'grey-200'}" class="no-padding">
            <md-card-actions layout="row" layout-align="end center">
              <span>
                  <md-switch ng-model="job.is_automated" aria-label="Enable or Disable the job" ng-true-value="'T'" ng-false-value="'F'" class="md-primary"></md-switch>
                  <md-tooltip>Enable/Disable Job</md-tooltip>
              </span>
              <md-button class="md-icon-button" aria-label="Favorite">
                <md-icon md-svg-icon="/assets/images/run.svg"></md-icon>
                <md-tooltip>Run the job now</md-tooltip>
              </md-button>
              <md-button ng-show="can.edit" class="md-icon-button" aria-label="Settings" ng-click="loadJobDetails(job.id)">
                <md-icon md-svg-icon="/assets/images/edit.svg"></md-icon>
                <md-tooltip>Edit job</md-tooltip>
              </md-button>
              <md-button ng-show="can.delete" class="md-icon-button md-warn md-hue-1" aria-label="Delete" ng-click="deleteJob(job.id)">
                <md-icon md-svg-icon="/assets/images/delete.svg"></md-icon>.
                <md-tooltip>Delete Job</md-tooltip>
              </md-button>
            </md-card-actions>
        </md-card-footer>
    </md-card>
</md-content>


<md-fab-speed-dial class="md-fling md-fab-bottom-right md-hover-full fixed-position" ng-show="can.add">
    <md-fab-trigger>
        <md-button aria-label="Add Job" class="md-fab" ng-click="manageJobDialog($event)">
            <md-icon style="color:#FFF" md-svg-icon="/assets/images/add.svg"></md-icon>
        </md-button>
    </md-fab-trigger>
</md-fab-speed-dial> 