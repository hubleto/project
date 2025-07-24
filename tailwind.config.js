/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./vendor/hubleto/main/**/*.{html,js,twig,tsx}",
    "./vendor/hubleto/framework/**/*.{tsx,twig}",
    "./node_modules/primereact/**/*.{js,ts,jsx,tsx}",
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

