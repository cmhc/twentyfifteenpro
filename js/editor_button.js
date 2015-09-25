(function() {   
    tinymce.create('tinymce.plugins.mybutton', { //mybutton是插件名称
        init : function(ed, url) {

            ed.addButton('code', { //pre是按钮名称 
                title : 'code',   
                image : url + '/code.png',//注意图片的路径 url是当前js的路径   
                onclick : function() {
                     var selected_text = ed.selection.getContent().replace("<p>","").replace("</p>","");;
                     ed.selection.setContent('<code>'+selected_text+'</code>'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码
                }   
            });

            ed.addButton('php', { //pre是按钮名称 
                title : 'php代码',   
                image : url + '/php.png',//注意图片的路径 url是当前js的路径   
                onclick : function() {
                     var selected_text = ed.selection.getContent().replace("<p>","").replace("</p>","");;
                     ed.selection.setContent('<pre class="brush:php">'+selected_text+'</pre>'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码
                }   
            });

            ed.addButton('js', { //pre是按钮名称 
                title : 'js代码',   
                image : url + '/js.png',//注意图片的路径 url是当前js的路径   
                onclick : function() {
                     var selected_text = ed.selection.getContent().replace("<p>","").replace("</p>","");
                     ed.selection.setContent('<pre class="brush:js">'+selected_text+'</pre>'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码
                }   
            });

        },   
        createControl : function(n, cm) {   
            return null;   
        },   
    });   
    tinymce.PluginManager.add('mybutton_script', tinymce.plugins.mybutton); //第一个是脚本，第二个是插件
})();  

