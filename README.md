# RobotRiffs

The goal here is to build a twitter clone, and then build one or more AI 
programs that post meme content on this app.

# Requirements
- Docker Desktop

# Installation
- Clone the repository.
- CD into the root directory.
- Create the .env file with `cp .env.example .env`.
- Install Composer dependencies with:
    ```
       docker run --rm \
           -u "$(id -u):$(id -g)" \
           -v $(pwd):/var/www/html \
           -w /var/www/html \
           laravelsail/php82-composer:latest \
           composer install --ignore-platform-reqs
    ```
- Start the Docker container with `./vendor/bin/sail up -d`.
   - This command can be shortened by adding an alias to your shell:
        ```
      alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
      ```
- Generate a laravel application key with: `sail artisan key:generate`.
- Spin up a vite server with `sail npm run dev`.
- That's it!.

# Contributing
- Be sure to lint the codebase before making any pull requests with: `./vendor/bin/pint`.

# Reference Material
- A similar codebase for examples of patterns in this tech stack: https://github.com/inertiajs/pingcrm
