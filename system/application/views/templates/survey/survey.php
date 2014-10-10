  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if($valid_survey): ?>
          <h2 class="text-center">
            Survey Title
            <small class="show">
              Quick Survey Blurb
            </small>
          </h2>
          <form role="form">
            <div class="form-group">
              <label for="email_field">
                Email Address <small>(Required)</small>
              </label>
              <input type="email" class="form-control" id="email_field" placeholder="Enter Email Address">
            </div>
            <?php foreach($questions as $question): ?>
              <?php if($question->question_type == 0): ?>
                <div class="form-group">
                  <label>
                    <?php echo $question->question_text . " <small>" .
                      ((!empty($question->helper_text)) ? $question->helper_text : "") .
                      (($question->required) ? " (Required) " : "") . "</small>"; ?>
                  </label>
                  <?php foreach($question->options as $option): ?>
                    <div class="radio">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                        <?php echo $option->option_text; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <?php if($question->question_type == 1): ?>
                <div class="form-group">
                  <label for="email_field">
                    <?php echo $question->question_text . (($question->required) ? " <small>(Required)</small>" : ""); ?>
                  </label>
                  <input type="email" class="form-control" id="email_field" placeholder="Enter Response">
                </div>
              <?php endif; ?>
              <?php if($question->question_type == 2): ?>
                <div class="form-group">
                  <label for="text_field">
                    <?php echo $question->question_text . (($question->required) ? " <small>(Required)</small>" : ""); ?>
                  </label>
                  <textarea class="form-control" rows="3" id="text_field" placeholder="Enter Response"></textarea>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success pull-right">Submit</button>
          </form>
        <?php else: ?>
          <div class="alert alert-danger text-center" role="alert">
            <strong>
              OOPS!
            </strong>
              It appears you have tried to access a survey that does not exist.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>