
$('[data-toggle="tooltip"]').tooltip();

$(".editItem").click(function(){
	var elementId   = $(this).attr("data-element");
	var requestPath = $(this).attr("data-path") + "/" + elementId;
	var formFields  = ($(this).attr("data-items")).split(",");
	
	$.get(requestPath, function(data){
		var formElement = $("#editElementModel").find("form");
		removeErrors(formElement);
		resetForm(formElement);
		var action      = formElement.attr("action");
		action          = action.replace(/\/[0-9]+$/, "/"+elementId);
		formElement.attr("action", action);
		if(formFields == "job") {
			display_job_fields(data, formElement);
		} else {
			fillFields(formElement, formFields, data);
		}
		
		$("#editElementModel").modal();
	})
});

function fillFields(form, fields, data) {
	for(index in fields) {
		fieldSelector = '[name="' + fields[index] + '"]';
		form.find(fieldSelector).val(data[fields[index]]);
	}
}

$(".ajaxForm").submit(function( event ) {
	event.preventDefault();
	removeErrors($(this));
	var post_url = $(this).attr("action");
	var formData = $(this).serialize();
	var formObj  = $(this);
	if (!$(this).parsley().validate()) {
		return false;
	}
	$.ajax({
	    type: "POST",
	    url: post_url,
	    data: formData,
	    dataType: "json",
	    success: function(data) {
	    	if(data.is_success) {
	    		window.location = window.location;
	    	} else {
				showFromErrors(data.data, formObj);
	    	}
	    },
	    error: function() {
	        alert('Destination Server unreachable!');
	    }
	});
});

$(".multiple-select").select2({
	theme: "bootstrap",
	allowClear: true,
	closeOnSelect: false
});

$(".toggleItem").change(function(){
	var target_cls = "." + $(this).attr("data-toggle");
	
	if($(this).is(':checked')) {
		$(target_cls).removeClass("hidden");
	} else {
		
		$(target_cls).addClass("hidden");
	}
})



//parsley events.
window.Parsley.on('field:error', function() {
  this.$element.closest("div").addClass("has-error")
});
window.Parsley.on('field:success', function() {
  this.$element.closest("div").removeClass("has-error")
});

function resetForm(form) {
	form.find(".triggerItemHolder").remove();
	
	var tabs = form.find('.tabbable');
	if( tabs.length){
		$(".tabbable").find('[href=".definition-tab"]').tab('show')
	}
	
	
	var passwordField = form.find('input[type="password"]');

	if(!passwordField.length){
		return;
	}
	
	var checkboxDiv   = form.find(".editPassword");
	var checkbox      = form.find(".editPassCb");
	
	checkbox.removeAttr('checked');
	passwordField.attr("disabled", "disabled");
	checkboxDiv.removeClass("hidden");
	
	form.find(".editPassCb").change(function() {
	    passwordField.attr('disabled',!this.checked)
	});
}

function removeErrors(form) {
	form.find(".has-error").removeClass("has-error");
	form.find(".text-danger").addClass("hidden");
}

function showFromErrors(errorObject, form){
	var selector;
	var element;
	if(Array.isArray(errorObject)) {
		return showJobErrors(errorObject, form);
	}
	
	for (var field in errorObject) {
	    if (errorObject.hasOwnProperty(field)) {
	    	selector = '[name="' + field + '"]';
	    	showFieldError(selector, form, errorObject[field][0]);
	    }
	}
}


function showFieldError(selector, form, errorMessage) {
	parent  = form.find(selector).closest("div");
	parent.addClass("has-error")
	var element = parent.find(".text-danger");
    element.text(errorMessage);
    element.removeClass("hidden");
}

$(".deleteItem").click(function(event){
	event.preventDefault();
	if(confirm("Do you really want to delete this item?")) {
		$(this).closest("form").submit();		
	}
});

$(".addNewAction").click(function(){
	var selectedType = $(this).closest(".input-group").find("select").val();
	if(!selectedType) {
		alert("Please select a valid type");
		return;
	}
	var elementID   = makeId();
	addNewTriggerFields(selectedType, elementID, $(this));
});

function makeId()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 8; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}




//job page js
function display_job_fields(data, form) {
	//basic data
	var BasicData = ['name','description','namespace','is_automated'];
	fillFields(form, BasicData, data);
	
	//manage actions
	var triggers_lookup = [
		[],
		["query", "is_csv", "connection_id"]
	]

	for(var index in data.actions) {
		var actionType = data.actions[index].action_type_id;
		var uniqueId   = "action_" + data.actions[index].id;
		addNewTriggerFields(actionType, uniqueId, form.find(".addNewAction"));
		
		for(var field in triggers_lookup[actionType]) {
			var curField = triggers_lookup[actionType][field];
			var selector = "[name='actions[" + uniqueId + "][triggerable][" + curField + "]']";
			form.find(selector).val(data.actions[index].triggerable[curField]);
		}
	}
	
	form.find(".panel-collapse").removeClass("in");
	
}

function showJobErrors(errors, form) {
	form.find('.nav-tabs a[href=".' + errors[0] + '-tab"]').tab('show');
	
	for (var field in errors[2]) {
	    if (errors[2].hasOwnProperty(field)) {
	    	var selector = "[name='" + errors[0] + errors[1] + "[" + field + "]']" ;
	    	showFieldError(selector, form, errors[2][field][0]);
	    }
	}
}

function addNewTriggerFields(selectedType, elementID, currentElement){
	var typesLookup  = ["", "db_action_cloneable"];
	var element = $("." + typesLookup[selectedType]).clone();
	var elementCode = element.html();
	elementCode = elementCode.replace(/generatedId/g, elementID);
	$('.accordion').find(".collapse").collapse('hide')
	currentElement.closest(".actions-tab").find(".accordion").append(elementCode);
}

function createToggleBtnObject() {
	var btn = $("<input>", {
		"type" : "checkbox",
		"data-size" : "mini",
		"data-onstyle": "success",
		"data-toggle": "toggle"
	});
	return btn;
}

function showMonthDaysButtons(element, start, end)
{
	if(element.length == 0)
		return;
	
	var btn = createToggleBtnObject();
	
	for(var day = start; day <= end; day++) {
		btn.attr({
			"data-on": day,
			"data-off": day
		})
		element.append(btn)
	}
}

if($(".scheduling-tab").length != 0) {
	showMonthDaysButtons($(".showMonthDaysBtns"), 1, 31);
	showMonthDaysButtons($(".showDaysOfLast"), -10, -1);
	
	$(".actions-tab").on("click", ".deleteAction", function(){
		if(confirm("Do you really want to delete this action?")) {
			$(this).closest(".triggerItemHolder").fadeOut(400, function() {
				$(this).remove();
			});
		}	
	});
	
	
	$('.datetimepicker').datepicker({
		"language": 'en',
		"timepicker": true,
		"position": 'top left',
		"dateFormat": 'dd-mm',
		"multipleDates" : true,
		"navTitles": {
			days: 'MM',
			months: ' '
		},
		onShow: function(dp, animationCompleted){
	        $(".datepicker--days-names").hide();
	    }
	});

}
