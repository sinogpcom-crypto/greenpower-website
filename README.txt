修复内容

1. 替换bangcms.cn链接
2. 兼容https协议
3. H5替换flash上传插件

新闻 pc标签填写where="posids!=1" 后，分页统计数量错误，修改bangcms\modules\content\classes\content_tag.class.php
count($data)   注释 if(isset($data['where'])) 

相关文章修改show_relation({MODELID},{ID})方法改show_relation(onmodelid，{MODELID},{ID})；onmodelid为当前表id MODELID为存入表id  