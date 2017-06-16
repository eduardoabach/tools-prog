<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Mover elementos teste</title>
	</head>
	<body>
    	<style type="text/css">
    		body {padding:10px}

			.quadrado {
				width:100px;
				height:100px;
				background-color:#666;
				color:white;
				padding:10px 12px;
				cursor:move;
			}
    	</style>

		<script>
			function draggable(id){
			   var obj = document.getElementById(id);
			   obj.style.position = "absolute";

			   obj.onmousedown = function(){
			      window.drag_obj = obj;
			      window.drag_obj_x = window.drag_x_pos - obj.offsetLeft;
			      window.drag_obj_y = window.drag_y_pos - obj.offsetTop;
			   }
			}
			 
			document.onmouseup = function(e){
			   window.drag_obj = null;
			};

			document.onmousemove = function(e){
			   window.drag_x_pos = document.all ? window.event.clientX : e.pageX;
			   window.drag_y_pos = document.all ? window.event.clientY : e.pageY;

			   if(window.drag_obj == null || window.drag_obj == undefined)
			      return;

			   window.drag_obj.style.left = (window.drag_x_pos - window.drag_obj_x) + 'px';
			   window.drag_obj.style.top = (window.drag_y_pos - window.drag_obj_y) + 'px';
			};
		</script>

    	<div id="a1" class='quadrado'>Mover 1!</div>
    	<div id="a2" class='quadrado'>Mover 2!</div>
    	<div id="a3" class='quadrado'>Mover 3!</div>

		<script>
			draggable('a1');
			draggable('a2');
			draggable('a3');
		</script>

	</body>
</html>