const path = require('path')
const webpack = require('webpack')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

const resolve = path.resolve
const production = process.env.NODE_ENV === 'production'

module.exports = {
  mode: production ? 'production' : 'development',
  devtool: production ? 'source-map' : 'eval',
  entry: [
    path.join(__dirname, './../assets/custom/js/custom.js'),
    path.join(__dirname, './../assets/custom/scss/mixed.scss')
  ],
  output: {
    path: resolve(__dirname, './../assets'),
    filename: '[name].bundle.js',
    publicPath: '/'
  },
  watch: true,
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              modules: false
            }
          }
        ]
      },
      {
        test: /\.(png|jpg|gif)$/,
        type: 'asset/source'
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          }, {
            loader: 'css-loader',
            options: {
              modules: false,
              url: false,
              sourceMap: true
            }
          }, {
            loader: 'postcss-loader',
            options: {
              sourceMap: true
            }
          }, {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
              sassOptions: {
                includePaths: [
                  resolve(__dirname, 'assets')
                ]
              }
            }
          }
        ]
      },
      {
        test: /\.(otf|eot|svg|ttf|woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
        type: 'asset/source'
      }
    ]
  },
  context: __dirname,
  target: 'web',
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'mixed.min.css'
    })
  ]
}
