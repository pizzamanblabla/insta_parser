var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    context: __dirname,
    entry:  {
        app: ['./app/main.tsx', './css/main.scss'],
    },
    output: {
        path:     '../public',
        filename: 'bundle-[name].js',
        sourceMapFilename: 'bundle-[name].js.map',
    },
    module: {
        loaders: [
            {
                test: /\.tsx$/,
                loader: 'awesome-typescript-loader',
                include: __dirname,
            },
            {
                test: /\.scss$/,
                loader: ExtractTextPlugin.extract('style', 'raw!sass'),
                include: [__dirname + '/css', __dirname + '/app'],
            }
        ],
    },
    plugins: [
        new ExtractTextPlugin("styles.css")
    ],
    resolve: {
        extensions: ["", ".webpack.js", ".web.js", ".ts", ".tsx", ".js"]
    },
};