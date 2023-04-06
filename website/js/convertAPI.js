document.querySelector(".convertor").addEventListener("click", function () {
  fetch("http://localhost:8082/")
    .then((response) => response.json())
    .then((data) => {
      const json = data.data.quote[2790].price;
      console.log(json);
      const convert =
        document.getElementById("premiumPrice").textContent / json;
      const inEther = convert.toFixed(8);
      document.getElementById("etherPrice").innerHTML = inEther;
    });
});
