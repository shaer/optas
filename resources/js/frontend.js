
// var lineChartData = {
//     labels : ["January","February","March","April","May","June","July"],
//     datasets : [
//         {
//             label: "My First dataset",
//             fillColor: "rgba(220,220,220,0.2)",
//             strokeColor: "rgba(220,220,220,1)",
//             pointColor: "rgba(220,220,220,1)",
//             pointStrokeColor: "#fff",
//             pointHighlightFill : "#fff",
//             pointHighlightStroke : "rgba(6, 197, 172, 1)",
//             data : [65,59,80,81,56,55,40]
//         },
//         {
//             label: "My Second dataset",
//              fillColor: "rgba(151,187,205,0.2)",
//             strokeColor: "rgba(151,187,205,1)",
//             pointColor: "rgba(151,187,205,1)",
//             pointStrokeColor: "#fff",
//             pointHighlightFill : "#fff",
//             pointHighlightStroke : "rgba(244, 204, 11, 1)",
//             data : [28,48,40,19,86,27,90]
//         }
//     ]

// }


//     var cline = document.getElementById("cline").getContext("2d");
//     new Chart(cline).Line(lineChartData, {
//         responsive: true
//     });
   

//   var pdata = [
//     {
//         value: 300,
//         color:"#F7464A",
//         highlight: "#FF5A5E",
//         label: "Red"
//     },
//     {
//         value: 50,
//       color: "#46BFBD",
//         highlight: "#5AD3D1",
//         label: "Green"
//     },
//     {
//         value: 100,
//         color: "#FDB45C",
//         highlight: "#FFC870",
//         label: "Yellow"
//     }
// ]
// var cpie = document.getElementById("cpie").getContext("2d");
// new Chart(cpie).Pie(pdata, { responsive: true});

// var ddata = [
//     {
//         value: 50,
//         color:"#F7464A",
//         highlight: "#FF5A5E",
//         label: "Red"
//     },
//     {
//         value: 300,
//         color: "#46BFBD",
//         highlight: "#5AD3D1",
//         label: "Green"
//     },
//     {
//         value: 160,
//         color: "#FDB45C",
//         highlight: "#FFC870",
//         label: "Yellow"
//     }
// ]
// var cdonut = document.getElementById("cdonut").getContext("2d");
// new Chart(cdonut).Doughnut(ddata, { responsive: true});

// var bdata = {
//         labels : ["January","February","March","April","May","June","July"],
//         datasets : [
//             {
//                 fillColor: "rgba(220,220,220,0.5)",
//                 strokeColor: "rgba(220,220,220,0.8)",
//                 highlightFill: "rgba(220,220,220,0.75)",
//                 highlightStroke: "rgba(220,220,220,1)",
//                 data : [130,160,95,205,170,135,200]
//             },
//             {
//               fillColor: "rgba(151,187,205,0.5)",
//                 strokeColor: "rgba(151,187,205,0.8)",
//                 highlightFill: "rgba(151,187,205,0.75)",
//                 highlightStroke: "rgba(151,187,205,1)",
//                 data : [85,90,160,145,180,130,195]
//             }
//         ]

//     }
//     var cbar = document.getElementById("cbar").getContext("2d");
//     new Chart(cbar).Bar(bdata, {
//             responsive : true
//         });

//     var podata = [
//     {
//         value: 300,
//         color:"#F7464A",
//         highlight: "#FF5A5E",
//         label: "Red"
//     },
//     {
//         value: 50,
//         color: "#46BFBD",
//         highlight: "#5AD3D1",
//         label: "Green"
//     },
//     {
//         value: 100,
//         color: "#FDB45C",
//         highlight: "#FFC870",
//         label: "Yellow"
//     },
//     {
//         value: 40,
//         color: "#949FB1",
//         highlight: "#A8B3C5",
//         label: "Grey"
//     },
//     {
//         value: 120,
//         color: "#4D5360",
//         highlight: "#616774",
//         label: "Dark Grey"
//     }

// ]

// var cpolar = document.getElementById("cpolar").getContext("2d");
// new Chart(cpolar).PolarArea(podata, { responsive: true});

//                 var ddata1 = [
//                     {
//                         value: 50,
//                         color:"#F7464A",
//                         highlight: "#FF5A5E",
//                         label: "Red"
//                     },
//                     {
//                         value: 300,
//                         color: "#46BFBD",
//                         highlight: "#5AD3D1",
//                         label: "Green"
//                     },
//                     {
//                         value: 160,
//                         color: "#FDB45C",
//                         highlight: "#FFC870",
//                         label: "Yellow"
//                     }
//                 ]
//                 var cdonut1 = document.getElementById("cdonut1").getContext("2d");
//                 new Chart(cdonut1).Doughnut(ddata1, { responsive: true});

$(".editItem").click(function(){
	var elementId   = $(this).attr("data-element");
	var requestPath = $(this).attr("data-path") + "/" + elementId;
	var formFields  = ($(this).attr("data-items")).split(",");
	
	$.get(requestPath, function(data){
		var formElement = $("#editElementModel").find("form");
		resetForm(formElement);
		resetPasswordField(formElement);
		var action      = formElement.attr("action");
		action          = action.replace(/\/[0-9]+$/, "/"+elementId);
		formElement.attr("action", action);
		
		for(index in formFields) {
			fieldSelector = '[name="' + formFields[index] + '"]';
			formElement.find(fieldSelector).val(data[formFields[index]]);
		}
		$("#editElementModel").modal();
	})
});


$(".ajaxForm").submit(function( event ) {
	event.preventDefault();
	resetForm($(this));
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

//parsley events.
window.Parsley.on('field:error', function() {
  this.$element.closest("div").addClass("has-error")
});
window.Parsley.on('field:success', function() {
  this.$element.closest("div").removeClass("has-error")
});

function resetPasswordField(form) {
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

function resetForm(form) {
	form.find(".has-error").removeClass("has-error");
	form.find(".text-danger").addClass("hidden");
}

function showFromErrors(errorObject, form){
	var selector;
	var element;
	
	for (var field in errorObject) {
	    if (errorObject.hasOwnProperty(field)) {
	    	selector = '[name="' + field + '"]';
	    	parent  = form.find(selector).closest("div");
	    	parent.addClass("has-error")
	    	element = parent.find(".text-danger");
	        element.text(errorObject[field][0]);
	        element.removeClass("hidden");
	    }
	}
}



