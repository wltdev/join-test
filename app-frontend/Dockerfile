FROM node:18

WORKDIR /usr/app

# Copy package files
COPY package*.json ./

# Install dependencies with npm retry settings
RUN npm set progress=false && \
    npm config set registry https://registry.npmjs.org/ && \
    npm install --no-audit --legacy-peer-deps

# Copy source files
COPY . .

EXPOSE 3000

# Development mode
ENV NODE_ENV=development
CMD ["npm", "run", "dev"]
