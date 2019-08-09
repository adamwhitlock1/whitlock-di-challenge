

/**
 * GET FIELD VALUES
 * @returns {{name: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), email: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), phone: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), message: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), pot: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery)}}
 */
export function getFormValues(){
  return {
    name: $("#name input").val(),
    email: $("#email input").val(),
    phone: $("#phone input").val(),
    message: $("#message textarea").val(),
    pot: $("#pot").val()
  }
}


/**
 * SHOW FORM ERRORS
 * when error occurs, show a
 * red bar under the offending form fields,
 * and set text to error message
 *
 * @param data
 */
export function showFormErrors(data){
  const entries = Object.entries(data);
  for (const [field, response] of entries) {
    if ( response.result === false ) {
      $(`#${field}`).removeClass("has-success");
      $(`#${field}`).addClass("has-error");
      $(`#${field} .field-message`).text(response.message);
    } else {
      $(`#${field} .field-message`).text(" ");
      $(`#${field}`).removeClass("has-error");
      $(`#${field}`).addClass("has-success");
    }
  }
}


// ALERT ERRORS

/**
 *
 * @param data
 */
export function alertErrors(data){
  if (typeof data.db !== 'undefined') {
    if (data.db.result === false) {
      setTimeout(function(){
        alert(`There was a problem submitting your form.
      Please contact our support at info@test.com.
      Error: ${data.db.message}`);
      }, 100);
      return
    }
  }
  setTimeout(function(){
    alert(`Your form has ${data.failures} error(s), please review and correct your information and re-submit the form.`)
  }, 100);
}


/**
 * SUCCESS MESSAGE
 *
 * removes the form and fades in a simple thank you message
 *
 * @param data
 */
export function showSuccessMessage(data){

  let col = $("#contact-column");
  col.fadeOut();

  setTimeout(()=>{
    col.append(`
    <div class="panel panel-success">
      <div class="panel-heading">
        ${data.db.message}
      </div>
      <div class="panel-body">
        <p class="text-success lead">Follow us on social media:</p>
        <div class="btn-group btn-group-justified" role="group" aria-label="social media buttons">
          <a href="https://twitter.com" target="_blank" class="btn btn-default"><i class="fa fa-3x fa-twitter"></i></a>
          <a href="https://facebook.com" target="_blank" class="btn btn-default"><i class="fa fa-3x fa-facebook"></i></a>
          <a href="https://intagram.com" target="_blank" class="btn btn-default"><i class="fa fa-3x fa-instagram"></i></a>
        </div>
      </div>
    </div>
    `);

    $("#contact-form").remove();
    col.fadeIn();
    $('html, body').animate({scrollTop: col.offset().top - 30}, 750, 'linear');
  },550);
}

