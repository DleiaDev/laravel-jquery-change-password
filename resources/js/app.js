require('./bootstrap');

// On submit: prevent, send the form via ajax and display the errors
$('#form').submit(event => {
  event.preventDefault();

  displayLoader();

  axios.post('/password', $('#form').serialize())
  .then(response => {
    var data = response.data;
    var inputs = ['old_password', 'new_password', 'new_password_repeat'];

    if (data.success) {
      displayMessage('Your password was changed.', 'success');
      resetErrors(inputs);
    }

    if (data.errors) {
      displayMessage('Something went wrong', 'error');
      displayErrors(inputs, data.errors);
    }

    hideLoader('Change Password');
  });

});

window.displayMessage = function(message, status) {
  var messageContainer = $('#message');
  messageContainer
    .html(message)
    .attr('class', '')
    .addClass(status)
    .animate({left: '0px'});
  setTimeout(function() {
    messageContainer.animate({left: '-320px'})
  }, 3000);
};

window.displayErrors = function(inputs, errors) {
  var input = '';
  for (var i = 0; i < inputs.length; i++) {
    input = inputs[i];
    $(`#${input}`).attr('class', 'form-control');
    $(`#${input}-error`).html('');
    if (errors[input]) {
      $(`#${input}`).addClass('failed');
      $(`#${input}-error`).html(errors[input]);
    }
  }
}

window.resetErrors = function(inputs) {
  var input = '';
  for (var i = 0; i < inputs.length; i++) {
    input = inputs[i];
    $(`#${input}`).attr('class', 'form-control').val('');
    $(`#${input}-error`).html('');
  }
}

window.displayLoader = function() {
  $('#submit-button').html('<img src="/img/loader.gif" width="40" height="40">');
}

window.hideLoader = function(text) {
  $('#submit-button')
    .html(text)
    .attr('class', 'btn btn-primary');
}
