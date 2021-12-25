
function goPost(url, body, rel) {

  request = $.ajax({
    url: url,
    type: "post",
    data: body,
    processData: false, // important
    contentType: false, // important
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    Swal.fire({
      // position: 'top-end',
      icon: 'success',
      title: 'Transaction succes!',
      showConfirmButton: false,
      timer: 2000
    }).then(function () {
      if (rel) {
        location.reload();
      }
    }
    );

  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error(
      "The following error occurred: " +
      textStatus, errorThrown
    );

    Swal.fire({
      title: 'Error!',
      text: 'Transaction failed!',
      icon: 'error',
      // confirmButtonText: 'Ok',
      // confirmButtonColor: '#19d895',
    })
  });

  // Callback handler that will be called regardless
  // if the request failed or succeeded
  request.always(function () {
    // Reenable the inputs
    $(":button").prop("disabled", false);
  });

}
