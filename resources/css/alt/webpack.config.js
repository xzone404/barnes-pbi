const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const devMode = process.env.NODE_ENV !== "production";


module.exports = {
  mode: devMode ?
    'development' : 'production',

  entry: {
    index: ['./resources/index.js', './resources/sass/main.scss']
  },

  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist'),
    assetModuleFilename: '[name][ext]', // Default is 'images/[hash][ext][query]'
  },

  plugins: [].concat(devMode ? [] : [
    new MiniCssExtractPlugin({
      filename: "css/[name].css",
    })
  ]),

  module: {
    rules: [
      {
        test: /\.(jpg|jpeg|gif|png|svg)$/,
        type: 'asset/resource',
        exclude: path.resolve(__dirname, 'resources/fonts'),
        generator: {
          filename: 'images/[name][ext]'
        },
      },
      {
          test: /\.(woff|woff2|eot|ttf|svg)$/,
          type: 'asset/resource',
          exclude: path.resolve(__dirname, 'resources/pictures'),
          generator: {
            filename: 'fonts/[name][ext]'
          },
      },
      {
        test: /\.css$/i,
        use: [
          devMode ? "style-loader" : MiniCssExtractPlugin.loader,
          "css-loader",
        ],
      },
      {
        test: /\.(c|sa|sc)ss$/i,
        use: [
          devMode ? "style-loader" : MiniCssExtractPlugin.loader,
          "css-loader",
          "sass-loader",
        ],
      },
    ],
  },
};