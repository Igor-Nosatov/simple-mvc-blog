const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    mode: "development",
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        new MiniCssExtractPlugin({
            filename: "../css/[name].css",
        })
    ],
    module: {
        rules: [
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: '../fonts/'
                    }
                }]
            },
            {
                test: /\.(s*)css$/,
                exclude: path.resolve(__dirname, 'node_modules/'),
                use: [{
                    loader: MiniCssExtractPlugin.loader,
                },
                {
                    loader: "css-loader",
                    options: {
                        url: true,
                    }
                },
                {
                    loader: "sass-loader"
                }]
            }
        ],
    },
    entry: './assets/js/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'public/js')
    }
};
