 <!-- Admin panel -->

 <div id="adminPanel">
     <div class="contact">
         <div class="container">
             <h3 class="text-white">Welcome Admin!</h3>
             <div class="col-md-12 text-white h4">
                 <span type="text" id="contractAddressAdmin" name="contractAddressAdmin"></span>
             </div>
             <div class="col-md-12 text-white h4">
                 <a id="etherScanLink" href="" class="text-warning" target="_blank">Ether Scan Link</a>
             </div>
             <div class="col-md-12 text-white h4">
                 <span type="text" id="contractBalance" name="contractBalance"></span>
             </div>



         </div>
     </div>
     <?php include "includes/footer.php" ?>
 </div>
 <!-- end admin panel -->
 <!-- choose insurance -->
 <div id="choose">

     <div class="business">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">

                     <div class="titlepage2 text-white">
                         <h1 class="text-white">Choose your desired insurance policy</h1>


                         <div class="choices">
                             <button onclick="chooseToTerms()">Phone insurance</button>
                             <button>Stay tuned for more!</button>
                         </div>
                         <button onclick="chooseToLogin()" class="read_more btn btn-default mb-5">Back</button>
                     </div>
                 </div>
             </div>

         </div>
     </div>
     <?php include "includes/footer.php" ?>
 </div>
 <!-- end choose insurance -->

 <!-- accept insurance terms -->
 <div id="terms">
     <div class="contact">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="titlepage2 text-center">
                         <h2>Below you will find the conditions of the insurance policy</h2>
                         <h3 class="text-white">Take a look at what is insured and what is not insured</h3>
                     </div>
                 </div>
             </div>
         </div>
         <div class="container">
             <section class="p-5">
                 <div class="row ">
                     <div class="col-md bg-primary text-start m-3">
                         <div class="card bg-primary text-light border-0">
                             <div class="card-body">
                                 <h2>What is insured?</h2>
                                 <ul class="phones">
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Material, production and design defects</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Wear and tear, aging</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Fall damage, accident</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Electronic damage (short circuit,
                                         over-voltage,
                                         induction)</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Damage caused by water, moisture</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Implosion/explosion, lightning strike</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Motor and bearing damage</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Glass ceramic breakage</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>calcification, Blockage</li>
                                     <li><span class="glyphicon glyphicon-ok mx-3 display-6"
                                             style='color:#4d9d0c'></span>Theft and cyber protection (Insurance+)</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-md bg-secondary text-start m-3">
                         <div class="card text-dark bg-secondary border-0">
                             <div class="card-body">
                                 <h2 class="text-dark">What is not insured?</h2>
                                 <ul class="phones">
                                     <li><span class="glyphicon glyphicon-remove mx-3 display-6"
                                             style='color:red'></span> Intentional damage
                                     <li>
                                     <li><span class="glyphicon glyphicon-remove mx-3 display-6"
                                             style='color:red'></span> Devices older than 5 years</li>
                                     <li><span class="glyphicon glyphicon-remove mx-3 display-6"
                                             style='color:red'></span> Already damaged devices</li>
                                     <li><span class="glyphicon glyphicon-remove mx-3 display-6"
                                             style='color:red'></span> Commercial devices</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>

             <div class="col-sm-12 text-center">
                 <button onclick="termsToChoose()" id="buttonText" class="read_more btn btn-default my-5">Back</button>
                 <button onclick="termsToCalc()" class="read_more btn btn-default">Accept</button>

             </div>

         </div>
     </div>
     <?php include "includes/footer.php" ?>
 </div>
 <!-- accept insurance terms -->
 <!-- Calculate insurance premium -->
 <div id="calc">
     <div class="contact">
         <div class="container">

             <div class="col-md-12">
                 <div class="titlepage2">
                     <h2>Find the best offer for you</h2>
                     <div class="mb-3">Please enter the information below </div>
                 </div>
             </div>
         </div>

         <div class="container">
             <div class="row">
                 <div class="col-md-12 ">

                     <div class="row">
                         <div class="main_form">



                             <div class="col-md-12">
                                 <label for="thief" class="purchasedatelabel m-2">Would you like to add extra
                                     thief and cyber protection? (for only €2.50)</label>
                                 <div class="text-danger star">*</div></br> </label>

                                 <select id="thief" class="inputed" onfocusout="showThief()">
                                     <option value="choose"></option>
                                     <option value="With">With</option>
                                     <option value="Without">Without</option>
                                 </select>


                             </div>

                             <div class="col-md-12">
                                 <label for="payinterval" class="purchasedatelabel m-3">Would you like to pay
                                     monthly or yearly?</label>
                                 <div class="text-danger star">*</div></br> </label>

                                 <select id="payinterval" class="inputed" onfocusout="showPayinterval()">
                                     <option value="choose"></option>
                                     <option value="Monthly">Monthly</option>
                                     <option value="Yearly">Yearly</option>
                                 </select>
                             </div>


                             <div class="col-md-12">
                                 <label for="phoneage" class="purchasedatelabel m-3">Date of purchase: <div
                                         class="text-danger star">*</div> </label></br>

                                 <select id="phoneage" class="inputed" onfocusout="showPhoneage()">
                                     <option value="choose"></option>
                                     <option value="older than 1 year">older than 1 year</option>
                                     <option value="newer than 1 year">newer than 1 year</option>
                                 </select>
                             </div>
                             <div class="col-md-12">
                                 <label for="priceinput" class="phones m-3">Enter your phone's purchase price:
                                     <div class="text-danger star userinput">*</div>
                                 </label></br>
                                 <input id="priceinput" class="inputed priceinput" placeholder="€" type="text"
                                     name="Phone Price" onfocusout="showPhoneprice()">
                             </div>








                             <div class="col-md-12">
                                 <div class="premiumpricelabel text-white row h3 font-weight-bold m-2">
                                     <div class="mr-2">Premium price: </div>

                                     <div class="text-danger star">€ </div>
                                     <div id="premiumPrice" class="premiumprice text-danger">0</div>
                                 </div>
                             </div>
                             <div class="notice3 text-danger h3"></div>
                             <div class="notice text-danger h3"></div>
                             <div class="notice2 text-danger h3"></div>
                             <div class="notice4 text-danger h3"></div>
                             <div class="notice5 text-danger h3"></div>
                             <div class="notice6 text-warning h3">Please note that the end-payment will be converted to
                                 ETH (in ethereum's Rinkeby testnet)</div>





                         </div>



                     </div>
                 </div>
             </div>
             <div class="text-center">
                 <button onclick="calcToTerms()" class="read_more btn btn-default my-5  ">back</button>
                 <button class="read_more btn btn-default calculate my-5"
                     onclick="setPremiumprice();setPhoneprice();setThief();setPayinterval();setPhoneage();">Calculate
                     Premium</button>
                 <button onclick="calcToInfo();setPremiumprice();showPremiumprice()"
                     class="convertor read_more btn btn-default my-5  ">Continue</button>
             </div>
         </div>
     </div>

     <?php include "includes/footer.php" ?>
 </div>
 <!-- end calculate insurance -->


 <!-- personal info -->
 <div id="info">
     <div class="contact">
         <div class="container">

             <div class="col-md-12">
                 <div class="titlepage2">
                     <h2>Complete your registration</h2>
                     <div class="mb-3">Please enter the information below </div>
                 </div>
             </div>
         </div>

         <div class="container">
             <div class="row">
                 <div class="col-md-12 ">

                     <div class="row">
                         <div class="main_form">

                             <div class="col-md-12">

                                 <div class="col-md-12">
                                     <label for="username" class="phones m-3">Username:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input type="text" id="updatePublicName" class="inputed priceinput"
                                         placeholder="Your username" name="username" onfocusout="showPublicName()">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="fullname" class="phones m-3">Full Name:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input id="updateFullname" class="inputed priceinput" placeholder="Your full name"
                                         type="text" name="fullname" onfocusout="showFullname()">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="homeAddress" class="phones m-3">Your address:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input id="homeAddress" class="inputed priceinput" placeholder="address"
                                         type="text" name="homeAddress" onfocusout="showHomeaddress()">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="phonemodel" class="phones m-3">Your Phone's Model:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input id="phoneModel" class="inputed priceinput" placeholder="phone model"
                                         type="text" name="phonemodel" onfocusout="showPhonemodel()">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="email" class="phones m-3">Your email:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input id="email" class="inputed priceinput" placeholder="email" type="text"
                                         name="email" onfocusout="showEmail()">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="phonenumber" class="phones m-3">Your Phone Number:
                                         <div class="text-danger star userinput">*</div>
                                     </label></br>
                                     <input id="phoneNumber" class="inputed priceinput" placeholder="Phone number"
                                         type="text" name="phonenumber" onfocusout="showPhonenumber()">
                                 </div>




                             </div>
                             <div class="notice3 text-danger h3"></div>
                             <div class="notice text-danger h3"></div>
                             <div class="notice2 text-danger h3"></div>
                             <div class="notice4 text-danger h3"></div>
                             <div class="notice5 text-danger h3"></div>

                             <div class="col-sm-12 text-center">
                                 <button onclick="infoToCalc()" class="read_more btn btn-default">back</button>
                                 <button
                                     onclick="infoToReview();setPublicName();showPublicName();setFullname();setHomeaddress();setPhonemodel();setEmail();setPhonenumber();"
                                     class="read_more btn btn-default">Continue</button>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <?php include "includes/footer.php" ?>
 </div>
 <!-- end Personal info -->


 <!-- review info -->
 <div id="review">
     <div class="contact">
         <div class="container">

             <div class="col-md-12">
                 <div class="titlepage2">
                     <h2>Please review your information</h2>
                     <div class="mb-3">Is the entered information correct?</div>
                 </div>
             </div>
         </div>

         <div class="container">
             <div class="row">
                 <div class="col-md-12 ">

                     <div class="row">
                         <div class="main_form">

                             <div id="showUserData" class="col-md-12">


                                 <div class="col-md-12">
                                     <label for="showEthAddress" class="phones m-3">Eth address:

                                     </label>
                                     <span type="text" id="showEthAddress" class="text-white"
                                         name="showEthAddress"></span>
                                 </div>



                                 <div class="col-md-12">
                                     <label for="username" class="phones m-3">Username:

                                     </label>
                                     <span type="text" id="editPublicName" class="text-white" name="username"></span>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="fullname" class="phones m-3">Full name:

                                     </label>
                                     <span type="text" id="editFullname" class="text-white" name="fullname"></span>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="showHomeaddress" class="phones m-3">Home address:

                                     </label>
                                     <span type="text" id="showHomeaddress" class="text-white"
                                         name="showHomeaddress"></span>
                                 </div>


                                 <div class="col-md-12">
                                     <label for="showPhonemodel" class="phones m-3">Phone model:

                                     </label>
                                     <span type="text" id="showPhonemodel" class="text-white"
                                         name="showPhonemodel"></span>
                                 </div>


                                 <div class="col-md-12">
                                     <label for="showEmail" class="phones m-3">Email address:

                                     </label>
                                     <span type="text" id="showEmail" class="text-white" name="showEmail"></span>
                                 </div>



                                 <div class="col-md-12">
                                     <label for="showPhonenumber" class="phones m-3">Phone number:

                                     </label>
                                     <span type="text" id="showPhonenumber" class="text-white"
                                         name="showPhonenumber"></span>
                                 </div>



                                 <div class="col-md-12">
                                     <label for="showThief" class="phones m-3">Extra thief and cyber protection:

                                     </label>
                                     <span type="text" id="showThief" class="text-white" name="showThief"></span>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="showPayinterval" class="phones m-3">Payment's interval:

                                     </label>
                                     <span type="text" id="showPayinterval" class="text-white"
                                         name="showPayinterval"></span>
                                 </div>


                                 <div class="col-md-12">
                                     <label for="showPhoneage" class="phones m-3">Phone's purchase date:

                                     </label>
                                     <span type="text" id="showPhoneage" class="text-white" name="showPhoneage"></span>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="showPhoneprice" class="phones m-3">Phone's purchase price:

                                     </label>
                                     <span type="text" id="showPhoneprice" class="text-white"
                                         name="showPhoneprice"></span>
                                 </div>


                                 <div class="notice5 text-warning h3 m-5">If the information is correct, click continue,
                                     otherwise go back and correct the mistake.</div>


                                 <div class="col-sm-12 text-center">

                                     <button onclick="reviewToInfo()" class="read_more btn btn-default">back</button>
                                     <button onclick="reviewToPayment()"
                                         class="read_more btn btn-default">Continue</button>
                                 </div>




                             </div>




                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <?php include "includes/footer.php" ?>
 </div>
 <!-- end review info -->



 <!-- payment -->

 <div id="payment">
     <div class="contact">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="titlepage2">
                         <h2>Please pay the premium price to continue</h2>
                         <h3 class="text-white">Ethereum's secure payment</h3>
                     </div>
                 </div>
             </div>
         </div>
         <div class="container">

             <div class="text-center">
                 <div>
                     <figure><img src="images/metamask.png" alt="#" style="width:80px;height:80px;" /></figure>
                 </div>

                 <div class="col-md-12 text-danger h4">
                     <label for="showPremiumprice" class="phones m-5">The amount to pay is:

                     </label>
                     <span type="text" id="showPremiumprice" name="showPremiumprice"></span> €
                 </div>

                 <div class="col-md-12 text-danger h4">
                     <label for="etherPrice" class="phones m-5">The equivalent amount in Ether:

                     </label>
                     <span type="text" id="etherPrice" name="etherPrice"></span> Ether
                 </div>

                 <div class="col-md-12 text-warning h4">

                     <span type="text" id="mining" name="mining"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="mined" name="mined"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="successConfirmation" name="successConfirmation"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="contractAddress" name="contractAddress"></span>
                 </div>
                 <div class="col-md-12 text-danger h4">

                     <span type="text" id="failedTransaction" name="failedTransaction"></span>
                 </div>

                 <div class="col-md-12 text-danger h4">

                     <br>
                     <button onclick="paymentToReview()" class="read_more btn btn-default mb-5">Back</button>
                     <button id="pay" class="read_more btn btn-default mb-5">Pay now</button>
                     <button onclick="paymentToUserPanel()" id="showUserPanel" style="display: none" onclick=""
                         class="read_more btn btn-default mb-5">Go to
                         panel</button>


                 </div>
             </div>
         </div>

         <?php include "includes/footer.php" ?>
     </div>


     <!-- end payment -->


     <!-- review claim panel -->


     <!-- <div id="loggedIn" style="display:none;"
         class="user-login-msg text-white h3 bg-success font-weight-bold my-3 p-3 text-center">
         Successful Login with your Ethereum address: <span id="ethAddress"></span>
     </div> -->



     <div id="reviewClaimPanel">

         <div class="contact">
             <div class="container">
                 <div id="claimReviewSingle">

                 </div>
                 <div class="col-md-12">
                     <label for="updateClaimPrice" class="phones">Claim Price:
                         <div class="text-danger star userinput">*</div>
                     </label></br>
                     <input id="updateClaimPrice" class="inputed" placeholder="€" type="text" name="updateClaimPrice"
                         onfocusout="">
                 </div>

                 <div class="col-md-12 text-danger h4">
                     <label for="showClaimPrice" class="phones">The amount to pay is:

                     </label>
                     <span type="text" id="showClaimPrice" name="showClaimPrice"></span> €
                 </div>

                 <div class="col-md-12 text-danger h4">
                     <label for="claimInEther" class="phones">The equivalent amount in Ether:

                     </label>
                     <span type="text" id="claimInEther" name="claimInEther"></span> Ether
                 </div>

                 <div class="col-md-12 text-danger h4">
                     <label for="customerAddressClaim" class="phones">Customer's Ethereum address:

                     </label>
                     <span type="text" id="customerAddressClaim" name="customerAddressClaim"></span>
                 </div>

                 <div class="col-md-12 text-warning h4">

                     <span type="text" id="miningClaim" name="miningClaim"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="minedClaim" name="minedClaim"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="successConfirmationClaim" name="successConfirmationClaim"></span>
                 </div>
                 <div class="col-md-12 text-success h4">

                     <span type="text" id="contractAddressClaim" name="contractAddressClaim"></span>
                 </div>
                 <div class="col-md-12 text-danger h4">

                     <span type="text" id="failedTransactionClaim" name="failedTransactionClaim"></span>
                 </div>

                 <button onclick="ReviewClaimToAdmin()" id="" class="read_more btn btn-default ml-4 mb-5">Back</button>
                 <button onclick="setClaimPrice()" id="claimApprove" class="read_more btn btn-default ml-4 mb-5">Set
                     claim price</button>
                 <button onclick="" id="payClaim" class="read_more btn btn-default ml-4 mb-5">Pay the claim</button>
                 <button onclick="dissapproveClaim()" id="" class="read_more btn btn-default ml-4 mb-5">Dissapprove
                     claim</button>

             </div>



         </div>


     </div>
     <!-- end review claim panel -->


     <!-- user panel -->
     <div id="loggedIn" style="display:none;"
         class="user-login-msg text-white h3 bg-success font-weight-bold my-3 p-3 text-center">
         Successful Login with your Ethereum address: <span id="ethAddress"></span>
     </div>
     <div id="userPanel">

         <div class="contact">
             <div class="container">
                 <h3 id="welcomeUser" class="text-white"></h3>
                 <div class="col-md-12">
                     <label for="claimTitle" class="phones m-3">Claim title:
                         <div class="text-danger star userinput">*</div>
                     </label>
                     <input id="claimTitle" class="inputed priceinput" type="text" name="claimTitle">


                 </div>
                 <div class="col-md-12">
                     <label for="claimText" class="phones m-3">Enter your claim here:
                         <div class="text-danger star userinput">*</div>
                     </label>
                     </br> <textarea id="claimText" name="claimText" rows="4" cols="50"></textarea>

                 </div>
                 <button onclick="" class="read_more btn btn-default mt-4 ml-4">Submit</button>
             </div>
             <?php include "includes/footer.php" ?>
         </div>
         <!-- end user panel -->