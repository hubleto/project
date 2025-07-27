# Hubleto Empty Project

## Instalation

  * `composer create-project hubleto/project`
  * `composer install`
  * `npm install`
  * `npm run build-js`
  * `npm run build-css`
  * `php hubleto init`

## Development environment

Prepare `hubleto/framework`:

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/framework.git`

Prepare `hubleto/main`:

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/framework.git`

Prepare `react-ui` package:

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/react-ui.git`
  * `cd react-ui`
  * `npm install`
  * `npm link`

Prepare dev folder:

  * `cd /var/www/html/hubleto`
  * `mkdir dev`
  * `cd dev`
  * `composer create-project hubleto/project`

Now change `package.json` file to link to your local `react-ui` package. Set `@hubleto/react-ui` dependency to following:

```
"@hubleto/react-ui": "file:../react-ui",
```

Install:

  * `composer install`
  * `npm link @hubleto/react-ui`
  * `npm install`
  * `npm run build`
  * `php hubleto init`

You may then use `npm run watch-js` or `npm run watch-css` for fast rebuild during the development.