<script type='text/javascript'>
	$(function(){
		$(document.body).on('click', '.editActiveAdmin', function(){
			$('.editActiveAdmin').attr('disabled', 'disabled');
			var id = $(this).attr('id');
			id = id.split('editActiveAdmin');
			id = id[1];
			var user_id = '#updateActiveAdminUser'+id;
			var user = $(user_id).val();
			var level = $('#adminActiveLevelEdit'+id).val();
			$.post("ajax/updateAdminAccountsAJAX.php", {id:id, user:user, level:level}, function(data){
				$('#showAdminAccountsActive').submit();
			})
		})
	})
</script> 

                                                                                                                                                                                