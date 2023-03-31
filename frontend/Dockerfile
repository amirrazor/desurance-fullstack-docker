FROM node:16-alpine
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
COPY package*.json ./
RUN npm install
COPY . .
EXPOSE 8081
CMD ["npm", "run", "start"]