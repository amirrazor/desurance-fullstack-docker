import { ethers } from "./ethers.js";
import { abi, contractAddress } from "./constants.js";

const payButton = document.getElementById("pay");
payButton.onclick = pay;
console.log(ethers);

async function pay() {
  const ethAmount = document.getElementById("etherPrice").innerHTML;
  console.log(ethAmount);
  console.log(typeof ethAmount);
  console.log(ethers.utils.parseEther(ethAmount));
  if (typeof window.ethereum !== "undefined") {
    const provider = new ethers.providers.Web3Provider(window.ethereum);
    const signer = provider.getSigner();
    const contract = new ethers.Contract(contractAddress, abi, signer);
    try {
      const transactionResponse = await contract.pay({
        value: ethers.utils.parseEther(ethAmount),
      });
      await transactionMined(transactionResponse, provider);
      document.getElementById("successConfirmation").innerHTML =
        "Transaction successful!";
      document.getElementById(
        "contractAddress"
      ).innerHTML = `contract address: ${contract.address}`;
      document.getElementById("failedTransaction").style.display = "none";
      document.getElementById("pay").innerHTML = "Paid";
      document.querySelector("#pay").disabled = true;
      document.getElementById("showUserPanel").style.display = "";
      setUserPaid();
    } catch (error) {
      console.log(error);
      document.getElementById("failedTransaction").innerHTML =
        "The transaction was failed!";
    }
  }
}

const payClaimButton = document.getElementById("payClaim");
payClaimButton.onclick = payClaim;

async function payClaim() {
  const ethAmountClaim = document.getElementById("claimInEther").innerHTML;

  if (typeof window.ethereum !== "undefined") {
    const provider = new ethers.providers.Web3Provider(window.ethereum);
    const signer = provider.getSigner();
    const contract = new ethers.Contract(contractAddress, abi, signer);

    console.log(ethers.utils.getAddress(customerAddressId));
    console.log(ethAmountClaim);
    console.log(typeof ethAmountClaim);
    console.log(ethers.utils.parseEther(ethAmountClaim));

    try {
      const transactionResponse = await contract.payBack(
        ethers.utils.parseEther(ethAmountClaim),
        ethers.utils.getAddress(customerAddressId)
      );
      await transactionMinedClaim(transactionResponse, provider);
      document.getElementById("successConfirmationClaim").innerHTML =
        "Transaction successful!";
      document.getElementById(
        "contractAddressClaim"
      ).innerHTML = `contract address: ${contract.address}`;
      document.getElementById("failedTransactionClaim").style.display = "none";
      claimPaidStatus();
    } catch (error) {
      console.log(error);
      document.getElementById("failedTransactionClaim").innerHTML =
        "The transaction was failed!";
    }
  }
}

function transactionMined(transactionResponse, provider) {
  document.getElementById(
    "mining"
  ).innerHTML = `mining with transaction hash of: ${transactionResponse.hash}`;
  return new Promise((resolve, reject) => {
    provider.once(transactionResponse.hash, (transactionReceipt) => {
      document.getElementById(
        "mined"
      ).innerHTML = `mining completed with ${transactionReceipt.confirmations} confirmations`;
      resolve();
    });
  });
}

function transactionMinedClaim(transactionResponse, provider) {
  document.getElementById(
    "miningClaim"
  ).innerHTML = `mining with transaction hash of: ${transactionResponse.hash}`;
  return new Promise((resolve, reject) => {
    provider.once(transactionResponse.hash, (transactionReceipt) => {
      document.getElementById(
        "minedClaim"
      ).innerHTML = `mining completed with ${transactionReceipt.confirmations} confirmations`;
      resolve();
    });
  });
}
