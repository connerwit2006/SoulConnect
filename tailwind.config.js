import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            animation: {
                'ping-slow': 'ping 2s cubic-bezier(0, 0, 0.2, 1) infinite', // Pas hier de duur aan, bv. 2s
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bg1: {
                    DEFAULT: '#fdf2e9', // Light brown background color
                },
                bg2: {
                    DEFAULT: '#ecd2bd', // Secondary background color
                },
                accent: {
                    DEFAULT: '#eda6ac', // Pink for small details
                },
            },
        },
    },

    plugins: [forms],
};
