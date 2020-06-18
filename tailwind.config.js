const defaultTheme = require('tailwindcss/defaultTheme')
const axiomTheme = require('./themes/axiom/tailwind.config')

// Unset to prevent duplication
axiomTheme.purge.options.whitelist = [];

module.exports = axiomTheme;
