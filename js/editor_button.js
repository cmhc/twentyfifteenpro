(function() {   
    tinymce.create('tinymce.plugins.mybutton', { //mybutton是插件名称
        init : function(ed, url) {   
            ed.addButton('pre', { //pre是按钮名称 
                title : 'pre标签',   
                image : url + '/pre.png',//注意图片的路径 url是当前js的路径   
                onclick : function() {
                     var selected_text = ed.selection.getContent();
                     ed.selection.setContent('<pre>'+selected_text+'</pre>'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码  
    
                }   
            });
        },   
        createControl : function(n, cm) {   
            return null;   
        },   
    });   
    tinymce.PluginManager.add('mybutton_script', tinymce.plugins.mybutton); //第一个是脚本，第二个是插件
})();  

