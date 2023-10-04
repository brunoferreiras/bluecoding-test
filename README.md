# Tech Test

## Gettings Started
It's need to install in your computer:
`Docker: 24.0.0+`

Execute this commands to start the application:
```bash
// Create the .env file
cp .env.example .env
// Update the variable GIPHY_API_KEY in .env file
// Start all containers docker
make up
// Enter in container
make bash
// Generate the key
php artisan key:generate
// Run the migrations
php artisan migrate
// Run the npm install
npm install
// Run the npm run dev
npm run dev
// It's everything!
// You can access the api in: http://localhost:8060/
```
## Framework
- [Laravel](https://laravel.com/)
## Database
- MySQL 8.0
- Redis 6.2

## Demo

![Demo](./docs/demo.mp4)
