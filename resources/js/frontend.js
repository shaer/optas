$('[data-toggle="tooltip"]').tooltip();

$(".editItem").click(function() {
	var elementId = $(this).attr("data-element");
	var requestPath = $(this).attr("data-path") + "/" + elementId;
	var formFields = ($(this).attr("data-items")).split(",");

	$.get(requestPath, function(data) {
		var formElement = $("#editElementModel").find("form");
		removeErrors(formElement);
		resetForm(formElement);
		var action = formElement.attr("action");
		action = action.replace(/\/[0-9]+$/, "/" + elementId);
		formElement.attr("action", action);
		fillFields(formElement, formFields, data);
		$("#editElementModel").modal();
	})
});

function fillFields(form, fields, data) {
	for (index in fields) {
		fieldSelector = '[name="' + fields[index] + '"]';
		form.find(fieldSelector).val(data[fields[index]]);
	}
}

window.Parsley.on('field:error', function() {
  this.$element.closest("div").addClass("has-error")
  });
  window.Parsley.on('field:success', function() {this.$element.closest("div").removeClass("has-error")
});

$(".ajaxForm").submit(function(event) {
	event.preventDefault();
	removeErrors($(this));
	var post_url = $(this).attr("action");
	var formData = $(this).serialize();
	var formObj = $(this);
	if (!$(this).parsley().validate()) {
		return false;
	}
	$.ajax({
		type: "POST",
		url: post_url,
		data: formData,
		dataType: "json",
		success: function(data) {
			if (data.is_success) {
				window.location = window.location;
			}
			else {
				showFromErrors(data.data, formObj);
			}
		},
		error: function() {
			alert('Destination Server unreachable!');
		}
	});
});


function resetForm(form) {

	var passwordField = form.find('input[type="password"]');

	if (!passwordField.length) {
		return;
	}

	var checkboxDiv = form.find(".editPassword");
	var checkbox = form.find(".editPassCb");

	checkbox.removeAttr('checked');
	passwordField.attr("disabled", "disabled");
	checkboxDiv.removeClass("hidden");

	form.find(".editPassCb").change(function() {
		passwordField.attr('disabled', !this.checked)
	});
}

function removeErrors(form) {
	form.find(".has-error").removeClass("has-error");
	form.find(".text-danger").addClass("hidden");
}

function showFromErrors(errorObject, form) {
	var selector;
	var element;

	for (var field in errorObject) {
		if (errorObject.hasOwnProperty(field)) {
			selector = '[name="' + field + '"]';
			showFieldError(selector, form, errorObject[field][0]);
		}
	}
}


function showFieldError(selector, form, errorMessage) {
	parent = form.find(selector).closest("div");
	parent.addClass("has-error")
	var element = parent.find(".text-danger");
	element.text(errorMessage);
	element.removeClass("hidden");
}

$(".deleteItem").click(function(event) {
	event.preventDefault();
	if (confirm("Do you really want to delete this item?")) {
		$(this).closest("form").submit();
	}
});
