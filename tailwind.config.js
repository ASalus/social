module.exports = {
    content: [
        './public/index.html',
        './resources/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                'blueGray': {
                    '100': '#cfd8dc',
                    '200': '#b0bec5',
                    '300': '#90a4ae',
                    '400': '#78909c',
                    '500': '#607d8b',
                    '600': '#546e7a',
                    '700': '#455a64',
                    '800': '#37474f',
                    '900': '#263238',
                },
            }
        },
    },
    plugins: [],
}