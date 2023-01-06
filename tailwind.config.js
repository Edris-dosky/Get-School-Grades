/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*/*.{html,php,js}"],
  theme: {
    fontFamily: {
      'display' : ["rudaw"],
    },
    extend: {
      colors: {
        'black-rgba': 'rgba(0, 0, 0, 0.19)',
      },
    },
  },
  plugins: [],
}
