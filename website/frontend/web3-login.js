let userLoginData = {
  state: "loggedOut",
  ethAddress: "",
  buttonText: "Log in",
  publicName: "",
  fullName: "",
  homeAddress: "",
  phoneModel: "",
  email: "",
  phoneNumber: "",
  thief: "",
  payInterval: "",
  phoneAge: "",
  phoneprice: "",
  premiumPrice: "",
  userPaid: "",
  claimUserName: "",
  claimTitle: "",
  claimContent: "",
  claimStatus: "",
  claimDate: "",
  claimPrice: "",
  claimAddressAdmin: "",
  claimUserNameAdmin: "",
  claimTitleAdmin: "",
  claimContentAdmin: "",
  claimStatusAdmin: "",
  claimDateAdmin: "",
  claimPriceAdmin: "",
  JWT: "",
  config: { headers: { "Content-Type": "application/json" } },
};

if (typeof backendPath == "undefined") {
  var backendPath = "";
}

const ethEnabled = async () => {
  if (window.ethereum) {
    await window.ethereum.send("eth_requestAccounts");
    window.web3 = new Web3(window.ethereum);
    // return true;
    ethInit();
  }
  return false;
};

function ethInit() {
  ethereum.on("accountsChanged", (_chainId) => ethNetworkUpdate());

  async function ethNetworkUpdate() {
    let accountsOnEnable = await web3.eth.getAccounts();
    let address = accountsOnEnable[0];
    address = address.toLowerCase();
    if (userLoginData.ethAddress != address) {
      userLoginData.ethAddress = address;
      showAddress();
      if (userLoginData.state == "loggedIn") {
        userLoginData.JWT = "";
        userLoginData.state = "loggedOut";
        userLoginData.buttonText = "Log in";
      }
    }
    if (
      userLoginData.ethAddress != null &&
      userLoginData.state == "needLogInToMetaMask"
    ) {
      userLoginData.state = "loggedOut";
    }
  }
}

// Show current msg
function showMsg(id) {
  let x = document.getElementsByClassName("user-login-msg");
  let i;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(id).style.display = "block";
}

// Show current address
function showAddress() {
  document.getElementById("ethAddress").innerHTML = userLoginData.ethAddress;
}

function showEthAddress() {
  document.getElementById("showEthAddress").innerHTML =
    userLoginData.ethAddress;
}

function showContinue() {
  document.getElementById("showContinue").style.display = "";
}

function hideContinue() {
  document.getElementById("showContinue").style.display = "none";
}

function showAdminPanel() {
  document.getElementById("showAdminPanel").style.display = "";
}

function hideAdminPanel() {
  document.getElementById("showAdminPanel").style.display = "none";
}

// Show current button text
function showButtonText() {
  document.getElementById("buttonText").innerHTML = userLoginData.buttonText;
  document.getElementById("buttonText2").innerHTML = userLoginData.buttonText;
}

async function userLoginOut() {
  if (
    userLoginData.state == "loggedOut" ||
    userLoginData.state == "needMetamask"
  ) {
    await onConnectLoadWeb3Modal();
  }
  if (web3ModalProv) {
    window.web3 = web3ModalProv;
    try {
      userLogin();
    } catch (error) {
      console.log(error);
      userLoginData.state = "needLogInToMetaMask";
      showMsg(userLoginData.state);
      return;
    }
  } else {
    userLoginData.state = "needMetamask";
    return;
  }
}

async function userLogin() {
  if (userLoginData.state == "loggedIn") {
    userLoginData.state = "loggedOut";
    showMsg(userLoginData.state);
    //hide continue button
    hideContinue();
    hideAdminPanel();
    userLoginData.JWT = "";
    userLoginData.buttonText = "Log in";
    showButtonText();
    return;
  }
  if (typeof window.web3 === "undefined") {
    userLoginData.state = "needMetamask";
    showMsg(userLoginData.state);
    return;
  }
  let accountsOnEnable = await web3.eth.getAccounts();
  let address = accountsOnEnable[0];
  address = address.toLowerCase();
  if (address == null) {
    userLoginData.state = "needLogInToMetaMask";
    showMsg(userLoginData.state);
    return;
  }
  userLoginData.state = "signTheMessage";
  showMsg(userLoginData.state);

  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "login",
        address: address,
      },
      userLoginData.config
    )
    .then(function (response) {
      if (response.data.substring(0, 5) != "Error") {
        let message = response.data;
        let publicAddress = address;
        handleSignMessage(message, publicAddress).then(handleAuthenticate);

        function handleSignMessage(message, publicAddress) {
          return new Promise((resolve, reject) =>
            web3.eth.personal.sign(
              web3.utils.utf8ToHex(message),
              publicAddress,
              (err, signature) => {
                if (err) {
                  userLoginData.state = "loggedOut";
                  showMsg(userLoginData.state);
                }
                return resolve({ publicAddress, signature });
              }
            )
          );
        }

        function handleAuthenticate({ publicAddress, signature }) {
          axios
            .post(
              backendPath + "backend/server.php",
              {
                request: "auth",
                address: arguments[0].publicAddress,
                signature: arguments[0].signature,
              },
              userLoginData.config
            )
            .then(function (response) {
              if (response.data[0] == "Success") {
                //if not admin
                if (
                  publicAddress != "0x822a5Ed5197536b4b355C0eBea5e7f0f89552b01"
                ) {
                  userLoginData.state = "loggedIn";
                  showMsg(userLoginData.state);
                  //show continue button
                  showContinue();
                  userLoginData.buttonText = "Log out";
                  showButtonText();
                  userLoginData.ethAddress = address;
                  showAddress();
                  showEthAddress();
                  userLoginData.publicName = response.data[1];
                  getPublicName();
                  showPublicName();
                  userLoginData.fullName = response.data[3];
                  getFullname();
                  showFullname();
                  welcomeUser();
                  userLoginData.homeAddress = response.data[4];
                  getHomeaddress();
                  showHomeaddress();
                  userLoginData.phoneModel = response.data[5];
                  getPhonemodel();
                  showPhonemodel();
                  userLoginData.email = response.data[6];
                  getEmail();
                  showEmail();
                  userLoginData.phoneNumber = response.data[7];
                  getPhonenumber();
                  showPhonenumber();
                  userLoginData.phoneprice = response.data[8];
                  getPhoneprice();
                  showPhoneprice();
                  userLoginData.premiumPrice = response.data[9];
                  getPremiumprice();
                  showPremiumprice();
                  userLoginData.thief = response.data[10];
                  getThief();
                  showThief();
                  userLoginData.payInterval = response.data[11];
                  getPayinterval();
                  showPayinterval();
                  userLoginData.phoneAge = response.data[12];
                  getPhoneage();
                  showPhoneage();

                  userLoginData.claimTitle = response.data[14];
                  userLoginData.claimContent = response.data[15];
                  userLoginData.claimStatus = response.data[16];
                  userLoginData.claimDate = response.data[17];
                  userLoginData.claimPrice = response.data[25];
                  getClaim();

                  userLoginData.userPaid = response.data[13];

                  //if user has finished registration and has paid
                  if (userLoginData.userPaid == "Paid") {
                    getUserPaid();
                  }
                  console.log(response.data[2]);
                  userLoginData.JWT = response.data[2];

                  // Clear Web3 wallets data for logout
                  localStorage.clear();
                }
                //if admin
                else {
                  userLoginData.state = "loggedIn";
                  showMsg(userLoginData.state);
                  showAdminPanel();
                  localStorage.clear();
                  userLoginData.buttonText = "Log out";
                  showButtonText();
                  userLoginData.ethAddress = address;
                  showAddress();
                  showEthAddress();
                  userLoginData.publicName = response.data[1];
                  getPublicName();
                  showPublicName();
                  userLoginData.claimAddressAdmin = response.data[18];
                  userLoginData.claimUserNameAdmin = response.data[19];
                  userLoginData.claimTitleAdmin = response.data[20];
                  userLoginData.claimContentAdmin = response.data[21];
                  userLoginData.claimStatusAdmin = response.data[22];
                  userLoginData.claimDateAdmin = response.data[23];
                  userLoginData.claimPriceAdmin = response.data[24];
                  getClaimAdmin();
                }
              }
            })
            .catch(function (error) {
              console.error(error);
            });
        }
      } else {
        console.log("Error: " + response.data);
      }
    })
    .catch(function (error) {
      console.error(error);
    });
}

function welcomeUser() {
  document.getElementById("welcomeUser").innerHTML = `welcome ${
    document.getElementById("updateFullname").value
  }!`;
}

function getPublicName() {
  document.getElementById("updatePublicName").value = userLoginData.publicName;
  console.log("Public Name: " + userLoginData.publicName);
}

function showPublicName() {
  document.getElementById("editPublicName").innerHTML =
    document.getElementById("updatePublicName").value;
}

function setPublicName() {
  let value = document.getElementById("updatePublicName").value;
  console.log("JWT:", userLoginData.JWT);
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePublicName",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        publicName: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
      console.log(userLoginData.JWT);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getFullname() {
  document.getElementById("updateFullname").value = userLoginData.fullName;
}

function showFullname() {
  document.getElementById("editFullname").innerHTML =
    document.getElementById("updateFullname").value;
}

function setFullname() {
  let value = document.getElementById("updateFullname").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updateFullname",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        fullName: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getHomeaddress() {
  document.getElementById("homeAddress").value = userLoginData.homeAddress;
}

function showHomeaddress() {
  document.getElementById("showHomeaddress").innerHTML =
    document.getElementById("homeAddress").value;
}

function setHomeaddress() {
  let value = document.getElementById("homeAddress").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updateHomeaddress",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        homeAddress: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPhonemodel() {
  document.getElementById("phoneModel").value = userLoginData.phoneModel;
}

function showPhonemodel() {
  document.getElementById("showPhonemodel").innerHTML =
    document.getElementById("phoneModel").value;
}

function setPhonemodel() {
  let value = document.getElementById("phoneModel").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePhonemodel",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        phoneModel: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getEmail() {
  document.getElementById("email").value = userLoginData.email;
}

function showEmail() {
  document.getElementById("showEmail").innerHTML =
    document.getElementById("email").value;
}

function setEmail() {
  let value = document.getElementById("email").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updateEmail",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        email: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPhonenumber() {
  document.getElementById("phoneNumber").value = userLoginData.phoneNumber;
}

function showPhonenumber() {
  document.getElementById("showPhonenumber").innerHTML =
    document.getElementById("phoneNumber").value;
}

function setPhonenumber() {
  let value = document.getElementById("phoneNumber").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePhonenumber",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        phoneNumber: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getThief() {
  document.getElementById("thief").options[
    (document.getElementById("thief").selectedIndex = "0")
  ].text = userLoginData.thief;
}

function showThief() {
  document.getElementById("showThief").innerHTML =
    document.getElementById("thief").options[
      document.getElementById("thief").selectedIndex
    ].text;
}

function setThief() {
  let value =
    document.getElementById("thief").options[
      document.getElementById("thief").selectedIndex
    ].text;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updateThief",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        thief: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPayinterval() {
  document.getElementById("payinterval").options[
    (document.getElementById("payinterval").selectedIndex = "0")
  ].text = userLoginData.payInterval;
}

function showPayinterval() {
  document.getElementById("showPayinterval").innerHTML =
    document.getElementById("payinterval").options[
      document.getElementById("payinterval").selectedIndex
    ].text;
}

function setPayinterval() {
  let value =
    document.getElementById("payinterval").options[
      document.getElementById("payinterval").selectedIndex
    ].text;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePayinterval",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        payInterval: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPhoneage() {
  document.getElementById("phoneage").options[
    (document.getElementById("phoneage").selectedIndex = "0")
  ].text = userLoginData.phoneAge;
}

function showPhoneage() {
  document.getElementById("showPhoneage").innerHTML =
    document.getElementById("phoneage").options[
      document.getElementById("phoneage").selectedIndex
    ].text;
}

function setPhoneage() {
  let value =
    document.getElementById("phoneage").options[
      document.getElementById("phoneage").selectedIndex
    ].text;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePhoneage",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        phoneAge: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPhoneprice() {
  document.getElementById("priceinput").value = userLoginData.phoneprice;
}

function showPhoneprice() {
  document.getElementById("showPhoneprice").innerHTML =
    document.getElementById("priceinput").value;
}

function setPhoneprice() {
  let value = document.getElementById("priceinput").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePhoneprice",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        phoneprice: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function getPremiumprice() {
  document.getElementById("premiumPrice").textContent =
    userLoginData.premiumPrice;
}

function showPremiumprice() {
  document.getElementById("showPremiumprice").innerHTML =
    document.getElementById("premiumPrice").textContent;
}

function setPremiumprice() {
  let value = document.getElementById("premiumPrice").textContent;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "updatePremiumprice",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        premiumPrice: value,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.error(error);
    });
}

function setClaim() {
  document.getElementById("claimTitleArray" + i).innerHTML =
    document.getElementById("claimTitle").value;
  document.getElementById("claimContentArray" + i).innerHTML =
    document.getElementById("claimContent").value;
  document.getElementById("claimStatusArray" + i).innerHTML = "To be reviewed";
  document.getElementById("claimDateArray" + i).innerHTML = "";
  document.getElementById("claimPriceArray" + i).innerHTML = "";
  let valueFullName = document.getElementById("updateFullname").value;
  let valueClaimTitle = document.getElementById("claimTitle").value;
  let valueClaimContent = document.getElementById("claimContent").value;
  axios
    .post(
      backendPath + "backend/server.php",
      {
        request: "setClaim",
        address: userLoginData.ethAddress,
        JWT: userLoginData.JWT,
        claimUserName: valueFullName,
        claimTitle: valueClaimTitle,
        claimContent: valueClaimContent,
      },
      this.config
    )
    .then(function (response) {
      console.log(response.data);
      document.getElementById("claimSuccessful").textContent =
        "Claim has been successfully sent";
      document.getElementById("claimNotice").textContent =
        "Please log in later to see changes to your claim's status";
    })
    .catch(function (error) {
      console.error(error.response.data);
      document.getElementById("claimNotice").textContent = "Claim was not sent";
    });
}

function getClaim() {
  let tableTagUser =
    '<table class="table table-bordered table-hover text-white mb-5"><thead><tr><th>Claim title</th><th>Claim content</th><th>Claim status</th><th>Date</th><th>Claim price</th></tr></thead><tbody>';

  let claimTitleArray = userLoginData.claimTitle;
  let claimContentArray = userLoginData.claimContent;
  let claimStatusArray = userLoginData.claimStatus;
  let claimDateArray = userLoginData.claimDate;
  let claimPriceArray = userLoginData.claimPrice;

  for (i = 0; i < claimTitleArray.length; i++) {
    tableTagUser += "<tr>";
    tableTagUser +=
      '<td id="claimTitleArray' + i + '">' + claimTitleArray[i] + "</td>";
    tableTagUser +=
      '<td id="claimContentArray' + i + '">' + claimContentArray[i] + "</td>";
    tableTagUser +=
      '<td id="claimStatusArray' + i + '">' + claimStatusArray[i] + "</td>";
    tableTagUser +=
      '<td id="claimDateArray' + i + '">' + claimDateArray[i] + "</td>";
    tableTagUser +=
      '<td id="claimPriceArray' + i + '">' + claimPriceArray[i] + "</td>";
    tableTagUser += "</tr>";
  }
  tableTagUser += "<tr>";
  tableTagUser += '<td id="claimTitleArray' + i + '"></td>';
  tableTagUser += '<td id="claimContentArray' + i + '"></td>';
  tableTagUser += '<td id="claimStatusArray' + i + '"></td>';
  tableTagUser += '<td id="claimDateArray' + i + '"></td>';
  tableTagUser += '<td id="claimPriceArray' + i + '"></td>';
  tableTagUser += "</tr>";
  tableTagUser += "</tbody></table>";
  document.getElementById("table-box-user").innerHTML = tableTagUser;
}
let customerAddressId = "";

function getClaimAdmin() {
  let tableTag =
    '<table class="table table-bordered table-hover text-white mb-5"><thead><tr><th>User Address</th><th>Full Name</th><th>Claim title</th><th>Claim content</th><th>Claim status</th><th>Date</th><th>Claim Price</th><th>Review</th></tr></thead><tbody>';
  reviewButtonId = 0;
  let claimAddressAdminArray = userLoginData.claimAddressAdmin;
  let claimUserNameAdminArray = userLoginData.claimUserNameAdmin;
  let claimTitleAdminArray = userLoginData.claimTitleAdmin;
  let claimContentAdminArray = userLoginData.claimContentAdmin;
  let claimStatusAdminArray = userLoginData.claimStatusAdmin;
  let claimDateAdminArray = userLoginData.claimDateAdmin;
  let claimDatePriceArray = userLoginData.claimPriceAdmin;
  i = 0;
  for (i; i < claimTitleAdminArray.length; i++) {
    tableTag += "<tr>";
    tableTag +=
      '<td id="claimAddressAdminArray' +
      reviewButtonId +
      '">' +
      claimAddressAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimUserNameAdminArray' +
      reviewButtonId +
      '">' +
      claimUserNameAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimTitleAdminArray' +
      reviewButtonId +
      '">' +
      claimTitleAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimContentAdminArray' +
      reviewButtonId +
      '">' +
      claimContentAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimStatusAdminArray' +
      reviewButtonId +
      '">' +
      claimStatusAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimDateAdminArray' +
      reviewButtonId +
      '">' +
      claimDateAdminArray[i] +
      "</td>";
    tableTag +=
      '<td id="claimDatePriceArray' +
      reviewButtonId +
      '">' +
      claimDatePriceArray[i] +
      "</td>";
    tableTag +=
      '<td><button onclick="" id="reviewButton' +
      reviewButtonId +
      '" class="btn btn-default">Review</button></td>';
    reviewButtonId++;
    tableTag += "</tr>";
  }
  tableTag += "</tbody></table>";
  document.getElementById("table-box").innerHTML = tableTag;

  let counter = 0;
  let button = document.getElementById("reviewButton" + counter);

  while (button) {
    button.addEventListener("click", function () {
      id_number = parseInt(this.id.replace(/[^0-9.]/g, ""));

      document.getElementById("adminPanel").style.display = "none";
      document.getElementById("reviewClaimPanel").style.display = "block";

      let tableTagSingle =
        '<table class="table table-bordered table-hover text-white"><thead><tr><th>User Address</th><th>Full Name</th><th>Claim title</th><th>Claim content</th><th>Claim status</th><th>Date</th><th>Claim Price</th></tr></thead><tbody>';

      tableTagSingle += "<tr>";
      tableTagSingle +=
        '<td id="claimAddressAdminArraySingle' +
        id_number +
        '">' +
        claimAddressAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimUserNameAdminArraySingle' +
        id_number +
        '">' +
        claimUserNameAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimTitleAdminArraySingle' +
        id_number +
        '">' +
        claimTitleAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimContentAdminArraySingle' +
        id_number +
        '">' +
        claimContentAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimStatusAdminArraySingle' +
        id_number +
        '">' +
        claimStatusAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimDateAdminArraySingle' +
        id_number +
        '">' +
        claimDateAdminArray[id_number] +
        "</td>";
      tableTagSingle +=
        '<td id="claimDatePriceArraySingle' +
        id_number +
        '">' +
        claimDatePriceArray[id_number] +
        "</td>";
      tableTagSingle += "</tr>";
      tableTagSingle += "</tbody></table>";
      document.getElementById("updateClaimPrice").value =
        userLoginData.claimPriceAdmin[id_number];
      document.getElementById("customerAddressClaim").textContent =
        claimAddressAdminArray[id_number];
      customerAddressId = document.getElementById(
        "customerAddressClaim"
      ).textContent;
      console.log(customerAddressId);
      document.getElementById("showClaimPrice").textContent =
        document.getElementById("updateClaimPrice").value;

      document.getElementById("claimReviewSingle").innerHTML = tableTagSingle;
      fetch("https://proxy.desurance.de:3009/")
        .then((response) => response.json())
        .then((data) => {
          const jsonClaim = data.data.quote[2790].price;
          console.log(jsonClaim);
          const convertClaim = claimDatePriceArray[id_number] / jsonClaim;
          const claimInEther = convertClaim.toFixed(8);
          document.getElementById("claimInEther").innerHTML = claimInEther;
        });
    });
    button = document.getElementById("reviewButton" + counter++);

    setClaimPrice = function () {
      document.getElementById("showClaimPrice").innerHTML =
        document.getElementById("updateClaimPrice").value;

      document.getElementById("claimStatusAdminArray" + id_number).innerHTML =
        "Approved";
      document.getElementById("claimDatePriceArray" + id_number).innerHTML =
        document.getElementById("updateClaimPrice").value;

      document.getElementById(
        "claimStatusAdminArraySingle" + id_number
      ).innerHTML = "Approved";
      document.getElementById(
        "claimDatePriceArraySingle" + id_number
      ).innerHTML = document.getElementById("updateClaimPrice").value;

      claimStatusAdminArray[id_number] = "Approved";
      claimDatePriceArray[id_number] =
        document.getElementById("updateClaimPrice").value;

      let value = document.getElementById("updateClaimPrice").value;
      let approved = "Approved";
      let userId = id_number;

      axios
        .post(
          backendPath + "backend/server.php",
          {
            request: "updateClaimPrice",
            claimPrice: value,
            approvement: approved,
            user_id: userId,
          },
          this.config
        )
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.error(error);
        });
    };

    dissapproveClaim = function () {
      document.getElementById("claimStatusAdminArray" + id_number).innerHTML =
        "Dissapproved";

      document.getElementById(
        "claimStatusAdminArraySingle" + id_number
      ).innerHTML = "Dissapproved";

      claimStatusAdminArray[id_number] = "Dissapproved";

      let dissapproved = "Dissapproved";
      let userId = id_number;

      axios
        .post(
          backendPath + "backend/server.php",
          {
            request: "dissapproveClaim",

            dissapprovement: dissapproved,
            user_id: userId,
          },
          this.config
        )
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.error(error);
        });
    };

    claimPaidStatus = function () {
      document.getElementById("claimStatusAdminArray" + id_number).innerHTML =
        "Successfully paid";
      document.getElementById(
        "claimStatusAdminArraySingle" + id_number
      ).innerHTML = "Successfully paid";
      claimStatusAdminArray[id_number] = "Successfully paid";

      let claimPaid = "Successfully paid";
      let userId = id_number;

      axios
        .post(
          backendPath + "backend/server.php",
          {
            request: "claimPaidStatus",

            claimPaidStatus: claimPaid,
            user_id: userId,
          },
          this.config
        )
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.error(error);
        });
    };
  }
}

function setUserPaid() {
  if (document.getElementById("pay").innerHTML == "Paid") {
    let value = document.getElementById("pay").innerHTML;
    axios
      .post(
        backendPath + "backend/server.php",
        {
          request: "userPaid",
          address: userLoginData.ethAddress,
          JWT: userLoginData.JWT,
          userPaid: value,
        },
        this.config
      )
      .then(function (response) {
        console.log(response.data);
      })
      .catch(function (error) {
        console.error(error);
      });
  }
}

function getUserPaid() {
  document.getElementById("userPanel").style.display = "block";
  document.getElementById("home").style.display = "none";
  document.getElementById("login").style.display = "none";
  document.getElementById("choose").style.display = "none";
  document.getElementById("terms").style.display = "none";
  document.getElementById("calc").style.display = "none";
  document.getElementById("info").style.display = "none";
  document.getElementById("review").style.display = "none";
  document.getElementById("payment").style.display = "none";
  document.getElementById("adminPanel").style.display = "none";
  document.getElementById("reviewClaimPanel").style.display = "none";
}

function logOutNav() {
  document.getElementById("login").style.display = "block";
  document.getElementById("userPanel").style.display = "none";
  document.getElementById("home").style.display = "none";
  document.getElementById("choose").style.display = "none";
  document.getElementById("terms").style.display = "none";
  document.getElementById("calc").style.display = "none";
  document.getElementById("info").style.display = "none";
  document.getElementById("review").style.display = "none";
  document.getElementById("payment").style.display = "none";
  document.getElementById("adminPanel").style.display = "none";
  document.getElementById("reviewClaimPanel").style.display = "none";
}
