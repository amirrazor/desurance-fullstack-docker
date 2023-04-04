//SPDX-License-Identifier: MIT
pragma solidity ^0.8.7;

contract Desurance {
    address public manager;

    constructor() {
        manager = msg.sender;
    }

    address[] public customers;
    mapping(address => uint256) public customerAddressToPremium;

    function pay() public payable {
        customers.push(msg.sender);
        customerAddressToPremium[msg.sender] = msg.value;
    }

    function payBack(uint256 claimAmount, address payable customerAddress)
        public
        onlyManager
    {
        customerAddress.transfer(claimAmount);
    }

    modifier onlyManager() {
        require(
            msg.sender == manager,
            "This address does not belong to the manager"
        );
        _;
    }

    receive() external payable {
        pay();
    }

    fallback() external payable {
        pay();
    }
}
