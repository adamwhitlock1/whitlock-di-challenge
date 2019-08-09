// Require path.
const path = require("path");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const TerserJSPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

// Configuration object.
const config = {
  // Create the entry points.
  // One for frontend and one for the admin area.
  entry: {
    // frontend and admin will replace the [name] portion of the output config below.
    main: "./src/client/js/main.js"
  },

  // Create the output files.
  // One for each of our entry points.
  output: {
    // [name] allows for the entry object keys to be used as file names.
    filename: "js/[name].js",
    // Specify the path to the JS files.
    path: path.resolve(__dirname, "public")
  },

  optimization: {
    minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})]
  },

  plugins: [
    new BrowserSyncPlugin({
      // browse to http://localhost:3000/ during development,
      // ./public directory is being served
      host: "localhost",
      port: 3000,
      proxy: "http://localhost:9999",
      open: false
    }),
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // all options are optional
      filename: "css/[name].css",
      chunkFilename: "css/[id].css",
      ignoreOrder: false // Enable to remove warnings about conflicting order
    })
  ],

  resolve: {
    extensions: [".js", ".css"]
  },

  // Setup a loader to transpile down the latest and great JavaScript so older browsers
  // can understand it.
  module: {
    rules: [
      {
        // Look for any .js files.
        test: /\.js$/,
        // Exclude the node_modules folder.
        exclude: /node_modules/,
        // Use babel loader to transpile the JS files.
        loader: "babel-loader"
      },
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              hmr: process.env.NODE_ENV === "development"
            }
          },
          "css-loader"
        ]
      }
    ]
  }
};

// Export the config object.
module.exports = config;
