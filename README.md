# Job Symfony

Job listing app developed with Symfony & vuejs. App provides smooth and fast user experience, especially when navigating to job detail page and back. All pages are accessible directly, even though that we use 

## Live demo

You can visit running app at https://recruitis.kiwko.cz/

## Install locally

Requirements:

- git
- composer
- symfony CLI
- npm
  - [optional] pnpm (if `pnpm` is not installed, run `npm install -g pnpm@latest-10`), but lock file is for `pnpm`. If you want to use `npm` replace `pnpm` with `npm` in all commands

Clone repository

```bash
git clone git@github.com:mskocik/recruitis-symfony.git my-dir
```

Change dir

```bash
cd my-dir
```

Install PHP dependencies

```bash
composer install
```

Install node.js dependencies

```bash
pnpm i
```

## App setup

Configuration file `.env.local` must be edited

```env
APP_ENV=dev|prod
RECRUITIS_API_KEY=<valid-recruitis-api-key>
```

Depending on `APP_ENV` value, frontend assets must be built.

- `dev`: run `pnpm run dev`
- `prod`: run `pnpm run build`

## Start server

Start server through Symfony CLI

```bash
symfony server:start
```

Visit http://127.0.0.1:8000 
