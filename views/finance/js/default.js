$(document).ready(function () {
  let path = "http://localhost/ricien_stock/";
  getAllFinance();
  
  function getAllFinance() {
    $.ajax({
      url:`${path}finance/getAllFinance`,
      type: "POST",
      dataType: 'JSON',
      success: function (data) {
        alert("jdjdjdj")
        console.log(data);
        $("#totalAchat").html(data.totalAchat+"FC");
        $("#totalVente").html(data.totalVente+"FC");
        $("#beneficeAttendu").html(data.beneficeAttendu+"FC");
        $("#beneficeRealise").html(data.beneficeRealise+"FC");
        $("#perte").html(data.perte+"FC");
        // $("#totalTva").htlm(data.totalTva);
      }
    })
  }
})