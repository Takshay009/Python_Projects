module.exports = {
  webpack: {
    configure: (webpackConfig) => {
      // Find the css rule
      const cssRule = webpackConfig.module.rules.find(rule => rule.oneOf);
      if (cssRule && cssRule.oneOf) {
        const postcssRule = cssRule.oneOf.find(rule => rule.test && rule.test.test && rule.test.test('.css') && rule.use);
        if (postcssRule) {
          postcssRule.use = postcssRule.use.map(loader => {
            if (loader.loader && loader.loader.includes('postcss-loader')) {
              loader.options.postcssOptions = {
                plugins: [
                  require('tailwindcss')('./tailwind.config.js'),
                  require('autoprefixer'),
                ],
              };
            }
            return loader;
          });
        }
      }
      return webpackConfig;
    },
  },
}