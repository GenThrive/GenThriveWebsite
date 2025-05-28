//all non-greensock js goes here
jQuery(document).ready(function () {}); //end jQuery onLoad

if (jQuery(".popmake-11489")) {
  jQuery(".popmake-11489").css("background-color", "#989898");
  jQuery(".popmake-11489").css("border-color", "#989898");
}
if (jQuery("#gform_7").length) {
  jQuery(".gform_heading .gform_title").css("color", "black");
}

if (jQuery("#gform_7").length) {
  jQuery(".gform_required_legend").css("display", "none");
  jQuery(
    '<p class="gform_required_legend">"<span class="gfield_required gfield_required_asterisk">*</span>" indicates required fields</p>'
  ).insertBefore("#gform_page_7_2 .gform_page_fields");
  jQuery("#gf_progressbar_wrapper_7").css("display", "none");
}

// jQuery(document).on("click", "#logo-preview #remove-preview", () => {
//   jQuery("#logo-preview").css("display", "none");
//   jQuery.ajax({
//     url: service_provider_obj.ajax_url,
//     type: "post",
//     data: {
//       action: "remove_logo_preview",
//     },
//     success: function (res) {},
//     error: function () {},
//   });
// });

/** code for program archive functionality */
function trash_button(program_id) {
  jQuery("#confirm_archive").attr("data-id", program_id);
}

jQuery("#confirm_archive").on("click", () => {
  var archive_program_id = jQuery("#confirm_archive").attr("data-id");
  jQuery.ajax({
    url: service_provider_obj.ajax_url,
    type: "post",
    data: {
      action: "archive_program",
      archive_program_id
    },
    success: function (res) {
      jQuery("#cancel_archive").trigger("click");
      location.reload(true);
    },
    error: function () {},
  });
})

/** code for unarchive or publish the program from single service provider */
function publish_button(program_id) {
  jQuery("#confirm_unarchive").attr("data-id", program_id);
}

jQuery("#confirm_unarchive").on("click", () => {
  var unarchive_program_id = jQuery("#confirm_unarchive").attr("data-id");
  jQuery.ajax({
    url: service_provider_obj.ajax_url,
    type: "post",
    data: {
      action: "unarchive_program",
      unarchive_program_id
    },
    success: function (res) {
      jQuery("#cancel_unarchive").trigger("click");
      location.reload(true);
    },
    error: function () {},
  });
})

//debounce function 
function debounce(func,delay){
  let timeout;
  return function(...args){
    const context = this;
    clearTimeout(timeout);
    timeout = setTimeout(()=> func.apply(context,args),delay);
  }
  
}

function decode_str(str) {
  let txt = document.createElement("textarea");
  txt.innerHTML = str;

  return txt.value;
}

function performSearch(){
  let search = jQuery('.search_front [name="search"]');
    jQuery.get( service_provider_obj.ajax_url, { action: 'get_sp_name',search_title:search.val() }, function( data ) {
      if(data != 'not'){
      let sp_arr = new Array();
      data.forEach(function (item) {
        sp_arr.push(decode_str(item));
      });
      search.autocomplete({
            source: sp_arr
        });
      }
  }, 'json');
}

jQuery( document ).ready(function($) {
  const debouncedSearch = debounce(performSearch, 300);

  $('.search_front [name="search"]').on('keydown', debouncedSearch);
	
	
	jQuery('img[src=""].sp-img').remove();

}); //end jQuery onLoad

jQuery(function($){
	//added for notification indicator
	let has_notif = $(".nav-tabs a:contains('Notifications')");
	if(has_notif.length > 0){
		//setInterval(function (){
			$.get(service_provider_obj.ajax_url, { action: 'notif_indicator' }, function(response){
				if(Number(response) > 0){
					has_notif.parents('.nav-link').addClass('with-notif');
					if(has_notif.find('.notif-indicator').length > 0){
						has_notif.find('.notif-indicator').html(response);
					}
					else{
						has_notif.append('<div class="notif-indicator">'+response+'</div>');
					}
				}
				else{
					has_notif.parents('.nav-link').removeClass('with-notif');
					has_notif.find('.notif-indicator').remove();
				}
			});
		//}, 100);
	}
  // Global flag to indicate if the page should refresh after modal closes
    var shouldRefreshPage = false;

  // Listen for the Bootstrap modal 'show' event
    $('#deleteUser').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract info from data-* attributes
        var userId = button.data('userid');
        var servicePid = button.data('service-pid');
        var pid = button.data('pid');
        var userName = button.data('username'); // NEW: Get the userName

        // Get the modal itself
        var modal = $(this);

        // Populate Gravity Forms fields
        modal.find('#input_15_2').val(userId);
        modal.find('#input_15_3').val(servicePid);
        modal.find('#input_15_4').val(pid);

        // NEW: Populate the div with data-userName
        modal.find('#deleteUserName').text(userName); // Use .text() for plain text

        // Reset the flag every time the modal is opened
        shouldRefreshPage = false;
    });

    // Clear the fields and the div when the modal is hidden
    $('#deleteUser').on('hidden.bs.modal', function () {
        var modal = $(this);
        modal.find('#input_15_2').val('');
        modal.find('#input_15_3').val('');
        modal.find('#input_15_4').val('');
        modal.find('#deleteUserName').empty(); 

        // Check if the page should be refreshed
        if (shouldRefreshPage) {
            // Refresh the page
            location.reload();
            // Reset the flag immediately to prevent accidental multiple refreshes
            shouldRefreshPage = false;
        }
    });

    // Listen for the Bootstrap modal 'show' event
    $('#editUser').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract info from data-* attributes
        var userId = button.data('userid');

        // Get the modal itself
        var modal = $(this);

        // Populate Gravity Forms fields
        // modal.find('#input_14_12').val(1111);
        // Delay the change event by a few milliseconds
        setTimeout(function() {
            modal.find('#input_14_12').val(userId).trigger( "change" );
        }, 500); 
        

        // Reset the flag every time the modal is opened
        shouldRefreshPage = false;
    });

    // Clear the fields and the div when the modal is hidden
    $('#editUser').on('hidden.bs.modal', function () {
        var modal = $(this);
        modal.find('#input_14_12').val('').trigger( "change" );

        // Check if the page should be refreshed
        if (shouldRefreshPage) {
            // Refresh the page
            location.reload();
            // Reset the flag immediately to prevent accidental multiple refreshes
            shouldRefreshPage = false;
        }
    });

    // This event fires after an AJAX submission and the confirmation message is loaded.
    $(document).on('gform_confirmation_loaded', function(event, form_id) {
        // Check if the confirmation is for the correct form (form ID 15)
        if (form_id === 14 || form_id === 15) {
            // Set the flag to true, indicating we need to refresh the page when the modal hides
            shouldRefreshPage = true;
        }
    });
});