BX.RegisterAgree = {
    onSubmit: function (item, e)
    {
        this.isFormSubmitted = true;
        if (this.btnAgree.checked)
        {
            if (this.errorVisible) {
                BX("no-agree").remove();
                this.errorVisible = false;
            }
            return true;
        }
        else
        {
            this.setError();
            if(e){
                e.preventDefault();
            }
            return false;
        }
    },
    setError: function(){
        if (!this.errorVisible){
            var Rules = 'Необходимо принять условия обработки данных',
                RulseContainer = BX.findChild(this.formNode, {className:'for-rules'}, true),
                RulesCheckbox = BX.findChild(RulseContainer, {tag:'i'}, true);
            BX.addClass(RulesCheckbox, 'is-error');
            BX.prepend(BX.create('DIV', {
                attrs: {
                    id: "no-agree",
                    class: "bg-danger bg-message mb-20",
                },
                text: Rules
            }),BX("errors-block"));
            this.errorVisible = true;
            
        };
    },
    loadFromForms: function (context, controlNode)
	{
        this.btnAgree = BX("reg-agree");
        this.formNode = BX.findParent(this.btnAgree, {tagName: 'FORM'});        
        BX.bind(this.formNode, 'submit', this.onSubmit.bind(this, this.formNode));
    }
}
;(function(){
    BX.ready(function () {
        BX.RegisterAgree.loadFromForms();
    });
})();