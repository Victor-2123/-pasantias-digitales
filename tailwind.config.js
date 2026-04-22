import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                lexend: ['Lexend', 'sans-serif'],
            },
            colors: {
                stitch: {
                    primary: '#00355f',
                    'primary-container': '#0f4c81',
                    secondary: '#006b5f',
                    'secondary-container': '#62fae3',
                    background: '#f8f9ff',
                    surface: '#f8f9ff',
                    'on-surface': '#0d1c2e',
                    'on-surface-variant': '#42474f',
                    outline: '#727780',
                }
            },
            borderRadius: {
                'stitch': '0.5rem',
            }
        },
    },

    plugins: [forms],
};
