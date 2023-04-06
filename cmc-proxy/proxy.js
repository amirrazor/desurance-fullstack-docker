const fs = require("fs");
const express = require("express");
// const https = require("https");
const cors = require("cors");
const morgan = require("morgan");
const axios = require("axios");

require("dotenv").config();

const app = express();

// var privateKey  = fs.readFileSync('sslcert/privkey.pem', 'utf8');
// var certificate = fs.readFileSync('sslcert/cert.pem', 'utf8');

// const credentials = {key: privateKey, cert: certificate};

app.use(morgan("tiny"));
app.use(cors());

app.get("/*", (req, res) => {
  let url = `https://pro-api.coinmarketcap.com/v2/tools/price-conversion?amount=1&id=1027&convert_id=2790`;

  axios
    .get(url, { headers: { "X-CMC_PRO_API_KEY": process.env.CMC_API_KEY } })
    .then((response) => {
      res.send(response.data);
      const jsonClaim = response.data.data.quote[2790].price;
      console.log(jsonClaim);
    })
    .catch((err) => {
      console.log(err.response.data);
      res.send(err.response.data);
    });
});

const port = process.env.PORT || 8082;
listen(port, () => {
  console.log("Listening on port ", port);
});
