module.exports = {
    purge: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'media', // or false or 'class'
    theme: {
        extend: {colors:{"leFocus": "var(--focus)"}},
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
