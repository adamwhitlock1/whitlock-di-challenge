import './css/main';
import axios from 'axios';

console.log('client/main.js loaded woo');

console.log('client/main.js loaded');
import "./css/main";
function getFormValues(){
  const formData = {
    name: $("#name input").val(),
    email: $("#email input").val(),
    phone: $("#phone input").val(),
    message: $("#message textarea").val(),
    pot: $("#pot").val()
  }
  return formData;
}

function postForm(){
  const data = getFormValues();
  axios.post('/form.php', data).then((res)=>{
    console.log(res.data);
    evalResponse(res.data);
  })
}

function evalResponse(data){
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
  if (data.failures > 0) {
    setTimeout(function(){
      alert(`Your form has ${data.failures} error(s), please review and correct your information and re-submit the form.`)
    }, 100);
  }
}

$("#primary-form-btn").click(function(e){
  e.preventDefault();
  postForm();
})
