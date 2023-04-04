function homeNav() {
  document.getElementById("home").style.display = "block";
  document.getElementById("login").style.display = "none";
  document.getElementById("choose").style.display = "none";
  document.getElementById("terms").style.display = "none";
  document.getElementById("calc").style.display = "none";
  document.getElementById("info").style.display = "none";
  document.getElementById("review").style.display = "none";
  document.getElementById("payment").style.display = "none";
  document.getElementById("adminPanel").style.display = "none";
  document.getElementById("userPanel").style.display = "none";
}

function loginNav() {
  document.getElementById("home").style.display = "none";
  document.getElementById("login").style.display = "block";
  document.getElementById("choose").style.display = "none";
  document.getElementById("terms").style.display = "none";
  document.getElementById("calc").style.display = "none";
  document.getElementById("info").style.display = "none";
  document.getElementById("review").style.display = "none";
  document.getElementById("payment").style.display = "none";
  document.getElementById("adminPanel").style.display = "none";
  document.getElementById("userPanel").style.display = "none";
}

function homeToLogin() {
  document.getElementById("home").style.display = "none";
  document.getElementById("login").style.display = "block";
}

function loginToHome() {
  document.getElementById("login").style.display = "none";
  document.getElementById("home").style.display = "block";
}

function loginToChoose() {
  document.getElementById("login").style.display = "none";
  document.getElementById("choose").style.display = "block";
}

function chooseToLogin() {
  document.getElementById("choose").style.display = "none";
  document.getElementById("login").style.display = "block";
}

function chooseToTerms() {
  document.getElementById("choose").style.display = "none";
  document.getElementById("terms").style.display = "block";
}

function termsToChoose() {
  document.getElementById("terms").style.display = "none";
  document.getElementById("choose").style.display = "block";
}

function termsToCalc() {
  document.getElementById("terms").style.display = "none";
  document.getElementById("calc").style.display = "block";
}

function calcToTerms() {
  document.getElementById("calc").style.display = "none";
  document.getElementById("terms").style.display = "block";
}

function calcToInfo() {
  document.getElementById("calc").style.display = "none";
  document.getElementById("info").style.display = "block";
}

function infoToCalc() {
  document.getElementById("info").style.display = "none";
  document.getElementById("calc").style.display = "block";
}

function infoToReview() {
  document.getElementById("info").style.display = "none";
  document.getElementById("review").style.display = "block";
}

function reviewToInfo() {
  document.getElementById("review").style.display = "none";
  document.getElementById("info").style.display = "block";
}

function reviewToPayment() {
  document.getElementById("review").style.display = "none";
  document.getElementById("payment").style.display = "block";
}

function paymentToReview() {
  document.getElementById("payment").style.display = "none";
  document.getElementById("review").style.display = "block";
}

function paymentToUserPanel() {
  document.getElementById("payment").style.display = "none";
  document.getElementById("userPanel").style.display = "block";
}

function loginToAdmin() {
  document.getElementById("adminPanel").style.display = "block";
  document.getElementById("login").style.display = "none";
}

function AdminToReviewClaim() {
  document.getElementById("adminPanel").style.display = "none";
  document.getElementById("reviewClaimPanel").style.display = "block";
}

function ReviewClaimToAdmin() {
  document.getElementById("adminPanel").style.display = "block";
  document.getElementById("reviewClaimPanel").style.display = "none";
}
