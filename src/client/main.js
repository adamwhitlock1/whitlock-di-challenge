import './css/main';
import axios from 'axios';
import {alertErrors, showFormErrors, showSuccessMessage, getFormValues} from "./actions";

import "./css/main";

function showLoading(bool){
  if(bool){
    $("#primary-form-btn").html('<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>');
    return
  }
  setTimeout(()=>{
    $("#primary-form-btn").html('submit');
  }, 150)
}

function postForm(e){
  e.preventDefault();
  showLoading(true);
  const data = getFormValues();
  axios.post('/form.php', data).then((res)=>{
    evalResponse(res.data);
  })
}

function evalResponse(data){
  console.log(data);
  if (data.failures > 0) {
    showLoading(false);
    showFormErrors(data);
    alertErrors(data);
    return
  }
  showSuccessMessage(data);
}

$("#primary-form-btn").click(function(e){
  postForm(e);
});

$("#contact-form").on('submit', function(e){
  postForm(e);
});
