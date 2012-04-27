/**
	Protoform(class) v1.1 18/03/2009
	Copyright (c) 2008 Filippo Buratti; info [at] cssrevolt.com [dot] com; http://www.filippoburatti.net/

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

REGEX_AUTO_FIELD  = /^[^_]+(_Req)?(_(Tel|Num|Int|Email|Url|Date))?$/;
REGEX_BLANK       = /^\s*$/;
REGEX_EMAIL       = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
REGEX_TEL         = /^([0-9]*\-?\ ?\/?[0-9]*)$/;
REGEX_NUM		  = /^[-+]?\d+(\.\d+)?$/;
REGEX_URL         = /^(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?/;
REGEX_DAY         = /^(0?[1-9]|[1-2][0-9]|3[01])$/;
REGEX_MONTH       = /^(0?[1-9]|1[0-2])$/;
REGEX_YEAR        = /^[0-9]{2,4}$/;
REGEX_TYPED_FIELD = /_(Tel|Num|Int|Email|Url|Date)$/;


var Protoform = Class.create({

initialize: function(form, options) {	  	
	this.options = {
      		ajax: true
    	}
		Object.extend(this.options, options || {});
	this.form      		= $(form);
	this.formProcess 	= this.checkForm.bindAsEventListener(this);
	this.form.observe("submit", this.formProcess );
	this.hoverFocus();
},

hoverFocus: function() { 
 	this.form.select('input', 'textarea').each(function(item) {
    	Event.observe(item,'focus',function() {
      		Element.addClassName(this,'hoverfocus');
    	}.bind(item));
    	Event.observe(item,'blur',function() {
      		Element.removeClassName(this,'hoverfocus');
    	}.bind(item));
	});
},
	
checkForm: function(event) { 
	Event.stop(event);
    var errors	= '';
    var faulty	= null;
	if ($('response')) { $('response').remove(); }
	
	this.form.getElements().each(function(formElements) {
		var value 			= ($F(formElements)!= null) ? $F(formElements) : '' ;
		var idField			= formElements.readAttribute('id') ? formElements.readAttribute('id') : '';
		
		var typedField 		= idField.match(REGEX_TYPED_FIELD);
		var errorMessage	= formElements.readAttribute('title');


		
		if (!idField.match(REGEX_AUTO_FIELD)) {
            return;
		}  
		
		if (idField.match(/_Req/) && value.match(REGEX_BLANK)) {
            errors += '<li>' + errorMessage + '</li>';
            faulty = faulty || formElements;
            return;
        }
		
		if (typedField  && !value.match(REGEX_BLANK)) {
	    	var type = typedField[1];		
	    	var error = this.checkField(value, type);
	    	if (error) {
				errors += '<li>' + errorMessage + '</li>';
				faulty = faulty || formElements;
	    	}
		}
	}.bindAsEventListener(this));
	
	
	if (errors==0) {
		if (this.options.ajax){
			this.sendData(); 
		} else {
			this.form.submit();
		}
	} else {
	
		if (!$('error')) {	
			this.form.insert({after:new Element('ul', {id:'error'}).update(errors)});
		} else {
			$('error').update(errors);	
		}
		faulty.focus();
	}
},
	
checkField: function (value, type) {
	switch (type) {
		case 'Tel':
			var phone= value;
			if (!phone.match(REGEX_TEL)) { return true; }     
			break;
		case 'Num':
			var number= value;
			if (!number.match(REGEX_NUM)) { return true; }     
			break;
		case 'Tel':
			var phone= value;
			if (!phone.match(REGEX_TEL)) { return true; }     
			break;
		case 'Email':
			var address= value;
			if (!address.match(REGEX_EMAIL)) { return true; }     
			break;
		case 'Url':
			var resource= value;
			if (!resource.match(REGEX_URL)) { return true; }
			break;
		case 'Date':
			var comps = value.split('/');
        	if (3 != comps.length || !comps[0].match(REGEX_DAY) || !comps[1].match(REGEX_MONTH) || !comps[2].match(REGEX_YEAR)) { return true; }
			break;
		default:
			return null;
	}

}.bind(this), 
	
sendData: function(event) {
	var url 	= (this.options.url) ? (this.options.url) : this.form.readAttribute('action');
	var reqType	= this.form.readAttribute('method');
	var pars 	= this.form.serialize();
	var myAjax 	= new Ajax.Request( url, { method: reqType, parameters: pars, onCreate: this.showLoad.bind(this), onComplete: this.getResponse.bind(this) });
},
	
showLoad: function() {
	this.form.insert({after:'<p id="working">loading...</p>'});
	if ($('error')) { $('error').remove(); }
},
	
getResponse: function(transport) {
	$('working').remove();
	var newData = transport.responseText;
	this.form.insert({after:newData}).reset();
}	
  
}); 