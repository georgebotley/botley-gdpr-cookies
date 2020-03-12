<% if not AllowedCookies && URLSegment!='cookie/settings' %>
	<!-- The Modal -->
	<div class="modal fade" id="CookieModal" data-backdrop="static">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	
	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">GDPR: Cookie Notice</h4>
	      </div>
	
	      <!-- Modal body -->
	      <div class="modal-body">
		      <% if $CookieOptOut %>
		      	<p class="alert alert-success"><i class="fas fa-ban"></i> You have opted out of Cookies.</p>
		      <% end_if %>
		      <p style="margin-bottom: 0px;">This websites makes use of cookies and session data to provide core functionality. For more information on the types of cookies used on this website and to set your preferences on the type of cookies set, click on the cog icon button below. Note that will not be able to use this website without at least agreeing to using strictly necessary cookies.<br /><br /></p>
		      <p>If you are happy with all types of cookies being set, click Yes.</p>
	      </div>
	
	      <!-- Modal footer -->
	      <div class="modal-footer">
	        <a href="/cookies/settings" role="button" class="btn btn-light">
	        	<i class="fas fa-cog"></i>
	        </button>
	        <a href="/cookies/optout" role="button" class="btn btn-danger">
	        	<i class="fas fa-times"></i> No
	        </a>
	        <a href="/cookies/optin" role="button" class="btn btn-success">
	        	<i class="fas fa-check"></i> Yes
	        </a>
	      </div>
	
	    </div>
	  </div>
	</div>
<% end_if %>