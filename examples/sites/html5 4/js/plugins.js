//http://stackoverflow.com/questions/1184624/convert-form-data-to-js-object-with-jquery
//http://jsfiddle.net/sxGtM/3/

//Converts form elements to a JSON object
//If the form element has square brackets ( <input type='checkbox' name='options[]> )
// the square brackets will be removed from the name but the array items will be preserved
// in the JSON object. This is a desireable property.

//Useage:   $('#contactForm').serializeObject()   returns property map of Form Elements.

(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);




/*

jQuery Populate Plugin

This plugin supports full PHP naming and deep data structures, as well as checkbox arrays, other non-standard UI controls, and even standard HTML elements such as labels or divs.
The plugin can be used as part of your AJAX toolkit, or for separating server-side code from HTML by populating a form after the page has loaded eg:

Useage: $('form').populate(property MAP of form elements) 

If a form element is of an array type with square brackets , <input type='checkbox' name='options[]> 
it is important that the key name not have the square brackets.   {options: ['music','software']} 

http://www.keyframesandcode.com/code/development/javascript/jquery-populate-plugin/
*/

jQuery.fn.populate = function(obj, options) {
	
	
	// ------------------------------------------------------------------------------------------
	// JSON conversion function
	
		// convert 
			function parseJSON(obj, path)
			{
				// prepare
					path = path || '';
				
				// iteration (objects / arrays)
					if(obj == undefined)
					{
						// do nothing
					}
					else if(obj.constructor == Object)
					{
						for(var prop in obj)
						{
							var name	= path + (path == '' ? prop : '[' +prop+ ']');
							parseJSON(obj[prop], name);
						}
					}
						
					else if(obj.constructor == Array)
					{
						for(var i = 0; i < obj.length; i++)
						{
							var index	= options.useIndices ? i : '';
							index		= options.phpNaming ? '[' +index+']' : index;
							var name	= path + index;
							parseJSON(obj[i], name);
						}
					}
					
				// assignment (values)
					else
					{
						// if the element name hasn't yet been defined, create it as a single value
						if(arr[path] == undefined)
						{
							arr[path] = obj;
						}
		
						// if the element name HAS been defined, but it's a single value, convert to an array and add the new value
						else if(arr[path].constructor != Array)
						{
							arr[path] = [arr[path], obj];
						}
							
						// if the element name HAS been defined, and is already an array, push the single value on the end of the stack
						else
						{
							arr[path].push(obj);
						}
					}
	
			};


	// ------------------------------------------------------------------------------------------
	// population functions
		
		function debug(str)
		{
			if(window.console && console.log)
			{
				console.log(str);
			}
		}
		
		function getElementName(name)
		{
			if (!options.phpNaming)
			{
				name = name.replace(/\[\]$/,'');
			}
			return name;
		}
		
		function populateElement(parentElement, name, value)
		{
			var selector	= options.identifier == 'id' ? '#' + name : '[' +options.identifier+ '="' +name+ '"]';
			var element		= jQuery(selector, parentElement);
			value			= value.toString();
			value			= value == 'null' ? '' : value;
			element.html(value);
		}
		
		function populateFormElement(form, name, value)
		{

			// check that the named element exists in the form
				var name	= getElementName(name); // handle non-php naming
				var element	= form[name];
				
			// if the form element doesn't exist, check if there is a tag with that id
				if(element == undefined)
				{
					// look for the element
						element = jQuery('#' + name, form);
						if(element)
						{
							element.html(value);
							return true;
						}
					
					// nope, so exit
						if(options.debug)
						{
							debug('No such element as ' + name);
						}
						return false;
				}
					
			// debug options				
				if(options.debug)
				{
					_populate.elements.push(element);
				}
				
			// now, place any single elements in an array.
			// this is so that the next bit of code (a loop) can treat them the 
			// same as any array-elements passed, ie radiobutton or checkox arrays,
			// and the code will just work

				elements = element.type == undefined && element.length ? element : [element];
				
				
			// populate the element correctly
			
				for(var e = 0; e < elements.length; e++)
				{
					
				// grab the element
					var element = elements[e];
					
				// skip undefined elements or function objects (IE only)
					if(!element || typeof element == 'undefined' || typeof element == 'function')
					{
						continue;
					}
					
				// anything else, process
					switch(element.type || element.tagName)
					{
	
						case 'radio':
							// use the single value to check the radio button
							element.checked = (element.value != '' && value.toString() == element.value);
							
						case 'checkbox':
							// depends on the value.
							// if it's an array, perform a sub loop
							// if it's a value, just do the check
							
							var values = value.constructor == Array ? value : [value];
							for(var j = 0; j < values.length; j++)
							{
								element.checked |= element.value == values[j];
							}
							
							//element.checked = (element.value != '' && value.toString().toLowerCase() == element.value.toLowerCase());
							break;
							
						case 'select-multiple':
							var values = value.constructor == Array ? value : [value];
							for(var i = 0; i < element.options.length; i++)
							{
								for(var j = 0; j < values.length; j++)
								{
									element.options[i].selected |= element.options[i].value == values[j];
								}
							}
							break;
						
						case 'select':
						case 'select-one':
							element.value = value.toString() || value;
							break;
	
						case 'text':
						case 'button':
						case 'textarea':
						case 'submit':
						default:
							value			= value == null ? '' : value;
							element.value	= value;
							
					}
						
				}

		}
		

		
	// ------------------------------------------------------------------------------------------
	// options & setup
		
		// exit if no data object supplied
			if (obj === undefined)
			{
				return this;
			};
		
		// options
			var options = jQuery.extend
			(
				{
					phpNaming:			true,
					phpIndices:			false,
					resetForm:			true,
					identifier:			'id',
					debug:				false
				},
				options
			);
				
			if(options.phpIndices)
			{
				options.phpNaming = true;
			}
	
	// ------------------------------------------------------------------------------------------
	// convert hierarchical JSON to flat array
		
			var arr	= [];
			parseJSON(obj);
			
			if(options.debug)
			{
				_populate =
				{
					arr:		arr,
					obj:		obj,
					elements:	[]
				}
			}
	
	// ------------------------------------------------------------------------------------------
	// main process function
		
		this.each
		(
			function()
			{
				
				// variables
					var tagName	= this.tagName.toLowerCase();
					var method	= tagName == 'form' ? populateFormElement : populateElement;
					
				// reset form?
					if(tagName == 'form' && options.resetForm)
					{
						this.reset();
					}

				// update elements
					for(var i in arr)
					{
						method(this, i, arr[i]);
					}
			}
			
		);

return this;
};