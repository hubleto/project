# Hubleto Empty Project

## Instalation

If you want to download and install Hubleto and use it, simply run following commands in any folder:

  * `composer create-project hubleto/project .` to create an empty project
  * `php hubleto init` to install database and required configs

Now, your Hubleto is ready to be used. You may develop your own apps. Check https://developer.hubleto.com for more information.

## Development environment

If you want to contribute to Hubleto core development, you need to do some more steps. You will need to download & install:

  * `hubleto/framework` - the MVC-based backend framework used by Hubleto ERP
  * `@hubleto/react-ui` - the React-based frontend library used by Hubleto ERP
  * `hubleto/main` - the ERP functionality built on top of the framework and UI library
  * `hubleto/project` - contents of the development folder

Follow the steps described below to install everything.

### Prepare `hubleto/framework`

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/framework.git`

### Prepare `@hubleto/react-ui` package

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/react-ui.git`
  * `cd react-ui`
  * `npm install`
  * `npm link`

### Prepare `hubleto/main`

  * `cd /var/www/html/hubleto`
  * `git clone https://github.com/hubleto/main.git`

### Install `hubleto/project` into your `dev` folder

Here we assume you will be installing your development version of Hubleto in the folder named `dev`. You may change this to any other folder name.

  * `cd /var/www/html/hubleto/dev`
  * `composer create-project hubleto/project .`
  * `composer install`
  * `php hubleto init`
  * `npm link @hubleto/react-ui`
  * `npm run build`

You may then use `npm run watch-js` or `npm run watch-css` for fast rebuild during the development.