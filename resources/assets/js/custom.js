$(document).ready(function () {
  $(".remove-btn").click(function (e) {
    var $data_url = $(this).data("url");

    Swal.fire({
      title: "Are you sure you want to close your bank account?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, close it!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = $data_url;
      }
    });
  });
});
