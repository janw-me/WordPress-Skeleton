(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('lightviewplus');
	
	tinymce.create('tinymce.plugins.lightviewplusPlugin', {
		init : function(ed, url) {
			var t = this;
			t.editor = ed;
			ed.addCommand('mce_lightviewplus', t._lightviewplus, t);
			ed.addButton('lightviewplus',{
				title : 'lightviewplus.desc', 
				cmd : 'mce_lightviewplus',
				image : url + '/img/lightviewplus-button.png'
			});
		},
		
		getInfo : function() {
			return {
				longname : 'Lightview Plus for Wordpress',
				author : 'Thorsten Puzich',
				authorurl : 'http://www.puzich.com',
				infourl : 'http://www.puzich.com/lightview-en/',
				version : '1.0'
			};
		},
		
		// Private methods
		_lightviewplus : function() { // open a popup window
			lightviewplus_insert();
			return true;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('lightviewplus', tinymce.plugins.lightviewplusPlugin);
})();