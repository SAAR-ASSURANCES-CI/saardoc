/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/**/*.php",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./vendor/laravel/jetstream/**/*.blade.php",
  ],
  theme: {
    extend: {
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-in-from-right': 'slideInFromRight 0.3s ease-out',
        'zoom-in-95': 'zoomIn95 0.3s ease-out',
        'bounce-in': 'bounceIn 0.6s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideInFromRight: {
          '0%': { 
            opacity: '0',
            transform: 'translateX(100%)'
          },
          '100%': { 
            opacity: '1',
            transform: 'translateX(0)'
          },
        },
        zoomIn95: {
          '0%': { 
            opacity: '0',
            transform: 'scale(0.95)'
          },
          '100%': { 
            opacity: '1',
            transform: 'scale(1)'
          },
        },
        bounceIn: {
          '0%': { 
            opacity: '0',
            transform: 'scale(0.3)'
          },
          '50%': { 
            opacity: '1',
            transform: 'scale(1.05)'
          },
          '70%': { 
            transform: 'scale(0.9)'
          },
          '100%': { 
            opacity: '1',
            transform: 'scale(1)'
          },
        },
      },
      transitionProperty: {
        'all-smooth': 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
      },
      transitionDuration: {
        '5000': '5000ms',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
