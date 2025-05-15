import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        screens: {
            sm: '640px',     // mobile
            md: '1000px',    // tablet (compact desktop)
            lg: '1280px',    // desktop
            xl: '1440px',    // large desktop
        },
        extend: {
            fontFamily: {
                title: ['Montserrat', 'sans-serif'], // Шрифт для заголовков
                body: ['Open Sans', 'sans-serif'],   // Шрифт для основного текста
            },
            colors: {
                primary: '#FFB400', // Yellow
                secondary: '#FF7043', // Orange
                accent: '#E63946', // Red
                background: '#121212', // Black
                text: '#FFFFFF', // White
            },
        },
    },

    plugins: [forms, typography],
};
