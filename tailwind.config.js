/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.{svelte,vue}",
  ],
  theme: {
    extend: {
            fontFamily: {
                //'sans': ['"Platypi"', ...defaultTheme.fontFamily.sans],
                //'sans': ['"Montserrat"', ...defaultTheme.fontFamily.sans],
            },
        },
  },
plugins: [
    require('@tailwindcss/typography'),
],
}

