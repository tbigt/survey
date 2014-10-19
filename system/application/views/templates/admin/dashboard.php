 <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>
          <span class="glyphicon glyphicon-th-list"></span>
          Active Surveys
        </h4>
        <?php if(isset($active_surveys) && $active_surveys != null): ?>
          <div class="list-group">
            <?php foreach($active_surveys as $survey): ?>
              <a href="<?php echo base_url() . "questions/" . $survey->slug; ?>" class="list-group-item">
                <?php echo $survey->title; ?>
                <span class="glyphicon glyphicon-chevron-right pull-right"></span>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-warning text-center" role="alert">
              There are no surveys available.
          </div>
        <?php endif; ?>
      </div>
      <div class="col-md-12">
        <h4>
          <span class="glyphicon glyphicon-comment"></span>
          Survey Responses
        </h4>
        <?php if(isset($survey_responses) && $survey_responses != null): ?>
          <div class="list-group">
            <?php foreach($survey_responses as $resonse): ?>
              <a href="<?php echo base_url() . "questions/" . $survey->slug; ?>" class="list-group-item">
                <span class="glyphicon glyphicon-chevron-right pull-right"></span>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-warning text-center" role="alert">
              There are no survey responses.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>