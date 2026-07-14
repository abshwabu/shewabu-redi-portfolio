import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#E8EEF4',
                    100: '#C5D3E3',
                    200: '#9BB4CD',
                    300: '#7194B7',
                    400: '#4D789F',
                    500: '#2A5C87',
                    600: '#1E4568',
                    700: '#15334E',
                    800: '#0F2840',
                    900: '#0B2545',
                    950: '#071828',
                    DEFAULT: '#0B2545',
                },
                accent: {
                    50: '#FBF6E8',
                    100: '#F5EAC7',
                    200: '#EBD58F',
                    300: '#E0BF57',
                    400: '#D4AD3A',
                    500: '#C9A227',
                    600: '#A8841F',
                    700: '#876719',
                    800: '#664E13',
                    900: '#45350D',
                    DEFAULT: '#C9A227',
                },
                surface: {
                    50: '#F7F8FA',
                    100: '#EEF0F3',
                    200: '#DCE0E6',
                    300: '#C5CCD6',
                    400: '#9AA3B2',
                    500: '#6B7585',
                    600: '#4A5565',
                    700: '#343C4A',
                    800: '#222833',
                    900: '#141820',
                    DEFAULT: '#F7F8FA',
                },
            },
            fontFamily: {
                display: ['"Libre Baskerville"', ...defaultTheme.fontFamily.serif],
                sans: ['"Source Sans 3"', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                card: '0 10px 30px -18px rgba(11, 37, 69, 0.45)',
                'card-hover': '0 18px 40px -20px rgba(11, 37, 69, 0.55)',
            },
        },
    },
    plugins: [typography],
};
