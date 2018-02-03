@extends('layouts.header')

@section('content')

  <div id="accordion">
    <div class="card boxshadow">
      
	  <div class="card-header" id="addTodo">
		<h4 class="mb-0 text-center alert alert-dark"  data-toggle="collapse" data-target="#formTodo">
		  AGGIUNGI
		</h4>
	  </div>
	
	  <div id="formTodo" class="collapse pointer" aria-labelledby="heading" data-parent="#accordion">
	    <div class="card-body">
          <form>
	  		<div class="alert alert-danger print-error-msg" style="display:none">
	  		  <ul></ul>
	  		</div>
            <div class="form-group">
              <label for="title">Titolo</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Titolo">
	  	    </div>
            <div class="form-group">
              <label for="description">Descrizione</label>
              <textarea  class="form-control" id="description" name="description" placeholder="Descrizione"></textarea>
            </div>
	  	    
	        @if (count($errors) > 0)
	          <div class="alert alert-danger">
	        	<ul>
	        	  @foreach($errors->all() as $error)
	        	    <li>
	        	  	{{ $error }}
	        	    </li>
	        	  @endforeach	
	        	</ul>
	          </div>
	        @endif
	  	    
	        <input type="hidden" id="state" name="state" value="0">
            <button id="addToDo-submit" type="button" class="btn btn-primary">Salva</button>			
	        {{ csrf_field() }} 
          </form>
	  	</div>
	  </div>
	  
    </div>
  </div>
	
  
  <div id="accordion">
    @php($separator = "true")
	@php($stateButton = "")
	@if (count($todos) > 0)
	  
      <h3 class="text-center">Da comletare</h3>
	 
	  @foreach ($todos as $todo)
		
		@if ($todo->state > 0 && $separator == "true")
			
		    @php($separator = "false")
			@php($stateButton = "disabled")
			
			<h3 class="text-center">Comletati</h3>
		    <div class="temporaryTodo">
			</div>
		@endif
		
	    <div class="card boxshadow" id="card">
	      <div class="card-header" id="heading{{ $todo->id }}">
		    <h5 class="mb-0"  data-toggle="collapse" data-target="#{{ $todo->id }}">
		      <button class="btn btn-light break-word" id="dataTitleTodo" data-toggle="collapse" data-target="#{{ $todo->id }}" aria-expanded="true" aria-controls="collapseOne">
		        {{ $todo->title }}
		      </button>
			  
			  @if ($todo->state > 0)
			  
			    <i class="fa fa-check-square fa-w-14 fa-2x text-success pull-right "></i>
				
			  @else 
				  
			    <i class="fa fa-check-square fa-w-14 fa-2x text-success pull-right " id="chStateLabelTodo" style="display:none;"></i>
				
			  @endif

		    </h5>
	      </div>
	      <div id="{{ $todo->id }}" class="collapse" aria-labelledby="heading{{ $todo->id }}" data-parent="#accordion">
		    <div class="card-body break-word" id="dataDescriptionTodo">
		      {{ $todo->description }}
		    </div>

			<div class="btn-group btn-group-sm special" data-id="{{ $todo->id }}" data-state="{{ $todo->state }}" role="group" aria-label="Basic example">
              <button type="button" id="chStateTodo" class="btn btn-success" {{ $stateButton }}>Completato</button>
              <button type="button" data-toggle="modal" data-target=".editModalTodo"  class="btn btn-secondary editbtnTodo">Modifica</button>
              <form class="special-form" action="{{ route('deleteTodo', ['todo' => $todo->id]) }}" method="post">
		        {{ method_field('DELETE') }}
			    {{ csrf_field() }}
			    <button type="submit" class="btn btn-danger deleteBtn">Elimina</button>
			
			  </form>
            </div>
			 
	      </div>
	    </div>
	
	  @endforeach
	  
	  <!-- Edit ToDo Modal -->
      <div class="modal fade editModalTodo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modifica ToDo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			  <div class="alert alert-danger print-error-modal" style="display:none">
	  		    <ul></ul>
	  		  </div>
		      <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="titleModal" name="titleModal" placeholder="Titolo">
	  	      </div>
              <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea  class="form-control" id="descriptionModal" name="descriptionModal" placeholder="Descrizione"></textarea>
                <input type="hidden" id="idModal">
			  </div>
			 
			  <div class="form-group">
                <label for="radioBtn"> Completato</label>
			    
			    <div class="btn-group btn-group-toggle form-control" name="radioBtn" data-toggle="buttons">
				  
                  <label class="btn btn-secondary" id="stateYesModal">
                    <input type="radio" id="options"  autocomplete="off" value="1"> Si
                  </label>
                  <label class="btn btn-secondary" id="stateNoModal">
                    <input type="radio" id="options"  autocomplete="off" value="0"> No
                  </label>
                  
                </div>
				
			  </div>
			</div>
			<div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="dismissEditTodo" data-dismiss="modal">Chiudi</button>
              <button type="button" class="btn btn-success" id="submitEditTodo" >Salva</button>
            </div>
          </div>
        </div>
      </div>
	  
	@else
	  
      <div class="alert alert-secondary boxshadow" role="alert">
        ToDo Assenti!
      </div>
    
    @endif	
	
  </div>
 
@endsection	
