  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>
          <span class="glyphicon glyphicon-comment"></span>
          Survey Response <?php echo (isset($responses) ? " - <a target='_blank' href='mailto:" . $responses["email"] . "'>" . $responses["email"] . "</a>" : ""); ?></small>
        </h4>
        <?php if(isset($valid_response) && $valid_response): ?>
        <ul class="list-group">
          <?php foreach($responses["responses"] as $response): ?>
            <li class="list-group-item">
              <h5 class="list-group-item-heading">
                <?php echo $response["question"]; ?>
              </h5>
              <p class="list-group-item-text">
                <ul>
                  <?php foreach($response["response"] as $answer): ?>
                    <li>
                      <?php echo ((!empty($answer)) ? $answer : "<i class='text-muted'>No Response</i>"); ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </p>
            </li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
          <div class="alert alert-warning text-center" role="alert">
            Invalid response request.
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>