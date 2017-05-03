<md-content class="md-padding" layout-xs="column" layout="row" layout-wrap >
    <md-card ng-repeat="(key, job) in jobs" class="jobCard">
        <md-card-header md-colors="{background: 'teal-50'}">
            <!--<md-card-avatar>-->
            <!--    <img src="/assets/images/database.svg"/>-->
            <!--</md-card-avatar>-->
            <md-card-header-text>
                <span class="md-title">Database Job</span>
                <span class="md-subhead">{{job.name}}</span>
            </md-card-header-text>
        </md-card-header>
        <md-card-content>
          <p>{{job.description}}</p>
          <ul>
              <li>Last Run: {{job.ended_at}}</li>
              <li>Next Run: {{job.next_run_date}}</li>
              <li>Status: {{job.status}}</li>
          </ul>
        </md-card-content>
        
        <md-card-footer  md-colors="{background: 'grey-200'}" class="no-padding">
            <md-card-actions layout="row" layout-align="end center">
              <md-button class="md-icon-button" aria-label="Favorite">
                <md-icon md-svg-icon="/assets/images/run.svg"></md-icon>
              </md-button>
              <md-button ng-show="can.edit" class="md-icon-button" aria-label="Settings" ng-click="loadJobDetails(job.id)">
                <md-icon md-svg-icon="/assets/images/edit.svg"></md-icon>
              </md-button>
              <md-button ng-show="can.delete" class="md-icon-button md-warn" aria-label="Delete" ng-click="deleteJob(job.id)">
                <md-icon md-svg-icon="/assets/images/delete.svg"></md-icon>
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