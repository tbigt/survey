  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($valid_survey) && $valid_survey && isset($show_questions) && $show_questions): ?>
          <h2 class="text-center">
            <?php echo ((isset($survey_title)) ? $survey_title : "Untitled"); ?>
            <small class="show">
              <?php echo ((isset($survey_subtitle)) ? $survey_subtitle : ""); ?>
            </small>
          </h2>
          <?php if(isset($survey_errors) && $survey_errors): ?>
            <div class="alert alert-danger" role="alert">
              <strong>
                Error<?php echo ((sizeof($errors) > 1) ? "s" : "" );?>:
              </strong>
              <ul>
                <?php foreach($errors as $error): ?>
                  <li>
                    <?php echo $error; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <form role="form" method="post" class="survey-form clearfix">
            <div class="form-group">
              <label for="email_field">
                Email Address <small>(Required)</small>
              </label>
              <input
                type="text"
                class="form-control"
                id="email_field"
                name="email_field"
                placeholder="Enter Email Address"
                value="<?php echo ((isset($_POST["email_field"]) && !empty($_POST["email_field"])) ? $_POST["email_field"] : "" ); ?>"
                autofocus>
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
                        <input 
                          type="radio"
                          name="question_<?php echo $question->id; ?>"
                          id="question_<?php echo $question->id . "_option" . $option->id; ?>"
                          value="<?php echo $option->id; ?>"
                          <?php echo ((isset($_POST["question_" . $question->id]) && $_POST["question_" . $question->id] == $option->id) ? "checked" : "" ); ?> >
                        <?php echo $option->option_text; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <?php if($question->question_type == 1): ?>
                <div class="form-group">
                  <label>
                    <?php echo $question->question_text . " <small>" .
                      ((!empty($question->helper_text)) ? $question->helper_text : "") .
                      (($question->required) ? " (Required) " : "") . "</small>"; ?>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Enter Response" 
                    name="question_<?php echo $question->id; ?>" 
                    id="question_<?php echo $question->id; ?>" 
                    value="<?php echo ((isset($_POST["question_" . $question->id]) && !empty($_POST["question_" . $question->id])) ? $_POST["question_" . $question->id] : "" ); ?>">
                </div>
              <?php endif; ?>
              <?php if($question->question_type == 2): ?>
                <div class="form-group">
                  <label>
                    <?php echo $question->question_text . " <small>" .
                      ((!empty($question->helper_text)) ? $question->helper_text : "") .
                      (($question->required) ? " (Required) " : "") . "</small>"; ?>
                  </label>
                  <textarea 
                    class="form-control"
                    rows="3"
                    placeholder="Enter Response"
                    name="question_<?php echo $question->id; ?>"
                    id="question_<?php echo $question->id; ?>"
                    value=""><?php 
                      echo ((isset($_POST["question_" . $question->id]) && !empty($_POST["question_" . $question->id])) ? $_POST["question_" . $question->id] : "" ); 
                    ?></textarea>
                </div>
              <?php endif; ?>
              <?php if($question->question_type == 3): ?>
                <div class="form-group">
                  <label>
                    <?php echo $question->question_text . " <small>" .
                      ((!empty($question->helper_text)) ? $question->helper_text : "") .
                      (($question->required) ? " (Required) " : "") . "</small>"; ?>
                  </label>
                  <?php foreach($question->options as $option): ?>
                    <div class="checkbox">
                      <label>
                        <input 
                          type="checkbox"
                          name="question_<?php echo $question->id; ?>[]"
                          id="question_<?php echo $question->id . "_option" . $option->id; ?>"
                          value="<?php echo $option->id; ?>"
                          <?php echo ((isset($_POST["question_" . $question->id]) && $_POST["question_" . $question->id] == $option->id) ? "checked" : "" ); ?> >
                        <?php echo $option->option_text; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-lg btn-success pull-right">Submit</button>
          </form>
        <?php elseif(isset($valid_survey) && $valid_survey && !(isset($survey_errors) && $survey_errors)): ?>
          <div class="alert alert-success text-center" role="alert">
            <strong>
              All Done!
            </strong>
              Thank you for completing the survey.
          </div>
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