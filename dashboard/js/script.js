const charts = document.querySelectorAll(".chart");

charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$(document).on('submit', '#addairplane', function (e) {
  e.preventDefault();
  var company = $('#addcompany').val();
  var minimum_rating = $('#addminimum_rating').val();
  if (company != '' && minimum_rating != '') {
    $.ajax({
      url: "http://localhost/airline/dashboard/add_airplane.php",
      type: "post",
      data: {
        company: company,
        minimum_rating: minimum_rating
      },
      success: function (data) {
        var json = JSON.parse(data);
        var status = json.status;
        if (status == 'true') {
          mytable = $('#airplane').DataTable();
          mytable.draw();
          $('#addcompany').val('');
          $('#addminimum_rating').val('');
          $('#addairplanemodal').modal('hide');
        } else {
          alert('failed');
        }
      }
    });
  } else {
    alert('Fill all the required fields');
  }
});

