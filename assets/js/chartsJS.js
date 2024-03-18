const ctx1 = document.getElementById("chart-1").getContext("2d");
$.ajax('/DA_QTDL/backend/api/baocao.php', {
  success: function (response) {
    var data = JSON.parse(response);
    var myData = [];
    $(data).each(function () {
      myData.push(this.soluong);
    });
    myData.push(0);
    const myChart2 = new Chart(ctx1, {
      type: "polarArea",
      data: {
        labels: ["Khách hàng","Sản phẩm","Góp ý","Đơn hàng"],
        datasets: [
          {
            label: "Thống kê",
            data: myData,
            backgroundColor: [
              "rgba(255,99,132,0.2)",
              "rgba(54,162,235,0.2)",
              "rgba(255,206,86,0.2)",
              "rgba(75,192,192,0.2)"
            ],
            borderColor: [
              "rgba(255,99,132,1)",
              "rgba(54,162,235,1)",
              "rgba(255,206,86,1)",
              "rgba(75,192,192,1)"
            ]
          }
        ]
      },
      options: {
        responsive: true
      }
    });
  }
});
const ctx2 = document.getElementById("chart-2").getContext("2d");
$.ajax('/DA_QTDL/backend/api/baocao_soluongsanpham.php', {
  success: function (response) {
    var data = JSON.parse(response);
    var myLabels = [];
    var myData = [];
    $(data).each(function () {
      myLabels.push(this.lsp_ten);
      myData.push(this.SoLuong);
    });
    myData.push(0);
    const myChart2 = new Chart(ctx2, {
      type: "bar",
      data: {
        labels: myLabels,
        datasets: [
          {
            label: "Thống kê",
            data: myData,
            backgroundColor: [
              "rgba(255,99,132,0.2)",
              "rgba(54,162,235,0.2)",
              "rgba(255,206,86,0.2)",
              "rgba(75,192,192,0.2)"
            ],
            borderColor: [
              "rgba(255,99,132,1)",
              "rgba(54,162,235,1)",
              "rgba(255,206,86,1)",
              "rgba(75,192,192,1)"
            ]
          }
        ]
      },
      options: {
        responsive: true
      }
    });
  }
});