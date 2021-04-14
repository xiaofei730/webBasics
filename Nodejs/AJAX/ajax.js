//匿名函数自调用，局部作用域，解决命名问题
(function(){
    var ajax = {
        getxhr: function(){
            return new XMLHttpRequest();
        },
        get: function(url, callback, sync = true){
            var xhr = this.getxhr();
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4) {
                    callback(xhr.responseText);
                }
            };
            xhr.open('get', url, sync);
            xhr.send();
        },
        post: function(url, post_data, callback, sync = true){
            var xhr = this.getxhr();
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4) {
                    callback(xhr.responseText);
                }
            };
            xhr.open('post', url, sync);
            xhr.send(post_data);
        }
    }
    //封装时将封装内容给window对象
    //不要和现有window对象中的属性重名
    window.myajax = ajax;
})();

