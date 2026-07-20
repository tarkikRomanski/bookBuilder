/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,ts,scss}",
  ],
  theme: {
    extend: {
      colors: {
        obsidian: '#0b0f19',
        pearl: '#f8fafc',
      }
    },
  },
  plugins: [],
}
