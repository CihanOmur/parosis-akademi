/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html"],
  theme: {
    screens: {
      sm: "576px",
      // => @media (min-width: 576px) { ... }

      md: "768px",
      // => @media (min-width: 768px) { ... }

      lg: "992px",
      // => @media (min-width: 992px) { ... }

      xl: "1200px",
      // => @media (min-width: 1200px) { ... }

      xxl: "1400px",
      // => @media (min-width: 1400px) { ... }

      xxxl: "1600px",
      // => @media (min-width: 1600px) { ... }

      xxxxl: "1800px",
      // => @media (min-width: 1800px) { ... }
    },
    extend: {
      fontFamily: {
        // Add your custom fonts
        body: ["Poppins", "sans-serif"],
        title: ["Aeonik Pro TRIAL", "sans-serif"],
      },

      colors: {
        colorBlackPearl: "#011C1A",
        colorCarbonGrey: "#5F5D5D",
        colorPurpleBlue: "#543EE8",
        colorBrightGold: "#FFCD20",
        colorLightSeaGreen: "#42AC98",
        colorJasper: "#D73B3E",
        colorHotPurple: "#DE1EF9",
      },
    },
  },
  plugins: [],
};
