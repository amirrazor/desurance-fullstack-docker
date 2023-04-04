const express = require("express");
const cors = require("cors");
const morgan = require("morgan");
const axios = require("axios");

require("dotenv").config();


const app = express();

app.use(morgan("tiny"));
app.use(cors());

// app.all('*', function(req, res, next) {
//   res.header('Access-Control-Allow-Origin', '*');
//   res.header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS');
//   res.header('Vary', 'origin');
//     res.header('Access-Control-Expose-Headers', 'MyCustomHeader');
//     res.header('MyCustomHeader', '');
//   res.header(
//     'Access-Control-Allow-Headers',
//     'Origin, X-Requested-With, Content-Type, Accept, Authorization'
//   );
//   res.header('Access-Control-Max-Age', '86400');
//   next();
// });


app.get("/*", (req, res) => {
  let url = `https://pro-api.coinmarketcap.com/v2/tools/price-conversion?amount=1&id=1027&convert_id=2790`;

  axios
    .get(url, { headers: { "X-CMC_PRO_API_KEY": process.env.CMC_API_KEY} })
    .then((response) => {
      res.send(response.data);
    })
    .catch((err) => {
      console.log(err.response.data);
      res.send(err.response.data);
    });
});

const port = process.env.PORT || 443;
app.listen(port,'0.0.0.0', () => {
  console.log("Listening on port ", port);
  
});
