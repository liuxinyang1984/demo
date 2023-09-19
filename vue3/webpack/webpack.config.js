//加载path对象
const path = require('path')

//加载htmlPlugin构造函数
const HtmlPlugin = require('html-webpack-plugin')
//实例化对象
const htmlPluginObj = new HtmlPlugin({
    template:'./src/index.html',
    filename:'./index.html',
})

//加载clean-webpack-plugin构造函数
const {CleanWebpackPlugin} = require('clean-webpack-plugin')
//实例化对象
const cleanWebpackPluginObj =  new CleanWebpackPlugin()

module.exports = {
    mode: 'development',     //mode用来指定构建模式,可选值有development和production
    output:{
        path:path.join(__dirname,'dist'),
        filename:'js/bundle.js'
    },
    devServer:{
        'static':'./',
        //'open':true
    },
    plugins:[htmlPluginObj,cleanWebpackPluginObj],
    module:{
        rules:[
            {
                test:/\.css$/,
                use:['style-loader','css-loader']
            },
            {
                test:/\.less$/,
                use:['style-loader','css-loader','less-loader']
            },
            {
                test:/\.jpg|png|gif|jpeg$/,
                use:{
                    loader:'url-loader',
                    options:{
                        limit:22228,
                        outputPath:"images"
                    }
                }
            }
        ]
    },
    devtool:'nosources-source-map'

}
