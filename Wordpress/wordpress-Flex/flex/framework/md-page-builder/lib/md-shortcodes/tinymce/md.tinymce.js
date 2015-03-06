(function() {

	tinymce.create('tinymce.plugins.md', {
		init : function(ed, url) {
		 ed.addCommand('shortcodeGenerator', function() {
		 		
		 		tb_show("MD Shortcodes", url + '/shortcode_generator/shortcode-generator.php?&width=960&height=500');

		 });
			//Add button
			ed.addButton('shortcodebtns', {	title : 'MD Shortcodes', cmd : 'shortcodeGenerator', image : url + '/shortcode_generator/icons/shortcode-icon.png' });
        },
        createControl : function(n, cm) {
			  return null;
        },
		  getInfo : function() {
			return {
				longname : 'MD TinyMCE',
				author : 'Themesholic',
				authorurl : 'http://themesholic.com',
				infourl : 'http://themesholic.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
    });
    
    tinymce.PluginManager.add('md_buttons', tinymce.plugins.md);
})();