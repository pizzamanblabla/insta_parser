module.exports = {
    context: __dirname,
    entry:  {
        app: ['./app/main.tsx', './css/main.scss'],
    },
    output: {
        path:     '../public',
        filename: 'bundle-[name].js',
        sourceMapFilename: 'bundle-[name].js.map',
    }
};