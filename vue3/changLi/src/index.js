// 导入jQuery
import $ from 'jquery'

// 导入css
import './css/index.css'
import './css/index.less'
// 隔行变色效果
$(function(){
    $("li:odd").css("cssText","background-color:cyan")
    $("li:even").css("cssText","background-color:green")
})


class Person{
    static info = "person info"
}
console.log(Person.info)
