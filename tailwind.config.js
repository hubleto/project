/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./vendor/hubleto/main/src/**/*.{html,js,twig,tsx}",
    "./vendor/hubleto/main/core/**/*.{html,js,twig,tsx}",
    "./vendor/hubleto/main/apps/**/*.{php,html,js,twig,tsx}",
    "./vendor/hubleto/framework/**/*.{tsx,twig}",
    "./vendor/hubleto/framework/node_modules/primereact/**/*.{js,ts,jsx,tsx}",
    "../premium/**/*.{php,html,js,twig,tsx}",
  ],
  safelist: [
    'adios-lookup__indicator',
    'adios-lookup__control',
    'adios-lookup__input-container',
    'adios-lookup__value-container',
    'adios-lookup__input',
  ],
  plugins: [],
}

