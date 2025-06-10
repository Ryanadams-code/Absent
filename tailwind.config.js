/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Material Design 3 color system - Updated to match KelasKu green logo
        primary: {
          50: '#e8f5e9',
          100: '#c8e6c9',
          200: '#a5d6a7',
          300: '#81c784',
          400: '#66bb6a',
          500: '#4caf50',
          600: '#43a047',
          700: '#388e3c',
          800: '#2e7d32',
          900: '#1b5e20',
          950: '#0d3c11',
        },
        secondary: {
          50: '#e0f2f1',
          100: '#b2dfdb',
          200: '#80cbc4',
          300: '#4db6ac',
          400: '#26a69a',
          500: '#009688',
          600: '#00897b',
          700: '#00796b',
          800: '#00695c',
          900: '#004d40',
          950: '#003329',
        },
        // Surface colors for Material Design 3
        surface: {
          50: '#fafafa',  // surface dim
          100: '#f5f5f5', // surface lowest
          200: '#eeeeee', // surface low
          300: '#e0e0e0', // surface container
          400: '#bdbdbd', // surface high
          500: '#9e9e9e', // surface highest
          600: '#757575',
          700: '#616161',
          800: '#424242',
          900: '#212121',
          950: '#121212', // surface dark
        },
        // Keep existing utility colors
        success: {
          50: '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#22c55e',
          600: '#16a34a',
          700: '#15803d',
          800: '#166534',
          900: '#14532d',
          950: '#052e16',
        },
        danger: {
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#ef4444',
          600: '#dc2626',
          700: '#b91c1c',
          800: '#991b1b',
          900: '#7f1d1d',
          950: '#450a0a',
        },
        warning: {
          50: '#fffbeb',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b',
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
          950: '#451a03',
        },
        info: {
          50: '#ecfeff',
          100: '#cffafe',
          200: '#a5f3fc',
          300: '#67e8f9',
          400: '#22d3ee',
          500: '#06b6d4',
          600: '#0891b2',
          700: '#0e7490',
          800: '#155e75',
          900: '#164e63',
          950: '#083344',
        },
      },
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      },
      boxShadow: {
        // Material Design 3 elevation levels
        'elevation-1': '0 1px 2px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1)',
        'elevation-2': '0 2px 4px rgba(0, 0, 0, 0.05), 0 2px 6px rgba(0, 0, 0, 0.1)',
        'elevation-3': '0 4px 8px rgba(0, 0, 0, 0.05), 0 4px 12px rgba(0, 0, 0, 0.1)',
        'elevation-4': '0 8px 16px rgba(0, 0, 0, 0.05), 0 8px 24px rgba(0, 0, 0, 0.1)',
        'elevation-5': '0 16px 32px rgba(0, 0, 0, 0.05), 0 16px 48px rgba(0, 0, 0, 0.1)',
      },
      borderRadius: {
        // Material Design 3 shape scale
        'none': '0',
        'sm': '0.25rem',    // 4px
        DEFAULT: '0.375rem', // 6px
        'md': '0.5rem',     // 8px
        'lg': '0.75rem',    // 12px
        'xl': '1rem',       // 16px
        '2xl': '1.5rem',    // 24px
        '3xl': '2rem',      // 32px
        'full': '9999px',
      },
    },
  },
  plugins: [],
}