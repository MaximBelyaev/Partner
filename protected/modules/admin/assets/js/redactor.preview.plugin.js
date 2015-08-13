if (typeof RedactorPlugins === 'undefined') window.RedactorPlugins = {};

RedactorPlugins.preview = function(){

	return {
		getTemplate: function()
        {
        	return String()
            + '<section id="redactor-modal-preview" class="news-block" >'
            + this.$editor[0].innerHTML
            + '</section>';
        },
        init: function ()
        {
            var button = this.button.add('preview', 'Предпросмотр');
            this.button.addCallback(button, this.preview.show);
        },
        show: function()
        {
            this.modal.addTemplate('preview', this.preview.getTemplate());
 
            this.modal.load('preview', 'Предпросмотр', 1000);
 
            // this.modal.createCancelButton();
 
            this.modal.show();
 
            $('#mymodal-textarea').focus();
        },
	}

}