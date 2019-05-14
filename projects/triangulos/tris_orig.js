var c = createjs,
	subdiv = {},
	imgctx,
	t;

subdiv.subDividingTris = function() {

	var canvas = document.getElementById("canvas"),
		stage = new c.Stage(canvas),
		bgRect = new c.Shape,
		refPic = new Image(),
		imageContainer = new c.Container,
		//second canvas to store image data
		imgCanvas = document.createElement('canvas');
		

	function resize() {
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
		bgRect.graphics.clear().beginFill("333").drawRect(0, 0, canvas.width, canvas.height);
	//	imageContainer.x = canvas.width / 2;
	//	imageContainer.y = canvas.height / 2;
	}

	function onPress() {
		console.log("press");
		//createTri();
	}

	function createTri() {
		//pass tri x + y co-ords, and reference to stage

		//calculate mid point
		var newSize = 600;
		var triHeight =  Math.sqrt((newSize * newSize) - (newSize / 2)*(newSize/2));
		
		//tri parameters: x, y, side length, ref to stage, boolean for up.
		var tri = new subdiv.Tri(canvas.width/2, canvas.height/2 - (triHeight / 2), newSize, stage, true);
		//maths to center tri.

		//tri.x = 300;
		//tri.y = 300;
		stage.addChild(tri);
	}

	function imageLoaded(){
		//draw image to img context.
		imgCanvas.width = window.innerWidth;
		imgCanvas.height = window.innerHeight;
		imgctx.drawImage(refPic, window.innerWidth/2 - refPic.width/2,window.innerHeight/2 - refPic.height/2);
	}

	//load image in for tri colours
	imgctx = imgCanvas.getContext('2d')

	//look for params for image names
	var prmstr = window.location.search.substr(1);
	var prmarr = prmstr.split ("&");
	var params = {};

	for ( var i = 0; i < prmarr.length; i++) {
	    var tmparr = prmarr[i].split("=");
	    params[tmparr[0]] = tmparr[1];
	}

	console.log(params);
	if(params.pic){
		refPic.src = "img/"+params.pic+".jpg";
	}else{
		refPic.src = "img/01.jpg";
	}
	
	refPic.onload = imageLoaded;

	resize();
	window.onresize = resize;

	c.Ticker.setFPS(30);
	c.Ticker.addListener(stage);
	//stage.addChild(bgRect);

	//stage.addChild(centeredContainer);
	//bgRect.onPress = onPress;
	createTri();
	stage.enableMouseOver()
}


subdiv.Tri = function(_x, _y, tSize, _stage, _isUp) { this.initialize(_x, _y, tSize, _stage, _isUp); };
t = subdiv.Tri.prototype = new c.Shape;
t.Shape_initialize = t.initialize;
t.initialize = function(_x, _y, _triSize, _stage, _isUp) {
	//kind of a super constructor
	this.Shape_initialize();

	var tri = this,
		g = tri.graphics,
		triSize = _triSize,
		x = _x,
		y = _y,
		stage = _stage,
		triHeight = 0,
		isUp = _isUp;

	if(isUp){
		drawTriUp(x, y, triSize);
	}else{
		drawTriDown(x, y, triSize);
	}

	//this.onPress = subDivide;
	//this.onMouseOver = subDivide;
	this.onClick = subDivide;
	triHeight = calcTriHeight(triSize);
//	console.log(triHeight);
	//console.log(this.onPress);
	//this.addEventListener("mouseOver", this.handleMouseOver, this);

	/*function onPress() {
		createTri();
	}*/

/*	function handleMouseOver(event) {
	    var target = event.target;
	    console.log(target);
	}*/
	function triMidColour(_x, _y){
		//if(imgctx){
			//console.log(_x, _y);
			imgData = imgctx.getImageData(_x, _y, 1, 1);
			
			var rgba = imgData.data;
			return(rgba);
			//console.log(imgData);
			
			//console.log(refBitmap.getImageData(x, y, 1, 1).data);
			//imgData = imgctx.getImageData(100,100,1,1);
		/*}else{
			console.log("not yet");
		}*/
		
		//var imgd = context.getImageData(x, y, width, height);
		//var pix = imgd.data;
	}

	function drawTriUp(){

		//calculate center point of tri
		centerX = x - triHeight/2;
		centerY = y + triHeight/2;
		//console.log(centerX, centerY);
		
		//get pixel colour at that point
		var a = triMidColour(centerX, centerY);

		//set colour
		var cr = a[0];
		var cg = a[1];
		var cb = a[2];
		g.beginFill(c.Graphics.getRGB(cr, cg, cb));

		//draw tri	
		//g.setStrokeStyle(1);
		//g.beginStroke(c.Graphics.getRGB(0,0,0));
		g.moveTo(x, y);
		g.lineTo(Math.cos(degreesToRadians(60))*triSize +x, Math.sin(degreesToRadians(60))*triSize +y);
		g.lineTo(Math.cos(degreesToRadians(120))*triSize +x, Math.sin(degreesToRadians(120))*triSize +y);
		g.closePath();
	}

	function drawTriDown(x, y, triSize){
		//get pixel colour at that point
		var a = triMidColour(centerX, centerY);

		//set colour
		var cr = a[0];
		var cg = a[1];
		var cb = a[2];
		g.beginFill(c.Graphics.getRGB(cr, cg, cb));

		g.moveTo(x - (triSize/2), y);
		g.lineTo(Math.cos(degreesToRadians(0))*triSize +(x - (triSize/2)), Math.sin(degreesToRadians(0))*triSize +y);
		g.lineTo(Math.cos(degreesToRadians(60))*triSize +(x - (triSize/2)), Math.sin(degreesToRadians(60))*triSize +y);
		g.closePath();
	}

	function degreesToRadians(degIn){
		return (degIn*Math.PI)/180;
	}

	function subDivide(e){

		//kill current tri.
		e.target.parent.removeChild(e.target);

		//create new tris in its place ------------
		var newSize = triSize/2;  //new side length of little triangles
		//var triHeight = Math.sqrt((newSize * newSize) - (newSize / 2)*(newSize/2));
		var triHeight = calcTriHeight(newSize);
		//console.log(triHeight);
		//console.log(newSize);

		if(isUp){
			var tri = new subdiv.Tri(x, y, newSize, stage, true);
			var tri2 = new subdiv.Tri(x, y+triHeight, newSize, stage, false);
			var tri3 = new subdiv.Tri(x+(newSize/2), y+triHeight, newSize, stage, true);
			var tri4 = new subdiv.Tri(x-(newSize/2), y+triHeight, newSize, stage, true);
		}else{
			var tri = new subdiv.Tri(x, y+triHeight, newSize, stage, false);
			var tri2 = new subdiv.Tri(x, y, newSize, stage, true);
			var tri3 = new subdiv.Tri(x+(newSize/2), y, newSize, stage, false);
			var tri4 = new subdiv.Tri(x-(newSize/2), y, newSize, stage, false);
		}
		//tri.x = 300;
		//tri.y = 300;
		//how to add back to stage?
		stage.addChild(tri);
		stage.addChild(tri2);
		stage.addChild(tri3);
		stage.addChild(tri4);


	}

	function calcTriHeight(sideLength){
		var triHeight = Math.sqrt((sideLength * sideLength) - (sideLength / 2)*(sideLength/2));
		return triHeight;
	}

	//noun.onPress = onPress;
}