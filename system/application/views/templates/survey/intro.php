  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($active_surveys) && $active_surveys != null): ?>
          <h1>
            Select a survey
          </h1>
          <div class="list-group">
            <?php foreach($active_surveys as $survey): ?>
              <a href="<?php echo base_url() . "questions/" . $survey->slug; ?>" class="list-group-item">
                <?php echo $survey->title; ?>
                <span class="glyphicon glyphicon-chevron-right pull-right"></span>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-danger text-center" role="alert">
            <strong>
              UH OH!
            </strong>
              It seems there are no surveys available.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>