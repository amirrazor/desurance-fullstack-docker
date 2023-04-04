<!-- login -->
<div id="loggedIn" style="display:none;"
    class="user-login-msg text-white h3 bg-success font-weight-bold my-3 p-3 text-center">
    Successful Login with your Ethereum address: <span id="ethAddress"></span>
</div>
<div id="login">
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage2">
                        <h2>Click the button to (sign up and) login!</h2>
                        <h3 class="text-white">It is super easy and very secure</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="text-center">
                <div>
                    <figure><img src="images/metamask.png" alt="#" style="width:80px;height:80px;" /></figure>
                </div>


                <div class="text-white h3 p-4">
                    <div id="loggedOut" class="user-login-msg">

                    </div>
                    <div id="needMetamask" style="display:none;color: rgb(255, 115, 0);" class="user-login-msg">
                        To login, first install a Web3 wallet, <a href="https://metamask.io/" style="color:#ff7300"
                            target="_blank">MetaMask</a> browser extension and create an account.
                    </div>
                    <div id="needLogInToMetaMask" style="display:none;color: rgb(255, 115, 0);" class="user-login-msg">
                        Log in to your wallet account first!
                    </div>
                    <div id="signTheMessage" style="display:none;" class="user-login-msg">
                        Sign the message with your wallet to authenticate.
                    </div>


                    <br>
                    <button onclick="loginToHome()" class="read_more btn btn-default">Back</button>
                    <button onclick="userLoginOut()" id="buttonText" class="read_more btn btn-default my-5">Log
                        in</button>
                    <button id="showContinue" style="display: none" onclick="loginToChoose()"
                        class="read_more btn btn-default">Continue</button>
                    <button id="showAdminPanel" style="display: none" onclick="loginToAdmin()"
                        class="read_more btn btn-default">Go to admin panel</button>


                </div>
            </div>
        </div>
    </div>

</div>
<!-- end login -->