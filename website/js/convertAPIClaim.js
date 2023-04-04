document.querySelector("#claimApprove").addEventListener("click", function () {
  fetch("https://proxy.desurance.de:3009/")
    .then((response) => response.json())
    .then((data) => {
      const jsonClaim = data.data.quote[2790].price;
      console.log(jsonClaim);
      const convertClaim = document.getElementById("showClaimPrice").innerHTML / jsonClaim;
      const claimInEther = convertClaim.toFixed(8);
    });
});
