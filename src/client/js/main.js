import axios from 'axios';
import FormData from "./form";
import '../css/main.css'

// actions for showing form messages/feedback
const form = new FormData();


// show error or success messages based on failures from ajax response
function evaluateResponse(data){
  console.log(data);
  form.setData = data;
  if (data.failures > 0) {
    form.showLoading(false);
    form.showFormErrors();
    form.alertErrors();
    return
  }
  form.showSuccessMessage();
}

// main function to post form data via axios ajax post
function postForm(e){
  e.preventDefault();
  form.showLoading(true);
  const data = form.values();
  if (form.testHoneypot(data)){
    axios.post('/form.php', data).then((res)=>{
      evaluateResponse(res.data);
    }).catch(function (error) {
      throw new Error(error);
    })
  }
}

// set click event to to do ajax instead of standard post action
$("#primary-form-btn").on('click',function(e){
  postForm(e);
});

// set submit event to to do ajax instead of standard post action
$("#contact-form").on('submit', function(e){
  postForm(e);
});
