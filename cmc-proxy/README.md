# cmc-proxy
A Nodejs **"dumb"** Proxy for interact with CoinMarketCap's new APIs.

## Motivation
Starting with the latest version of CoinMarketCap (CMC) API released early 2019, it is no longer possible call the CMC's API directly from a client.

## Tech used
<b>Built with</b>
- [NodeJS](https://nodejs.org)
- [Express](https://expressjs.com)
- [Axios](https://github.com/axios/axios)

## Features
When it receives a request, it'll simply forward the request to CMC's API and return the response being it a successful request or not.

The response behavior will be the same as if you were sending requests to CMC's API directly, no data manipulation is done on the proxy.

## Local Installation and develompent execution
To install it locally, clone the repository, cd in cmc-proxy and type in your terminal
```
npm install
```

You also need to replace the **.env.sample** file with **.env** file and replace the content with your CMC's API.

To start the development server, type in your terminal
```
npm run dev
```

If you need to run the script in production, type in your terminal
```
npm run start
```

## Deploy on Vercel
For deploying on Vercel, you must add your CMC's API key as a secret
```
vercel secrets add cmc_api_key "YOUR_CMC_API_KEY_GOES_HERE"
```
and then to deploy it type in your terminal
```
vercel
```
the console output will provide you the url of the proxy. You can change it directly from Vercel's dashboard too.

## Can I deploy it on another platform?
Sure. 

You can deploy it on Lambda, on Azure Functions, on Heroku or on your favourite service as long as it can run NodeJS.

In this case, instead of setting the **vercel secret**, you have to replace the **.env.sample** file with **.env** file and replace the value with your CMC's API key.