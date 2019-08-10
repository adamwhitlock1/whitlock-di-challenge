export default class Form {

  /**
   * GET FIELD VALUES
   * @returns {{name: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), email: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), phone: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), message: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery), pot: (jQuery.fn.init|jQuery|HTMLElement|string|number|string[]|any|ChaiJQuery)}}
   */
  static get values() {
    return {
      name: $("#name input").val(),
      email: $("#email input").val(),
      phone: $("#phone input").val(),
      message: $("#message textarea").val(),
      pot: $("#pot").val()
    }
  }

}

