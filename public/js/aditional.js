$(document).ready(function() {
    
	// Add ToDo
	$("#addToDo-submit").click(function(e){
    	e.preventDefault();
   
    	var title = $("#title").val();
    	var description = $("#description").val();
   
        $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            url: "addTodo",
            type:'POST',
            data: {
				title:title, 
				description:description,
				state:'0'
			},
            success: function(data) {
				
                if($.isEmptyObject(data.error)){
                	window.location.reload();
                }else{
                	printErrorMsg(data.error);
                }
				
            }
        });

    });

	function printErrorMsg (msg) {
		$(".print-error-msg").find("ul").html('');
		$(".print-error-msg").css('display','block');
		$.each( msg, function( key, value ) {
			$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
		});
	}
   
    // Perform the TODO 
	$(document).on('click','#chStateTodo', function(){
   
    	var id = $(this).parent(".special").data('id');
		var selector = $(this).closest('.card');
        $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            url: "chStateTodo",
            type:'POST',
            data: {
				id:id,
				state: 1
			},
            success: function(data) {
				
                if($.isEmptyObject(data.success)){
                	alert('Errore');
                }else{
					selector.hide();
					selector.find('.show').removeClass('show');
					selector.find('#chStateLabelTodo').show('slow');
					selector.parent().find('.temporaryTodo').prepend(selector);
					selector.fadeIn('slow');
                }
            }
        });

    });
	
	// Edit ToDo
	$('.editbtnTodo').on('click', function () {
		
		var id = $(this).parent(".special").data('id');
		var state = $(this).parent(".special").data('state');
		var selector = $(this).closest('.card');
		var title = selector.find('#dataTitleTodo').text().trim();
		var description = selector.find('#dataDescriptionTodo').text().trim();
		var modal = $('.editModalTodo');
		modal.find('#titleModal').val(title);
		modal.find('#descriptionModal').text(description);
		modal.find('#idModal').data('id', id);

		if (state === 0){
			modal.find('#stateNoModal').addClass('active');
		}
		else{
			modal.find('#stateYesModal').addClass('active');
		}

	})
    
	$(document).on('click','#dismissEditTodo', function(){
		var modal = $('.editModalTodo');
		modal.find('.active.focus').removeClass('active');
	});
	
	
    $(document).on('click','#submitEditTodo', function(){
		
		var selector = $(this).closest('.editModalTodo');
		var id = selector.find('#idModal').data('id');
		var state = selector.find('.active').children().val();
		var title = selector.find("#titleModal").val();
		var description = selector.find("#descriptionModal").val();
		
		if(title.length > 100 | description.length > 500){
			
			$(".print-error-modal").css('display','block');
			if(title.length > 100){
				$(".print-error-modal").find("ul").append('<li>Titolo - massimo 100 simboli!</li>');
			}
			if(description.length > 500){
				$(".print-error-modal").find("ul").append('<li>Descrizione -  massimo 500 simboli!</li>');
			}
			
		}
		else{

			selector.find('.active .focus').removeClass('active');
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "editTodo",
				type:'POST',
				data: {
					id:id,
					title: title,
					description: description,
					state: state
				},
				success: function(data) {
					
					if($.isEmptyObject(data.success)){
						alert('Errore');
					}else{
					window.location.reload();	
					}
				}
			});
		
		}

    });
    
});

