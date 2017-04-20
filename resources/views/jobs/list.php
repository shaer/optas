<md-content class="md-padding" layout-xs="column" layout="row" layout-wrap >
    <md-card ng-repeat="(key, job) in jobs">
        <md-card-title>
            <md-card-title-text>
                <span class="md-headline">{{job.name}}</span>
                <span class="md-subhead">{{job.description}}</span>
            </md-card-title-text>
            <md-card-title-media>
                <div class="md-media-lg card-media"></div>
            </md-card-title-media>
        </md-card-title>
        <md-card-actions layout="row" layout-align="end center">
            <md-button class="md-icon-button md-raised md-accent" aria-label="Delete">
                <md-icon md-svg-icon="/assets/images/run.svg"></md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary" aria-label="Delete">
                <md-icon md-svg-icon="/assets/images/edit.svg"></md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-warn" aria-label="Delete">
                <md-icon md-svg-icon="/assets/images/delete.svg"></md-icon>
            </md-button>
        </md-card-actions>
    </md-card>
</md-content>


<md-fab-speed-dial class="md-fling md-fab-bottom-right md-hover-full fixed-position">
    <md-fab-trigger>
        <md-button aria-label="Add Job" class="md-fab" >
            <md-icon style="color:#FFF" md-svg-icon="/assets/images/add.svg"></md-icon>
        </md-button>
    </md-fab-trigger>
</md-fab-speed-dial> 