const { ethers } = require("hardhat");

async function main() {
  const DesuranceFactory = await ethers.getContractFactory("Desurance");

  console.log("please wait, deploying contract to the blockchain...");
  const desurance = await DesuranceFactory.deploy();
  await desurance.deployed();
  console.log("deployed to the address: ", desurance.address);
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
