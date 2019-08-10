import axios from 'axios';
import Actions from "./actions";
import Form from "./form";
import '../css/main.css'

// actions for showing form messages/feedback
const actions = new Actions();

/*
show error or success messages based on failures from ajax response
 */
function evaluateResponse(data){
  console.log(data);
  let actions = new Actions();
  actions.setData = data;
  if (data.failures > 0) {
    actions.showLoading(false);
    actions.showFormErrors();
    actions.alertErrors();
    return
  }
  actions.showSuccessMessage();
}

function postForm(e){
  e.preventDefault();
  actions.showLoading(true);
  const data = Form.values;
  axios.post('/form.php', data).then((res)=>{
    evaluateResponse(res.data);
  }).catch(function (error) {
    // handle error
    alert("An error occurred " + error + "\n\r Please Contact Support");
  })
}


// set events to to do ajax instead of standard post action
$("#primary-form-btn").on('click',function(e){
  postForm(e);
});

$("#contact-form").on('submit', function(e){
  postForm(e);
});
