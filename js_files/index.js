function remove_todo(id){
        $.get("session_timeout.php", function(data){
          if(data==0){ window.location.href="logout.php";}
        });
        $.ajax({
          url: 'add-todo.php',
          type: 'post',
          data: {id:id,remove:'item'},
          success:function(){
     	      $("#display-todo").load("add-todo.php");
          }
        });
      };

      $(document).ready(function(){

        setInterval(function(){
          $.get("session_timeout.php", function(data){
            if(data==0) window.location.href="logout.php";
          });
        },600000);

        $.get("session_timeout.php", function(data){
          if(data==0){ window.location.href="logout.php";}
        });

        $('#telephone').mask('0000000000');

        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters only please"); 

        $("#todoregister").validate({
          rules:{
            phonenumber:{
              digits:true,
              required:true,
              minlength:10,
              maxlength:10
            }
          }
        });

        $("#todologin").validate();
	      $("#todo-add").click(function(){
          $.get("session_timeout.php", function(data){
            if(data==0){ window.location.href="logout.php";}
          });
    	    var item = $("#todo-item").val();
          if(item!=''){
            $.ajax({
              url: 'add-todo.php',
              type: 'post',
              data: {item:item,add:'item'},
              success: function(){
                $("#todo-item").val('');
                $("#display-todo").load("add-todo.php");
              }
            });
          }
        });

        $("#display-todo").load("add-todo.php");
      });