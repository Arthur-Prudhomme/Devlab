/** @type {import('tailwindcss').Config} */
module.exports = {

  content: [
    "**/*.php",
  ],

  theme: {
    extend: {
      colors:{
        fond:'#0D1013',
        gris:'#726F6F',
        form:'#0A0F14',
        rouge:'#AE0000',
        bg:'#15191E',
      },

      backgroundImage: {
        'card-bg': "url('https://i.pinimg.com/originals/df/07/fb/df07fbdb4002b4098f68ea166fafa7de.jpg')",
        'card_bg': "url('https://static0.srcdn.com/wordpress/wp-content/uploads/2020/02/v-for-vendetta-Edited.jpg')",
      }
    },
  },
  plugins: [
    //require('tw-elements/dist/plugin')
  ],
}