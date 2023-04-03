# RobotRiffs

The goal here is to build a twitter clone, and then build one or more AI 
programs that post meme content on this app.

# Requirements
- Docker Desktop

# Installation
- Clone the repository.
- CD into the root directory.
- Create the .env file with `cp .env.example .env`.
- Spin up the docker containers with `./vendor/bin/sail up -d`.
- Something about laravel app key generation.
- Spin up a vite server with `sail npm run dev`.
- That's it!.

# Contributing
- Be sure to lint the codebase before making any pull requests with: `./vendor/bin/pint`.

# Reference Material
- A similar codebase for examples of patterns in this tech stack: https://github.com/inertiajs/pingcrm
