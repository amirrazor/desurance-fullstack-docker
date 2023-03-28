import { ethers } from "./ethers.js";
import { abi, contractAddress } from "./constants.js";

if (typeof window.ethereum !== "undefined") {
  const provider = new ethers.providers.Web3Provider(window.ethereum);
  const signer = provider.getSigner();
  const contract = new ethers.Contract(contractAddress, abi, signer);
  document.getElementById(
    "contractAddressAdmin"
  ).innerHTML = `contract address: ${contract.address}`;
  const balance = await provider.getBalance(contract.address);
  document.getElementById(
    "contractBalance"
  ).innerHTML = `Phone insurance pool: ${ethers.utils.formatEther(
    balance
  )} Ethers`;
  let link = document.getElementById("etherScanLink");
  link.href = `https://goerli.etherscan.io/address/${contract.address}`;
}

// async function payBack() {
//   const ethAmount = document.getElementById("etherPrice").innerHTML;
//   console.log(ethAmount);
//   if (typeof window.ethereum !== "undefined") {
//     const provider = new ethers.providers.Web3Provider(window.ethereum);
//     const signer = provider.getSigner();
//     const contract = new ethers.Contract(contractAddress, abi, signer);
//     try {
//       const transactionResponse = await contract.payBack(
//         {
//           value: ethers.utils.parseEther(ethAmount),
//         },
//         address
//       );
//       await transactionMined(transactionResponse, provider);
//       document.getElementById("successConfirmation").innerHTML =
//         "Transaction successful!";
//       document.getElementById(
//         "contractAddress"
//       ).innerHTML = `contract address: ${contract.address}`;
//       document.getElementById("failedTransaction").style.display = "none";
//       document.getElementById("pay").style.display = "none";
//       document.getElementById("showUserPanel").style.display = "";
//     } catch (error) {
//       console.log(error);
//       document.getElementById("failedTransaction").innerHTML =
//         "The transaction was failed!";
//     }
//   }
// }
