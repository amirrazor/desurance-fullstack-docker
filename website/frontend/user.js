import { ethers } from "./ethers.js";
import { abi, contractAddress } from "./constants.js";

if (typeof window.ethereum !== "undefined") {
  const provider = new ethers.providers.Web3Provider(window.ethereum);
  const signer = provider.getSigner();
  const contract = new ethers.Contract(contractAddress, abi, signer);
  
}
