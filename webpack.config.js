const path = require('path');
const fs = require('fs');


function loadEntriesFromRepository(folder) {
  let entries = [];
  if (fs.lstatSync(folder).isDirectory()) {
    fs.readdirSync(folder).forEach(function(app){
      const stat = fs.statSync(folder + '/' + app);
      const loaderEntry = folder + '/' + app + '/Loader';
      if (stat && stat.isDirectory() && fs.existsSync(loaderEntry + '.tsx')) {
        entries.push(loaderEntry);
      }
    });
  }
  return entries;
}

module.exports = (env, arg) => {
  return {
    // stats: 'verbose',
    entry: {
      hubleto: [
        './vendor/hubleto/main/src/Main',
        // './repositories.tsx',
        ...loadEntriesFromRepository(path.resolve(__dirname, 'vendor/hubleto/main/apps')),
        // ...loadEntriesFromRepository(path.resolve(__dirname, '../apps')),
      ],
    },
    output: {
      path: path.resolve(__dirname, 'assets/compiled/js'),
      filename: '[name].js',
      clean: true
    },
    // optimization: {
    //   minimize: true,
    // },
    module: {
      rules: [
        {
          test: /\.(js|mjs|jsx|ts|tsx)$/,
          use: 'babel-loader',
        },
        {
          test: /\.(scss|css)$/,
          use: ['style-loader', 'css-loader', 'sass-loader'],
        }
      ],
    },
    optimization: {
      splitChunks: {
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: 'vendors',
            chunks: 'all'
          }
        }
      }
    },
    resolve: {
      modules: [ path.resolve(__dirname, './node_modules') ],
      extensions: ['.js', '.jsx', '.ts', '.tsx', '.scss', '.css'],
      alias: {
        '@hubleto/ui/core': path.resolve(__dirname, 'vendor/hubleto/framework/src/Components/Core'),
        '@hubleto/ui/ext': path.resolve(__dirname, 'vendor/hubleto/framework/src/Components/Ext'),
        '@hubleto/apps': path.resolve(__dirname, 'vendor/hubleto/main/apps'),
      },
    }
  }
};
